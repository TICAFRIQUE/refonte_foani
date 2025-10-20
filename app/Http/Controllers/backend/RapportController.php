<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Produit;

class RapportController extends Controller
{
    // Rapport de vente avec filtre date et détail des produits
    public function rapportVente(Request $request)
    {
        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');

        // Récupérer les commandes livrées filtrées par date
        $ventes = Commande::with(['user', 'produits'])
            ->when($date_debut, fn($q) => $q->whereDate('created_at', '>=', $date_debut))
            ->when($date_fin, fn($q) => $q->whereDate('created_at', '<=', $date_fin))
            ->statut('livrée')
            ->orderByDesc('created_at')
            ->get();

        // Récupérer les produits vendus avec quantités et totaux
        $produits = [];
        foreach ($ventes as $vente) {
            foreach ($vente->produits as $produit) {
                $id = $produit->id;
                if (!isset($produits[$id])) {
                    $produits[$id] = [
                        'libelle' => $produit->libelle,
                        'quantite' => 0,
                        'total' => 0,
                    ];
                }
                $produits[$id]['quantite'] += $produit->pivot->quantite ?? 1;
                $produits[$id]['total'] += ($produit->pivot->prix_unitaire ?? $produit->prix_de_vente) * ($produit->pivot->quantite ?? 1);
            }
        }

        $total = $ventes->sum('total');


        return view('backend.pages.rapports.vente', compact('date_debut', 'date_fin', 'ventes', 'total', 'produits'));
    }
}
