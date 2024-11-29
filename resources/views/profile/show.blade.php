@include('bovenenbeneden.header')

<div class="container mx-auto p-8 bg-white rounded-lg shadow-md">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">Mijn Profiel</h1>

    <!-- Profielinformatie -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Persoonlijke Informatie</h2>
        <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
            <p><strong>Naam:</strong> {{ $speler->naam }}</p>
            <p><strong>Achternaam:</strong> {{ $speler->achternaam }}</p>
            <p><strong>Email:</strong> {{ $speler->email }}</p>
            <p><strong>Team:</strong> {{ $speler->team ? $speler->team->naam : 'Geen team' }}</p>
        </div>
    </div>

    <!-- Notificaties -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Notificaties</h2>
        <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
            @if($berichten->isEmpty())
                <p class="text-gray-500">Je hebt geen nieuwe berichten van je teameigenaar.</p>
            @else
                <ul class="list-disc pl-6 space-y-2">
                    @foreach($berichten as $bericht)
                        <li class="bg-white p-4 rounded shadow">
                            <p class="text-sm text-gray-600">{{ $bericht->created_at->diffForHumans() }}</p>
                            <p class="font-medium">{{ $bericht->inhoud }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <!-- Team-aanvragen -->
    <div>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Aanvragen om bij een team aan te sluiten</h2>
        <div class="bg-gray-100 p-6 rounded-lg shadow-sm">
            @if($aanvragen->isEmpty())
                <p class="text-gray-500">Je hebt geen nieuwe aanvragen.</p>
            @else
                <ul class="list-disc pl-6 space-y-2">
                    @foreach($aanvragen as $aanvraag)
                        <li class="bg-white p-4 rounded shadow flex justify-between items-center">
                            <div>
                                <p><strong>Team:</strong> {{ $aanvraag->team->naam }}</p>
                                <p class="text-sm text-gray-600">{{ $aanvraag->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <form method="POST" action="{{ route('aanvraag.accepteren', $aanvraag->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Accepteren</button>
                                </form>
                                <form method="POST" action="{{ route('aanvraag.afwijzen', $aanvraag->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Afwijzen</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

@include('bovenenbeneden.footer')
