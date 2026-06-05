<?php

namespace App\Observers;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;

class SliderObserver
{
    /**
     * Handle the Slider "created" event.
     */
    public function created(Slider $slider): void
    {
        //
        Cache::forget('accueil.sliders');
    }

    /**
     * Handle the Slider "updated" event.
     */
    public function updated(Slider $slider): void
    {
        //
        Cache::forget('accueil.sliders');
    }

    /**
     * Handle the Slider "deleted" event.
     */
    public function deleted(Slider $slider): void
    {
        //
        Cache::forget('accueil.sliders');
    }

    /**
     * Handle the Slider "restored" event.
     */
    public function restored(Slider $slider): void
    {
        //
    }

    /**
     * Handle the Slider "force deleted" event.
     */
    public function forceDeleted(Slider $slider): void
    {
        //
    }
}
