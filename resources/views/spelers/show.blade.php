@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white shadow rounded-lg">
    <h1 class="text-3xl font-bold mb-6">{{ $speler->voornaam }} {{ $speler->achternaam }}</h1>
    <p><strong>Email:</strong> {{ $speler->email }}</p>
    <p><strong>Positie:</strong> {{ $speler->positie }}</p>

    @if($speler->acceptedTeams->isNotEmpty())
        <p><strong>Team:</strong> {{ $speler->acceptedTeams->first()->naam }}</p>
    @elseif($speler->role === 'eigenaar' && $speler->teamEigenaar)
        <p><strong>Eigenaar van:</strong> {{ $speler->teamEigenaar->naam }}</p>
    @else
        <p><em>Geen team</em></p>
    @endif
</div>
@endsection
