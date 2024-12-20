<?php

namespace App\Http\Controllers;

use App\Models\Speler;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function showStep(Request $request, $step = 1)
    {
        $progress = $step * 33; // voortgang
        $role = session('registration.role', null);

        return view('register.index', compact('step', 'progress', 'role'));
    }

    public function processStep(Request $request, $step)
    {
        $role = session('registration.role', $request->input('role', null));

        if ($step == 1) {
            $request->validate([
                'role' => 'required|in:speler,eigenaar',
                'email' => 'required|email|unique:spelers',
                'password' => 'required|confirmed|min:8',
            ]);

            session()->put('registration', [
                'role' => $request->role,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('register.step', ['step' => 2]);
        }

        if ($step == 2) {
            if ($role === 'speler') {
                $request->validate([
                    'voornaam' => 'required|string|max:255',
                    'achternaam' => 'required|string|max:255',
                    'leeftijd' => 'required|integer|min:0',
                    'rugnummer' => 'nullable|integer',
                    'positie' => 'nullable|string|max:255',
                ]);

                session()->put('registration', array_merge(session('registration'), $request->only(['voornaam', 'achternaam', 'leeftijd', 'rugnummer', 'positie'])));
            } elseif ($role === 'eigenaar') {
                $request->validate([
                    'voornaam' => 'required|string|max:255',
                    'achternaam' => 'required|string|max:255',
                ]);

                session()->put('registration', array_merge(session('registration'), $request->only(['voornaam', 'achternaam'])));
            }

            return redirect()->route('register.step', ['step' => 3]);
        }

        if ($step == 3) {
            if ($role === 'speler') {
                $registrationData = session('registration');
                $registrationData['role'] = 'speler';
                Speler::create($registrationData);
            } elseif ($role === 'eigenaar') {
                $registrationData = session('registration');
                $registrationData['role'] = 'eigenaar';
                $speler = Speler::create($registrationData);
        
                Team::create([
                    'naam' => $request->teamnaam,
                    'adres' => $request->adres,
                    'max_spelers' => $request->max_spelers,
                    'eigenaar_id' => $speler->id,
                ]);
            }
            
            session()->forget('registration');
            return redirect()->route('home')->with('success', 'Registratie voltooid!');
        }
        
    }
}
