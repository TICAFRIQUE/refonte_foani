<?php

namespace App\Http\Controllers\frontend;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoutiqueController extends Controller
{
    // Page pour voir tous les produits groupés par catégorie (query string)
    public function index(Request $request)
    {
        try {
            $categorieSlug = $request->categorie;
            $recherche = $request->recherche;
            $categorie = null;
            $query = Produit::with('categorie')->active();

            // Filtre par catégorie
            if ($categorieSlug) {
                $categorie = Categorie::where('slug', $categorieSlug)->first();
                if ($categorie) {
                    $query->where('categorie_id', $categorie->id);
                }
            }

            // Filtre par recherche
            if ($recherche) {
                $query->where(function($q) use ($recherche) {
                    $q->where('libelle', 'LIKE', '%' . $recherche . '%')
                      ->orWhere('description', 'LIKE', '%' . $recherche . '%')
                      ->orWhereHas('categorie', function($catQuery) use ($recherche) {
                          $catQuery->where('libelle', 'LIKE', '%' . $recherche . '%');
                      });
                });
            }

            $produits = $query->paginate(16);

            return view('frontend.pages.boutique', compact('produits', 'categorie', 'recherche'));
        } catch (\Throwable $th) {
            return redirect()->route('boutique.accueil')->with('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
        }
    }

    // Page pour voir les produits d'une catégorie via slug dans l'URL
    public function categorie($slug)
    {
        try {
            $categorie = Categorie::where('slug', $slug)->firstOrFail();
            $recherche = request('recherche');
            $query = Produit::with('categorie')
                ->where('categorie_id', $categorie->id)
                ->active();

            // Filtre par recherche dans la catégorie
            if ($recherche) {
                $query->where(function($q) use ($recherche) {
                    $q->where('libelle', 'LIKE', '%' . $recherche . '%')
                      ->orWhere('description', 'LIKE', '%' . $recherche . '%');
                });
            }

            $produits = $query->paginate(16);

            return view('frontend.pages.boutique', compact('produits', 'categorie', 'recherche'));
        } catch (\Throwable $th) {
            return redirect()->route('boutique.accueil')->with('error', 'Catégorie introuvable.');
        }
    }
}
