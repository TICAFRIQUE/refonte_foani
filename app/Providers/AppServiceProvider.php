<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\CategoriePage;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Parametre;
use App\Models\Produit;
use App\Models\Slider;
use App\Observers\CategorieObserver;
use App\Observers\ProduitObserver;
use App\Observers\SliderObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
         Categorie::observe(CategorieObserver::class);
        Produit::observe(ProduitObserver::class);
        Slider::observe(SliderObserver::class);

        //pagination par defaut a 10
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        Schema::defaultStringLength(191);


        $this->app->booted(function () {
            try {
                if (Schema::hasTable('permissions') && Schema::hasTable('roles')) {
                    $permissions = Permission::pluck('id')->toArray();

                    $developpeurRole = Role::where('name', 'developpeur')->first();
                    $superadminRole = Role::where('name', 'superadmin')->first();

                    if ($developpeurRole) {
                        $developpeurRole->permissions()->sync($permissions);
                    }

                    if ($superadminRole) {
                        $superadminRole->permissions()->sync($permissions);
                    }
                }
            } catch (\Exception $e) {
                // Optionnel : log de l'erreur si besoin
                return back()->withErrors('Une erreur est survenue lors de la synchronisation des permissions.', 'Message d\'erreur:' . $e->getMessage());
            }
        });



        //recuperer les parametres
        $data_parametre = [];
        if (Schema::hasTable('parametres')) {
            $data_parametre = Parametre::with('media')->first();
        }

        //partager le nombre d'éléments dans le panier dans toutes les vues(frontend)
        view()->composer(['frontend.layouts.app', 'frontend.web.layouts.appweb'], function ($view) {
            $count = 0;
            $panier = session('panier', []);
            if (!empty($panier)) {
                $count = array_sum(array_column($panier, 'quantite'));
            }



            //partager les categories page et les pages dans toutes les vues
            if (Schema::hasTable('categorie_pages')) {
                $categories_pages = CategoriePage::with('pages')->active()->orderBy('created_at', 'asc')->get();
            }
            if (Schema::hasTable('pages')) {
                $pages = Page::where('statut', 1)->get();
            }
            $categories_pages = [];
            $pages = [];

            if (Schema::hasTable('categorie_pages')) {
                $categories_pages = CategoriePage::with('pages')->active()->orderBy('created_at', 'asc')->get();
            }
            if (Schema::hasTable('pages')) {
                $pages = Page::where('statut', 1)->get();
            }



            //detail de la page
            $page_detail = null;

            $view->with(['count' => $count, 'categories_pages' => $categories_pages, 'pages' => $pages, 'page_detail' => $page_detail]);
        });





        if (Schema::hasTable('contacts')) {
            $newMessagesCount = Contact::where('is_read', false)->count();
        } else {
            $newMessagesCount = 0;
        }

        //compter les reservations en attente
        if (Schema::hasTable('reservations')) {
            $pendingReservationsCount = \App\Models\Reservation::where('statut', 'en_attente')->count();
        } else {
            $pendingReservationsCount = 0;
        }

        //compter les commandes en attente
        if (Schema::hasTable('commandes')) {
            $pendingCommandesCount = \App\Models\Commande::where('statut', 'en_attente')->count();
        } else {
            $pendingCommandesCount = 0;
        }

        view()->share([
            'data_parametre' => $data_parametre,
            'newMessagesCount' => $newMessagesCount,
            'pendingReservationsCount' => $pendingReservationsCount,
            'pendingCommandesCount' => $pendingCommandesCount
        ]);
    }
}
