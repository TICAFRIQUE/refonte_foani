<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PointVente extends Model
{
    use HasFactory;
    //
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id
    protected $fillable = [
        'categorie_point_vente_id',
        'commune_id',
        'quartier',
        'contact',
        'autre_contact',
        'responsable',
        'email',
        'google_map',
        'statut',
    ];

    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'point_ventes', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    // un point de vente appartient à une catégorie de point de vente
    public function categoriePointVente()
    {
        return $this->belongsTo(CategoriePointVente::class, 'categorie_point_vente_id');
    }
    // un point de vente appartient à une commune
    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id');
    }
}
