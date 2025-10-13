<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie_page;
use App\Models\Page;
use App\Services\convertToMajuscule;
use Illuminate\Http\Request;

class PageController extends  Controller
{
    //index
    public function index()
    {
        $pages = Page::with(['categorie'])->get();

        return view('backend.pages.gestions_pages.pages.index', ['pages' => $pages]);
    }

    // index
    public function create()
    {
        return view('backend.pages.gestions_pages.pages.partials.create', ['categories' => Categorie_page::all()]);
    }

    // store
    public function store(Request $request)
    {
        try {
            // Validation des champs sauf visibilite
            $validated = $request->validate([
                'titre' => 'required|string|max:255',
                'mot_cle' => 'nullable|string|max:255',
                'id_categorie_page' => 'required|exists:categorie_pages,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
                'contenu' => 'nullable|string',
            ]);

            // Vérifier si une page avec le même titre existe déjà
            if (Page::where('titre', $request->titre)->exists()) {
                return redirect()->back()->with('error', 'Une page avec ce titre existe déjà')->withInput();
            }

            // mettre le titre en majuscule sans accent
            $validated['titre'] = convertToMajuscule::toUpperNoAccent($request->titre);

            // Checkbox → bool
            $validated['visibilite'] = $request->has('visibilite') && $request->visibilite === 'on';

            // Créer la page
            Page::create($validated);

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
            $categories = Categorie_page::all();
            return view('backend.pages.gestions_pages.pages.partials.edit', compact('page', 'categories'));
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
                'titre' => 'required|string|max:255',
                'mot_cle' => 'nullable|string|max:255',
                'id_categorie_page' => 'required|exists:categorie_pages,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
                'contenu' => 'nullable|string',
            ]);

            // Vérifier le titre unique
            if (Page::where('titre', $request->titre)->where('id', '!=', $id)->exists()) {
                return redirect()->back()->with('error', 'Une page avec ce titre existe déjà')->withInput();
            }

            // Gérer l'image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/pages'), $filename);
                $validated['image'] = 'uploads/pages/' . $filename;

                // Supprimer l'ancienne
                if ($page->image && file_exists(public_path($page->image))) {
                    unlink(public_path($page->image));
                }
            }

            // Checkbox visibilite → bool
            $validated['visibilite'] = $request->has('visibilite') ? true : false;

            // Titre en majuscule sans accent
            $validated['titre'] = convertToMajuscule::toUpperNoAccent($request->titre);

            $page->update($validated);

            return redirect()->route('pages.index')->with('success', 'La page a été mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }


    // Delete
    public function delete(Request $request, $id)
    {

        try {
            $page = Page::findOrFail($request->id);

            // Supprimer l'image si elle existe
            if ($page->image && file_exists(public_path($page->image))) {
                unlink(public_path($page->image));
            }

            $page->delete();

            return redirect()->route('pages.index')->with('success', 'La page a été supprimée avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('pages.index')->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
