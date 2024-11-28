@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Poule Bewerken</h1>

    <!-- Validatiefouten -->
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('poules.update', $poule->id) }}" method="POST" class="bg-white p-6 shadow-md rounded">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="naam" class="block text-gray-700 font-bold mb-2">Naam:</label>
            <input type="text" name="naam" id="naam" class="w-full p-2 border rounded" value="{{ old('naam', $poule->naam) }}" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
            Bijwerken
        </button>
        <a href="{{ route('poules.index') }}" class="ml-4 text-gray-600 hover:underline">Annuleren</a>
    </form>
</div>
@endsection
