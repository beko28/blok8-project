<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speler;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Speler::with('team');
    
        if ($request->has('search') && $request->search) {
            $query->where('voornaam', 'like', '%' . $request->search . '%')
                  ->orWhere('achternaam', 'like', '%' . $request->search . '%');
        }
    
        $spelers = $query->get();
    
        return view('spelers.index', compact('spelers'));
    }
}
