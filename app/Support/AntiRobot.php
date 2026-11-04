<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

/**
 * Protection des formulaires publics contre les robots, sans service externe :
 *  - un champ « piège » invisible que seuls les robots remplissent ;
 *  - un jeton chiffré qui note l'heure d'affichage du formulaire
 *    (un humain met plus de quelques secondes à le remplir) ;
 *  - des contrôles de contenu (liens, alphabets étrangers) pour les messages.
 * Le formulaire inclut : @include('frontend.components.anti-robot')
 */
class AntiRobot
{
    /** Champ piège : doit rester vide. */
    public const PIEGE = 'info_complementaire';

    /** Champ caché contenant l'heure d'affichage chiffrée. */
    public const JETON = '_fj';

    /** Délai minimal (secondes) entre l'affichage et l'envoi. */
    public const DELAI_MIN = 3;

    /** Durée de validité du formulaire (secondes) : 12 h. */
    public const DUREE_MAX = 43200;

    public static function jeton(): string
    {
        return Crypt::encryptString((string) now()->timestamp);
    }

    /**
     * Contrôle l'envoi. Renvoie null si tout va bien, sinon la raison :
     * 'piege', 'jeton', 'trop_rapide' ou 'expire'.
     */
    public static function verifier(Request $request): ?string
    {
        if (filled($request->input(self::PIEGE))) {
            return 'piege';
        }

        try {
            $affiche = (int) Crypt::decryptString((string) $request->input(self::JETON));
        } catch (\Throwable) {
            return 'jeton';
        }

        $age = now()->timestamp - $affiche;

        if ($age < self::DELAI_MIN) {
            return 'trop_rapide';
        }

        return $age > self::DUREE_MAX ? 'expire' : null;
    }

    /** Lien, balise ou domaine typique du spam. */
    public static function contientLien(?string $texte): bool
    {
        return preg_match('~(https?://|www\.|\[url|\[link|<\s*a\s|\.(ru|cn|xyz|top|click)\b)~i', (string) $texte) === 1;
    }

    /** Alphabets jamais utilisés par la clientèle (cyrillique, chinois, coréen, japonais, thaï). */
    public static function alphabetEtranger(?string $texte): bool
    {
        return preg_match('/[\p{Cyrillic}\p{Han}\p{Hangul}\p{Hiragana}\p{Katakana}\p{Thai}]/u', (string) $texte) === 1;
    }

    /** Règle de validation : refuse liens et alphabets étrangers. */
    public static function regleTexte(): \Closure
    {
        return function (string $attribut, mixed $valeur, \Closure $echec) {
            if (self::contientLien($valeur)) {
                $echec('Les liens ne sont pas autorisés dans ce formulaire.');
            } elseif (self::alphabetEtranger($valeur)) {
                $echec('Merci d\'écrire votre message en français.');
            }
        };
    }

    /** Trace une tentative bloquée (sans données personnelles complètes). */
    public static function journaliser(Request $request, string $raison): void
    {
        Log::notice('Anti-robot : envoi bloqué', [
            'raison' => $raison,
            'route' => $request->route()?->getName(),
            'ip' => $request->ip(),
            'agent' => mb_substr((string) $request->userAgent(), 0, 120),
        ]);
    }
}
