<?php

namespace App\Observers;

use App\Models\Categorie;
use Illuminate\Support\Facades\Cache;

class CategorieObserver
{
    /**
     * Handle the Categorie "created" event.
     */
    public function created(Categorie $categorie): void
    {
        //
        Cache::forget('accueil.categories');
    }

    /**
     * Handle the Categorie "updated" event.
     */
    public function updated(Categorie $categorie): void
    {
        //
        Cache::forget('accueil.categories');
    }

    /**
     * Handle the Categorie "deleted" event.
     */
    public function deleted(Categorie $categorie): void
    {
        //
        Cache::forget('accueil.categories');
    }

    /**
     * Handle the Categorie "restored" event.
     */
    public function restored(Categorie $categorie): void
    {
        //
        Cache::forget('accueil.categories');
    }

    /**
     * Handle the Categorie "force deleted" event.
     */
    public function forceDeleted(Categorie $categorie): void
    {
        //
        Cache::forget('accueil.categories');
    }
}
