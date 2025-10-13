<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ville;

class VilleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villes = [
            'ABIDJAN',
            'YAMOUSSOUKRO',
            'BOUAKÉ',
            'DALOA',
            'SAN-PÉDRO',
            'DIVO',
            'KORHOGO',
            'ANYAMA',
            'ABENGOUROU',
            'MAN',
            'GAGNOA 1',
            'SOUBRÉ',
            'AGBOVILLE',
            'DABOU',
            'GRAND-BASSAM',
            'BOUAFLÉ',
            'ISSIA',
            'SINFRA',
            'KATIOLA',
            'BINGERVILLE',
            'ADZOPÉ',
            'SÉGUÉLA',
            'BONDOUKOU',
            'OUMÉ',
            'FERKESSEDOUGOU',
            'DIMBOKRO',
            'ODIENNÉ',
            'DUÉKOUÉ',
            'DANANÉ',
            'TINGRÉLA',
            'GUIGLO',
            'BOUNDIALI',
            'AGNIBILÉKRO',
            'DAOUKRO',
            'VAVOUA',
            'ZUÉNOULA',
            'TIASSALÉ',
            'TOUMODI',
            'AKOUPÉ',
            'LAKOTA',
            'SONGON',
            'TANDA',
            'BOUNA',
            'TIEBISSOU',
            'GAGNOA 2',
        ];

        foreach ($villes as $ville) {
            Ville::create([
                'libelle' => $ville,
                'statut' => true
            ]);
        }
    }
}
