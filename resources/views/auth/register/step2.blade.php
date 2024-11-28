@include('bovenenbeneden.header')

<div class="w-full bg-gray-200 h-1">
    <div id="progress-bar" class="bg-indigo-600 h-1" style="width: 66%;"></div>
</div>

<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">Stap 2: Aanvullende gegevens</h2>
        <form method="POST" action="{{ $role === 'speler' ? route('register.step2.speler') : route('register.step2.eigenaar') }}">
            @csrf
            @if ($role === 'speler')
            <label class="block mb-2">
                <span class="text-gray-700">Naam</span>
                <input type="text" name="naam" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>
            <label class="block mb-2">
                <span class="text-gray-700">Achternaam</span>
                <input type="text" name="achternaam" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>
            <label class="block mb-2">
                <span class="text-gray-700">Leeftijd</span>
                <input type="number" name="leeftijd" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>
            <label class="block mb-2">
                <span class="text-gray-700">Rugnummer (optioneel)</span>
                <input type="number" name="rugnummer"
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">Positie (optioneel)</span>
                <input type="text" name="positie"
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>
            @else
            <label class="block mb-2">
                <span class="text-gray-700">Voornaam</span>
                <input type="text" name="voornaam" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>
            <label class="block mb-2">
                <span class="text-gray-700">Achternaam</span>
                <input type="text" name="achternaam" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>
            <label class="block mb-4">
                <span class="text-gray-700">Leeftijd</span>
                <input type="number" name="leeftijd" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>
            @endif

            <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Volgende
            </button>
        </form>
    </div>
</div>

@include('bovenenbeneden.footer')
