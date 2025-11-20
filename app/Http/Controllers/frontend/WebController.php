<?php

namespace App\Http\Controllers\frontend;

use App\Models\Page;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\CategoriePage;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    //

    public function index()
    {
        //recuperer les sliders visibles
        $sliders = Slider::visible()->web()->orderBy('position', 'asc')->get();

        //recuperer les pages activites
        $activites = Page::where('categorie_page_id', CategoriePage::whereSlug('activites')->first()->id)->get();

        //recuperer  la page presentation
        $presentation = Page::whereSlug('presentation')->with('media')->first();

        //mot du directeur
        $directeur = Page::whereSlug('mot-du-directeur')->with('media')->first();

        //
        return view('web', compact('sliders', 'activites', 'presentation', 'directeur'));
    }

    //contenu dynamique des pages
    public function pageShow($slug)
    {
        try {

            if (isset($slug)) {
                $page = Page::where('slug', $slug)->firstOrFail();
            }

            return view('frontend.web.pages.page-detail', compact('page'));
        } catch (\Throwable $th) {
            return $th->getMessage();

            //throw $th;
            // return redirect()->route('accueil')->with('error', 'La page demandée n\'existe pas ou a été supprimée !');
        }
    }
}
