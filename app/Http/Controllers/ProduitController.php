<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\TypeOffre;
use App\Services\convertToMajuscule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    /**
     * Affiche la liste des produits actifs.
     */
    public function index()
    {
        try {
            // Récupérer les produits actifs avec leurs relations
            $produits = Produit::with(['categorie', 'typeOffres'])
                ->where('statut', 1)
                ->orderByDesc('created_at')
                ->get();

            // Retourner la vue avec les données
            return view('backend.pages.produits.index', compact('produits'));
        } catch (\Exception $e) {
            // En cas d'erreur, logguer et rediriger avec un message
            redirect()->route('produit.index')->with('error', 'Erreur lors du chargement des produits : ' . $e->getMessage());

            return redirect()->back()->with('error', "Une erreur est survenue lors du chargement des produits.");
        }
    }



    /**
     * Afficher le formulaire de création de produit
     */
    public function create()
    {
        try {
            $categories = Categorie::where('statut', 1)->get(); // Catégories actives
            $typeoffres = TypeOffre::where('statut', 1)->get(); // Types d'offres actifs

            return view('backend.pages.produits.partials.create', compact('categories', 'typeoffres'));
        } catch (\Exception $e) {
            redirect()->back()->with('error', 'Erreur lors de l\'affichage du formulaire de création de produit : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Impossible de charger le formulaire de création du produit.');
        }
    }

    /**
     * Stocker un nouveau produit
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'libelle' => 'required|string|max:255',
                'categorie_id' => 'required|exists:categories,id',
                'type_offre_id' => 'required|exists:type_offres,id',
                'prix_achat' => 'nullable|numeric',
                'prix_de_vente' => 'nullable|numeric',
                'frais_de_port' => 'nullable|numeric',
                'stock' => 'nullable|integer',
                'type_reduction' => 'nullable|in:montant,pourcentage',
                'valeur_reduction' => 'nullable|numeric',
                'date_debut_reduction' => 'nullable|date',
                'date_fin_reduction' => 'nullable|date|after_or_equal:date_debut_reduction',
                'visibilite' => 'nullable|boolean',
                'statut' => 'nullable|boolean',
                'description' => 'nullable|string',
            ]);

            if (Produit::where('libelle', $request->libelle)
                ->where('prix_de_vente', $request->prix_de_vente)
                ->exists()
            ) {
                return redirect()->route('produit.index')->with('error', 'Le produit existe déjà.');
            }

            $validated['libelle'] = convertToMajuscule::toUpperNoAccent($request->libelle);

            // Créer une nouvelle instance de Produit
            $produit = new Produit($validated);

            // Générer un code produit si vide
            if (!$produit->code) {
                $produit->code = 'PROD-' . Str::upper(Str::random(6));
            }

            // Générer un slug unique
            $produit->slug = Str::slug($produit->libelle . '-' . time());

            $produit->save();

            return redirect()->route('produit.index')->with('success', 'Produit ajouté avec succès.');
        } catch (\Exception $e) {
            redirect()->back()->with('error', 'Erreur lors de la création d\'un produit : ' . $e->getMessage());
            return redirect()->route('produit.index')->with('error', 'Une erreur est survenue lors de l\'ajout du produit.');
        }
    }


    public function edit($id)
    {
        try {
            // Récupère le produit avec ses relations
            $produit = Produit::with(['categorie', 'typeOffres'])->findOrFail($id);

            // Vérifie que le produit est actif
            if ($produit->statut != 1) {
                return redirect()
                    ->route('produit.index')
                    ->with('error', 'Produit introuvable ou inactif.');
            }

            // Récupère uniquement les catégories et types d’offres actifs
            $categories = Categorie::where('statut', 1)->get(['id', 'libelle']);
            $typeoffres = TypeOffre::where('statut', 1)->get(['id', 'libelle']);

            return view('backend.pages.produits.partials.edit', compact('produit', 'categories', 'typeoffres'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du chargement de l’édition du produit : ' . $e->getMessage());
        }
    }






    /**
     * Mettre à jour un produit
     */
    public function update(Request $request, $id)
    {
        try {

            // ✅ Validation des données
            $validated = $request->validate([
                'libelle' => 'required|string|max:255',
                'categorie_id' => 'required|exists:categories,id',
                'type_offre_id' => 'required|exists:type_offres,id',
                'prix_achat' => 'nullable|numeric',
                'prix_de_vente' => 'nullable|numeric',
                'frais_de_port' => 'nullable|numeric',
                'stock' => 'nullable|integer',
                'type_reduction' => 'nullable|in:montant,pourcentage',
                'valeur_reduction' => 'nullable|numeric',
                'date_debut_reduction' => 'nullable|date',
                'date_fin_reduction' => 'nullable|date',
                'visibilite' => 'nullable|boolean',
                'statut' => 'nullable|boolean',
                'description' => 'nullable|string',
            ]);

            // ✅ Récupération du produit
            $produit = Produit::findOrFail($id);

            // ✅ Vérification d’unicité personnalisée
            $existe = Produit::where('libelle', $request->libelle)
                ->where('prix_de_vente', $request->prix_de_vente)
                ->where('id', '!=', $id)
                ->exists();

            if ($existe) {
                return redirect()->back()->with('error', 'Un produit identique existe déjà.');
            }

            // ✅ Mise à jour du produit
            $produit->update($validated);

            // ✅ Recalcule du slug (si libellé changé)
            $produit->slug = Str::slug($produit->libelle . '-' . $produit->id);
            $produit->save();

            return redirect()->route('produit.index')->with('success', 'Produit mis à jour avec succès.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
    /**
     * Supprimer un produit
     */

    public function delete($id)
    {
        try {
            Produit::findOrFail($id)->forceDelete();
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('produit.index')
                ->with('error', 'Impossible de supprimer ce produit : ' . $e->getMessage());
        }
    }
}
