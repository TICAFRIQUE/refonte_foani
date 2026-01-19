<?php

namespace App\Http\Controllers\frontend;

use App\Models\Ville;
use App\Models\Commune;
use App\Models\Produit;
use App\Models\Commande;
use App\Services\smsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\TicAfriqueSms;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class PanierController extends Controller
{

    // Afficher le panier
    public function index()
    {
        $panier_sessions = Session::get('panier', []);
        $panier = [];

        foreach ($panier_sessions as $id => $item) {
            $produit = Produit::find($id);
            if ($produit) {
                // On ajoute la quantité stockée en session à l'objet produit
                $produit->quantite = $item['quantite'];
                $panier[] = $produit;
            }
        }

        return view('frontend.pages.commande.panier', compact('panier'));
    }

    // Ajouter un produit au panier
    public function add(Request $request, $produit_id)
    {
        $produit = Produit::findOrFail($produit_id);
        $panier = Session::get('panier', []);

        if (isset($panier[$produit_id])) {
            $panier[$produit_id]['quantite'] += 1;
        } else {
            $panier[$produit_id] = [
                'quantite' => 1,
            ];
        }

        Session::put('panier', $panier);
        $count = array_sum(array_column($panier, 'quantite'));

        return response()->json([
            'success' => true,
            'count' => $count,
            'message' => 'Produit ajouté au panier.'
        ]);
    }

    // Mettre à jour la quantité d’un produit
    public function update(Request $request, $produit_id)
    {
        $quantite = (int) $request->input('quantite');
        $panier = Session::get('panier', []);

        if (isset($panier[$produit_id])) {
            $panier[$produit_id]['quantite'] = $quantite;
            Session::put('panier', $panier);
        }

        return response()->json(['success' => true]);
    }

    // Supprimer un produit du panier
    public function remove($produit_id)
    {
        $panier = Session::get('panier', []);
        if (isset($panier[$produit_id])) {
            unset($panier[$produit_id]);
            Session::put('panier', $panier);
        }

        return response()->json(['success' => true]);
    }


    //caisse
    public function caisse()
    {
        $panier_sessions = Session::get('panier', []);
        $panier = [];

        foreach ($panier_sessions as $id => $item) {
            $produit = Produit::find($id);
            if ($produit) {
                $produit->quantite = $item['quantite'];
                $panier[] = $produit;
            }
        }

        // recuperer les communes et villes de livraison
        $villes = Ville::active()->alphabetique()->get();
        $communes = Commune::active()->alphabetique()->get();

        return view('frontend.pages.commande.caisse', compact('panier', 'villes', 'communes'));
    }



    public function commandeStore(Request $request)
    {
        // 🔐 Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()
                ->route('user.loginForm')
                ->with('error', 'Veuillez vous connecter pour valider votre commande.');
        }

        // 🧾 Validation des données du formulaire
        $request->validate([
            'username'        => 'required|string|max:255',
            'phone'           => 'required|string|max:10|min:10',
            'email'           => 'nullable|email|max:255',
            'commune'         => 'required|exists:communes,id',
            'quartier'        => 'required|string|max:255',
            'frais_livraison' => 'required|numeric',
            'sous_total'      => 'required|numeric|min:10000',
            'total_general'   => 'required|numeric|min:10000',
        ], [
            'commune.exists' => 'La commune choisie n\'existe pas.',
            'phone.required' => 'Le numéro de téléphone est obligatoire pour vous contacter.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'phone.min' => 'Le numéro de téléphone doit contenir au moins 10 chiffres.',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 10 chiffres.',
            'quartier.required' => 'Le quartier est obligatoire.',
            'frais_livraison.required' => 'Le frais de livraison est obligatoire.',
            'sous_total.required' => 'Le sous-total est obligatoire.',
            'total_general.required' => 'Le total general est obligatoire.',
            'total_general.min' => 'Le total general doit etre au moins 10 000 FCFA.',
            'sous_total.min' => 'Le sous-total doit etre au moins 10 000 FCFA.',
        ]);

        // 🛒 Vérification du panier en session
        $panier_sessions = Session::get('panier', []);
        if (empty($panier_sessions)) {
            return redirect()->back()->with('error', 'Votre panier est vide.');
        }

        // 📍 Récupération des infos de la commune et ville
        $commune = Commune::findOrFail($request->commune);
        $ville = Ville::find($commune->ville_id);

        try {
            // 💾 Transaction : tout ou rien
            $commande = DB::transaction(function () use ($request, $panier_sessions, $commune, $ville) {

                // 🔸 Création de la commande
                $commande = Commande::create([
                    'user_id'        => Auth::id(),
                    'code'           => uniqid('CMD-'),
                    'sous_total'     => $request->sous_total,
                    'frais_livraison' => $request->frais_livraison,
                    'total'          => $request->total_general,
                    'nom'            => $request->username,
                    'telephone'      => $request->phone,
                    'adresse'        => $request->quartier,
                    'ville'          => $ville->libelle ?? '',
                    'commune'        => $commune->libelle,
                    'statut'         => 'en_attente',
                    'mode_paiement'  => 'espece',
                    'date_commande'  => now(),
                ]);

                // 🔹 Enregistrement des produits liés à la commande avec détails
                $produits_details = [];
                foreach ($panier_sessions as $id => $item) {
                    $produit = Produit::find($id);
                    if ($produit) {
                        $total_produit = $produit->prix_de_vente * $item['quantite'];

                        $commande->produits()->attach($produit->id, [
                            'quantite'      => $item['quantite'],
                            'prix_unitaire' => $produit->prix_de_vente,
                            'total'         => $total_produit,
                        ]);

                        // Stocker les détails pour le SMS
                        $produits_details[] = [
                            'nom' => $produit->libelle,
                            'quantite' => $item['quantite'],
                            'prix_unitaire' => $produit->prix_de_vente,
                            'total' => $total_produit
                        ];
                    }
                }

                // Ajouter les détails des produits à la commande pour usage ultérieur
                $commande->produits_details = $produits_details;

                // 🧹 Nettoyer le panier après succès
                Session::forget('panier');

                return $commande;
            });

            // 📱 Envoi SMS à l'administrateur après succès de la transaction
            $ticAfriqueService = new TicAfriqueSms();
            $ticAfriqueService->sendNewOrderSms($commande);

            // ✅ Si tout s'est bien passé
            return redirect()
                ->route('panier.index')
                ->with('success', 'Commande enregistrée avec succès !');
        } catch (\Exception $e) {
            // ❌ En cas d'erreur
            return redirect()
                ->back()
                ->with('error', "Erreur lors de l'enregistrement de la commande : " . $e->getMessage());
        }
    }





    ################################# SMS ADMINISTRATEUR #################################





    /**
     * 📱 Envoyer SMS de notification à l'administrateur
     */
    private function envoyerSmsAdministrateur($commande, $request)
    {
        try {
            $smsService = new smsService();

            // 📞 Numéro de l'administrateur (à configurer dans .env)
            $numero_admin = '2250142855584'; // Numéro par défaut
            // // $numero_admin = ltrim($numero_admin, '0'); // retire le 0 au début
            // $numero_admin = '225' . $numero_admin; // ajoute l’indicatif du pays

            // 📋 Construction du message détaillé
            $message = $this->construireMessageAdmin($commande, $request);

            // 📤 Envoi du SMS
            $response = $smsService->send(
                env('SMS_API_USERNAME'),
                env('SMS_API_PASSWORD'),
                env('SMS_API_SENDER', 'FOANI'),
                $message,
                0, // Message normal (pas flash)
                env('SMS_ADMIN_PHONE'),
            );

            // 📝 Log pour debug (optionnel)
            Log::info('SMS Admin envoyé', [
                'commande_id' => $commande->id,
                'message' => $message,
                'numero' => env('SMS_ADMIN_PHONE'),
                'response' => $response
            ]);
        } catch (\Exception $e) {
            // 🚨 En cas d'erreur SMS, on ne fait pas échouer la commande
            Log::error('Erreur envoi SMS Admin', [
                'commande_id' => $commande->id,
                'error' => $e->getMessage()
            ]);
        }
    }






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
                $nom = strtolower($nom); //mettre en lowercase
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



    /**
     * 📱 Méthode pour envoyer SMS de confirmation au client (bonus)
     */
    private function envoyerSmsClient($commande)
    {
        try {
            $smsService = new smsService();

            // 📞 Numéro du client
            $numero_client = ltrim($commande->telephone, '0');
            $numero_client = '225' . $numero_client;

            // 📝 Message de confirmation client
            $message = "🎉 Commande confirmée !\n";
            $message .= "━━━━━━━━━━━━━━━━━━━━━━\n";
            $message .= "📦 N° {$commande->code}\n";
            $message .= "💰 Total: " . number_format($commande->total, 0, ',', ' ') . " FCFA\n";
            $message .= "📍 Livraison: {$commande->quartier}, {$commande->commune}\n";
            $message .= "━━━━━━━━━━━━━━━━━━━━━━\n";
            $message .= "🚚 Livraison dans 24-48h\n";
            $message .= "📞 Support: 05 05 96 96 25\n";
            $message .= "🙏 Merci de votre confiance !\n";
            $message .= "🌐 www.foani.ci";

            // 📤 Envoi
            $response = $smsService->send(
                env('SMS_API_USERNAME'),
                env('SMS_API_PASSWORD'),
                env('SMS_API_SENDER', 'FOANI'),
                $message,
                0,
                $numero_client
            );
        } catch (\Exception $e) {
            Log::error('Erreur envoi SMS Client', [
                'commande_id' => $commande->id,
                'error' => $e->getMessage()
            ]);
        }
    }

    // ...existing code pour les autres méthodes...

    /**
     * Envoyer un SMS de confirmation de commande (TEST)
     */
    public function send(Request $request)
    {
        $sms = new smsService();

        // On récupère la dernière commande
        $commande = Commande::latest()->first();

        if (!$commande) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aucune commande trouvée.'
            ]);
        }

        // Numéro du client (à adapter selon ta base)
        // $numero = Auth::user()->telephone ?? $request->get('telephone');
        $numero = '0779613593'; // numéro de test
        $numero = ltrim($numero, '0'); // retire le ²0 au début
        $numero = '225' . $numero; // ajoute l’indicatif du pays

        // Construire un message court compatible SMS
        $message = "Nouvelle commande FOANI: ";
        $message .= "Cmd #{$commande->code}, ";
        $message .= "Client: {$commande->nom}, ";
        $message .= "Tel: {$commande->telephone}, ";
        $message .= "Total: " . number_format($commande->total, 0, ',', ' ') . " FCFA, ";

        if (!$numero) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aucun numéro de téléphone fourni.'
            ]);
        }

        // Message
        // $message = "Bonjour " . Auth::user()->username .
        //     ", votre commande #{$commande->id} a été validée avec succès.";

        // Envoi du SMS
        $response = $sms->send(
            env('SMS_API_USERNAME'),
            env('SMS_API_PASSWORD'),
            'FOANI',
            $message,
            0, // flash message : 0 = normal, 1 = message flash
            '2250779613593', // <= très important !
        );

        return response()->json([
            'status' => 'ok',
            'response' => $response
        ]);
    }
}
