<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\CategoriePointVente;
use App\Models\Contact;
use App\Models\PointVente;
use App\Models\Produit;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function accueil(Request $request)
    // {
    //     //
    //     try {
    //         //Afficher les categories et leurs produits limités à 4 sur la page d'accueil
    //         $categories = Categorie::with(['produits' => function ($query) {
    //             $query->where('statut', true)->limit(4); // Limiter à 4 produits actifs par catégorie
    //         }])->active()->position()->get();

    //         //recuperer les sliders visibles
    //         $sliders = Slider::visible()->boutique()->orderBy('position', 'asc')->get();

    //         // Récupérer le premier produit en offre spéciale avec ses médias
    //         $offreSpeciale = Produit::specialOffer()
    //             ->active()
    //             ->with('categorie')
    //             ->first();

    //         // dd($sliders->toArray());

    //         return view('index', compact('categories', 'sliders', 'offreSpeciale'));
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         return view('backend.utility.auth-404-basic');
    //     }
    // }

    public function accueil(Request $request)
    {
        try {
            $categories = Cache::remember(
                'accueil.categories',
                now()->addMinutes(30),
                fn() =>
                Categorie::with(['produits' => function ($query) {
                    $query->where('statut', true)
                        // ->select('id', 'categorie_id', 'nom', 'prix', 'slug')
                        ->with('media')
                        ->limit(4);
                }])
                    ->active()
                    ->position()
                    // ->select('id', 'nom', 'slug', 'position')
                    ->get()
            );

            $sliders = Cache::remember(
                'accueil.sliders',
                now()->addMinutes(60),
                fn() =>
                Slider::visible()
                    ->boutique()
                    ->orderBy('position', 'asc')
                    // ->select('id', 'image', 'titre', 'lien', 'position')
                    ->get()
            );

            $offreSpeciale = Cache::remember(
                'accueil.offre_speciale',
                now()->addMinutes(15),
                fn() =>
                Produit::specialOffer()
                    ->active()
                    ->with('categorie')
                    // ->select('id', 'nom', 'prix', 'slug', 'categorie_id')
                    ->first()
            );

            return view('index', compact('categories', 'sliders', 'offreSpeciale'));
        } catch (\Throwable $th) {
            return view('backend.utility.auth-404-basic');
        }
    }

    // Page de contact
    public function contact()
    {
        return view('frontend.pages.contact');
    }


    //Point de ventes
    public function pointsDeVente($slug)
    {
        try {
            // Récupérer la catégorie de point de vente par slug
            $categorie = CategoriePointVente::where('slug', $slug)->firstOrFail();

            // Récupérer les points de vente associés à cette catégorie
            $points_de_vente = PointVente::where('categorie_point_vente_id', $categorie->id)
                ->where('statut', true)
                ->get();

            return view('frontend.pages.points_de_vente', compact('categorie', 'points_de_vente'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('boutique.accueil')->with('error', 'Catégorie de point de vente non trouvée.');
        }
    }

    // Liste des categories
    public function categories()
    {
        $categories = Categorie::withCount('produits')->active()->position()->get();
        return view('frontend.pages.categorie', compact('categories'));
    }
}
