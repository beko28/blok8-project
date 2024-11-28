<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');
        // Voeg je zoeklogica hier toe
        return view('search.results', compact('query'));
    }
}

