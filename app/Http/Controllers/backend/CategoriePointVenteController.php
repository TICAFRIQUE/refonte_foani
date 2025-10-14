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
            return view('backend.pages.points_de_ventes.categorie.index', compact('categories'));
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
            return view('backend.pages.points_de_ventes.categorie.partials.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Enregistrer une nouvelle catégorie.
     */
    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'titre_categorie' => 'required|string|max:255|unique:categorie_point_ventes,titre_categorie',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            ]);


            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/categories_point_vente'), $filename);
                $validated['image'] = 'uploads/categories_point_vente/' . $filename;
            }



            // mettre le titre en maj et sans accent
            $validated['titre_categorie'] = convertToMajuscule::toUpperNoAccent($request->titre_categorie);

            if (CategoriePointVente::where('titre_categorie', $validated['titre_categorie'])->exists()) {
                return redirect()->back()
                    ->with('error', 'La catégorie "' . $validated['titre_categorie'] . '" existe déjà')
                    ->withInput();
            }

            CategoriePointVente::create($validated);

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
            return view('backend.pages.points_de_ventes.categorie.partials.edit', compact('categorie'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Mettre à jour une catégorie.
     */
    public function update(Request $request, $id)
    {
        try {
            $categorie = CategoriePointVente::findOrFail($id);

            $validated = $request->validate([
                'titre_categorie' => 'required|string|max:255|unique:categorie_point_ventes,titre_categorie,' . $id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            if ($request->hasFile('image')) {
                // Suppression de l’ancienne image
                if ($categorie->image && File::exists(public_path($categorie->image))) {
                    File::delete(public_path($categorie->image));
                }

                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/categories_point_vente'), $filename);
                $validated['image'] = 'uploads/categories_point_vente/' . $filename;
            }
            // mettre le titre en maj et sans accent
            $validated['titre_categorie'] = convertToMajuscule::toUpperNoAccent($request->titre_categorie);
            if (CategoriePointVente::where('titre_categorie', $validated['titre_categorie'])->exists()) {
                return redirect()->back()
                    ->with('error', 'La catégorie "' . $validated['titre_categorie'] . '" existe déjà')
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
    public function destroy($id)
    {
        try {
            $categorie = CategoriePointVente::findOrFail($id);

            if ($categorie->image && File::exists(public_path($categorie->image))) {
                File::delete(public_path($categorie->image));
            }

            $categorie->delete();

            return redirect()->route('categorie_point_de_vente.index')->with('success', 'Catégorie supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
