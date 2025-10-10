<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\TypeOffre;
use App\Services\convertToMajuscule;
use Illuminate\Http\Request;

class TypeOffreController extends Controller
{
    /**
     * Affiche la liste des types d’offres
     */
    public function index()
    {
        $types_offres = TypeOffre::alphabetique()->get();
        return view('backend.pages.offres.index', compact('types_offres'));
    }

    /**
     * Enregistre un nouveau type d’offre
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validation
        $validated = $request->validate([
            'slug'        => 'nullable|string|max:255',
            'libelle'     => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut'      => 'required|boolean',
        ]);

        //verifier si le nom existe déjà
        if (TypeOffre::where('libelle', $request->libelle)->exists()) {
            return redirect()->route('offre.index')
                ->with('error', 'L\'offre existe déjà.');
        }
        TypeOffre::firstOrCreate([
            'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
            'description' => $request->description,
            'statut' => $request->statut,
            'slug' => $request->slug,
        ]);
        return redirect()->route('offre.index')
            ->with('success', 'L\'offre a été ajoutée avec succès.');
    }



    /**
     * Met à jour un type d’offre
     */
    public function update(Request $request, $id)
    {
        try {
            $type_offre = TypeOffre::findOrFail($id);
            // Validation
            $validated = $request->validate([
                'libelle'     => 'required|string|max:255',
                'description' => 'nullable|string',
                'statut'      => 'required|boolean',
            ]);

            if (TypeOffre::where('libelle', $request->libelle)->where('id', '!=', $id)->exists()) {
                return redirect()->route('offre.index')->with('error', "L'offre existe déjà");
            }

            $validated['libelle'] = convertToMajuscule::toUpperNoAccent($request->libelle);
            $type_offre->update($validated);

            return redirect()->route('offre.index')
                ->with('success', 'L\'offre a été mise à jour avec succès.');
        } catch (\Throwable $th) {
            return redirect()->route('offre.index')->with('error', "Erreur lors de la mise à jour de l'offre");
        }
    }

    /**
     * Supprime un type d’offre
     */
    public function delete($id)
    {
        try {
            TypeOffre::findOrFail($id)->forceDelete();
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('offre.index')
                ->with('error', 'Impossible de supprimer cette offre : ' . $e->getMessage());
        }
    }
}
