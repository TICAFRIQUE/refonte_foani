<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CategoriePointVente;
use App\Services\convertToMajuscule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoriePointVenteController extends Controller
{
    /**
     * Afficher la liste des catégories de points de vente.
     */
    public function index()
    {
        try {
            $categories = CategoriePointVente::latest()->get();
            return view('backend.pages.gestion_points_de_ventes.categorie.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        try {
            return view('backend.pages.gestion_points_de_ventes.categorie.partials.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Enregistrer une nouvelle catégorie.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'statut' => 'required|boolean',
        ]);

        try {

            if (CategoriePointVente::where('libelle', $request->libelle)->exists()) {
                return redirect()->back()
                    ->with('error', 'La catégorie "' . $request['libelle'] . '" existe déjà')
                    ->withInput();
            }

            $CategoriePointVente = CategoriePointVente::firstOrCreate([
                'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
                'statut' => $request->statut,
            ]);

            // Upload de l’image avec spatie
            if ($request->hasFile('image')) {
                $CategoriePointVente->addMediaFromRequest('image')
                    ->toMediaCollection('image');
            }

            return redirect()->route('categorie_point_de_vente.index')->with('success', 'Catégorie ajoutée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Afficher le formulaire d’édition.
     */
    public function edit($id)
    {
        try {
            $categorie = CategoriePointVente::findOrFail($id);
            return view('backend.pages.gestion_points_de_ventes.categorie.partials.edit', compact('categorie'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Mettre à jour une catégorie.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'statut' => 'required|boolean',
        ]);

        try {
            $categorie = CategoriePointVente::findOrFail($id);
            if ($request->hasFile('image')) {
                //supprimer limage associeee precedente
                $categorie->clearMediaCollection('image');
                //ajouter la nouvelle image
                $categorie->addMediaFromRequest('image')
                    ->toMediaCollection('image');
            }
            // mettre le libelle en maj et sans accent
            $validated['libelle'] = convertToMajuscule::toUpperNoAccent($validated['libelle']);

            //verifier si une autre categorie a le meme libelle
            if (CategoriePointVente::where('libelle', $validated['libelle'])->where('id', '!=', $id)->exists()) {
                return redirect()->back()
                    ->with('error', 'La catégorie "' . $validated['libelle'] . '" existe déjà')
                    ->withInput();
            }

            $categorie->update($validated);

            return redirect()->route('categorie_point_de_vente.index')->with('success', 'Catégorie mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Supprimer une catégorie.
     */
    public function delete($id)
    {
        try {
            $categorie = CategoriePointVente::findOrFail($id);

            // Supprimer l’image associée si elle existe
            $categorie->clearMediaCollection('image');
            $categorie->delete();

           return response()->json([
               'status' => 200,
               'message' => 'Catégorie supprimée avec succès.'
           ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()
            ]);
        }
    }
}
