<?php


namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Reservation;
use App\Support\Periode;
use App\Support\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ReservationAdminController extends Controller
{
    // Liste des réservations : onglets de statut, période, recherche, pagination
    public function index(Request $request)
    {
        try {
            [$base, $periode] = $this->requeteFiltree($request);
            $statut = $request->has('statut') ? $request->input('statut') : Statut::EN_ATTENTE;

            $parStatut = (clone $base)
                ->select('statut', DB::raw('COUNT(*) as nombre'), DB::raw('SUM(total) as montant'))
                ->groupBy('statut')
                ->get()
                ->keyBy('statut');

            $reservations = (clone $base)
                ->with('produit:id,libelle')
                ->when($statut !== null && $statut !== '', fn ($q) => $q->where('statut', $statut))
                ->latest()
                ->paginate(25)
                ->withQueryString();

            return view('backend.pages.reservations.index', compact('reservations', 'parStatut', 'statut', 'periode'));
        } catch (Exception $e) {
            report($e);
            Alert::error('Erreur', 'Impossible de charger les réservations');
            return back();
        }
    }

    // Export CSV des réservations (mêmes filtres que la liste)
    public function export(Request $request)
    {
        [$query] = $this->requeteFiltree($request);
        $query->with('produit:id,libelle')
            ->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->input('statut')))
            ->latest();

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['Code', 'Date', 'Client', 'Téléphone', 'Produit', 'Quantité', 'Commune', 'Total', 'Statut'], ';');
            $query->chunk(500, function ($lignes) use ($out) {
                foreach ($lignes as $r) {
                    fputcsv($out, [
                        $r->code, $r->created_at?->format('d/m/Y H:i'), $r->nom, $r->telephone, $r->produit?->libelle,
                        (int) $r->quantite, $r->commune, (int) $r->total, Statut::label($r->statut),
                    ], ';');
                }
            });
            fclose($out);
        }, 'reservations-' . now()->format('Y-m-d-His') . '.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /** Requête de base : période (facultative) + recherche. Retourne [requête, Periode|null]. */
    private function requeteFiltree(Request $request): array
    {
        $avecPeriode = $request->filled('periode') || $request->filled('date_debut') || $request->filled('date_fin');
        $periode = $avecPeriode ? Periode::depuisRequete($request) : null;
        $recherche = trim((string) $request->input('q'));

        $query = Reservation::query()
            ->when($periode, fn ($q) => $q->whereBetween('created_at', $periode->bornes()))
            ->when($recherche !== '', function ($q) use ($recherche) {
                $q->where(function ($q) use ($recherche) {
                    $q->where('code', 'like', "%{$recherche}%")
                        ->orWhere('nom', 'like', "%{$recherche}%")
                        ->orWhere('telephone', 'like', "%{$recherche}%")
                        ->orWhere('commune', 'like', "%{$recherche}%")
                        ->orWhereHas('produit', fn ($p) => $p->where('libelle', 'like', "%{$recherche}%"));
                });
            });

        return [$query, $periode];
    }

    // Affichage d'une réservation
    public function show($id)
    {

        try {
            $reservation = Reservation::with(['user', 'produit.media'])->findOrFail($id);

            return view('backend.pages.reservations.partials.show', compact('reservation'));
        } catch (Exception $e) {
            Alert::error('Erreur', 'Réservation introuvable');
            return back();
        }
    }

    // Mise à jour
    public function update(Request $request, $id)
    {
        // Validation hors du try : un statut invalide suit le circuit d'erreurs standard de Laravel
        $request->validate(['statut' => Statut::regle()]);

        try {
            $reservation = Reservation::findOrFail($id);

            $reservation->update(['statut' => $request->statut]);

            Alert::toast('Réservation ' . $reservation->code . ' : ' . Statut::label($reservation->statut), 'success');
            return redirect()->route('reservations.show', $reservation->id);
        } catch (Exception $e) {
            Alert::error('Erreur', 'Erreur lors de la mise à jour : ' . $e->getMessage());
            return back()->withInput();
        }
    }


    // Suppression d'une réservation
    public function delete($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();

            return response()->json([
                'status'  => 200,

            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => 500,
            ], 500);
        }
    }

    // Compte des nouvelles réservations
    public function newReservationCount(Request $request)
    {
        try {
            // Récupérer les dernières réservations en attente (adapter 'en_attente' si nécessaire)
            $reservations = Reservation::with(['produit', 'user'])
                ->where('statut', 'en_attente')
                ->where('created_at', '>=', now()->subMinutes(2))
                ->latest()
                ->take(6)
                ->get();

            $payload = $reservations->map(function ($r) {
                return [
                    'id'         => $r->id,
                    'code'       => $r->code ?? 'RES-' . $r->id,
                    'nom'        => $r->nom,
                    'produit'    => $r->produit->libelle ?? null,
                    'quantite'   => (int) ($r->quantite ?? 1),
                    'total'      => (int) ($r->total ?? 0),
                    'created_at' => optional($r->created_at)->diffForHumans(),
                    'url'        => route('reservations.show', $r->id),
                ];
            });

            return response()->json([
                'status'       => 200,
                'count'        => $reservations->count(),
                'reservations' => $payload,
            ]);
        } catch (Exception $e) {
            Log::error('newReservationCount error: ' . $e->getMessage());
            return response()->json([
                'status'  => 500,
                'message' => 'Erreur serveur',
            ], 500);
        }
    }
}
