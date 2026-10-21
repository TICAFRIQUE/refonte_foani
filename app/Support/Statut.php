<?php

namespace App\Support;

/**
 * Statuts des commandes et réservations : libellés, couleurs et icônes communs
 * à toutes les pages du back-office.
 */
class Statut
{
    public const EN_ATTENTE = 'en_attente';
    public const EN_COURS = 'en_cours';
    public const LIVREE = 'livrée';
    public const ANNULEE = 'annulée';

    /** Étapes normales du traitement (l'annulation est à part). */
    public const ETAPES = [self::EN_ATTENTE, self::EN_COURS, self::LIVREE];

    public const LISTE = [
        self::EN_ATTENTE => ['label' => 'En attente', 'couleur' => 'warning', 'icone' => 'ri-time-line'],
        self::EN_COURS => ['label' => 'En cours de livraison', 'couleur' => 'info', 'icone' => 'ri-truck-line'],
        self::LIVREE => ['label' => 'Livrée', 'couleur' => 'success', 'icone' => 'ri-checkbox-circle-line'],
        self::ANNULEE => ['label' => 'Annulée', 'couleur' => 'danger', 'icone' => 'ri-close-circle-line'],
    ];

    public static function info(?string $statut): array
    {
        return self::LISTE[$statut] ?? [
            'label' => ucfirst(str_replace('_', ' ', (string) $statut)) ?: 'Inconnu',
            'couleur' => 'secondary',
            'icone' => 'ri-question-line',
        ];
    }

    public static function label(?string $statut): string
    {
        return self::info($statut)['label'];
    }

    /** Règle de validation pour un changement de statut. */
    public static function regle(): string
    {
        return 'required|in:' . implode(',', array_keys(self::LISTE));
    }
}
