<?php

namespace App\Http\Middleware;

use App\Support\AntiRobot;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Bloque les envois de formulaires faits par des robots (voir App\Support\AntiRobot).
 * Usage sur une route : ->middleware('antirobot')
 */
class AntiRobotMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $raison = AntiRobot::verifier($request);

        if ($raison === null) {
            return $next($request);
        }

        AntiRobot::journaliser($request, $raison);

        // Champ piège rempli : c'est un robot. On fait comme si tout s'était bien passé,
        // pour qu'il ne cherche pas à contourner la protection.
        if ($raison === 'piege') {
            return back()->with('success', $request->routeIs('contact.store')
                ? 'Merci ! Votre message a bien été envoyé, nous vous répondons rapidement.'
                : 'Votre demande a bien été prise en compte.');
        }

        $message = match ($raison) {
            'trop_rapide' => 'Envoi trop rapide. Patientez quelques secondes puis réessayez.',
            default => 'Le formulaire a expiré. Rechargez la page puis réessayez.',
        };

        $retour = back()
            ->withInput($request->except(['password', 'password_confirmation', AntiRobot::PIEGE, AntiRobot::JETON]))
            ->withErrors(['formulaire' => $message]);

        // Les pages de contact affichent les messages « error » en notification
        return $request->routeIs('contact.store') ? $retour->with('error', $message) : $retour;
    }
}
