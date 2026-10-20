<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\CategoriePage;
use App\Models\CategoriePointVente;
use App\Models\Commande;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Parametre;
use App\Models\Produit;
use App\Models\Reservation;
use App\Models\Slider;
use App\Observers\CategorieObserver;
use App\Observers\ProduitObserver;
use App\Observers\SliderObserver;
use App\Support\SiteCache;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    // Rôles qui ont toujours toutes les permissions
    private const SUPER_ROLES = ['developpeur', 'superadmin'];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Categorie::observe(CategorieObserver::class);
        Produit::observe(ProduitObserver::class);
        Slider::observe(SliderObserver::class);

        Paginator::useBootstrapFive();
        Schema::defaultStringLength(191);

        $this->registerCacheInvalidation();
        $this->registerSuperRoles();
        $this->registerViewData();
    }

    /**
     * Vide le cache du site dès qu'une donnée affichée sur le front change
     * (y compris un changement d'image).
     */
    private function registerCacheInvalidation(): void
    {
        $models = [
            Parametre::class, CategoriePage::class, Page::class, CategoriePointVente::class,
            Categorie::class, Produit::class, Slider::class, Media::class,
        ];

        foreach ($models as $model) {
            $model::saved(fn () => SiteCache::flush());
            $model::deleted(fn () => SiteCache::flush());
        }
    }

    /**
     * Avant : les permissions des super-rôles étaient re-synchronisées à CHAQUE requête.
     * Maintenant : synchro uniquement quand une permission est créée,
     * et Gate::before garantit l'accès total à ces rôles.
     */
    private function registerSuperRoles(): void
    {
        Gate::before(function ($user) {
            if (method_exists($user, 'hasAnyRole') && $user->hasAnyRole(self::SUPER_ROLES)) {
                return true;
            }

            return null;
        });

        Permission::created(function () {
            $ids = Permission::pluck('id');
            Role::whereIn('name', self::SUPER_ROLES)->get()
                ->each(fn (Role $role) => $role->permissions()->sync($ids));
        });
    }

    private function registerViewData(): void
    {
        // Paramètres du site : partagés partout, lus une seule fois puis mis en cache
        view()->composer('*', function ($view) {
            $view->with('data_parametre', once(fn () => $this->safe(fn () => SiteCache::parametre())));
        });

        // Front (boutique + site vitrine) : panier, menus, points de vente
        view()->composer(['frontend.layouts.app', 'frontend.web.layouts.appweb'], function ($view) {
            $panier = session('panier', []);

            $view->with([
                'count' => $panier ? array_sum(array_column($panier, 'quantite')) : 0,
                'categories_pages' => $this->safe(fn () => SiteCache::menuPages(), collect()),
                'menu_points_vente' => $this->safe(fn () => SiteCache::pointsVente(), collect()),
                'page_detail' => null,
            ]);
        });

        // Back-office uniquement : compteurs de la sidebar
        view()->composer('backend.layouts.sidebar', function ($view) {
            $view->with([
                'newMessagesCount' => $this->safe(fn () => Contact::where('is_read', false)->count(), 0),
                'pendingReservationsCount' => $this->safe(fn () => Reservation::where('statut', 'en_attente')->count(), 0),
                'pendingCommandesCount' => $this->safe(fn () => Commande::where('statut', 'en_attente')->count(), 0),
            ]);
        });
    }

    // Évite de casser l'app si une table n'existe pas encore (installation, migrations)
    private function safe(callable $callback, mixed $default = null): mixed
    {
        try {
            return $callback();
        } catch (Throwable) {
            return $default;
        }
    }
}
