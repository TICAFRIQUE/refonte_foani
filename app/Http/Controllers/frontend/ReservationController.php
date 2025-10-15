<?php

namespace App\Http\Controllers\frontend;

use App\Models\Commune;
use App\Models\Produit;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    //creer une reservation
    public function create($slug)
    {
        try {
            $produit = Produit::where('slug', $slug)->firstOrFail();
            // recuperer les communes et villes de livraison
            $communes = Commune::active()->alphabetique()->get();

            return view('frontend.pages.commande.reservation', compact('slug', 'produit', 'communes'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('boutique.index')->with('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
        }
    }


    //stocker une reservation
    public function store(Request $request, $id)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'commune_id' => 'required|exists:communes,id',
            'quartier' => 'required|string|max:255',
            'commentaire' => 'nullable|string|max:500',
        ]);

        try {
            $produit = Produit::findOrFail($id);
            $commune = Commune::findOrFail($request->commune_id);

            $prix_unitaire = $produit->prix_de_vente;
            $quantite = $request->quantite;
            $sous_total = $prix_unitaire * $quantite;
            $frais_livraison = $commune->frais_de_port;
            $total = $sous_total + $frais_livraison;

            // Vérification du montant minimum
            if ($total < 5000) {
                return back()->withInput()->with('error', 'Le montant total à payer doit être au moins 5 000 FCFA pour valider la réservation.');
            }

            // Enregistrement de la réservation
            Reservation::create([
                'code'           => uniqid('RES-'),
                'nom'            => $request->nom,
                'telephone'      => $request->telephone,
                'adresse'        => $request->quartier,
                'ville'          => $commune->ville->libelle ?? null,
                'commune'        => $commune->libelle,
                'produit_id'     => $produit->id,
                'prix_unitaire'  => $prix_unitaire,
                'sous_total'     => $sous_total,
                'frais_livraison' => $frais_livraison,
                'total'          => $total,
                'date_reservation' => now(),
                'commentaire'    => $request->commentaire,
                'statut'         => 'en_attente',
                'user_id'        => Auth::id(),
            ]);

            return back()->with('success', 'Votre réservation a bien été envoyée.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Une erreur est survenue lors de la création de la réservation : ' . $th->getMessage());
        }
    }
}
