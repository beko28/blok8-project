<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speler;
use App\Models\Bericht;
use App\Models\Aanvraag;
use App\Models\Team;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $spelerId = $request->session()->get('id');
    
        if (!$spelerId) {
            return redirect()->route('login')->withErrors('Je moet ingelogd zijn om je profiel te bekijken.');
        }
    
        $speler = Speler::with('team')->findOrFail($spelerId);
    
        $berichten = Bericht::where('ontvanger_id', $spelerId)->latest()->get();
    
        $aanvragen = Aanvraag::where('speler_id', $spelerId)->latest()->get();
    
        $teams = Team::all();
    
        return view('profile.show', compact('speler', 'berichten', 'aanvragen', 'teams'));
    }
    

    public function accepteerAanvraag(Request $request, $id)
    {
        $spelerId = $request->session()->get('speler_id');
        $speler = Speler::findOrFail($spelerId);

        $aanvraag = Aanvraag::findOrFail($id);

        $speler->team_id = $aanvraag->team_id;
        $speler->save();

        $aanvraag->delete();

        return redirect()->route('profile.show')->with('success', 'Aanvraag geaccepteerd!');
    }

    public function afwijzenAanvraag($id)
    {
        $aanvraag = Aanvraag::findOrFail($id);
        $aanvraag->delete();

        return redirect()->route('profile.show')->with('success', 'Aanvraag afgewezen!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'voornaam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'email' => 'required|email|unique:spelers,email,' . $id,
            'team_id' => 'nullable|exists:teams,id',
        ]);
    
        $speler = Speler::findOrFail($id);
    
        $speler->update([
            'voornaam' => $request->voornaam,
            'achternaam' => $request->achternaam,
            'email' => $request->email,
            'team_id' => $request->team_id,
        ]);
    
        return redirect()->route('profile.show')->with('success', 'Gegevens succesvol bijgewerkt.');
    }
    
public function edit($id)
{
    $speler = Speler::findOrFail($id);
    $teams = Team::all(); // Haal alle teams op
    return view('profiel.edit', compact('speler', 'teams'));
}


public function destroy($id)
{
    $user = Speler::findOrFail($id);
    $user->delete();

    return redirect('/')->with('success', 'Je account is succesvol verwijderd.');
}


}
