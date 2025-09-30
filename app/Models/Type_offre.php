<?php

namespace App\Models;

use App\Models\Produit;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Type_offre extends Model
{
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id


    protected $fillable = [

        'type_offre_id',
        'libelle',

    ];


    // Relation avec le modèle Produit
    public function produits()
    {
        return $this->hasMany(Produit::class, 'type_offre_id');
    }

   


    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'type_offre', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
