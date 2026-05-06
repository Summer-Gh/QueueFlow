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
    

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}