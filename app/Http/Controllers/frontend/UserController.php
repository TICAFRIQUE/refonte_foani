<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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

    //login de la nouvelle version du site
    // public function login(Request $request)
    // {

    //     // Valider les données du formulaire
    //     $request->validate(
    //         [
    //             'phone' => 'required|string|min:10|max:10',
    //             'password' => 'required|string|min:6',
    //         ],
    //         [
    //             'phone.required' => 'Le numéro de téléphone est requis.',
    //             //le numero de telephone doit contenir 10 chiffres minimum
    //             'phone.min' => 'Le numéro de téléphone doit contenir au moins 10 chiffres.',
    //             'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 10 chiffres.',
    //             'password.required' => 'Le mot de passe est requis.',
    //             'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
    //         ]
    //     );
    //     $credentials = $request->only('phone', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed...
    //         $request->session()->regenerate();

    //         $redirectUrl = session()->pull('redirect_after_login', '/');

    //         // ✅ Empêche les redirections externes
    //         if (!str_starts_with($redirectUrl, url('/'))) {
    //             $redirectUrl = '/';
    //         }

    //         return redirect($redirectUrl)->with('success', 'Connexion réussie !');
    //     }

    //     return back()->withErrors('Numéro de téléphone ou mot de passe incorrect.')->withInput();
    // }

    public function login(Request $request)
    {
        // 1️⃣ Validation
        $request->validate([
            'phone' => 'required|string|size:10',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return back()->withErrors(['phone' => 'Numéro de téléphone ou mot de passe incorrect.'])->withInput();
        }

        $password = $request->password;

        // 2️⃣ Détection du type de hash
        if ($this->isSha1($user->password)) {
            // SHA-1
            if (sha1($password) === $user->password) {
                Auth::login($user);
                $request->session()->regenerate();

                // Ré-hashage en Bcrypt
                $user->password = Hash::make($password);
                $user->save();

                return redirect('/')->with('success', 'Connexion réussie (mot de passe mis à jour) !');
            }
        } else {
            // Bcrypt classique
            if (Hash::check($password, $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();

                return redirect('/')->with('success', 'Connexion réussie !');
            }
        }

        // 3️⃣ Échec
        return back()->withErrors(['phone' => 'Numéro de téléphone ou mot de passe incorrect.'])->withInput();
    }

    private function isSha1(string $password): bool
    {
        return strlen($password) === 40 && preg_match('/^[a-f0-9]{40}$/i', $password);
    }


    public function register(Request $request)
    {

        // Valider les données du formulaire
        $request->validate([
            'email' => 'nullable|email|unique:users',
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
            $user = User::create([
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

            $request->session()->regenerate();

            $redirectUrl = session()->pull('redirect_after_login', '/');

            // ✅ Empêche les redirections externes
            if (!str_starts_with($redirectUrl, url('/'))) {
                $redirectUrl = '/';
            }

            return redirect($redirectUrl)->with('success', 'Inscription réussie !');
        } catch (\Throwable $th) {
            return back()->withErrors('Une erreur est survenue lors de l\'inscription : ' . $th->getMessage());
        }
    }

    //mes commandes
    public function mesCommandes()
    {
        try {
            $commandes = Commande::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
            return view('frontend.pages.dashboard_client.commandes', compact('commandes'));
        } catch (\Throwable $th) {
            return back()->withErrors('Une erreur est survenue lors de la récupération des commandes : ' . $th->getMessage());
        }
    }

    //détail d'une commande
    public function mesCommandesShow($id)
    {
        try {
            $commande = Commande::with('produits')->where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            return view('frontend.pages.dashboard_client.commande_detail', compact('commande'));
        } catch (\Throwable $th) {
            return back()->withErrors('Une erreur est survenue lors de la récupération de la commande : ' . $th->getMessage());
        }
    }


    //MES RESERVATIONS
    public function mesReservations()
    {
        try {
            $reservations = Reservation::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
            return view('frontend.pages.dashboard_client.reservations', compact('reservations'));
        } catch (\Throwable $th) {
            return back()->withErrors('Une erreur est survenue lors de la récupération des reservations : ' . $th->getMessage());
        }
    }

    //détail d'une commande
    public function mesReservationsShow($id)
    {
        try {

            $reservation = Reservation::with('produit')->where('user_id', Auth::id())->where('id', $id)->firstOrFail();

            return view('frontend.pages.dashboard_client.reservation_detail', compact('reservation'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Une erreur est survenue lors de la récupération de la reservation : ' . $th->getMessage());
        }
    }

    public function profil(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'nullable|email|unique:users,email,' . $user->id,
                'phone' => 'required|string|min:10|max:10|unique:users,phone,' . $user->id,
                'password' => 'nullable|string|min:6|confirmed',
            ], [
                'username.required' => 'Le nom d\'utilisateur est requis.',
                'email.email' => 'L\'adresse email doit avoir un format valide.',
                'email.unique' => 'Cet email est deja utilisé.',
                'phone.required' => 'Le numéro de téléphone est requis.',
                'phone.min' => 'Le numéro de téléphone doit contenir au moins 10 chiffres.',
                'phone.max' => 'Le numéro de téléphone ne doit pas dépasser 10 chiffres.',
                'phone.unique' => 'Ce numéro de téléphone est deja utilisé.',
                'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
                'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
            ]);


            User::where('id', $user->id)->update([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => trim($request->phone),
                'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            ]);

            return back()->with('success', 'Profil mis à jour avec succès !');
        }

        return view('frontend.pages.dashboard_client.profil', compact('user'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Alert::success('Déconnexion', 'Déconnexion réussie !');
        return redirect()->route('accueil');
    }
}
