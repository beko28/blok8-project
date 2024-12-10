<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nieuws;

class NieuwsController extends Controller
{
    public function index()
    {
        $nieuws = Nieuws::latest()->get();
        return view('nieuws.index', compact('nieuws'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'eigenaar') {
            return redirect()->route('nieuws.index')->withErrors('Je hebt geen rechten om nieuws aan te maken.');
        }
    
        return view('nieuws.create');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'titel' => 'required|string|max:255',
            'inhoud' => 'required|string',
        ]);

        Nieuws::create([
            'titel' => $request->titel,
            'inhoud' => $request->inhoud,
        ]);

        return redirect()->route('nieuws.index')->with('success', 'Nieuws succesvol toegevoegd!');
    }
}
