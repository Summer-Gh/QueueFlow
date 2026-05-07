<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use App\Models\utilisateurs;

class AuthController extends Controller
{
    // =========================
    // SHOW LOGIN
    // =========================
    public function showLogin()
    {
        if (session()->has('user_id')) {
            return redirect('/dashboard');
        }

        return view('login');
    }

    // =========================
    // SHOW REGISTER
    // =========================
    public function showRegister()
    {
        return view('register');
    }

    // =========================
    // LOGIN
    // =========================
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)
                    ->where('mdp', $password)
                    ->first();

        if ($user) {

            // detect role
            $isAgent = Agent::where('idUser', $user->idUser)->exists();

            session()->flush();

            session([
                'user_id' => $user->idUser,
                'user_nom' => $user->nom,
                'role' => $isAgent ? 'agent' : 'utilisateur'
            ]);

            return redirect('/dashboard');
        }

        return back()->with('error', 'Email ou mot de passe incorrect');
    }

    // =========================
    // REGISTER (SIGN UP)
    // =========================
    public function register(Request $request)
    {
    $request->validate([
        'nom' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:3|same:c_password',
        'c_password' => 'required'
    ], [
        'password.same' => 'Les mots de passe ne correspondent pas'
    ]);

    // create user
    $user = User::create([
        'nom' => $request->nom,
        'email' => $request->email,
        'mdp' => $request->password
    ]);

    // create utilisateur (optional telephone)
    utilisateurs::create([
        'idUser' => $user->idUser,
        'Telephone' => $request->telephone
    ]);

    return redirect('/login')->with('success', 'Compte créé avec succès');
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
    // =========================
    // PROFILE PAGE
    // =========================
    public function profile()
    {
    $user = User::find(session('user_id'));

    return view('profile', compact('user'));
    }

// =========================
// UPDATE PROFILE
// =========================
    public function updateProfile(Request $request)
    {
    $user = User::find(session('user_id'));

    $user->nom = $request->nom;
    $user->email = $request->email;

    if($request->password != null){
        $user->mdp = $request->password;
    }

    $user->save();

    session([
        'user_nom' => $user->nom
    ]);

    return back()->with('success', 'Profil modifié avec succès');
    }

// =========================
// DELETE PROFILE
// =========================
    public function deleteProfile()
    {
    $userId = session('user_id');

    // delete utilisateur row first
    \App\Models\utilisateurs::where('idUser', $userId)->delete();

    // delete tickets
    \App\Models\Ticket::where('idUser', $userId)->delete();

    // delete services created by this user
    $services = \App\Models\Service::where('idUser', $userId)->get();

    foreach($services as $service){

        $file = \App\Models\FileAttente::where(
            'idService',
            $service->idService
        )->first();

        if($file){

            \App\Models\Ticket::where(
                'idFile',
                $file->idFile
            )->delete();

            $file->delete();
        }

        $service->delete();
    }

    // finally delete user
    \App\Models\User::where('idUser', $userId)->delete();

    session()->flush();

    return redirect('/')
        ->with('success', 'Compte supprimé avec succès');
    }
}
