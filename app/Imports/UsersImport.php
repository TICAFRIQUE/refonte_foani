<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * Chaque ligne du fichier CSV devient un User.
     */
    public function model(array $row)
    {
        // Ignorer les lignes vides
        if (empty($row['email'])) {
            return null;
        }

        // Création ou mise à jour d’un utilisateur
        $user = User::updateOrCreate(
            ['email' => trim($row['email'])], // condition de recherche
            [
                'username' => trim($row['first_name']) . ' ' . trim($row['last_name']),
                'email' => trim($row['email']),
                // Le mot de passe du CSV est SHA1, on le re-hash pour Laravel
                'password' => Hash::make($row['password']),
                'phone' => trim($row['mobile']),
                // 'commune' => trim($row['commune'] ?? ''),
                // 'quartier' => trim($row['quartier'] ?? ''),
                'created_at' => trim($row['date_ins']) . ' ' . trim($row['heure_ins']),
                'role' => 'client',
                // 'statut' => trim($row['statut'] ?? '1'),
            ]
        );

        // Attribution du rôle Spatie (si tu utilises spatie/laravel-permission)
        if (method_exists($user, 'assignRole')) {
            $user->assignRole('client');
        }

        return $user;
    }
}
