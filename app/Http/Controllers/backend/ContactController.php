<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Support\AntiRobot;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // liste des personnes qui ont remplir le form de contact
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return view('backend.pages.contact.index', compact('contacts'));
    }


    // regester of new message
    public function store(Request $request)
    {


        // 1️⃣ Validation des champs
        $texte = AntiRobot::regleTexte();
        $request->validate([
            'nom_prenoms' => ['required', 'string', 'min:2', 'max:100', $texte],
            'objet' => ['required', 'string', 'max:150', $texte],
            'email' => ['required', 'email', 'max:150'],
            'telephone' => ['required', 'string', 'max:20', 'regex:/^[0-9+().\s-]{8,20}$/'],
            'message' => ['required', 'string', 'min:10', 'max:3000', $texte],
        ], [
            'telephone.regex' => "Le numéro de téléphone n'est pas valide.",
            'message.min' => 'Votre message est trop court (10 caractères minimum).',
        ]);

        // Même message déjà reçu dans les dernières 24 h (double envoi ou robot) : on ne l'enregistre pas deux fois
        $doublon = Contact::where('email', $request->email)
            ->where('message', $request->message)
            ->where('created_at', '>=', now()->subDay())
            ->exists();

        if ($doublon) {
            return back()->with('success', 'Merci ! Votre message a bien été envoyé, nous vous répondons rapidement.');
        }

        Contact::create([
            'nom_prenoms' => $request->nom_prenoms,
            'objet' => $request->objet,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'message' => $request->message,
            'is_read' => false,
        ]);

        // 3️⃣ Redirection avec message de succès
        // Retour sur la page d'origine (boutique ou site vitrine)
        return back()->with('success', 'Merci ! Votre message a bien été envoyé, nous vous répondons rapidement.');
    }

    public function show($id)
    {

        $contact = Contact::findOrFail($id);

        // Marquer le message comme lu
        if (!$contact->is_read) {
            $contact->is_read = true;
            $contact->save();
        }

        return view('backend.pages.contact.partials.show', compact('contact'));
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Message supprimé avec succès', 'status' => 200]);
    }

    // supprimer un message
}
