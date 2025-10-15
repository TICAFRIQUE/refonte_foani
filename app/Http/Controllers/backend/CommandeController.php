<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class CommandeController extends Controller
{
    // Liste des commandes
    public function index()
    {
        try {
            $commandes = Commande::with(['user', 'produits'])->latest()->get();
            return view('backend.pages.commandes.index', compact('commandes'));
        } catch (Exception $e) {
            Alert::error('Erreur', 'Impossible de charger les commandes');
            return back();
        }
    }




    // Affichage d'une commande
    public function show($id)
    {
        try {
            $commande = Commande::with('user', 'produits')->findOrFail($id);
            return view('backend.pages.commandes.partials.show', compact('commande'));
        } catch (Exception $e) {
            Alert::error('Erreur', 'Commande introuvable');
            return back();
        }
    }



    // Mise à jour d'une commande
    public function update(Request $request, $id)
    {
        try {
            $commande = Commande::findOrFail($id);

            $request->validate([
                'statut' => 'required|string',
            ]);

            $commande->update([
                'statut' => $request->statut,
            ]);

            // mettre à jour la date de livraison si le statut est "livrée"
            if ($request->statut === 'livrée' && !$commande->date_livraison) {
                $commande->date_livraison = now();
                $commande->save();
            }

            Alert::success('Succès', 'Commande mise à jour avec succès');
            return redirect()->route('commandes.index', $commande->id);
        } catch (Exception $e) {
            Alert::error('Erreur', 'Erreur lors de la mise à jour : ' . $e->getMessage());
            return back()->withInput();
        }
    }

    // Suppression d'une commande
    public function destroy($id)
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
}
