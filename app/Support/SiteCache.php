<?php

namespace App\Support;

use App\Models\Categorie;
use App\Models\CategoriePage;
use App\Models\CategoriePointVente;
use App\Models\Parametre;
use App\Models\Produit;
use Illuminate\Support\Facades\Cache;

/**
 * Données du site lues sur presque toutes les pages (menus, paramètres, catégories).
 * Mises en cache et vidées automatiquement quand un modèle concerné change
 * (voir AppServiceProvider::registerCacheInvalidation).
 */
class SiteCache
{
    private const TTL = 3600; // 1 h, au cas où une invalidation serait manquée

    private const KEYS = [
        'site.parametre',
        'site.menu_pages',
        'site.points_vente',
        'site.shop_categories',
        'site.shop_total',
        'accueil.categories',
        'accueil.sliders',
        'accueil.offre_speciale',
        'web.accueil',
    ];

    public static function parametre(): ?Parametre
    {
        return Cache::remember('site.parametre', self::TTL, fn () => Parametre::with('media')->first());
    }

    public static function menuPages()
    {
        return Cache::remember('site.menu_pages', self::TTL, fn () => CategoriePage::with('pages')
            ->active()
            ->orderBy('created_at')
            ->get());
    }

    public static function pointsVente()
    {
        return Cache::remember('site.points_vente', self::TTL, fn () => CategoriePointVente::active()
            ->alphabetique()
            ->get());
    }

    /** Catégories actives de la boutique avec le nombre de produits actifs et leur image. */
    public static function shopCategories()
    {
        return Cache::remember('site.shop_categories', self::TTL, fn () => Categorie::active()
            ->position()
            ->with('media')
            ->withCount(['produits' => fn ($q) => $q->active()])
            ->get());
    }

    public static function shopTotal(): int
    {
        return Cache::remember('site.shop_total', self::TTL, fn () => Produit::active()->count());
    }

    public static function flush(): void
    {
        foreach (self::KEYS as $key) {
            Cache::forget($key);
        }
    }
}
