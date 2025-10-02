<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategorieController extends Controller
{
    // Affiche la liste des catégories (index)
    public function index()
    {
        $categories = Categorie::paginate(25); // pagination
        return view('backend.pages.categorie.index', compact('categories'));
    }

    // Stocke une nouvelle catégorie (depuis modal Create)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|boolean',
        ]);

        Categorie::create($validated);

        return redirect()->route('categorie.index')
            ->with('success', 'La catégorie a été ajoutée avec succès.');
    }

    // Met à jour une catégorie existante (depuis modal Edit)
    public function update(Request $request, $id)
    {

        $categorie = Categorie::findOrFail($id);

        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut' => 'required|boolean',
        ]);

        $categorie->update($validated);

        return redirect()->route('categorie.index')
            ->with('success', 'La catégorie a été mise à jour avec succès.');
    }

    // Supprime une catégorie
    public function delete(Request $request)
    {
       

        $categorie = Categorie::findOrFail($request->id);

        try {
            $categorie->delete();
            return redirect()->route('categorie.index')
                ->with('success', 'La catégorie a été supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('categorie.index')
                ->with('error', 'Impossible de supprimer cette catégorie : ' . $e->getMessage());
        }
    }
}
