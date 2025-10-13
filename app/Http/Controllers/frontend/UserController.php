<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function loginForm()
    {
        return view('frontend.pages.auth.login');
    }
    public function registerForm()
    {
        return view('frontend.pages.auth.register');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/caisse')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ])->withInput();
    }
    public function register(Request $request)
    {

        // Valider les données du formulaire
        $request->validate([
            'email' => 'unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|min:10|max:10|unique:users',
            'username' => 'required|string|max:255',
        ], [
            'email.unique' => 'Cet email est déjà utilisé.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'phone.required' => 'Le numéro de téléphone est requis.',
            'username.required' => 'Le nom d\'utilisateur est requis.',

            //le numero de telephone doit contenir 10 chiffres minimum
            'phone.min' => 'Le numéro de téléphone doit contenir au moins 10 chiffres.',
            'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 10 chiffres.',
            'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
        ]);

        try {
            // Créer un nouvel utilisateur
            $user = \App\Models\User::create([
                'phone' => trim($request->phone),
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'client',
            ]);

            // Assignation du rôle "client" à l'utilisateur
            $user->assignRole('client');

            // Connecter automatiquement l'utilisateur après l'inscription
            Auth::login($user);

            // Rediriger vers une page spécifique après l'inscription
            return redirect('/caisse')->with('success', 'Inscription réussie !');
        } catch (\Throwable $th) {
            return back()->withErrors('Une erreur est survenue lors de l\'inscription : ' . $th->getMessage());
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
