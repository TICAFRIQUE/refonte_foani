<?php

namespace App\Http\Controllers\backend;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\CategoriePage;
use App\Models\Categorie_page;
use App\Http\Controllers\Controller;
use App\Services\convertToMajuscule;

class PageController extends  Controller
{
    //index
    public function index()
    {
        try {
            $pages = Page::with('categorie')->get();
            return view('backend.pages.pages.pages.index', compact('pages'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    // index
    public function create()
    {
        try {
            $categories = CategoriePage::active()->get();
            return view('backend.pages.pages.pages.partials.create', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    // store
    public function store(Request $request)
    {
        // dd($request->all());

        // Validation des champs sauf visibilite
        $validated = $request->validate([
            'libelle' => 'required|string',
            'mot_cle' => 'nullable|string|max:255',
            'categorie_page_id' => 'required|exists:categorie_pages,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'description' => 'nullable|string',
            'statut' => 'required|boolean',
        ]);

        try {
            // Créer la page
            $page = Page::firstOrCreate([
                'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
                'mot_cle' => $request->mot_cle,
                'categorie_page_id' => $request->categorie_page_id,
                'description' => $request->description,
                'statut' => $request->statut
            ]);

            // enrgistrer l'image
            if ($request->hasFile('image')) {
                $page->addMediaFromRequest('image')
                    ->toMediaCollection('image');
            }

            return redirect()->route('pages.index')->with('success', 'La page a été créée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }


    // Edit
    public function edit(Request $request, $id)
    {

        try {
            $page = Page::findOrFail($request->id);
            $categories = CategoriePage::active()->get();
            return view('backend.pages.pages.pages.partials.edit', compact('page', 'categories'));
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    // Update
    public function update(Request $request, $id)
    {
        try {
            $page = Page::findOrFail($id);

            // Validation
            $validated = $request->validate([
                'libelle' => 'required|string|max:255',
                'mot_cle' => 'nullable|string|max:255',
                'categorie_page_id' => 'required|exists:categorie_pages,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
                'description' => 'nullable|string',
                'statut' => 'required|boolean',
            ]);

            // Vérifier le libellé unique
            if (Page::where('libelle', $request->libelle)->where('id', '!=', $id)->exists()) {
                return redirect()->back()->with('error', 'Une page avec ce libellé existe déjà')->withInput();
            }

            // Gérer l'image avec spatie
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($page->hasMedia('image')) {
                    $page->clearMediaCollection('image');
                }

                $page->addMediaFromRequest('image')
                    ->toMediaCollection('image');
            }

            $page->update([
                'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
                'mot_cle' => $request->mot_cle,
                'categorie_page_id' => $request->categorie_page_id,
                'description' => $request->description,
                'statut' => $request->statut,
            ]);

            return redirect()->route('pages.index')->with('success', 'La page a été mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }




    // Delete
    public function delete($id)
    {
        try {
            $page = Page::findOrFail($id);

            // Supprimer l'image si elle existe
            if ($page->hasMedia('image')) {
                $page->clearMediaCollection('image');
            }
            // Suppression définitive (comme dans ModuleController)
            $page->forceDelete();

            return response()->json([
                'status'  => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 500,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage(),
            ], 500);
        }
    }
}
