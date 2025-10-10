<?php

namespace App\Http\Controllers\frontend;

use App\Models\Categorie;
use Illuminate\Http\Request;
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

            // dd($categories->toArray());

            return view('index', compact('categories'));
        } catch (\Throwable $th) {
            //throw $th;
            return view('backend.utility.auth-404-basic'); 
        }
    }
}
