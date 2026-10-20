<?php

namespace App\Models\Concerns;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Génère une version WebP légère de chaque image uploadée.
 *  - "thumb" : pour les cartes (produits, catégories), ~600 px
 *  - "large" : pour les bannières / sliders, ~1600 px
 * Les originaux restent intacts. Pour les images déjà en ligne :
 *   php artisan media-library:regenerate
 */
trait HasOptimizedImages
{
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Max, 600, 600)
            ->format('webp')
            ->quality(80)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->fit(Fit::Max, 1600, 1600)
            ->format('webp')
            ->quality(80)
            ->nonQueued();
    }
}
