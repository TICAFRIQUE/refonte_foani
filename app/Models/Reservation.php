<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Reservation extends Model
{
    //
    public $incrementing = false;

    protected $fillable = [
        'code',
        'nom',
        'telephone',
        'adresse',
        'ville',
        'commune',
        'produit_id',
        'prix_unitaire',
        'sous_total',
        'frais_livraison',
        'total',
        'date_reservation',
        'commentaire',
        'statut',
        'user_id',
    ];


    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'reservations', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    //scope pour les statuts
    public function scopeStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    protected $casts = [
        'date_reservation' => 'datetime',
    ];
}
