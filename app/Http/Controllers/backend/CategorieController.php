<?php

namespace App\Http\Controllers\backend;

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
        try {
            $categories = Categorie::position()->get();
            return view('backend.pages.categorie.index', compact('categories'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Erreur lors du chargement des catégories : ' . $th->getMessage());
        }
    }

    // Stocke une nouvelle catégorie (depuis modal Create)
    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'libelle' => 'required|string|max:255',
                'description' => 'nullable|string',
                'statut' => 'required|boolean',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            //verifier le nom existe dejà
            if (Categorie::where('libelle', $request->libelle)->exists()) {
                return redirect()->route('categorie.index')
                    ->with('error', 'La catégorie existe déjà.');
            }
            // compter le nombre de categories existantes pour definir la position
            $data_count = Categorie::count();

            $categorie = Categorie::firstOrCreate([
                'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
                'description' => $request->description,
                'statut' => $request->statut,
                'position' => $data_count + 1,
            ]);

            // Gestion de l'image 
            if ($request->hasFile('image')) {
                $categorie->addMediaFromRequest('image')
                    ->toMediaCollection('image');
            }


            return redirect()->route('categorie.index')
                ->with('success', 'La catégorie a été ajoutée avec succès.');
        } catch (\Throwable $th) {

            return back()->with('error', 'Erreur lors de l\'ajout de la catégorie : ' . $th->getMessage());
        }
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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'position' => 'required|integer',
            ]);

            //verifier le nom existe dejà
            if (Categorie::where('libelle', $request->libelle)->where('id', '!=', $id)->exists()) {
                return redirect()->route('categorie.index')
                    ->with('error', 'La catégorie existe déjà.');
            }

            $validated['libelle'] = convertToMajuscule::toUpperNoAccent($request->libelle);

            $categorie->update($validated);
            // Gestion de l'image 
            if ($request->hasFile('image')) {
                //supprimer limage associee
                if ($categorie->hasMedia('image')) {
                    $categorie->clearMediaCollection('image');
                }
                $categorie->addMediaFromRequest('image')
                    ->toMediaCollection('image');
            }


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
            //supprimer limage associee
            $categorie = Categorie::findOrFail($id);
            if ($categorie->hasMedia('image')) {
                $categorie->clearMediaCollection('image');
            }

            //mettre a jour la position des autres categories
            $categories = Categorie::where('position', '>', $categorie->position)->get();
            foreach ($categories as $cat) {
                $cat->position = $cat->position - 1;
                $cat->save();
            }

            // Suppression de la catégorie
            $categorie->forceDelete();
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('categorie.index')
                ->with('error', 'Impossible de supprimer cette catégorie : ' . $e->getMessage());
        }
    }
}
