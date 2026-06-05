<?php

namespace App\Observers;

use App\Models\Produit;
use Illuminate\Support\Facades\Cache;

class ProduitObserver
{
    /**
     * Handle the Produit "created" event.
     */
    public function created(Produit $produit): void
    {
        //
        Cache::forget('accueil.categories');
        Cache::forget('accueil.offre_speciale');
    }

    /**
     * Handle the Produit "updated" event.
     */
    public function updated(Produit $produit): void
    {
        //
        Cache::forget('accueil.categories');
        Cache::forget('accueil.offre_speciale');
    }

    /**
     * Handle the Produit "deleted" event.
     */
    public function deleted(Produit $produit): void
    {
        //
        Cache::forget('accueil.categories');
        Cache::forget('accueil.offre_speciale');
    }

    /**
     * Handle the Produit "restored" event.
     */
    public function restored(Produit $produit): void
    {
        //
        Cache::forget('accueil.categories');
        Cache::forget('accueil.offre_speciale');
    }

    /**
     * Handle the Produit "force deleted" event.
     */
    public function forceDeleted(Produit $produit): void
    {
        //
        Cache::forget('accueil.categories');
        Cache::forget('accueil.offre_speciale');
    }
}
