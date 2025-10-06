<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\convertToMajuscule;
use RealRashid\SweetAlert\Facades\Alert;

class CategorieController extends Controller
{
    // Affiche la liste des catégories (index)
    public function index()
    {
        $categories = Categorie::alphabetique()->get();
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
        //verifier le nom existe dejà
        if (Categorie::where('libelle', $request->libelle)->exists()) {
            return redirect()->route('categorie.index')
                ->with('error', 'La catégorie existe déjà.');
        }

        Categorie::firstOrCreate([
            'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
            'description' => $request->description,
            'statut' => $request->statut,
        ]);

        return redirect()->route('categorie.index')
            ->with('success', 'La catégorie a été ajoutée avec succès.');
    }

    // Met à jour une catégorie existante (depuis modal Edit)
    public function update(Request $request, $id)
    {

        try {
            $categorie = Categorie::findOrFail($id);

            $validated = $request->validate([
                'libelle' => 'required|string|max:255',
                'description' => 'nullable|string',
                'statut' => 'required|boolean',
            ]);

            //verifier le nom existe dejà
            if (Categorie::where('libelle', $request->libelle)->where('id', '!=', $id)->exists()) {
                return redirect()->route('categorie.index')
                    ->with('error', 'La catégorie existe déjà.');
            }

            $validated['libelle'] = convertToMajuscule::toUpperNoAccent($request->libelle);

            $categorie->update($validated);


            // Alert::success('Succès', 'La catégorie a été mise à jour avec succès.');
            // return redirect()->route('categorie.index');

            return redirect()->route('categorie.index')
                ->with('success', 'La catégorie a été mise à jour avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('categorie.index')
                ->with('error', 'Erreur lors de la mise à jour de la catégorie : ' . $th->getMessage());
        }
    }

    // Supprime une catégorie
    public function delete($id)
    {
        try {
            Categorie::findOrFail($id)->forceDelete();
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('categorie.index')
                ->with('error', 'Impossible de supprimer cette catégorie : ' . $e->getMessage());
        }
    }
}
