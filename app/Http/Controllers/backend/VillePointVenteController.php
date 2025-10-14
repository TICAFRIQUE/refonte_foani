<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Commune;
use App\Models\Ville;
use App\Models\VillePointVente;
use Illuminate\Http\Request;

class VillePointVenteController extends Controller
{
    /**
     * Afficher la liste des villes liées aux points de vente
     */
    public function index()
    {
        try {
            $ville_point_ventes = VillePointVente::with(['ville', 'commune'])->latest()->get();
            $villes = Ville::all();
            $communes = Commune::all();

            return view('backend.pages.points_de_ventes.gestions_points_de_vente.index', compact('ville_point_ventes', 'villes', 'communes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors du chargement : ' . $e->getMessage());
        }
    }

    /**
     * Enregistrer un nouveau point de vente ville/commune
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'id_ville' => 'required',
                'id_commune' => 'required',
                'quartier' => 'nullable|string|max:255',
                'responsable' => 'nullable|string|max:255',
                'contact' => 'nullable|string|max:50',
                'email' => 'nullable|email|max:255',
                'google_map' => 'nullable|url|max:255',
            ]);

            // Vérifier unicité d’une même ville + commune
            $exists = VillePointVente::where('id_ville', $request->id_ville)
                ->where('id_commune', $request->id_commune)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->with('error', 'Cette combinaison de ville et de commune existe déjà.')
                    ->withInput();
            }
         
            VillePointVente::create($validated);

            return redirect()->route('ville_point_vente.index')
                ->with('success', 'Ville du point de vente ajoutée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Mettre à jour un point de vente existant
     */
    public function update(Request $request, $id)
    {
        try {
            $villePointVente = VillePointVente::findOrFail($id);

            $validated = $request->validate([
                'id_ville' => 'required|exists:villes,id',
                'id_commune' => 'required|exists:communes,id',
                'quartier' => 'nullable|string|max:255',
                'responsable' => 'nullable|string|max:255',
                'contact' => 'nullable|string|max:50',
                'email' => 'nullable|email|max:255',
                'google_map' => 'nullable|url|max:255',
            ]);

            // Vérifier unicité lors de la mise à jour
            $exists = VillePointVente::where('id_ville', $request->id_ville)
                ->where('id_commune', $request->id_commune)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->with('error', 'Cette combinaison de ville et de commune existe déjà.')
                    ->withInput();
            }

            $villePointVente->update($validated);

            return redirect()->route('ville_point_vente.index')
                ->with('success', 'Mise à jour effectuée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Supprimer un point de vente
     */
    public function destroy($id)
    {
        try {
            $villePointVente = VillePointVente::findOrFail($id);
            $villePointVente->delete();

            return redirect()->route('ville_point_vente.index')
                ->with('success', 'Enregistrement supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
