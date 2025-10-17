<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\User;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CommandeController extends Controller
{
    // Liste des commandes
    public function index()
    {
        try {
            $commandes = Commande::with(['user', 'produits'])->orderBy('created_at' , 'desc')->get();
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
