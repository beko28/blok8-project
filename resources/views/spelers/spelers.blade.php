@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Spelers Beheer</h1>
        <a href="{{ route('spelers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800">
            Nieuwe Speler Toevoegen
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        @if($spelers->isEmpty())
            <p class="text-gray-600">Er zijn nog geen spelers toegevoegd.</p>
        @else
        <table class="min-w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2 text-left">#</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Naam</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Positie</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Leeftijd</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($spelers as $speler)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-200 px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $speler->naam }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $speler->positie }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $speler->leeftijd }}</td>
                    <td class="border border-gray-200 px-4 py-2">
                        <a href="{{ route('spelers.edit', $speler->id) }}" class="text-blue-600 hover:underline mr-2">Bewerken</a>
                        <form action="{{ route('spelers.destroy', $speler->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Verwijderen</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
