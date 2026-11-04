<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

/**
 * Envoi de SMS via l'API TIC Afrique.
 * Réglages dans le .env (lus via config/services.php) :
 *   TICAFRIQUE_SMS_KEY  clé API
 *   SMS_ADMIN_PHONE     numéro(s) de l'administrateur, séparés par des virgules
 */
class TicAfriqueSms
{
    /**
     * Envoyer un SMS via l'API TIC Afrique
     */
    private function sendSms(string $numero, string $message): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('services.ticafrique.url'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'to' => $numero,
            'message' => $message,
            'sender_id' => config('services.ticafrique.sender'),
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Délais courts : l'envoi a lieu juste après la commande, le client ne doit pas attendre
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . config('services.ticafrique.key'),
            'Content-Type: application/json',
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $erreur = curl_error($ch);

        return [
            'http_code' => $httpCode,
            'response' => $response === false ? $erreur : $response,
        ];
    }

    /**
     * Numéros de l'administrateur (SMS_ADMIN_PHONE), au format international +225XXXXXXXXXX.
     * Accepte « 0700000000 », « 2250700000000 » ou « +225 07 00 00 00 00 », séparés par des virgules.
     */
    public static function numerosAdmin(): array
    {
        return collect(explode(',', (string) config('services.ticafrique.admin_phone')))
            ->map(fn ($n) => preg_replace('/\D/', '', $n))
            ->filter()
            ->map(fn ($n) => '+' . (strlen($n) === 10 ? '225' . $n : $n))
            ->unique()
            ->values()
            ->all();
    }

    /** Envoyer un SMS à l'administrateur pour la nouvelle commande */
    public function sendNewOrderSms($commande): void
    {
        $numeros = self::numerosAdmin();

        if (! $numeros || ! config('services.ticafrique.key')) {
            Log::warning('SMS TIC Afrique non envoyé : SMS_ADMIN_PHONE ou TICAFRIQUE_SMS_KEY manquant dans le .env', [
                'commande_id' => $commande->id,
            ]);

            return;
        }

        $message = $this->construireMessageAdmin($commande);

        foreach ($numeros as $numero) {
            $result = $this->sendSms($numero, $message);

            Log::info('SMS TIC Afrique envoyé', [
                'commande_id' => $commande->id,
                'numero' => $numero,
                'message' => $message,
                'http_code' => $result['http_code'],
                'response' => $result['response'],
            ]);
        }
    }

    /**
     * Construire le message pour l'administrateur
     */
    private function construireMessageAdmin($commande)
    {
        // Fonction pour enlever les accents
        $clean = function ($str) {
            return str_replace(
                ['é', 'è', 'ê', 'à', 'ù', 'â', 'î', 'ô', 'û', 'ï', 'ö', 'ë', 'ç'],
                ['e', 'e', 'e', 'a', 'u', 'a', 'i', 'o', 'u', 'i', 'o', 'e', 'c'],
                $str
            );
        };

        // Nettoyage des infos client
        $nom = $clean($commande->nom);
        $commune = $clean($commande->commune);
        $adresse = $clean($commande->adresse);

        // Produits en une seule ligne, compressés
        $produits = collect($commande->produits_details)
            ->map(function ($p) use ($clean) {
                $nom = $clean($p['nom']);
                $nom = substr($nom, 0, 20); // raccourcir
                $nom = strtolower($nom); // mettre en lowercase
                return $nom . 'x' . $p['quantite'] . ' de ' . $p['prix_unitaire'];
            })
            ->implode(',');

        // Message compressé
        $message = "Commande:{$nom} {$commande->telephone} Ad:{$commune} {$adresse} Liv:"
            . number_format($commande->frais_livraison, 0, '', '')
            . " Total:" . number_format($commande->total, 0, '', '')
            . " Prod:{$produits}";

        // Limite 160 caracteres
        return substr($message, 0, 160);
    }
}
