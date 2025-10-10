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
                'position' => 1,
            ],
            [
                'libelle' => 'Poulets de Chair',
                'description' => 'Poulets élevés pour la production de viande',
                'statut' => true,
                'position' => 2,
            ],
            [
                'libelle' => 'Poules Pondeuses',
                'description' => 'Poules élevées pour la production d\'œufs',
                'statut' => true,
                'position' => 3,
            ],
            [
                'libelle' => 'Œufs',
                'description' => 'Œufs frais de poules, œufs à couver',
                'statut' => true,
                'position' => 4,
            ],
            [
                'libelle' => 'Aliments pour Volaille',
                'description' => 'Aliments composés, graines, compléments nutritionnels',
                'statut' => true,
                'position' => 5,
            ],
            [
                'libelle' => 'Équipements d\'Élevage',
                'description' => 'Cages, abreuvoirs, mangeoires, chauffage',
                'statut' => true,
                'position' => 6,
            ],
            [
                'libelle' => 'Médicaments Vétérinaires',
                'description' => 'Vaccins, antibiotiques, vitamines pour volailles',
                'statut' => true,
                'position' => 7,
            ],
            [
                'libelle' => 'Matériel d\'Incubation',
                'description' => 'Incubateurs, couveuses, équipements d\'éclosion',
                'statut' => true,
                'position' => 8,
            ],
            [
                'libelle' => 'Canards et Oies',
                'description' => 'Palmipèdes d\'élevage et leurs produits dérivés',
                'statut' => true,
                'position' => 9,
            ],
            [
                'libelle' => 'Services Avicoles',
                'description' => 'Consultation vétérinaire, formation, expertise',
                'statut' => true,
                'position' => 10,
            ],
        ];

        foreach ($categories as $categorie) {
            $string = $categorie['libelle'];
            $categorie['libelle'] = convertToMajuscule::toUpperNoAccent($string);
            Categorie::create($categorie);
        }
    }
}
