<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie\backend;
use App\Models\Categorie_page;
use App\Services\convertToMajuscule;
use Exception;
use Illuminate\Http\Request;

class CategoriePageController extends Controller
{
    //index / liste des categories
    public function index()
    {
        return view('backend.pages.gestions_pages.categories.index', [
            'categories' =>  $categories = Categorie_page::all(),
        ]);
    }

    // store
    public function store(Request $request)
    {
        try {
            // Validation des données
            $validated = $request->validate([
                'titre' => 'required|string|max:100',
            ]);

            // Vérification de l'existence
            if (Categorie_page::where('titre', $request->titre)->exists()) {
                return redirect()->back()->with('error', 'Cette catégorie existe déjà.');
            }

            // Conversion du titre en majuscules sans accent
            $validated['titre'] = convertToMajuscule::toUpperNoAccent($request->titre);

            // Création de la catégorie
            Categorie_page::create($validated);

            return redirect()->back()->with('success', 'La catégorie a été créée avec succès.');
        } catch (Exception $e) {
            // Gestion d'une erreur de validation
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        } catch (Exception $e) {
            // Gestion des autres erreurs (ex: SQL, logique, etc.)
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            // Validation des données
            $validated = $request->validate([
                'titre' => 'required|string|max:255',
            ]);

            // Récupération de la catégorie existante
            $categorie = Categorie_page::findOrFail($id);

            // Vérification de l’existence d’un doublon (autre que celle en cours)
            $exists = Categorie_page::where('titre', $request->titre)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()->with('error', 'Une autre catégorie porte déjà ce titre.');
            }

            // Conversion du titre en majuscules sans accent
            $validated['titre'] = convertToMajuscule::toUpperNoAccent($request->titre);

            // Mise à jour
            $categorie->update($validated);

            return redirect()->back()->with('success', 'La catégorie a été mise à jour avec succès.');
        } catch (Exception $e) {
            // Retourne les erreurs de validation
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        } catch (Exception $e) {
            // Capture toute autre erreur
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }


    public function delete($id)
    {
        try {
            // Vérifie si la catégorie existe
            $categorie = Categorie_page::findOrFail($id);

            // Suppression
            $categorie->delete();

            return redirect()->back()->with('success', 'La catégorie a été supprimée avec succès.');
        } catch (Exception $e) {
            // Si l'ID n'existe pas
            return redirect()->back()->with('error', 'Catégorie introuvable.');
        } catch (Exception $e) {
            // Erreur générale (conflit de clé étrangère, etc.)
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression : ' . $e->getMessage());
        }
    }
}
