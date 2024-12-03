@extends('layout')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold text-gray-800">{{ $poule->naam }}</h1>

    <h2 class="text-2xl mt-6 font-semibold text-gray-700">Teams in deze poule</h2>

    @if($poule->teams->isEmpty())
        <p class="text-gray-500 mt-4">Er zijn nog geen teams toegewezen aan deze poule.</p>
    @else
        <ul class="mt-4 bg-white rounded shadow-md divide-y divide-gray-200">
            @foreach($poule->teams as $team)
                <li class="px-4 py-3 flex justify-between items-center">
                    <span class="font-medium text-gray-800">{{ $team->naam }}</span>
                    <span class="text-sm text-gray-500">{{ $team->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-6">
        <a href="{{ route('poules.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
            Terug naar overzicht
        </a>
    </div>
</div>
@endsection
