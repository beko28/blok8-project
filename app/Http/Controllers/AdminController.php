<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Toon een overzicht van alle gebruikers.
     */
    public function index()
    {
        $users = User::all(); // Haal alle gebruikers op
        return view('admin.index', compact('users')); // Stuur naar de view
    }

    /**
     * Toon het formulier voor het bewerken van een gebruiker.
     */
    public function edit(User $user)
    {
        return view('admin.edit', compact('user')); // Toon de bewerkpagina
    }

    /**
     * Werk de gegevens van een gebruiker bij.
     */
    public function update(Request $request, User $user)
    {
        // Valideer de invoer
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|in:admin,user', // Beperk tot geldige rollen
        ]);

        // Bijwerken van de gebruiker
        $user->update($request->only('name', 'email', 'role'));

        return redirect()->route('admin.index')->with('success', 'Gebruiker succesvol bijgewerkt.');
    }

    /**
     * Verwijder een gebruiker.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Gebruiker succesvol verwijderd.');
    }

    /**
     * Toon het formulier om een nieuwe gebruiker aan te maken.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Sla een nieuwe gebruiker op.
     */
    public function store(Request $request)
    {
        // Valideer de invoer
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        // Nieuwe gebruiker aanmaken
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('success', 'Gebruiker succesvol aangemaakt.');
    }
}
