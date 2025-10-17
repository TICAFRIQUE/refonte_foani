<?php

namespace App\Http\Controllers\frontend;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\CategoriePage;
use App\Http\Controllers\Controller;

class PageDynamiqueController extends Controller
{
    //contenu dynamique des pages
    public function pageShow($slug)
    {
        try {
            $page = Page::where('slug', $slug)->firstOrFail();
            return view('frontend.pages.gestion_page.detail', compact('page'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('accueil')->with('error', 'La page demandée n\'existe pas ou a été supprimée !');
        }
    }

    // voir la page des activités

    public function pageActivites()
    {
      try {
          $categories_pages = CategoriePage::whereSlug('activites')->active()->first();
          $activites = Page::where('categorie_page_id', $categories_pages->id)->get();
          return view('frontend.pages.gestion_page.activites', compact('categories_pages' , 'activites'));
      } catch (\Throwable $th) {
          //throw $th;
          return redirect()->route('accueil')->with('error', 'Une erreur est survenue lors du chargement des activités !');
      }
    }
  
}
