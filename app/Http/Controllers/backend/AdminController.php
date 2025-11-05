<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use App\Models\Caisse;
use App\Models\Setting;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Models\HistoriqueCaisse;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {

        if (request()->method() == 'GET') {
            return view('backend.pages.auth-admin.login');
        } elseif (request()->method() == 'POST') {
            $credentials = $request->validate([
                'email' => ['required',],
                'password' => ['required'],
            ]);
            if (Auth::attempt($credentials)) {
                Alert::success('Connexion réussi,  Bienvenue  ' . Auth::user()->first_name, 'Success Message');
                return redirect()->route('dashboard.index');
            } else {
                // Alert::error('Email ou mot de passe incorrect' , 'Error Message');
                // return back();
                return back()->withError('Email ou mot de passe incorrect');
            }
        }
    }



    //logout admin
    public function logout(Request $request)
    {


        Auth::logout();

        Alert::success('Vous etes deconnecté', 'Success Message');
        return Redirect()->route('admin.login');
    }



    //Liste des users admin

    public function index()
    {

        $data_role = Role::get();

        $data_admin = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'client');
        })->get();
        // dd($data_admin->toArray());

        return view('backend.pages.auth-admin.register.index', compact('data_admin', 'data_role'));
    }

    // liste des clients
    public function index_client()
    {
        try {
            $clients = User::with('roles')
                ->where(function ($e) {
                    $e->whereHas('roles', function ($query) {
                        $query->where('name', 'client');
                    })->orWhere('role', 'client');
                })
                ->latest()
                ->get();

            return view('backend.pages.clients.index', compact('clients'));
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Impossible de charger les clients : ' . $e->getMessage());
            return back();
        }
    }

    // public function delete_client($id)
    // {
    //     try {
    //         User::find($id)->forceDelete();
    //         return response()->json([
    //             'status' => 200,
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => 500,
    //             'message' => $th->getMessage(),
    //         ]);
    //     }
    // }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'email' => 'required|email',
                'phone' => 'required|',
                'role' => 'required',
                'password' => 'required|min:6',
            ]);

            // Vérifier si le téléphone existe déjà
            if (User::where('phone', $request->phone)->exists()) {
                Alert::error('Le numéro de téléphone existe déjà associé à un utilisateur', 'Erreur');
                return back()->withInput();
            }

            // Vérification supplémentaire pour le numéro de téléphone
            if (!preg_match('/^[0-9]{10}$/', $request->phone)) {
                return back()->with('Erreur', 'Le numéro de téléphone doit contenir exactement 10 chiffres.');
                // Alert::error('Erreur', 'Le numéro de téléphone doit contenir exactement 10 chiffres.');
                // return back();
            }

            // Vérifier si l'email existe déjà
            if (User::where('email', $request->email)->exists()) {
                return back()->with('L\'adresse email existe déjà associé à un utilisateur', 'Erreur');

                // Alert::error('L\'adresse email existe déjà associé à un utilisateur', 'Erreur');
                // return back()->withInput();
            }

            $data_user = User::firstOrCreate([
                'username' => $request['username'],
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);

            if ($request->has('role')) {
                $data_user->assignRole($request['role']);
            }

            Alert::success('Opération réussie', 'Succès');
            return back();
        } catch (\Exception $e) {

            return back()->with('error', 'Une erreur est survenue lors de la création : ' . $e->getMessage());


            // Alert::error('Erreur', $e->getMessage());
            // return back();
        }
    }



    public function update(Request $request, $id)
    {

        try {
            $user = User::findOrFail($id);

            $updateData = [
                'username' => $request['username'],
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
            ];

            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($request->password);
            }

            $user->update($updateData);

            if ($request->has('role')) {
                $user->syncRoles($request['role']);
            }

            Alert::success('Opération réussie', 'Les informations ont été mises à jour');
            return back();
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la mise à jour : ' . $e->getMessage());
            // Alert::error('Erreur', 'Une erreur est survenue lors de la mise à jour : ' . $e->getMessage());

        }
    }

    public function delete($id)
    {
        try {
            User::find($id)->forceDelete();
            return response()->json([
                'status' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }



    public function profil($id)
    {

        $data_admin = User::find($id);
        $data_role = Role::get();
        return view('backend.pages.auth-admin.register.profil', compact('data_admin', 'data_role'));
    }

    public function changePassword(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {

            Alert::error('Ancien mot de passe incorrect', 'Error Message');
            return back();
        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        Alert::success('Operation réussi', 'Success Message');
        return back();
    }

    public function assignRole(Request $request)
    {

        try {
            $clients = User::where('role', 'client')->get();

            foreach ($clients as $client) {
                if (!$client->hasRole('client')) {
                    $client->assignRole('client');
                }
            }

            Alert::success('Rôles assignés', 'Tous les utilisateurs avec le rôle "client" ont été mis à jour.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Erreur', 'Une erreur est survenue : ' . $e->getMessage());
            return back();
        }
    }


    //importer clients
    // public function importer_client(Request $request)
    // {
    //     if ($request->isMethod('post')) {
    //         $request->validate([
    //             'csv_file' => 'required|file|mimes:csv,txt|max:2048',
    //         ]);

    //         try {
    //             $file = $request->file('csv_file');

    //             if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {

    //                 // ✅ Lire les entêtes (utiliser , car ton CSV est séparé par des virgules)
    //                 $headers = fgetcsv($handle, 1000, ",");

    //                 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    //                     $userData = array_combine($headers, $data);

    //                     // Ignorer si pas d’email
    //                     if (empty($userData['email'])) {
    //                         continue;
    //                     }

    //                     // ✅ Insertion ou mise à jour
    //                     $userImported = User::updateOrCreate(
    //                         ['email' => $userData['email']], // condition
    //                         [
    //                             'username' => trim($userData['first_name']) . ' ' . trim($userData['last_name']),
    //                             'email' => trim($userData['email']),
    //                             'password' => Hash::make($userData['password']),
    //                             'phone' => trim($userData['mobile']),
    //                             // 'commune' => trim($userData['commune'] ?? ''),
    //                             // 'quartier' => trim($userData['quartier'] ?? ''),
    //                             'created_at' => trim($userData['date_ins']) . ' ' . trim($userData['heure_ins']),
    //                             'role' => 'client',
    //                             // 'statut' => trim($userData['statut'] ?? '1'),
    //                         ]
    //                     );

    //                     // ✅ Attribuer le rôle
    //                     if (method_exists($userImported, 'assignRole')) {
    //                         $userImported->assignRole('client');
    //                     }
    //                 }

    //                 fclose($handle);
    //             }

    //             Alert::success('Importation réussie', 'Les clients ont été importés avec succès.');
    //             return redirect()->route('client.index_client');
    //         } catch (\Throwable $th) {
    //             Alert::error('Erreur', 'Une erreur est survenue : ' . $th->getMessage());
    //             return back();
    //         }
    //     }

    //     return view('backend.pages.clients.import');
    // }



    // public function importer_client(Request $request)
    // {
    //     if ($request->isMethod('post')) {
    //         $request->validate([
    //             'csv_file' => 'required|file|mimes:csv,txt,xlsx|max:4096',
    //         ]);

    //         try {
    //             Excel::import(new UsersImport, $request->file('csv_file'));
    //             Alert::success('Importation réussie', 'Les clients ont été importés avec succès.');
    //             return redirect()->route('client.index_client');
    //         } catch (\Throwable $th) {
    //             Alert::error('Erreur', 'Une erreur est survenue : ' . $th->getMessage());
    //             return back();
    //         }
    //     }

    //     return view('backend.pages.clients.import');
    // }

    public function importer_client(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'csv_file' => 'required|file|mimes:csv,txt|max:10240',
            ]);

            try {
                ini_set('max_execution_time', 600);
                ini_set('memory_limit', '1G');

                $file = $request->file('csv_file');
                $handle = fopen($file->getRealPath(), "r");

                // Lire les en-têtes
                $headers = fgetcsv($handle, 1000, ",");

                $count = 0;
                $skipped = 0;

                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (!$data || count($data) !== count($headers)) {
                        $skipped++;
                        continue;
                    }

                    $userData = array_combine($headers, $data);

                    // Vérifie si l'email ou le mobile est vide
                    if (empty($userData['email']) && empty($userData['mobile'])) {
                        $skipped++;
                        continue;
                    }

                    $email = trim(strtolower($userData['email']));
                    $phone = trim($userData['mobile']);

                    // ✅ Vérifie si le mot de passe est déjà un hash bcrypt
                    $password = trim($userData['password']);
                    // if (!preg_match('/^\$2y\$/', $password)) {
                    //     // Si ce n’est pas un hash bcrypt, on le hash
                    //     $password = Hash::make($password);
                    // }

                    // ✅ Création ou mise à jour
                    $user = User::updateOrCreate(
                        ['email' => $email], // condition de recherche
                        [
                            'username'   => trim($userData['first_name']) . ' ' . trim($userData['last_name']),
                            'email'      => $email,
                            'password'   => $password,
                            'phone'      => $phone,
                            'created_at' => trim($userData['date_ins']) . ' ' . trim($userData['heure_ins']),
                            'role'       => 'client',
                        ]
                    );

                    // ✅ Si Spatie roles/permissions
                    if (method_exists($user, 'assignRole')) {
                        $user->syncRoles(['client']);
                    }

                    $count++;
                }

                fclose($handle);

                Alert::success('Import terminé', "$count clients importés, $skipped lignes ignorées.");
                return redirect()->route('client.index_client');
            } catch (\Throwable $th) {
                Alert::error('Erreur', 'Une erreur est survenue : ' . $th->getMessage());
                return back();
            }
        }

        return view('backend.pages.clients.import');
    }





    // public function importer_client(Request $request)
    // {
    //     if ($request->isMethod('post')) {
    //         $file = $request->file('csv_file');
    //         $handle = fopen($file->getRealPath(), "r");

    //         $headers = fgetcsv($handle, 1000, ",");
    //         $sql = "INSERT INTO users (username, email, password, phone, role, created_at) VALUES\n";

    //         $values = [];
    //         while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    //             $row = array_combine($headers, $data);
    //             if (empty($row['email'])) continue;

    //             $username = addslashes(trim($row['first_name'] . ' ' . $row['last_name']));
    //             $email = addslashes(trim(strtolower($row['email'])));
    //             // $password = addslashes(Hash::make($row['password']));
    //             $password = addslashes($row['password']);
    //             $phone = addslashes(trim($row['mobile']));
    //             $role = 'client';
    //             $created = trim($row['date_ins']) . ' ' . trim($row['heure_ins']);

    //             $values[] = "('$username', '$email', '$password', '$phone', '$role', '$created')";
    //         }

    //         $sql .= implode(",\n", $values) . ";";

    //         fclose($handle);

    //         $path = storage_path('app/public/import_users2.sql');
    //         file_put_contents($path, $sql);

    //         return response()->download($path);
    //     }

    //     return view('backend.pages.clients.import');
    // }
}
