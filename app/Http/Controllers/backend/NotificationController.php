<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Contact;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

/**
 * Notifications du back-office (badges du header et de la sidebar).
 *
 * Remplace les deux interrogations toutes les 10 s (commandes + réservations) par
 * un seul appel, mis en cache 15 s : quel que soit le nombre d'onglets ou d'admins
 * ouverts, la base n'est interrogée qu'une fois toutes les 15 s au maximum.
 */
class NotificationController extends Controller
{
    private const CACHE_KEY = 'admin.notifications';
    private const CACHE_TTL = 15; // secondes
    private const LIMITE = 5;

    public function index(): JsonResponse
    {
        $data = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            $commandes = Commande::where('statut', 'en_attente')->latest()->take(self::LIMITE)
                ->get(['id', 'code', 'nom', 'total', 'created_at']);

            $reservations = Reservation::with('produit:id,libelle')->where('statut', 'en_attente')->latest()->take(self::LIMITE)
                ->get(['id', 'code', 'nom', 'total', 'produit_id', 'created_at']);

            $messages = Contact::where('is_read', false)->latest()->take(self::LIMITE)
                ->get(['id', 'nom_prenoms', 'objet', 'created_at']);

            return [
                'counts' => [
                    'commandes' => Commande::where('statut', 'en_attente')->count(),
                    'reservations' => Reservation::where('statut', 'en_attente')->count(),
                    'messages' => Contact::where('is_read', false)->count(),
                ],
                // Date du plus récent élément de chaque type : sert à savoir s'il y a du nouveau (son)
                'latest_at' => [
                    'commandes' => $commandes->first()?->created_at?->toIso8601String(),
                    'reservations' => $reservations->first()?->created_at?->toIso8601String(),
                    'messages' => $messages->first()?->created_at?->toIso8601String(),
                ],
                'items' => [
                    'commandes' => $commandes->map(fn ($c) => [
                        'title' => $c->code ?: 'Commande',
                        'text' => trim(($c->nom ?? '') . ' · ' . number_format((float) $c->total, 0, ',', ' ') . ' FCFA', ' ·'),
                        'when' => $c->created_at?->diffForHumans(),
                        'url' => route('commandes.show', $c->id),
                    ]),
                    'reservations' => $reservations->map(fn ($r) => [
                        'title' => $r->code ?: 'Réservation',
                        'text' => trim(($r->nom ?? '') . ($r->produit ? ' · ' . $r->produit->libelle : ''), ' ·'),
                        'when' => $r->created_at?->diffForHumans(),
                        'url' => route('reservations.show', $r->id),
                    ]),
                    'messages' => $messages->map(fn ($m) => [
                        'title' => $m->nom_prenoms ?: 'Message',
                        'text' => $m->objet,
                        'when' => $m->created_at?->diffForHumans(),
                        'url' => route('contact.show', $m->id),
                    ]),
                ],
            ];
        });

        return response()->json($data)->header('Cache-Control', 'no-store');
    }

    /** À appeler quand un élément change de statut, pour que les badges se mettent à jour tout de suite. */
    public static function oublier(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
