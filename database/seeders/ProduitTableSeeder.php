<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Str;

class ProduitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Categorie::pluck('id')->toArray();
        $typeOffres = [1, 2, 3]; // adapte selon tes types d'offres existants

        for ($i = 1; $i <= 100; $i++) {
            Produit::create([
                'code' => 'PROD-' . Str::upper(Str::random(6)),
                'libelle' => 'Produit ' . $i,
                'slug' => Str::slug('Produit ' . $i . '-' . $i),
                'stock' => rand(10, 100),
                'description' => 'Description du produit ' . $i,
                'prix_achat' => rand(1000, 5000),
                'prix_de_vente' => rand(6000, 20000),
                'frais_de_port' => rand(500, 2000),
                'type_reduction' => null,
                'valeur_reduction' => null,
                'date_debut_reduction' => null,
                'date_fin_reduction' => null,
                'visibilite' => true,
                'statut' => true,
                'categorie_id' => $categories[array_rand($categories)],
                'type_offre_id' => null,
                'user_id' => null, // adapte selon tes utilisateurs existants
            ]);
        }
    }
}
