<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Produit;

class PanierController extends Controller
{
    // Afficher le panier
    public function index()
    {
        $panier_sessions = Session::get('panier', []);
        $panier = [];

        foreach ($panier_sessions as $id => $item) {
            $produit = Produit::find($id);
            if ($produit) {
                // On ajoute la quantité stockée en session à l'objet produit
                $produit->quantite = $item['quantite'];
                $panier[] = $produit;
            }
        }

        return view('frontend.pages.commande.panier', compact('panier'));
    }

    // Ajouter un produit au panier
    public function add(Request $request, $produit_id)
    {
        $produit = Produit::findOrFail($produit_id);
        $panier = Session::get('panier', []);

        if (isset($panier[$produit_id])) {
            $panier[$produit_id]['quantite'] += 1;
        } else {
            $panier[$produit_id] = [
                'quantite' => 1,
            ];
        }

        Session::put('panier', $panier);
        $count = array_sum(array_column($panier, 'quantite'));

        return response()->json([
            'success' => true,
            'count' => $count,
            'message' => 'Produit ajouté au panier.'
        ]);
    }

    // Mettre à jour la quantité d’un produit
    public function update(Request $request, $produit_id)
    {
        $quantite = (int) $request->input('quantite');
        $panier = Session::get('panier', []);

        if (isset($panier[$produit_id])) {
            $panier[$produit_id]['quantite'] = $quantite;
            Session::put('panier', $panier);
        }

        return response()->json(['success' => true]);
    }

    // Supprimer un produit du panier
    public function remove($produit_id)
    {
        $panier = Session::get('panier', []);
        if (isset($panier[$produit_id])) {
            unset($panier[$produit_id]);
            Session::put('panier', $panier);
        }

        return response()->json(['success' => true]);
    }


    //caisse
    public function caisse()
    {
        $panier_sessions = Session::get('panier', []);
        $panier = [];

        foreach ($panier_sessions as $id => $item) {
            $produit = Produit::find($id);
            if ($produit) {
                $produit->quantite = $item['quantite'];
                $panier[] = $produit;
            }
        }

        return view('frontend.pages.commande.caisse', compact('panier'));
    }
}
