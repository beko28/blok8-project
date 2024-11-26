<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Toon het profiel van de ingelogde gebruiker.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Haal de ingelogde gebruiker op
        $user = Auth::user();

        // Geef de profielpagina weer met gebruikersgegevens
        return view('profile.show', compact('user'));
    }

    public function edit()
{
    $user = Auth::user();
    return view('profile.edit', compact('user'));
}

}
