<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Type_offre;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Produit extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable;
    // decrementer l'incrementation automatique de l'id
    public $incrementing = false;
    protected $fillable = [
        'code',
        'slug',
        'libelle',
        'stock',
        'description',
        'prix_achat',
        'prix_de_vente',
        'frais_de_port',
        'type_reduction',
        'valeur_reduction',
        'date_debut_reduction',
        'date_fin_reduction',
        'visibilite',
        'statut',
        'categorie_id',
        'type_offre_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'libelle'
            ]
        ];
    }




    // Relation avec le modèle Type_offres
    public function typeOffres()
    {
        return $this->belongsTo(TypeOffre::class, 'type_offre_id');
    }



    // Relation avec le modèle Categorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }


    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'produits', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
