<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Produit;
use App\Support\SiteCache;
use Illuminate\Http\Request;

class BoutiqueController extends Controller
{
    private const PAR_PAGE = 16;

    // Tous les produits (filtres optionnels ?categorie= et ?recherche=)
    public function index(Request $request)
    {
        try {
            $recherche = trim((string) $request->recherche);
            $categorie = $request->categorie
                ? Categorie::where('slug', $request->categorie)->first()
                : null;

            $produits = $this->produitsQuery($categorie, $recherche, true)
                ->paginate(self::PAR_PAGE);

            return $this->render($produits, $categorie, $recherche);
        } catch (\Throwable $th) {
            report($th);

            return redirect()->route('boutique.accueil')->with('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
        }
    }

    // Produits d'une catégorie (slug dans l'URL)
    public function categorie($slug)
    {
        $categorie = Categorie::with('media')->where('slug', $slug)->first();

        if (! $categorie) {
            return redirect()->route('boutique.accueil')->with('error', 'Catégorie introuvable.');
        }

        try {
            $recherche = trim((string) request('recherche'));
            $produits = $this->produitsQuery($categorie, $recherche, false)
                ->paginate(self::PAR_PAGE);

            return $this->render($produits, $categorie, $recherche);
        } catch (\Throwable $th) {
            report($th);

            return redirect()->route('boutique.accueil')->with('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
        }
    }

    private function produitsQuery(?Categorie $categorie, string $recherche, bool $chercherDansCategories)
    {
        return Produit::query()
            ->select(['id', 'slug', 'libelle', 'stock', 'prix_de_vente', 'categorie_id', 'statut'])
            ->with(['media', 'categorie:id,libelle,slug'])
            ->active()
            ->when($categorie, fn ($q) => $q->where('categorie_id', $categorie->id))
            ->when($recherche !== '', function ($q) use ($recherche, $chercherDansCategories) {
                $q->where(function ($q) use ($recherche, $chercherDansCategories) {
                    $q->where('libelle', 'LIKE', "%{$recherche}%")
                        ->orWhere('description', 'LIKE', "%{$recherche}%");

                    if ($chercherDansCategories) {
                        $q->orWhereHas('categorie', fn ($c) => $c->where('libelle', 'LIKE', "%{$recherche}%"));
                    }
                });
            })
            ->orderByRaw('stock > 0 DESC') // produits disponibles en premier
            ->latest();
    }

    private function render($produits, ?Categorie $categorie, string $recherche)
    {
        return view('frontend.pages.boutique', [
            'produits' => $produits,
            'categorie' => $categorie,
            'recherche' => $recherche !== '' ? $recherche : null,
            'categories' => SiteCache::shopCategories(),
            'totalProduits' => SiteCache::shopTotal(),
        ]);
    }
}
