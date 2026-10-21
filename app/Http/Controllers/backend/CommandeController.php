<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use App\Models\Commande;
use App\Support\Periode;
use App\Support\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CommandeController extends Controller
{
    // Liste des commandes
    // public function index()
    // {
    //     try {
    //         $commandes = Commande::with(['user', 'produits'])->orderBy('created_at' , 'desc')->get();
    //         return view('backend.pages.commandes.index', compact('commandes'));
    //     } catch (Exception $e) {
    //         Alert::error('Erreur', 'Impossible de charger les commandes');
    //         return back();
    //     }
    // }

    // Liste des commandes : onglets de statut, période, recherche, pagination
    public function index(Request $request)
    {
        try {
            [$base, $periode] = $this->requeteFiltree($request);

            // Statut affiché : celui demandé, sinon « en attente » (la liste à traiter)
            $statut = $request->has('statut') ? $request->input('statut') : Statut::EN_ATTENTE;

            // Compteurs par statut (même période / recherche) pour les onglets
            $parStatut = (clone $base)
                ->select('statut', DB::raw('COUNT(*) as nombre'), DB::raw('SUM(total) as montant'))
                ->groupBy('statut')
                ->get()
                ->keyBy('statut');

            $commandes = (clone $base)
                ->when($statut !== null && $statut !== '', fn ($q) => $q->where('statut', $statut))
                ->latest()
                ->paginate(25, ['id', 'code', 'user_id', 'nom', 'telephone', 'commune', 'ville', 'total', 'statut', 'created_at'])
                ->withQueryString();

            return view('backend.pages.commandes.index', compact('commandes', 'parStatut', 'statut', 'periode'));
        } catch (Exception $e) {
            report($e);
            Alert::error('Erreur', 'Impossible de charger les commandes');
            return back();
        }
    }

    // Export CSV des commandes (mêmes filtres que la liste)
    public function export(Request $request)
    {
        [$query] = $this->requeteFiltree($request);
        $query->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->input('statut')))->latest();

        $fichier = 'commandes-' . now()->format('Y-m-d-His') . '.csv';

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF"); // BOM : accents corrects dans Excel
            fputcsv($out, ['Code', 'Date', 'Client', 'Téléphone', 'Commune', 'Ville', 'Sous-total', 'Livraison', 'Total', 'Statut'], ';');
            $query->chunk(500, function ($lignes) use ($out) {
                foreach ($lignes as $c) {
                    fputcsv($out, [
                        $c->code, $c->created_at?->format('d/m/Y H:i'), $c->nom, $c->telephone, $c->commune, $c->ville,
                        (int) $c->sous_total, (int) $c->frais_livraison, (int) $c->total, Statut::label($c->statut),
                    ], ';');
                }
            });
            fclose($out);
        }, $fichier, ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /** Requête de base : période (facultative) + recherche. Retourne [requête, Periode|null]. */
    private function requeteFiltree(Request $request): array
    {
        $avecPeriode = $request->filled('periode') || $request->filled('date_debut') || $request->filled('date_fin');
        $periode = $avecPeriode ? Periode::depuisRequete($request) : null;
        $recherche = trim((string) $request->input('q'));

        $query = Commande::query()
            ->when($periode, fn ($q) => $q->whereBetween('created_at', $periode->bornes()))
            ->when($recherche !== '', function ($q) use ($recherche) {
                $q->where(function ($q) use ($recherche) {
                    $q->where('code', 'like', "%{$recherche}%")
                        ->orWhere('nom', 'like', "%{$recherche}%")
                        ->orWhere('telephone', 'like', "%{$recherche}%")
                        ->orWhere('commune', 'like', "%{$recherche}%");
                });
            });

        return [$query, $periode];
    }

    // Affichage d'une commande
    public function show($id)
    {
        try {
            $commande = Commande::with(['user', 'produits.media'])->findOrFail($id);
            return view('backend.pages.commandes.partials.show', compact('commande'));
        } catch (Exception $e) {
            Alert::error('Erreur', 'Commande introuvable');
            return back();
        }
    }



    // Mise à jour d'une commande
    public function update(Request $request, $id)
    {
        // Validation hors du try : un statut invalide suit le circuit d'erreurs standard de Laravel
        $request->validate(['statut' => Statut::regle()]);

        try {
            $commande = Commande::findOrFail($id);

            $commande->statut = $request->statut;
            // date de livraison renseignée au passage à « livrée »
            if ($request->statut === Statut::LIVREE && !$commande->date_livraison) {
                $commande->date_livraison = now();
            }
            $commande->save();

            Alert::toast('Commande ' . $commande->code . ' : ' . Statut::label($commande->statut), 'success');
            return redirect()->route('commandes.show', $commande->id);
        } catch (Exception $e) {
            Alert::error('Erreur', 'Erreur lors de la mise à jour : ' . $e->getMessage());
            return back()->withInput();
        }
    }

    // Suppression d'une commande
    public function delete($id)
    {
        try {
            $commande = Commande::findOrFail($id);
            $commande->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Commande supprimée avec succès',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage(),
            ]);
        }
    }



    /**
     * Retourne les dernières commandes (JSON) pour le polling.
     */
    public function newOrders(Request $request)
    {
        try {
            // récupérer seulement les commandes des 2 dernières minutes (nouvelles)
            $orders = Commande::with('user')
                ->whereIn('statut', ['en_attente', 'nouveau'])
                ->where('created_at', '>=', now()->subMinutes(2))
                ->orderByDesc('created_at')
                ->get();

            $payload = $orders->map(function ($o) {
                return [
                    'id' => $o->id,
                    'code' => $o->code ?? 'CMD-' . $o->id,
                    'client_name' => $o->user?->username ?? ($o->nom ?? 'Client'),
                    'telephone' => $o->telephone ?? $o->user?->telephone ?? '',
                    'total' => (float) ($o->total ?? 0),
                    'created_at' => $o->created_at?->toDateTimeString(),
                    'created_at_display' => $o->created_at?->format('d/m/Y H:i'),
                    'statut' => $o->statut,
                    'show_url' => route('commandes.show', $o->id),
                ];
            });

            return response()->json([
                'count' => $orders->count(),
                'orders' => $payload,
            ]);
        } catch (\Throwable $e) {
            Log::error('newOrders error: ' . $e->getMessage());
            return response()->json(['count' => 0, 'orders' => []], 500);
        }
    }
}
