<?php

namespace App\Http\Controllers;

use App\Models\Speler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = Speler::all();
        return view('admin.index', compact('users')); // Stuur naar de view
    }

    public function edit(Speler $user)
    {
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, Speler $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|in:admin,speler', 
        ]);

        $user->update($request->only('name', 'email', 'role'));

        return redirect()->route('admin.index')->with('success', 'Gebruiker succesvol bijgewerkt.');
    }

    public function destroy(Speler $user)
    {
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Gebruiker succesvol verwijderd.');
    }

    public function create()
    {
        return view('admin.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:admin,speler',
        ]);

        Speler::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('success', 'Gebruiker succesvol aangemaakt.');
    }
}
