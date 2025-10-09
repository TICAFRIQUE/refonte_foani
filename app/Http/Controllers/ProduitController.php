<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use App\Models\TypeOffre;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\convertToMajuscule;
use Illuminate\Support\Facades\Auth;

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
            $categories = Categorie::active()->alphabetique()->get(); // Catégories actives
            $typeoffres = TypeOffre::active()->alphabetique()->get(); // Types d'offres actifs

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
                'type_offre_id' => 'nullable|exists:type_offres,id',
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
                'image_principale' => 'required|image|mimes:jpg,jpeg,png,gif|max:1024',
                'autre_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',

            ]);

            if (Produit::where('libelle', $request->libelle)
                ->where('prix_de_vente', $request->prix_de_vente)
                ->exists()
            ) {
                return redirect()->route('produit.index')->with('error', 'Le produit existe déjà.');
            }
            // Convertir le libellé en majuscules sans accents
            $validated['libelle'] = convertToMajuscule::toUpperNoAccent($request->libelle);
            // Générer un code produit si vide
            $validated['code'] = 'PROD-' . Str::upper(Str::random(6));
            // Assigner l'ID de l'utilisateur authentifié
            $validated['user_id'] = Auth::user()->id;

            // Créer une nouvelle instance de Produit
            $produit = Produit::create($validated);

            // Gestion de l'image principale
            if ($request->hasFile('image_principale')) {
                $produit->addMediaFromRequest('image_principale')
                    ->toMediaCollection('image_principale');
            }

            // Gestion des images multiples
            if ($request->hasFile('autre_images')) {
                foreach ($request->file('autre_images') as $image) {
                    $produit->addMedia($image)
                        ->toMediaCollection('autre_images');
                }
            }

            return redirect()->route('produit.index')->with('success', 'Produit ajouté avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la création d\'un produit : ' . $e->getMessage());
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
            $validated = $request->validate([
                'libelle' => 'required|string|max:255',
                'categorie_id' => 'required|exists:categories,id',
                'type_offre_id' => 'nullable|exists:type_offres,id',
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
                'image_principale' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
                'autre_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
                'supprimer_image_principale' => 'nullable|boolean',
                'supprimer_autres_images' => 'nullable|array',
            ]);

            $produit = Produit::findOrFail($id);

            // Vérification d’unicité personnalisée
            $existe = Produit::where('libelle', $request->libelle)
                ->where('prix_de_vente', $request->prix_de_vente)
                ->where('id', '!=', $id)
                ->exists();

            if ($existe) {
                return redirect()->back()->with('error', 'Un produit identique existe déjà.');
            }

            $validated['libelle'] = convertToMajuscule::toUpperNoAccent($request->libelle);

            $produit->update($validated);

            // Slug recalculé
            $produit->slug = Str::slug($produit->libelle . '-' . $produit->id);
            $produit->save();

            // Suppression image principale
            if ($request->boolean('supprimer_image_principale')) {
                $produit->clearMediaCollection('image_principale');
            }

            // Ajout ou remplacement image principale
            if ($request->hasFile('image_principale')) {
                $produit->clearMediaCollection('image_principale');
                $produit->addMediaFromRequest('image_principale')
                    ->toMediaCollection('image_principale');
            }

            // Suppression des images multiples cochées
            if ($request->has('supprimer_autres_images')) {
                foreach ($request->supprimer_autres_images as $mediaId) {
                    $media = $produit->getMedia('autre_images')->where('id', $mediaId)->first();
                    if ($media) {
                        $media->delete();
                    }
                }
            }

            // Ajout de nouvelles images multiples
            if ($request->hasFile('autre_images')) {
                foreach ($request->file('autre_images') as $image) {
                    $produit->addMedia($image)
                        ->toMediaCollection('autre_images');
                }
            }

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
            // supprimer les médias associés
            $produit = Produit::findOrFail($id);
            $produit->clearMediaCollection('image_principale');
            $produit->clearMediaCollection('autre_images');
            // supprimer le produit
            $produit->delete();

            return response()->json([
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('produit.index')
                ->with('error', 'Impossible de supprimer ce produit : ' . $e->getMessage());
        }
    }
}
