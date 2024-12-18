@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-4xl font-extrabold mb-8 text-gray-900 text-center">Zoekresultaten</h1>

    <div class="mb-12">
        <form action="{{ route('search.index') }}" method="GET" class="flex items-center justify-center">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Zoek naar spelers of teams..."
                   class="bg-gray-100 text-gray-800 py-3 px-6 rounded-l-full shadow-lg w-3/4 lg:w-1/2 focus:outline-none focus:ring focus:ring-blue-400">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-r-full hover:bg-blue-600 transition">
                Zoek
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Spelers Sectie -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Spelers</h2>
            @if($spelers->isEmpty())
                <p class="text-gray-500 italic">Geen spelers gevonden.</p>
            @else
                <ul class="bg-white shadow-md rounded-lg divide-y divide-gray-200">
                    @foreach($spelers as $speler)
                        <li class="p-4 flex justify-between items-center hover:bg-gray-50 transition">
                            <div>
                                <span class="font-medium text-gray-900">{{ $speler->voornaam }} {{ $speler->achternaam }}</span>
                                @if($speler->team)
                                    <span class="block text-sm text-gray-500">Team: {{ $speler->team->naam }}</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Teams Sectie -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Teams</h2>
            @if($teams->isEmpty())
                <p class="text-gray-500 italic">Geen teams gevonden.</p>
            @else
                <ul class="bg-white shadow-md rounded-lg divide-y divide-gray-200">
                    @foreach($teams as $team)
                        <li class="p-4 hover:bg-gray-50 transition">
                            <span class="font-medium text-gray-900">{{ $team->naam }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
