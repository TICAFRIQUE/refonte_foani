<?php

namespace App\Providers;

use Throwable;
use App\Models\Page;
use App\Models\Parametre;
use App\Models\CategoriePage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;

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

        //partager le nombre d'éléments dans le panier dans toutes les vues
        view()->composer('frontend.layouts.app', function ($view) {
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

            $view->with(['count', $count, 'categories_pages' => $categories_pages, 'pages' => $pages]);
        });


        //partager les categories page et les pages dans toutes les vues



        $newMessagesCount = \App\Models\Contact::where('is_read', false)->count();

        view()->share([
            'data_parametre' => $data_parametre,
            'newMessagesCount' => $newMessagesCount,
        ]);
    }
}
