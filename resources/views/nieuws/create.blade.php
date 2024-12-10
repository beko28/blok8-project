@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Nieuws Aanmaken</h1>

    <form action="{{ route('nieuws.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="titel" class="block font-bold">Titel</label>
            <input type="text" name="titel" id="titel" class="w-full border border-gray-300 rounded p-2" required>
        </div>
        <div class="mb-4">
            <label for="inhoud" class="block font-bold">Inhoud</label>
            <textarea name="inhoud" id="inhoud" rows="5" class="w-full border border-gray-300 rounded p-2" required></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Opslaan</button>
    </form>
</div>
@endsection
