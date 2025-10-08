<?php

namespace App\Http\Controllers;

use App\Models\VilleLivraison;
use Illuminate\Http\Request;

class VilleLivraisonController extends Controller
{
    public function index()
    {
        try {
            $villes = VilleLivraison::all();
            return view('backend.pages.point_de_livraison.ville.index', compact('villes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du chargement des villes : ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate(['libelle' => 'required|string|max:255']);

        try {
            VilleLivraison::create([
                'libelle' => $request->libelle,
            ]);

            return redirect()->route('ville.index')->with('success', 'Ville ajoutée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible d’ajouter la ville : ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate(['libelle' => 'required|string|max:255']);

        try {
            $ville = VilleLivraison::findOrFail($id);
            $ville->update(['libelle' => $request->libelle]);

            return redirect()->route('ville.index')->with('success', 'Ville mise à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Impossible de mettre à jour la ville : ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $ville = VilleLivraison::findOrFail($id);
            $ville->delete();

            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Impossible de supprimer la ville : ' . $e->getMessage()]);
        }
    }
}
