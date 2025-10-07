<?php

use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\ModuleController;
use App\Http\Controllers\backend\ParametreController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\TypeOffreController;
use Illuminate\Support\Facades\Route;




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
});



/**-------------------------------------------------------------ROUTE FRONTEND-------------------------------------------------------- */
route::get('/', function () {
    return view('index');
});
