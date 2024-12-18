<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speler;
use App\Models\Team;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $spelersQuery = Speler::query();
        $teamsQuery = Team::query();

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;

            $spelersQuery->where('voornaam', 'like', '%' . $searchTerm . '%')
                         ->orWhere('achternaam', 'like', '%' . $searchTerm . '%');

            $teamsQuery->where('naam', 'like', '%' . $searchTerm . '%');
        }

        $spelers = $spelersQuery->get();
        $teams = $teamsQuery->get();

        return view('zoekresultaten.index', compact('spelers', 'teams'));
    }
}
