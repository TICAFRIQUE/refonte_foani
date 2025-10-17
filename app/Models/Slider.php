<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    /**
     * Les attributs pouvant être remplis massivement.
     */
    protected $fillable = [
        'libelle',
        'url',
        'btn_nom',
        'description',
        'image',
        'visible',
    ];

    /**
     * Retourne le chemin complet de l’image si elle existe.
     */
    // public function getImageUrlAttribute()
    // {
    //     return $this->image ? asset('storage/' . $this->image) : asset('images/default.jpg');
    // }
}
