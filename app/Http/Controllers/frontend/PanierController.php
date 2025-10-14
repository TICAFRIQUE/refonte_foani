<?php

namespace App\Http\Controllers\frontend;

use App\Models\Ville;
use App\Models\Commune;
use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        // recuperer les communes et villes de livraison
        $villes = Ville::active()->alphabetique()->get();
        $communes = Commune::active()->alphabetique()->get();

        return view('frontend.pages.commande.caisse', compact('panier', 'villes', 'communes'));
    }

    // public function commandeStore(Request $request)
    // {
    //     // Vérifier si l'utilisateur est connecté
    //     if (!Auth::check()) {
    //         return redirect()->route('user.loginForm')->with('error', 'Veuillez vous connecter pour valider votre commande.');
    //     }

    //     // Validation des données du formulaire
    //     $request->validate([
    //         'username' => 'required|string|max:255',
    //         'phone' => 'required|string|max:20',
    //         'email' => 'email|max:255',
    //         'commune' => 'required|exists:communes,id',
    //         'quartier' => 'required|string|max:255',
    //         'frais_livraison' => 'required|numeric',
    //         'sous_total' => 'required|numeric',
    //         'total_general' => 'required|numeric',
    //     ]);

    //     $panier_sessions = Session::get('panier', []);
    //     if (empty($panier_sessions)) {
    //         return redirect()->back()->with('error', 'Votre panier est vide.');
    //     }

    //     $commune = Commune::find($request->commune);
    //     $ville = Ville::find($commune->ville_id);

    //     try {
    //         \DB::beginTransaction();

    //         $commande = Commande::create([
    //             'user_id'      => Auth::id(),
    //             'code'         => uniqid('CMD-'),
    //             'sous_total'   => $request->sous_total,
    //             'frais_livraison' => $request->frais_livraison,
    //             'total'        => $request->total_general,
    //             'nom'          => $request->username,
    //             'telephone'    => $request->phone,
    //             'adresse'      => $request->quartier,
    //             'ville'        => $ville->libelle,
    //             'commune'      => $commune->libelle,
    //             'statut'       => 'en_attente',
    //             'mode_paiement' => 'espece',
    //             'date_commande' => now(),
    //         ]);

    //         foreach ($panier_sessions as $id => $item) {
    //             $produit = Produit::find($id);
    //             if ($produit) {
    //                 $commande->produits()->attach($produit->id, [
    //                     'quantite' => $item['quantite'],
    //                     'prix_unitaire' => $produit->prix_de_vente,
    //                     'total' => $produit->prix_de_vente * $item['quantite'],
    //                 ]);
    //             }
    //         }

    //         Session::forget('panier');
    //         \DB::commit();

    //         return redirect()->route('panier.index')->with('success', 'Commande enregistrée avec succès !');
    //     } catch (\Exception $e) {
    //         \DB::rollBack();
    //         return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement de la commande.');
    //     }
    // }


    public function commandeStore(Request $request)
    {
        // 🔐 Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()
                ->route('user.loginForm')
                ->with('error', 'Veuillez vous connecter pour valider votre commande.');
        }

        // 🧾 Validation des données du formulaire
        $request->validate([
            'username'        => 'required|string|max:255',
            'phone'           => 'required|string|max:10|min:10',
            'email'           => 'nullable|email|max:255',
            'commune'         => 'required|exists:communes,id',
            'quartier'        => 'required|string|max:255',
            'frais_livraison' => 'required|numeric',
            'sous_total'      => 'required|numeric',
            'total_general'   => 'required|numeric',
        ], [
            'commune.exists' => 'La commune choisie n\'existe pas.',
            'phone.required' => 'Le numéro de téléphone est obligatoire pour vous contacter.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            //le numero de telephone doit contenir 10 chiffres minimum
            'phone.min' => 'Le numéro de téléphone doit contenir au moins 10 chiffres.',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 10 chiffres.',
        ]);

        // 🛒 Vérification du panier en session
        $panier_sessions = Session::get('panier', []);
        if (empty($panier_sessions)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        // 📍 Récupération des infos de la commune et ville
        $commune = Commune::findOrFail($request->commune);
        $ville = Ville::find($commune->ville_id);

        try {
            // 💾 Transaction : tout ou rien
            DB::transaction(function () use ($request, $panier_sessions, $commune, $ville) {

                // 🔸 Création de la commande
                $commande = Commande::create([
                    'user_id'        => Auth::id(),
                    'code'           => uniqid('CMD-'),
                    'sous_total'     => $request->sous_total,
                    'frais_livraison' => $request->frais_livraison,
                    'total'          => $request->total_general,
                    'nom'            => $request->username,
                    'telephone'      => $request->phone,
                    'adresse'        => $request->quartier,
                    'ville'          => $ville->libelle ?? '',
                    'commune'        => $commune->libelle,
                    'statut'         => 'en_attente',
                    'mode_paiement'  => 'espece',
                    'date_commande'  => now(),
                ]);

                // 🔹 Enregistrement des produits liés à la commande
                foreach ($panier_sessions as $id => $item) {
                    $produit = Produit::find($id);
                    if ($produit) {
                        $commande->produits()->attach($produit->id, [
                            'quantite'      => $item['quantite'],
                            'prix_unitaire' => $produit->prix_de_vente,
                            'total'         => $produit->prix_de_vente * $item['quantite'],
                        ]);
                    }
                }

                // 🧹 Nettoyer le panier après succès
                Session::forget('panier');
            });

            // ✅ Si tout s’est bien passé
            return redirect()
                ->route('panier.index')
                ->with('success', 'Commande enregistrée avec succès !');
        } catch (\Exception $e) {
            // ❌ En cas d’erreur
            return redirect()
                ->back()
                ->with('error', "Erreur lors de l'enregistrement de la commande : " . $e->getMessage());
        }
    }
}
