<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appreciation extends Model
{
    protected $fillable = [
        'libelle',

    ];

    public function produits()
    {
        return $this->hasMany(Produit::class, 'id_appreciation');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'libelle'
            ]
        ];
    }
}
