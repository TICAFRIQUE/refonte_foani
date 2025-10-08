<?php

namespace App\Http\Controllers;

use App\Models\CommuneLivraison;
use App\Models\VilleLivraison;
use Illuminate\Http\Request;

class CommuneLivraisonController extends Controller
{
    public function index()
    {
        try {
            $communes = CommuneLivraison::with('ville')->get();
            $villes = VilleLivraison::all(); // pour le select dans le create/edit
            return view('backend.pages.point_de_livraison.communes.index', compact('communes', 'villes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du chargement des communes : ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {


        $request->validate([
            'libelle' => 'required|string|max:255',
            'id_ville_livraison' => 'required|exists:ville_livraisons,id',
            'frais_de_port' => 'nullable|numeric',
        ]);
        //   dd($request->all());
        try {
            CommuneLivraison::create($request->all());
            return redirect()->route('commune.index')->with('success', 'Commune ajoutée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible d’ajouter la commune : ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'id_ville_livraison' => 'required|exists:ville_livraisons,id',
            'frais_de_port' => 'nullable|numeric',
        ]);

        try {
            $commune = CommuneLivraison::findOrFail($id);
            $commune->update($request->all());
            return redirect()->route('commune.index')->with('success', 'Commune mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible de mettre à jour la commune : ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $commune = CommuneLivraison::findOrFail($id);
            $commune->delete();
            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Impossible de supprimer la commune : ' . $e->getMessage()]);
        }
    }
}
