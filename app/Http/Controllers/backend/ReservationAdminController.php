<?php


namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ReservationAdminController extends Controller
{
    // Liste des réservations
    public function index()
    {
        try {
            $reservations = Reservation::with(['user', 'produit'])->latest()->get();
            return view('backend.pages.reservations.index', compact('reservations'));
        } catch (Exception $e) {
            Alert::error('Erreur', 'Impossible de charger les réservations');
            return back();
        }
    }

    // Affichage d'une réservation
    public function show($id)
    {

        try {
            $reservation = Reservation::with(['user', 'produit'])->findOrFail($id);

            return view('backend.pages.reservations.partials.show', compact('reservation'));
        } catch (Exception $e) {
            Alert::error('Erreur', 'Réservation introuvable');
            return back();
        }
    }

    // Mise à jour
    public function update(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);

            $request->validate([
                'statut' => 'required|string',
            ]);

            $reservation->update([
                'statut' => $request->statut,
            ]);

            Alert::success('Succès', 'Statut de la réservation mis à jour avec succès');
            return redirect()->route('reservations.index', $reservation->id);
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
