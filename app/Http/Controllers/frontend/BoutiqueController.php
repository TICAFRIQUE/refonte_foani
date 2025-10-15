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
            $categorie = null;
            $query = Produit::with('categorie')->active();

            if ($categorieSlug) {
                $categorie = Categorie::where('slug', $categorieSlug)->first();
                if ($categorie) {
                    $query->where('categorie_id', $categorie->id);
                }
            }

            $produits = $query->paginate(16);

            return view('frontend.pages.boutique', compact('produits', 'categorie'));
        } catch (\Throwable $th) {
            return redirect()->route('accueil')->with('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
        }
    }

    // Page pour voir les produits d'une catégorie via slug dans l'URL
    public function categorie($slug)
    {
        try {
            $categorie = Categorie::where('slug', $slug)->firstOrFail();
            $produits = Produit::with('categorie')
                ->where('categorie_id', $categorie->id)
                ->active()
                ->paginate(16);

            return view('frontend.pages.boutique', compact('produits', 'categorie'));
        } catch (\Throwable $th) {
            return redirect()->route('accueil')->with('error', 'Catégorie introuvable.');
        }
    }
}
