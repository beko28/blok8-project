@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-6">Overzicht van Spelers</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($spelers->isEmpty())
        <p class="text-gray-600">Er zijn geen spelers toegevoegd.</p>
    @else
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2">#</th>
                    <th class="border border-gray-200 px-4 py-2">Naam</th>
                    <th class="border border-gray-200 px-4 py-2">Positie</th>
                    <th class="border border-gray-200 px-4 py-2">Leeftijd</th>
                </tr>
            </thead>
            <tbody>
                @foreach($spelers as $speler)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $speler->naam }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $speler->positie }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $speler->leeftijd }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
