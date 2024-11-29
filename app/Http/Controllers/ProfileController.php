<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speler;
use App\Models\Bericht;
use App\Models\Aanvraag;

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

        return view('profile.show', compact('speler', 'berichten', 'aanvragen'));
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
}
