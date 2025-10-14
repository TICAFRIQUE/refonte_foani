<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

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
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default.jpg');
    }
}
