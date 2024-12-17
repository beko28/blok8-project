@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    <h1 class="text-4xl font-extrabold mb-10 text-center text-blue-800">Team Manager voor {{ $team->naam }}</h1>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6 shadow">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Teamgegevens bewerken -->
    <div class="bg-white p-8 rounded-lg shadow-md mb-10">
        <div class="flex items-center mb-6 space-x-3">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17a2.75 2.75 0 115.5 0M12 3.75v12.5M19.5 12H4.5"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Teamgegevens Bewerken</h2>
        </div>
        
        <form class="space-y-6" method="POST" action="{{ route('teammanager.updateTeam') }}">
            @csrf
            @method('PUT')
            <div>
                <label for="naam" class="block font-semibold mb-2 text-gray-700">Teamnaam</label>
                <input type="text" name="naam" id="naam" value="{{ $team->naam }}"
                       class="border border-gray-300 rounded-lg p-2 w-full focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="adres" class="block font-semibold mb-2 text-gray-700">Adres</label>
                <input type="text" name="adres" id="adres" value="{{ $team->adres }}"
                       class="border border-gray-300 rounded-lg p-2 w-full focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Opslaan
            </button>
        </form>
    </div>

    <!-- Teamleden -->
    <div class="bg-white p-8 rounded-lg shadow-md mb-10">
        <div class="flex items-center mb-6 space-x-3">
            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4l-2-2m0 0l-2 2m2-2v6m-4 2H6a2 2 0 01-2-2v-5a2 2 0 012-2h8m4 0H6"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Teamleden</h2>
        </div>
        
        @if($teamleden->isEmpty())
            <p class="text-gray-500 italic">Geen teamleden gevonden.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach($teamleden as $lid)
                    <li class="flex items-center justify-between py-4">
                        <div>
                            <span class="font-semibold text-gray-800">{{ $lid->voornaam }} {{ $lid->achternaam }}</span>
                            <span class="text-gray-500 ml-2">({{ $lid->email }})</span>
                        </div>
                        <form method="POST" action="{{ route('teammanager.verwijderen', $lid->pivot->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                Verwijderen
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Aanvragen -->
    <div class="bg-white p-8 rounded-lg shadow-md mb-10">
        <div class="flex items-center mb-6 space-x-3">
            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-3-3.87M16 21h0M8 21v-2a4 4 0 013-3.87M8 21h0M12 11.5a4 4 0 100-8 4 4 0 000 8zm0 0v1m0 4H7m5 0h5"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Aanvragen</h2>
        </div>

        @if($aanvragen->isEmpty())
            <p class="text-gray-500 italic">Geen aanvragen op dit moment.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach($aanvragen as $aanvraag)
                    <li class="flex items-center justify-between py-4">
                        <div>
                            <span class="font-semibold text-gray-800">{{ $aanvraag->voornaam }} {{ $aanvraag->achternaam }}</span>
                            <span class="text-gray-500 ml-2">({{ $aanvraag->email }})</span>
                        </div>
                        <div class="flex space-x-2">
                            <form method="POST" action="{{ route('teammanager.accepteren', $aanvraag->pivot->id) }}">
                                @csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                                    Accepteren
                                </button>
                            </form>
                            <form method="POST" action="{{ route('teammanager.weigeren', $aanvraag->pivot->id) }}">
                                @csrf
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                    Weigeren
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Uitnodigingen voor dit team -->
<div class="bg-white p-8 rounded-lg shadow-md mb-10">
    <div class="flex items-center mb-6 space-x-3">
        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m0 6v-8"></path>
        </svg>
        <h2 class="text-2xl font-bold text-gray-800">Uitnodigingen voor Poules</h2>
    </div>

    @if($uitnodigingen->isEmpty())
        <p class="text-gray-500 italic">Geen uitnodigingen voor dit team op dit moment.</p>
    @else
        <ul class="divide-y divide-gray-200">
            @foreach($uitnodigingen as $uitnodiging)
                <li class="flex items-center justify-between py-4">
                    <div>
                        <span class="font-semibold text-gray-800">Poule:</span> 
                        <span class="text-blue-600">{{ $uitnodiging->poule_naam }}</span>
                        <span class="ml-2 text-gray-500">(Status: {{ ucfirst($uitnodiging->status) }})</span>
                    </div>
                    <div class="flex space-x-2">
                        <form method="POST" action="{{ route('poule.acceptUitnodiging', $uitnodiging->id) }}">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                                Accepteren
                            </button>
                        </form>
                        <form method="POST" action="{{ route('poule.weigerUitnodiging', $uitnodiging->id) }}">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                                Weigeren
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

    <!-- Uitnodigen Speler -->
    <div class="bg-white p-8 rounded-lg shadow-md mb-10">
        <div class="flex items-center mb-6 space-x-3">
            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8m0 0l-2 2m2-2l-2-2M8 16l2 2m-2-2l2-2M12 4v1m-7 1h14"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800">Speler Uitnodigen</h2>
        </div>
        
        <form method="POST" action="{{ route('teammanager.uitnodigen') }}" class="sm:flex sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
            @csrf
            <input type="email" name="email" placeholder="Email speler"
                   class="border border-gray-300 rounded p-2 flex-1 focus:ring-blue-500 focus:border-blue-500"
                   required>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Uitnodigen
            </button>
        </form>
    </div>

</div>
@endsection
