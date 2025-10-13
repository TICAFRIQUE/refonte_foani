<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 3567451204,
                'libelle' => 'ABATS',
                'slug' => 'equipements-d-elevage',
                'description' => 'Cages, abreuvoirs, mangeoires, chauffage',
                'statut' => 1,
                'position' => 6,
                'created_at' => '2025-10-10 09:47:51',
                'updated_at' => '2025-10-10 11:52:27',
            ),
            1 => 
            array (
                'id' => 6066990652,
                'libelle' => 'POULES PONDEUSES',
                'slug' => 'poules-pondeuses',
                'description' => 'Poules élevées pour la production d\'œufs',
                'statut' => 1,
                'position' => 1,
                'created_at' => '2025-10-10 09:47:51',
                'updated_at' => '2025-10-10 10:02:14',
            ),
            2 => 
            array (
                'id' => 10439886291,
                'libelle' => 'POUSSINS',
                'slug' => 'poussins',
                'description' => 'Poussins d\'un jour de différentes races',
                'statut' => 1,
                'position' => 3,
                'created_at' => '2025-10-10 09:47:51',
                'updated_at' => '2025-10-10 10:02:05',
            ),
            3 => 
            array (
                'id' => 10983121031,
                'libelle' => 'ŒUFS',
                'slug' => 'oeufs',
                'description' => 'Œufs frais de poules, œufs à couver',
                'statut' => 1,
                'position' => 4,
                'created_at' => '2025-10-10 09:47:51',
                'updated_at' => '2025-10-10 09:47:51',
            ),
            4 => 
            array (
                'id' => 16106744531,
                'libelle' => 'EPICES',
                'slug' => 'canards-et-oies',
                'description' => 'Palmipèdes d\'élevage et leurs produits dérivés',
                'statut' => 1,
                'position' => 8,
                'created_at' => '2025-10-10 09:47:51',
                'updated_at' => '2025-10-10 11:54:18',
            ),
            5 => 
            array (
                'id' => 18915861111,
                'libelle' => 'POULETS DE CHAIR',
                'slug' => 'poulets-de-chair',
                'description' => 'Poulets élevés pour la production de viande',
                'statut' => 1,
                'position' => 2,
                'created_at' => '2025-10-10 09:47:51',
                'updated_at' => '2025-10-10 09:47:51',
            ),
            6 => 
            array (
                'id' => 20372027951,
                'libelle' => 'POULET CRIKA',
                'slug' => 'medicaments-veterinaires',
                'description' => 'Vaccins, antibiotiques, vitamines pour volailles',
                'statut' => 1,
                'position' => 7,
                'created_at' => '2025-10-10 09:47:51',
                'updated_at' => '2025-10-10 11:53:22',
            ),
            7 => 
            array (
                'id' => 21017031631,
                'libelle' => 'DECOUPES',
                'slug' => 'aliments-pour-volaille',
                'description' => 'Aliments composés, graines, compléments nutritionnels',
                'statut' => 1,
                'position' => 5,
                'created_at' => '2025-10-10 09:47:51',
                'updated_at' => '2025-10-10 11:51:37',
            ),
        ));
        
        
    }
}