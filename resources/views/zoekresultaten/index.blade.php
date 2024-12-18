@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Zoekresultaten</h1>

    <div class="mb-8">
        <form action="{{ route('search.index') }}" method="GET" class="flex items-center">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Zoek naar spelers of teams..."
                   class="bg-white text-gray-800 py-2 px-4 rounded-full shadow-lg w-full focus:outline-none focus:ring focus:ring-blue-300">
            <button type="submit" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                Zoek
            </button>
        </form>
    </div>

    <div>
        <h2 class="text-2xl font-bold mb-4">Spelers</h2>
        @if($spelers->isEmpty())
            <p class="text-gray-600">Geen spelers gevonden.</p>
        @else
            <ul class="bg-white shadow-lg rounded-lg divide-y divide-gray-200">
                @foreach($spelers as $speler)
                    <li class="p-4 flex justify-between items-center">
                        <span>{{ $speler->voornaam }} {{ $speler->achternaam }}</span>
                        @if($speler->team)
                            <span class="text-sm text-gray-500">Team: {{ $speler->team->naam }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-10">
        <h2 class="text-2xl font-bold mb-4">Teams</h2>
        @if($teams->isEmpty())
            <p class="text-gray-600">Geen teams gevonden.</p>
        @else
            <ul class="bg-white shadow-lg rounded-lg divide-y divide-gray-200">
                @foreach($teams as $team)
                    <li class="p-4">
                        {{ $team->naam }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
