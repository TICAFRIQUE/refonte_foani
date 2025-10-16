<?php


namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

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
            return redirect()->route('reservation.index', $reservation->id);
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
}
