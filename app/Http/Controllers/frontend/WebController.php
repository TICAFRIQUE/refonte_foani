<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Slider;
use App\Support\SiteCache;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    // Accueil du site vitrine
    public function index()
    {
        // Vidé automatiquement par SiteCache::flush() quand une page / un slider change
        $data = Cache::remember('web.accueil', 3600, fn () => [
            'sliders' => Slider::visible()->web()->with('media')->orderBy('position')->get(),
            'activites' => Page::with('media')
                ->whereHas('categorie', fn ($q) => $q->where('slug', 'activites'))
                ->position()
                ->get(),
            'presentation' => Page::whereSlug('presentation')->with('media')->first(),
            'directeur' => Page::whereSlug('mot-du-directeur')->with('media')->first(),
        ]);

        // Données déjà en cache (communes avec la boutique)
        $data['categories'] = SiteCache::shopCategories();
        $data['zonesPointsVente'] = SiteCache::pointsVente();

        return view('web', $data);
    }

    // Contenu dynamique des pages
    public function pageShow($slug)
    {
        $page = Page::with('media')->where('slug', $slug)->firstOrFail();

        return view('frontend.web.pages.page-detail', compact('page'));
    }
}
