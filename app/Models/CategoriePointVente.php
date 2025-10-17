<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;

class CategoriePointVente extends Model implements Hasmedia
{
    use Sluggable, HasFactory, InteractsWithMedia;
    public $incrementing = false;


    protected $fillable = [
        'libelle',
        'statut',
        'slug',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'categorie_point_ventes', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'libelle'
            ]
        ];
    }

    // une catégorie de point de vente peut avoir plusieurs points de vente
    public function pointVentes()
    {
        return $this->hasMany(PointVente::class, 'categorie_point_vente_id');
    }


    //scope pour les categories points de vente actives
    public function scopeActive($query)
    {
        return $query->where('statut', true);
    }
}
