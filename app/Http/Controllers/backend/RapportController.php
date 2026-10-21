<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Support\Periode;
use App\Support\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Rapport de ventes : tout est calculé en SQL (sommes, regroupements),
 * sans charger les commandes en mémoire.
 */
class RapportController extends Controller
{
    public function rapportVente(Request $request)
    {
        $periode = Periode::depuisRequete($request, 'mois');
        $base = $this->base($request);
        $precedente = $periode->precedente();

        $actuel = $this->totaux($base, $periode);
        $avant = $this->totaux($base, $precedente);

        $kpis = [
            'ca' => $actuel->ca,
            'ca_evol' => Periode::evolution($actuel->ca, $avant->ca),
            'commandes' => $actuel->nombre,
            'commandes_evol' => Periode::evolution($actuel->nombre, $avant->nombre),
            'panier' => $actuel->nombre ? $actuel->ca / $actuel->nombre : 0,
            'livraison' => $actuel->livraison,
            'articles' => (int) $this->lignes($base, $periode)->sum('commande_produit.quantite'),
        ];

        // Ventes par produit (avec catégorie)
        $produits = $this->lignes($base, $periode)
            ->join('produits', 'produits.id', '=', 'commande_produit.produit_id')
            ->leftJoin('categories', 'categories.id', '=', 'produits.categorie_id')
            ->groupBy('produits.id', 'produits.libelle', 'categories.libelle')
            ->orderByDesc('montant')
            ->get([
                'produits.libelle',
                DB::raw('categories.libelle as categorie'),
                DB::raw('SUM(commande_produit.quantite) as quantite'),
                DB::raw('SUM(commande_produit.total) as montant'),
                DB::raw('COUNT(DISTINCT commandes.id) as commandes'),
            ]);
        $totalProduits = max(1, (float) $produits->sum('montant'));

        // Ventes par catégorie
        $categories = $produits->groupBy(fn ($p) => $p->categorie ?: 'Sans catégorie')
            ->map(fn ($g, $nom) => (object) ['nom' => $nom, 'quantite' => $g->sum('quantite'), 'montant' => $g->sum('montant')])
            ->sortByDesc('montant')
            ->values();

        // Ventes par commune de livraison
        $communes = $this->commandes($base, $periode)
            ->groupBy('commune')
            ->orderByDesc('montant')
            ->limit(10)
            ->get([DB::raw("COALESCE(NULLIF(commune, ''), 'Non renseignée') as commune"), DB::raw('COUNT(*) as nombre'), DB::raw('SUM(total) as montant')]);

        // Courbe : par jour (période ≤ 62 jours) ou par mois
        $parJour = $periode->nombreDeJours() <= 62;
        $format = $parJour ? '%Y-%m-%d' : '%Y-%m';
        $serie = $this->commandes($base, $periode)
            ->selectRaw("DATE_FORMAT(created_at, '{$format}') as cle, SUM(total) as montant, COUNT(*) as nombre")
            ->groupBy('cle')
            ->pluck('montant', 'cle');

        $graphique = ['labels' => [], 'montant' => []];
        $curseur = $periode->debut->copy();
        while ($curseur->lte($periode->fin)) {
            $cle = $curseur->format($parJour ? 'Y-m-d' : 'Y-m');
            $graphique['labels'][] = $parJour ? $curseur->format('d/m') : Str::ucfirst($curseur->locale('fr')->translatedFormat('M Y'));
            $graphique['montant'][] = (float) ($serie[$cle] ?? 0);
            $parJour ? $curseur->addDay() : $curseur->addMonthNoOverflow();
        }

        return view('backend.pages.rapports.vente', [
            'periode' => $periode,
            'base' => $request->input('base', 'livrees'),
            'kpis' => $kpis,
            'produits' => $produits,
            'totalProduits' => $totalProduits,
            'categories' => $categories,
            'communes' => $communes,
            'graphique' => $graphique,
            'parJour' => $parJour,
        ]);
    }

    // Export CSV des ventes par produit
    public function export(Request $request)
    {
        $periode = Periode::depuisRequete($request, 'mois');
        $produits = $this->lignes($this->base($request), $periode)
            ->join('produits', 'produits.id', '=', 'commande_produit.produit_id')
            ->leftJoin('categories', 'categories.id', '=', 'produits.categorie_id')
            ->groupBy('produits.libelle', 'categories.libelle')
            ->orderByDesc('montant')
            ->get(['produits.libelle', DB::raw('categories.libelle as categorie'), DB::raw('SUM(commande_produit.quantite) as quantite'), DB::raw('SUM(commande_produit.total) as montant')]);

        $nom = 'rapport-ventes-' . $periode->debut->format('Y-m-d') . '-au-' . $periode->fin->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($produits, $periode) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['Rapport de ventes FOANI', $periode->libelle()], ';');
            fputcsv($out, ['Produit', 'Catégorie', 'Quantité vendue', 'Montant (FCFA)'], ';');
            foreach ($produits as $p) {
                fputcsv($out, [$p->libelle, $p->categorie, (int) $p->quantite, (int) $p->montant], ';');
            }
            fputcsv($out, ['TOTAL', '', (int) $produits->sum('quantite'), (int) $produits->sum('montant')], ';');
            fclose($out);
        }, $nom, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /** Statuts pris en compte : livrées (encaissé) ou toutes sauf annulées. */
    private function base(Request $request): array
    {
        return $request->input('base') === 'toutes'
            ? ['operateur' => '!=', 'statut' => Statut::ANNULEE]
            : ['operateur' => '=', 'statut' => Statut::LIVREE];
    }

    private function commandes(array $base, Periode $p)
    {
        return Commande::whereBetween('created_at', $p->bornes())->where('statut', $base['operateur'], $base['statut']);
    }

    private function lignes(array $base, Periode $p)
    {
        return DB::table('commande_produit')
            ->join('commandes', 'commandes.id', '=', 'commande_produit.commande_id')
            ->whereBetween('commandes.created_at', $p->bornes())
            ->where('commandes.statut', $base['operateur'], $base['statut']);
    }

    private function totaux(array $base, Periode $p): object
    {
        $t = $this->commandes($base, $p)
            ->selectRaw('COALESCE(SUM(total), 0) as ca, COUNT(*) as nombre, COALESCE(SUM(frais_livraison), 0) as livraison')
            ->first();

        return (object) ['ca' => (float) $t->ca, 'nombre' => (int) $t->nombre, 'livraison' => (float) $t->livraison];
    }
}
