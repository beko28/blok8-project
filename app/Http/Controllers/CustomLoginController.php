<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        // Valideer input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Probeer in te loggen met de meegegeven credentials
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Login gelukt
            return redirect()->intended('/profile')->with('success', 'Je bent ingelogd!');
        }

        // Login mislukt
        return back()->withErrors([
            'email' => 'Deze inloggegevens komen niet overeen met onze records.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Je bent uitgelogd!');
    }
}
