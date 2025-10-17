<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CategoriePointVente;
use App\Models\Commune;
use App\Models\PointVente;
use App\Models\Ville;
use App\Models\VillePointVente;
use App\Services\convertToMajuscule;
use Illuminate\Http\Request;

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
            $communes = Commune::active()->alphabetique()->get();
            $categories = CategoriePointVente::orderBy('libelle', 'asc')->get();;

            return view('backend.pages.gestion_points_de_ventes.points_de_ventes.index', compact('point_ventes', 'villes', 'communes', 'categories'));
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors du chargement : ' . $e->getMessage());
        }
    }

    /**
     * Enregistrer un nouveau point de vente ville/commune
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'commune_id' => 'required',
            'categorie_point_vente_id' => 'required',
            'quartier' => 'nullable|string|max:255',
            'responsable' => 'nullable|string|max:255',
            'autre_contact' => 'nullable|string|min:10|max:10',
            'contact' => 'required||min:10|max:10',
            'email' => 'nullable|email|max:255',
            'google_map' => 'nullable|url|max:255',
        ]);



        try {




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

            return redirect()->route('point_vente.index')
                ->with('success', 'Ville du point de vente ajoutée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Mettre à jour un point de vente existant
     */
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'commune_id' => 'required',
            'categorie_point_vente_id' => 'required',
            'quartier' => 'nullable|string|max:255',
            'responsable' => 'nullable|string|max:255',
            'autre_contact' => 'nullable|string|min:10|max:10',
            'contact' => 'required||min:10|max:10',
            'email' => 'nullable|email|max:255',
            'google_map' => 'nullable|url|max:255',
        ]);



        try {
            $villePointVente = PointVente::findOrFail($id);



            $villePointVente->update([
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

            return redirect()->route('point_vente.index')
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
            $villePointVente = PointVente::findOrFail($id);
            $villePointVente->delete();

            return response()->json([
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
