<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Commande extends Model
{
    protected $table = 'commandes';
    public $incrementing = false; // Désactive l'incrémentation automatique de l'ID


    protected $fillable = [
        'user_id',
        'code',
        'sous_total',
        'frais_livraison',
        'total',
        'nom',
        'telephone',
        'adresse',
        'ville',
        'commune',
        'statut',
        'mode_paiement',
        'date_commande',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'commandes', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
            ->withPivot('quantite', 'prix_unitaire', 'total')
            ->withTimestamps();
    }


   //scope pour les statuts
   public function scopeStatut($query, $statut)
   {
       return $query->where('statut', $statut);
   }
}
