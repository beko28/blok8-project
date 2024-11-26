@include('bovenenbeneden.header')

<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-4">Speler Bewerken</h1>

    <!-- Validatie fouten -->
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulier -->
    <form action="{{ route('spelers.update', $speler->id) }}" method="POST" class="bg-white shadow-md rounded p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="naam" class="block font-semibold mb-2">Naam</label>
            <input type="text" name="naam" id="naam" class="border rounded w-full p-2" value="{{ $speler->naam }}" required>
        </div>
        <div class="mb-4">
            <label for="positie" class="block font-semibold mb-2">Positie</label>
            <input type="text" name="positie" id="positie" class="border rounded w-full p-2" value="{{ $speler->positie }}" required>
        </div>
        <div class="mb-4">
            <label for="leeftijd" class="block font-semibold mb-2">Leeftijd</label>
            <input type="number" name="leeftijd" id="leeftijd" class="border rounded w-full p-2" value="{{ $speler->leeftijd }}" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Opslaan</button>
        <a href="{{ route('spelers.index') }}" class="ml-4 text-gray-600 hover:underline">Annuleren</a>
    </form>
</div>
@include('bovenenbeneden.footer')
