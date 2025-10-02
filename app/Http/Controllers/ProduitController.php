<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\TypeOffre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    /**
     * Afficher la liste des produits
     */
    public function index()
    {
        $produits = Produit::with(['categories', 'typeOffres'])->orderBy('id', 'desc')->paginate(10);
        $categories = Categorie::all();
        $typeoffres = TypeOffre::all();

        return view('backend.pages.produits.index', compact('produits', 'categories', 'typeoffres'));
    }

    /**
     * Stocker un nouveau produit
     */
    public function store(Request $request)
    {
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

        // Créer une nouvelle instance de Produit
        $produit = new Produit($validated);

        // Générer un code produit si vide
        if (!$produit->code) {
            $produit->code = 'PROD-' . Str::upper(Str::random(6));
        }

        // Générer un slug unique
        $produit->slug = Str::slug($produit->libelle . '-' . time());

        $produit->save();

        return redirect()->back()->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Afficher la modale d'édition (optionnel si modal inline)
     */
    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        $typeoffres = TypeOffre::all();
        return view('backend.pages.produits.edit', compact('produit', 'categories', 'typeoffres'));
    }

    /**
     * Mettre à jour un produit
     */
    public function update(Request $request, Produit $produit)
    {
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

        $produit->update($validated);

        // Mettre à jour le slug si le libelle change
        $produit->slug = Str::slug($produit->libelle . '-' . $produit->id);
        $produit->save();

        return redirect()->back()->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Supprimer un produit
     */
    public function delete(Produit $produit)
    {
        $produit->delete();
        return redirect()->back()->with('success', 'Produit supprimé avec succès.');
    }
}
