<?php

namespace App\Http\Controllers\backend;

use App\Models\Ville;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\convertToMajuscule;

class CommuneLivraisonController extends Controller
{
    public function index()
    {
        try {
            $communes = Commune::with('ville')->get();
            $villes = Ville::all(); // pour le select dans le create/edit
            return view('backend.pages.point_de_livraison.communes.index', compact('communes', 'villes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du chargement des communes : ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'ville_id' => 'required|exists:villes,id',
            'frais_de_port' => 'required|numeric',
        ]);

        try {
            Commune::firstOrCreate([
                'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
                'ville_id' => $request->ville_id,
                'frais_de_port' => $request->frais_de_port,
                'statut' => true,
            ]);
            return redirect()->route('commune.index')->with('success', 'Commune ajoutée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible d’ajouter la commune : ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'ville_id' => 'required|exists:villes,id',
            'frais_de_port' => 'required|numeric',
        ]);

        try {
            $commune = Commune::findOrFail($id);
            $commune->update([
                'libelle' => convertToMajuscule::toUpperNoAccent($request->libelle),
                'ville_id' => $request->ville_id,
                'frais_de_port' => $request->frais_de_port,
                'statut' => $request->statut,
            ]);
            return redirect()->route('commune.index')->with('success', 'Commune mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible de mettre à jour la commune : ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $commune = Commune::findOrFail($id);
            $commune->delete();
            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Impossible de supprimer la commune : ' . $e->getMessage()]);
        }
    }
}
