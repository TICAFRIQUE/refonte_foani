<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Concerns\HasOptimizedImages;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasOptimizedImages {
        HasOptimizedImages::registerMediaConversions insteadof InteractsWithMedia;
    }

    /**
     * Les attributs pouvant être remplis massivement.
     */
    protected $fillable = [
        'libelle',
        'url',
        'btn_nom',
        'description',
        'position',
        'type', //[web, 'boutique', etc.]
        'image',
        'visible',
    ];


       //ScopeVisible
       public function scopeVisible($query)
       {
           return $query->where('visible', true);
       }

       //scopeTypeWeb
       public function scopeWeb($query)
       {
           return $query->where('type', 'web');
       }

       //scopeBoutique
       public function scopeBoutique($query)
       {
           return $query->where('type', 'boutique');
       }

}
