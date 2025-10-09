<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;
use App\Services\convertToMajuscule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'libelle' => 'Poussins',
                'description' => 'Poussins d\'un jour de différentes races',
                'statut' => true,
            ],
            [
                'libelle' => 'Poulets de Chair',
                'description' => 'Poulets élevés pour la production de viande',
                'statut' => true,
            ],
            [
                'libelle' => 'Poules Pondeuses',
                'description' => 'Poules élevées pour la production d\'œufs',
                'statut' => true,
            ],
            [
                'libelle' => 'Œufs',
                'description' => 'Œufs frais de poules, œufs à couver',
                'statut' => true,
            ],
            [
                'libelle' => 'Aliments pour Volaille',
                'description' => 'Aliments composés, graines, compléments nutritionnels',
                'statut' => true,
            ],
            [
                'libelle' => 'Équipements d\'Élevage',
                'description' => 'Cages, abreuvoirs, mangeoires, chauffage',
                'statut' => true,
            ],
            [
                'libelle' => 'Médicaments Vétérinaires',
                'description' => 'Vaccins, antibiotiques, vitamines pour volailles',
                'statut' => true,
            ],
            [
                'libelle' => 'Matériel d\'Incubation',
                'description' => 'Incubateurs, couveuses, équipements d\'éclosion',
                'statut' => true,
            ],
            [
                'libelle' => 'Canards et Oies',
                'description' => 'Palmipèdes d\'élevage et leurs produits dérivés',
                'statut' => true,
            ],
            [
                'libelle' => 'Services Avicoles',
                'description' => 'Consultation vétérinaire, formation, expertise',
                'statut' => true,
            ],
        ];

        foreach ($categories as $categorie) {
            $string = $categorie['libelle'];
            $categorie['libelle'] = convertToMajuscule::toUpperNoAccent($string);
            Categorie::create($categorie);
        }
    }
}
