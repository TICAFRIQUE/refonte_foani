<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TypeOffre;
use Illuminate\Http\Request;

class TypeOffreController extends Controller
{
    /**
     * Affiche la liste des types d’offres
     */
    public function index()
    {
        $types_offres = TypeOffre::paginate(25);
        return view('backend.pages.offres.index', compact('types_offres'));
    }

    /**
     * Enregistre un nouveau type d’offre
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'slug'        => 'nullable|string|max:255',
            'libelle'     => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut'      => 'required|boolean',
        ]);

        TypeOffre::create($validated);

        return redirect()->route('offre.index')
            ->with('success', 'L\'offre a été ajoutée avec succès.');
    }

    /**
     * Affiche le formulaire d’édition
     */
    public function edit(Request $request)
    {

        $type_offre = TypeOffre::findOrFail($request->id);

        // dd($type_offres->slug);
        return view('backend.pages.offres.edit', compact('type_offre'));
    }

    /**
     * Met à jour un type d’offre
     */
    public function update(Request $request, TypeOffre $type_offre)
    {

      
        // Validation
        $validated = $request->validate([
            'libelle'     => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut'      => 'required|boolean',
        ]);

        $type_offre->update($validated);

        return redirect()->route('offre.index')
            ->with('success', 'L\'offre a été mise à jour avec succès.');
    }

    /**
     * Supprime un type d’offre
     */
    public function delete(TypeOffre $type_offre)
    {
        $type_offre->delete();

        return redirect()->route('offre.index')
            ->with('success', 'L\'offre a été supprimée avec succès.');
    }
}
