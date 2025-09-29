<?php

namespace App\Models;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Produit extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $fillable = [
        'libelle',
        'id_categorie',
        'prix_de_vente',
        'frais_de_port',
        'id_appreciation',
        'stock',
        'description',
        'mots_cle',
        'prix_achat',
        'reduction_en_procentage',
        'visibilite',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'libelle'
            ]
        ];
    }

    public function categories()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function appreciation()
    {
        return $this->belongsTo(Appreciation::class, 'id_appreciation');
    }
}
