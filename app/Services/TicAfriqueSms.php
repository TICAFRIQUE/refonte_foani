<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class TicAfriqueSms
{
    /**
     * Envoyer un SMS via l'API TIC Afrique
     */
    private function sendSms($numero, $message)
    {
        $apiKey = 'sk_dc830cc321f38bdac8f026edbd051386e9886c498478fe75bd24b45f652a1d89';
        $url = 'https://sms.ticafrique.ci/api/v1/sms/send';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'to' => $numero,
            'message' => $message,
            'sender_id' => 'FOANI'
        ]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return [
            'http_code' => $httpCode,
            'response' => $response
        ];
    }



    /**Envoyer un SMS  a l'administrateur pour la nouvelle commande */
    public function sendNewOrderSms($commande)
    {
        // Préparer le numéro (ajouter +225 si besoin)
        $numero = '+2250779613593';
        
        // Construire le message
        $message = $this->construireMessageAdmin($commande);
        
        // Envoyer le SMS
        $result = $this->sendSms($numero, $message);

        // Log du résultat
        Log::info('SMS TIC Afrique envoyé', [
            'commande_id' => $commande->id,
            'numero' => $numero,
            'message' => $message,
            'http_code' => $result['http_code'],
            'response' => $result['response']
        ]);
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
