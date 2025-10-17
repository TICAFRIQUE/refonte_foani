<?php

namespace App\Http\Controllers\frontend;

use App\Models\Slider;
use App\Models\Contact;
use App\Models\Categorie;
use App\Models\PointVente;
use Illuminate\Http\Request;
use App\Models\CategoriePointVente;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function accueil(Request $request)
    {
        //
        try {
            //Afficher les categories et leurs produits limités à 4 sur la page d'accueil
            $categories = Categorie::with(['produits' => function ($query) {
                $query->where('statut', true)->limit(4); // Limiter à 4 produits actifs par catégorie
            }])->active()->position()->get();

            //recuperer les sliders visibles
            $sliders = Slider::where('visible', true)->get();

            // dd($sliders->toArray());

            return view('index', compact('categories', 'sliders'));
        } catch (\Throwable $th) {
            //throw $th;
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
            return redirect()->route('accueil')->with('error', 'Catégorie de point de vente non trouvée.');
        }
    }



  
}
