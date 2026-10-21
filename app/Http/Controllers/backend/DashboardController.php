<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Contact;
use App\Models\Reservation;
use App\Models\User;
use App\Support\Periode;
use App\Support\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $periode = Periode::depuisRequete($request, 'mois');
        $precedente = $periode->precedente();

        // ---------- Indicateurs de la période (et de la période précédente pour l'évolution) ----------
        $actuel = $this->indicateurs($periode);
        $avant = $this->indicateurs($precedente);

        $kpis = [
            'ca' => $actuel['ca'],
            'ca_evol' => Periode::evolution($actuel['ca'], $avant['ca']),
            'montant' => $actuel['montant'],
            'montant_evol' => Periode::evolution($actuel['montant'], $avant['montant']),
            'commandes' => $actuel['commandes'],
            'commandes_evol' => Periode::evolution($actuel['commandes'], $avant['commandes']),
            'panier' => $actuel['commandes'] ? $actuel['montant'] / $actuel['commandes'] : 0,
            'clients' => $actuel['clients'],
            'clients_evol' => Periode::evolution($actuel['clients'], $avant['clients']),
            // À traiter (toutes périodes confondues)
            'en_attente' => Commande::where('statut', Statut::EN_ATTENTE)->count(),
            'en_cours' => Commande::where('statut', Statut::EN_COURS)->count(),
            'reservations' => Reservation::where('statut', Statut::EN_ATTENTE)->count(),
            'messages' => Contact::where('is_read', false)->count(),
            'total_clients' => $this->clientsQuery()->count(),
        ];

        // ---------- Répartition des commandes par statut sur la période ----------
        $repartition = Commande::whereBetween('created_at', $periode->bornes())
            ->select('statut', DB::raw('COUNT(*) as nombre'), DB::raw('SUM(total) as montant'))
            ->groupBy('statut')
            ->get()
            ->keyBy('statut');

        // ---------- Évolution sur 12 mois (mois sans commande = 0) ----------
        $debut12 = now()->subMonths(11)->startOfMonth();
        $parMois = Commande::where('created_at', '>=', $debut12)
            ->where('statut', '!=', Statut::ANNULEE)
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mois")
            ->selectRaw('SUM(total) as montant')
            ->selectRaw('SUM(CASE WHEN statut = ? THEN total ELSE 0 END) as encaisse', [Statut::LIVREE])
            ->selectRaw('COUNT(*) as nombre')
            ->groupBy('mois')
            ->get()
            ->keyBy('mois');

        $graphique = ['labels' => [], 'montant' => [], 'encaisse' => [], 'nombre' => []];
        for ($i = 0; $i < 12; $i++) {
            $mois = $debut12->copy()->addMonths($i);
            $ligne = $parMois->get($mois->format('Y-m'));
            $graphique['labels'][] = Str::ucfirst($mois->locale('fr')->translatedFormat('M y'));
            $graphique['montant'][] = (float) ($ligne->montant ?? 0);
            $graphique['encaisse'][] = (float) ($ligne->encaisse ?? 0);
            $graphique['nombre'][] = (int) ($ligne->nombre ?? 0);
        }

        // ---------- Classements de la période (commandes non annulées) ----------
        $topProduits = DB::table('commande_produit')
            ->join('commandes', 'commandes.id', '=', 'commande_produit.commande_id')
            ->join('produits', 'produits.id', '=', 'commande_produit.produit_id')
            ->whereBetween('commandes.created_at', $periode->bornes())
            ->where('commandes.statut', '!=', Statut::ANNULEE)
            ->groupBy('produits.id', 'produits.libelle')
            ->orderByDesc('quantite')
            ->limit(5)
            ->get(['produits.libelle', DB::raw('SUM(commande_produit.quantite) as quantite'), DB::raw('SUM(commande_produit.total) as montant')]);

        $topClients = Commande::whereBetween('created_at', $periode->bornes())
            ->where('statut', '!=', Statut::ANNULEE)
            ->groupBy('user_id', 'nom')
            ->orderByDesc('montant')
            ->limit(5)
            ->get(['nom', DB::raw('COUNT(*) as nombre'), DB::raw('SUM(total) as montant')]);

        $topCommunes = Commande::whereBetween('created_at', $periode->bornes())
            ->where('statut', '!=', Statut::ANNULEE)
            ->whereNotNull('commune')
            ->groupBy('commune')
            ->orderByDesc('nombre')
            ->limit(5)
            ->get(['commune', DB::raw('COUNT(*) as nombre'), DB::raw('SUM(total) as montant')]);

        // ---------- À traiter maintenant ----------
        $aTraiter = Commande::whereIn('statut', [Statut::EN_ATTENTE, Statut::EN_COURS])
            ->latest()
            ->take(6)
            ->get(['id', 'code', 'nom', 'commune', 'total', 'statut', 'created_at']);

        return view('backend.pages.index', compact(
            'periode', 'kpis', 'repartition', 'graphique', 'topProduits', 'topClients', 'topCommunes', 'aTraiter'
        ));
    }

    /** Indicateurs d'une période : CA encaissé (livrées), montant commandé, nb commandes, nouveaux clients. */
    private function indicateurs(Periode $p): array
    {
        $commandes = Commande::whereBetween('created_at', $p->bornes())
            ->selectRaw('SUM(CASE WHEN statut = ? THEN total ELSE 0 END) as ca', [Statut::LIVREE])
            ->selectRaw('SUM(CASE WHEN statut != ? THEN total ELSE 0 END) as montant', [Statut::ANNULEE])
            ->selectRaw('SUM(CASE WHEN statut != ? THEN 1 ELSE 0 END) as nombre', [Statut::ANNULEE])
            ->first();

        return [
            'ca' => (float) ($commandes->ca ?? 0),
            'montant' => (float) ($commandes->montant ?? 0),
            'commandes' => (int) ($commandes->nombre ?? 0),
            'clients' => $this->clientsQuery()->whereBetween('created_at', $p->bornes())->count(),
        ];
    }

    /** Clients = utilisateurs ayant le rôle client (les comptes admin ne sont pas comptés). */
    private function clientsQuery()
    {
        return User::where(function ($q) {
            $q->where('role', 'client')->orWhereHas('roles', fn ($r) => $r->where('name', 'client'));
        });
    }
}
