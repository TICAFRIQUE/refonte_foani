<?php

namespace App\Http\Controllers\backend;

use App\Models\Ville;
use App\Models\Commune;
use App\Models\PointVente;
use Illuminate\Http\Request;
use App\Models\VillePointVente;
use App\Http\Controllers\Controller;
use App\Services\convertToMajuscule;

class PointVenteController extends Controller
{
    /**
     * Afficher la liste des villes liées aux points de vente
     */
    public function index()
    {
        try {
            $point_ventes = PointVente::with(['categoriePointVente', 'commune'])->get();
            $villes = Ville::active()->alphabetique()->get();
            $communes = Commune::ctive()->alphabetique()->get();

            return view('backend.pages.gestion_points_de_ventes.points_de_ventes.index', compact('point_ventes', 'villes', 'communes'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors du chargement : ' . $e->getMessage());
        }
    }

    /**
     * Enregistrer un nouveau point de vente ville/commune
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'commune_id' => 'required',
                'categorie_point_vente_id' => 'required',
                'quartier' => 'nullable|string|max:255',
                'responsable' => 'nullable|string|max:255',
                'contact' => 'nullable|string|min:10|max:10',
                'autre_contact' => 'nullable|string|min:10|max:10',
                'email' => 'nullable|email|max:255',
                'google_map' => 'nullable|url|max:255',
            ]);

            // Vérifier unicité d’une même ville + commune
            $exists = PointVente::where('categorie_point_vente_id', $request->categorie_point_vente_id)
                ->where('commune_id', $request->commune_id)
                ->exists();

            if ($exists) {
                return back()
                    ->with('error', 'Cette combinaison de ville et de commune existe déjà.')
                    ->withInput();
            }
            PointVente::create([
                'categorie_point_vente_id' => $request->categorie_point_vente_id,
                'commune_id' => $request->commune_id,
                'quartier' => convertToMajuscule::toUpperNoAccent($request->quartier),
                'responsable' => $request->responsable,
                'contact' => $request->contact,
                'email' => $request->email,
                'google_map' => $request->google_map,
                'autre_contact' => $request->autre_contact,
                'statut' => true,
            ]);

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
    public function delete($id)
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
