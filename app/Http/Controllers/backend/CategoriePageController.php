<?php

namespace App\Http\Controllers\backend;

use Exception;
use Illuminate\Http\Request;
use App\Models\CategoriePage;
use App\Models\Categorie_page;
use App\Models\Categorie\backend;
use App\Http\Controllers\Controller;
use App\Services\convertToMajuscule;

class CategoriePageController extends Controller
{
    //index / liste des categories
    public function index()
    {
        try {
            $categories = CategoriePage::all();
            return view('backend.pages.pages.categories.index', compact('categories'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    // store
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'libelle' => 'required|string',
            'statut' => 'required|boolean',
        ]);
        try {

            // Vérification de l'existence
            if (CategoriePage::where('libelle', $request->libelle)->exists()) {
                return redirect()->back()->with('error', 'Cette catégorie existe déjà.');
            }

            // Création de la catégorie
            CategoriePage::firstOrcreate([
                'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
                'statut' => $request->statut
            ]);

            return redirect()->back()->with('success', 'La catégorie a été créée avec succès.');
        } catch (Exception $e) {
            // Gestion des autres erreurs (ex: SQL, logique, etc.)
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'statut' => 'required|boolean',
        ]);
        try {

            // Récupération de la catégorie existante
            $categorie = CategoriePage::findOrFail($id);

            // Vérification de l’existence d’un doublon (autre que celle en cours)
            $exists = CategoriePage::where('libelle', $request->libelle)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()->with('error', 'Une autre catégorie porte déjà ce titre.');
            }



            // Mise à jour
            $categorie->update([
                'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
                'statut' => $request->statut
            ]);

            return redirect()->back()->with('success', 'La catégorie a été mise à jour avec succès.');
        } catch (Exception $e) {
            // Capture toute autre erreur
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            // Vérifie si la catégorie existe
            $categorie = CategoriePage::findOrFail($id);

            // Suppression de la catégorie
            $categorie->forceDelete();
            return response()->json([
                'status' => 200,
            ]);

        } catch (Exception $e) {
            // Erreur générale (conflit de clé étrangère, etc.)
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression : ' . $e->getMessage());
        }
    }
}
