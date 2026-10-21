<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Période de dates pour le tableau de bord et les rapports.
 *
 * - Préréglages : aujourd'hui, 7 jours, 30 jours, ce mois, mois dernier, cette année
 * - Ou dates personnalisées (date_debut / date_fin)
 * - Les bornes couvrent des journées entières (00:00:00 → 23:59:59), y compris le dernier jour
 * - Fournit la période précédente de même durée, pour calculer une évolution
 */
class Periode
{
    public const PRESETS = [
        'aujourdhui' => "Aujourd'hui",
        '7j' => '7 jours',
        '30j' => '30 jours',
        'mois' => 'Ce mois',
        'mois_dernier' => 'Mois dernier',
        'annee' => 'Cette année',
    ];

    public function __construct(
        public readonly Carbon $debut,
        public readonly Carbon $fin,
        public readonly string $preset,
    ) {
    }

    public static function depuisRequete(Request $request, string $defaut = 'mois'): self
    {
        $preset = $request->input('periode');

        if (! $preset && ($request->filled('date_debut') || $request->filled('date_fin'))) {
            $preset = 'perso';
        }

        $preset = $preset ?: $defaut;
        $maintenant = now();

        [$debut, $fin] = match ($preset) {
            'aujourdhui' => [$maintenant->copy()->startOfDay(), $maintenant->copy()->endOfDay()],
            '7j' => [$maintenant->copy()->subDays(6)->startOfDay(), $maintenant->copy()->endOfDay()],
            '30j' => [$maintenant->copy()->subDays(29)->startOfDay(), $maintenant->copy()->endOfDay()],
            'mois_dernier' => [$maintenant->copy()->subMonthNoOverflow()->startOfMonth(), $maintenant->copy()->subMonthNoOverflow()->endOfMonth()],
            'annee' => [$maintenant->copy()->startOfYear(), $maintenant->copy()->endOfYear()],
            'perso' => [
                self::date($request->input('date_debut'))?->startOfDay() ?? $maintenant->copy()->startOfMonth(),
                self::date($request->input('date_fin'))?->endOfDay() ?? $maintenant->copy()->endOfDay(),
            ],
            default => [$maintenant->copy()->startOfMonth(), $maintenant->copy()->endOfMonth()],
        };

        if ($debut->gt($fin)) {
            [$debut, $fin] = [$fin->copy()->startOfDay(), $debut->copy()->endOfDay()];
        }

        return new self($debut, $fin, array_key_exists($preset, self::PRESETS) || $preset === 'perso' ? $preset : 'mois');
    }

    /** Période précédente de même durée (ex. : mois précédent pour « ce mois »). */
    public function precedente(): self
    {
        if ($this->preset === 'mois' || $this->preset === 'mois_dernier') {
            $debut = $this->debut->copy()->subMonthNoOverflow()->startOfMonth();
            return new self($debut, $debut->copy()->endOfMonth(), 'perso');
        }

        $jours = $this->nombreDeJours();
        $fin = $this->debut->copy()->subDay()->endOfDay();

        return new self($fin->copy()->subDays($jours - 1)->startOfDay(), $fin, 'perso');
    }

    public function bornes(): array
    {
        return [$this->debut, $this->fin];
    }

    public function libelle(): string
    {
        if ($this->debut->isSameDay($this->fin)) {
            return $this->debut->translatedFormat('d F Y');
        }

        return 'du ' . $this->debut->format('d/m/Y') . ' au ' . $this->fin->format('d/m/Y');
    }

    public function nombreDeJours(): int
    {
        return (int) floor(abs($this->debut->diffInDays($this->fin))) + 1;
    }

    /** Évolution en % par rapport à une valeur précédente (null si non calculable). */
    public static function evolution(float|int $actuel, float|int $precedent): ?float
    {
        if ((float) $precedent === 0.0) {
            return (float) $actuel === 0.0 ? 0.0 : null;
        }

        return round((($actuel - $precedent) / $precedent) * 100, 1);
    }

    private static function date(?string $valeur): ?Carbon
    {
        if (! $valeur) {
            return null;
        }

        try {
            return Carbon::parse($valeur);
        } catch (\Throwable) {
            return null;
        }
    }
}
