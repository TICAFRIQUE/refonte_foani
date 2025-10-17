<?php


use App\Http\Controllers\backend\ContactController;
use App\Models\Page;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\backend\PageController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\backend\ModuleController;
use App\Http\Controllers\backend\ProduitController;
use App\Http\Controllers\frontend\PanierController;
use App\Http\Controllers\backend\CandidatController;
use App\Http\Controllers\Backend\CommandeController;
use App\Http\Controllers\backend\CategorieController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ParametreController;
use App\Http\Controllers\backend\TypeOffreController;
use App\Http\Controllers\frontend\BoutiqueController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\PointVenteController;
use App\Http\Controllers\frontend\ReservationController;
use App\Http\Controllers\backend\CategoriePageController;
use App\Http\Controllers\backend\VilleLivraisonController;
use App\Http\Controllers\frontend\PageDynamiqueController;
use App\Http\Controllers\backend\CommuneLivraisonController;
use App\Http\Controllers\backend\ReservationAdminController;
use App\Http\Controllers\Backend\CategoriePointVenteController;







Route::fallback(function () {
    return view('backend.utility.auth-404-basic');
});

Route::middleware(['admin'])->prefix('admin')->group(function () {

    // login and logout
    Route::controller(AdminController::class)->group(function () {
        route::get('/login', 'login')->name('admin.login')->withoutMiddleware('admin'); // page formulaire de connexion
        route::post('/login', 'login')->name('admin.login')->withoutMiddleware('admin'); // envoi du formulaire
        route::post('/logout', 'logout')->name('admin.logout');
    });



    // dashboard admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // parametre application
    Route::prefix('parametre')->controller(ParametreController::class)->group(function () {
        route::get('', 'index')->name('parametre.index');
        route::post('store', 'store')->name('parametre.store');
        route::get('maintenance-up', 'maintenanceUp')->name('parametre.maintenance-up');
        route::get('maintenance-down', 'maintenanceDown')->name('parametre.maintenance-down');
        route::get('optimize-clear', 'optimizeClear')->name('parametre.optimize-clear');
        Route::get('download-backup/{file}', 'downloadBackup')->name('setting.download-backup');  // download backup db
    });


    //register admin
    Route::prefix('register')->controller(AdminController::class)->group(function () {
        route::get('', 'index')->name('admin-register.index');
        route::post('store', 'store')->name('admin-register.store');
        route::post('update/{id}', 'update')->name('admin-register.update');
        route::get('delete/{id}', 'delete')->name('admin-register.delete');
        route::get('profil/{id}', 'profil')->name('admin-register.profil');
        route::post('change-password', 'changePassword')->name('admin-register.new-password');
    });

    //role
    Route::prefix('role')->controller(RoleController::class)->group(function () {
        route::get('', 'index')->name('role.index');
        route::post('store', 'store')->name('role.store');
        route::post('update/{id}', 'update')->name('role.update');
        route::get('delete/{id}', 'delete')->name('role.delete');
    });

    //permission
    Route::prefix('permission')->controller(PermissionController::class)->group(function () {
        route::get('', 'index')->name('permission.index');
        route::get('create', 'create')->name('permission.create');
        route::post('store', 'store')->name('permission.store');
        route::get('edit{id}', 'edit')->name('permission.edit');
        route::put('update/{id}', 'update')->name('permission.update');
        route::get('delete/{id}', 'delete')->name('permission.delete');
    });

    //module
    Route::prefix('module')->controller(ModuleController::class)->group(function () {
        route::get('', 'index')->name('module.index');
        route::post('store', 'store')->name('module.store');
        route::post('update/{id}', 'update')->name('module.update');
        route::get('delete/{id}', 'delete')->name('module.delete');
    });


    // categorie
    Route::prefix('categorie')->controller(CategorieController::class)->group(function () {
        Route::get('', 'index')->name('categorie.index');
        Route::post('store', 'store')->name('categorie.store');
        Route::post('update/{id}', 'update')->name('categorie.update');
        Route::get('delete/{id}', 'delete')->name('categorie.delete');
    });

    //    offre
    Route::prefix('offre')->controller(TypeOffreController::class)->group(function () {
        Route::get('offre', 'index')->name('offre.index');
        Route::post('offre', 'store')->name('offre.store');
        // Route::get('show/{id}', 'show')->name('offre.show');
        Route::get('offre/{id}', 'edit')->name('offre.edit');
        Route::put('offre/{type_offre}',  'update')->name('offre.update');
        Route::get('offre/{id}',  'delete')->name('offre.delete');
    });

    // produit
    Route::prefix('produit')->controller(ProduitController::class)->group(function () {
        Route::get('', 'index')->name('produit.index');
        Route::get('create', 'create')->name('produit.create');
        Route::post('store', 'store')->name('produit.store');
        // Route::get('show/{id}', 'show')->name('produit.show');
        Route::get('edit/{id}', 'edit')->name('produit.edit');
        Route::put('update/{id}', 'update')->name('produit.update');
        Route::get('delete/{id}', 'delete')->name('produit.delete');
    });


    // Ville de livraison
    Route::prefix('ville')->controller(VilleLivraisonController::class)->group(function () {
        Route::get('', 'index')->name('ville.index');
        Route::get('create', 'create')->name('ville.create');
        Route::post('', 'store')->name('ville.store');
        Route::get('{id}/edit', 'edit')->name('ville.edit');
        Route::post('/update/{id}', 'update')->name('ville.update');
        Route::get('/delete/{id}', 'delete')->name('ville.delete');
    });

    //CommuneLivraison
    Route::prefix('commune')->controller(CommuneLivraisonController::class)->group(function () {
        Route::get('/', 'index')->name('commune.index');            // Liste des communes
        Route::post('/store', 'store')->name('commune.store');       // Ajouter une commune
        Route::post('/update/{id}', 'update')->name('commune.update'); // Modifier une commune
        Route::get('/delete/{id}', 'delete')->name('commune.delete'); // Supprimer une commune
    });


    // Categorie page
    Route::prefix('categorie_page')->controller(CategoriePageController::class)->group(function () {
        Route::get('/', 'index')->name('categorie_page.index'); // Page d'index (liste)
        Route::post('/store', 'store')->name('categorie_page.store'); // Enregistrement
        Route::get('/edit/{id}', 'edit')->name('categorie_page.edit'); // Récupération d'une catégorie pour édition
        Route::post('/update/{id}', 'update')->name('categorie_page.update'); // Mise à jour
        Route::get('/delete/{id}', 'delete')->name('categorie_page.delete'); // Suppression
    });


    // Page
    Route::prefix('page')->controller(PageController::class)->group(function () {
        Route::get('/', 'index')->name('pages.index'); // liste des page
        Route::get('create', 'create')->name('pages.create');
        Route::post('store', 'store')->name('pages.store');
        Route::get('edit/{id}', 'edit')->name('pages.edit');
        Route::post('update/{id}', 'update')->name('pages.update');
        Route::get('delete/{id}', 'delete')->name('pages.delete');
    });
    // categorie point de vente
    Route::prefix('categorie_point_de_vente')->name('categorie_point_de_vente.')->controller(CategoriePointVenteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });

    // ville point de vente
    Route::prefix('point_vente')->name('point_vente.')->controller(PointVenteController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });

    // sliders
    Route::prefix('sliders')->name('sliders.')->controller(SliderController::class)->group(function () {
        Route::get('/', 'index')->name('index');           // Liste des sliders
        Route::get('create', 'create')->name('create');    // Formulaire d'ajout
        Route::post('store', 'store')->name('store');      // Enregistrement
        Route::get('edit/{id}', 'edit')->name('edit');     // Formulaire d'édition
        Route::post('update/{id}', 'update')->name('update'); // Mise à jour
        Route::get('delete/{id}', 'delete')->name('delete');  // Suppression
    });

    // commandes
    Route::prefix('commandes')->name('commandes.')->controller(CommandeController::class)->group(function () {
        Route::get('/', 'index')->name('index'); // Liste des commandes
        Route::post('store', 'store')->name('store'); // Enregistrement d'une commande
        Route::get('{commande}', 'show')->name('show'); // Détail d'une commande
        Route::post('{commande}', 'update')->name('update'); // Mise à jour
        Route::delete('{commande}', 'destroy')->name('destroy'); // Suppression
    });


    // reservations
    Route::prefix('reservation')->name('reservation.')->controller(ReservationAdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');           // Liste des réservations
        Route::post('{reservation}', 'update')->name('update'); // Mise à jour
        Route::get('{reservation}', 'show')->name('show'); // Détail d'une réservation
        Route::delete('{reservation}', 'delete')->name('delete'); // Suppression
    });

    // clients
    Route::prefix('clients')->name('client.')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index_client')->name('index_client');            // Liste des clients
        Route::get('delete/{id}', 'delete_client')->name('delete');    // Suppression (retour JSON recommandé)
    });

    // candidats
    Route::prefix('candidats')->name('candidats.')->controller(CandidatController::class)->group(function () {
        Route::get('/', 'index')->name('index');           // liste des candidats
        Route::get('delete/{id}', 'delete')->name('delete'); // suppression
    });

    // contact
    Route::prefix('contact')->name('contact.')->controller(ContactController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
});



/**-------------------------------------------------------------ROUTE FRONTEND-------------------------------------------------------- */
//Authentification user
Route::controller(UserController::class)->group(function () {
    route::get('login', 'loginForm')->name('user.loginForm');
    route::post('loginStore', 'login')->name('user.login');
    route::get('register', 'registerForm')->name('user.registerForm');
    route::post('registerStore', 'register')->name('user.register');
    route::get('mes-commandes', 'mesCommandes')->name('user.commandes')->middleware('client');
    route::get('mes-commandes/{id}', 'mesCommandesShow')->name('user.commandes.show')->middleware('client');
    route::get('mes-reservations', 'mesReservations')->name('user.reservations')->middleware('client');
    route::get('mes-reservations/{id}', 'mesReservationsShow')->name('user.reservations.show')->middleware('client');
    route::get('profil', 'profil')->name('user.profil')->middleware('client');
    route::post('profil', 'profil')->name('user.profil')->middleware('client');
    route::get('logout', 'logout')->name('user.logout')->middleware('client');
});



Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'accueil')->name('accueil'); // page d'accueil
    Route::get('/contact', 'contact')->name('contact'); // page contact
});

//gestion des pages dynamiques
Route::controller(PageDynamiqueController::class)->group(function () {
    Route::get('/pages/{slug}', 'pageShow')->name('page.show'); // detail de la page
    Route::get('/nos-activites', 'pageActivites')->name('page.activites'); // liste des activites
});

// boutique
Route::controller(BoutiqueController::class)->group(function () {
    Route::get('/boutique', 'index')->name('boutique.index'); // page boutique
    Route::get('/boutique/categorie/{slug}', 'categorie')->name('boutique.categorie'); // page boutique par categorie', 'show')->name('boutique.show'); // page detail produit
});


// Panier routes
Route::controller(PanierController::class)->group(function () {
    Route::get('/panier', 'index')->name('panier.index');
    Route::post('/panier/add/{produit_id}', 'add')->name('panier.add');
    Route::post('/panier/update/{produit_id}', 'update')->name('panier.update');
    Route::post('/panier/remove/{produit_id}', 'remove')->name('panier.remove');
    Route::get('/caisse', 'caisse')->name('panier.caisse')->middleware('client');
    Route::post('/commande-store', 'commandeStore')->name('panier.commande.store')->middleware('client'); // route de validation de la commande
});

//Reservation
Route::controller(ReservationController::class)->group(function () {
    Route::get('/reservation/{slug}', 'create')->name('reservation.create')->middleware('client');
    Route::post('/reservation/{id}', 'store')->name('reservation.store')->middleware('client');
});
