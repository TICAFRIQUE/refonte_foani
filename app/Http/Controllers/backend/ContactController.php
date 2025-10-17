<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // liste des personnes qui ont remplir le form de contact
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return view('backend.pages.contact.index', compact('contacts'));
    }


    public function store(Request $request)
    {
        // 1️⃣ Validation des champs
        $request->validate([
            'nom_prenoms' => 'required|string|max:255',
            'objet' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'message' => 'required|string',
            'is_read' => 'boolean',
        ]);
        $request['is_read'] = false;


        Contact::create([
            'nom_prenom' => $request->nom_prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'message' => $request->message,
            'is_read' => $request->is_read,
        ]);

        // 3️⃣ Redirection avec message de succès
        return redirect()->route('contact.index')
            ->with('success', 'Votre message a été enregistré avec succès !');
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
}
