@include('bovenenbeneden.header')

<div class="container mx-auto p-8 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg shadow-lg">
    <h1 class="text-5xl font-extrabold mb-8 text-center text-blue-800">Mijn Profiel</h1>
    
    <!-- Persoonlijke Informatie -->
    <div class="mb-10">
        <h2 class="text-3xl font-semibold text-blue-600 mb-6">Persoonlijke Informatie</h2>
        <div class="bg-white p-8 rounded-lg shadow-md space-y-4">
            <p class="text-lg"><strong>Voornaam:</strong> {{ $speler->voornaam }}</p>
            <p class="text-lg"><strong>Achternaam:</strong> {{ $speler->achternaam }}</p>
            <p class="text-lg"><strong>Email:</strong> {{ $speler->email }}</p>
            <div class="flex space-x-4 mt-6">
                <button id="editProfileButton" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                    Gegevens Bewerken
                </button>
                <button id="deleteAccountButton" class="bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition">
                    Account Verwijderen
                </button>
            </div>
        </div>
    </div>
    
    @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'eigenaar']))
    <div class="mb-10">
        <h2 class="text-3xl font-semibold text-blue-600 mb-6">Aanvragen om bij je team aan te sluiten</h2>
        <div class="bg-white p-8 rounded-lg shadow-md">
            @if($aanvragen->isNotEmpty())
                <ul class="divide-y divide-gray-200">
                    @foreach($aanvragen as $aanvraag)
                        <li class="py-4 flex justify-between items-center">
                            <div>
                                <p class="text-lg font-semibold">{{ $aanvraag->voornaam }} {{ $aanvraag->achternaam }}</p>
                                <p class="text-gray-600 text-sm">Wil zich aansluiten bij jouw team</p>
                            </div>
                            <div class="flex space-x-4">
                                <form action="{{ route('aanvraag.accepteer', $aanvraag->pivot->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                        class="bg-green-500 text-white font-semibold px-4 py-2 rounded-lg shadow hover:bg-green-600 transition-colors duration-200">
                                        Accepteren
                                    </button>
                                </form>
                                <form action="{{ route('aanvraag.afwijzen', $aanvraag->pivot->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">
                                        Weigeren
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 italic">Er zijn momenteel geen aanvragen.</p>
            @endif
        </div>
    </div>
    @endif

    <div class="mb-10">
        <h2 class="text-3xl font-semibold text-blue-600 mb-6">Notificaties</h2>
        <div class="bg-white p-8 rounded-lg shadow-md">
            @if($berichten->isEmpty())
                <p class="text-gray-500 italic">Je hebt geen nieuwe berichten van je teameigenaar.</p>
            @else
                <ul class="space-y-4">
                    @foreach($berichten as $bericht)
                        <li class="p-4 bg-gray-100 rounded-lg shadow">
                            <p class="text-sm text-gray-500">{{ $bericht->created_at->diffForHumans() }}</p>
                            <p class="text-lg font-medium">{{ $bericht->inhoud }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<!-- Modals -->
<div id="editProfileModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white w-full max-w-lg p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Gegevens Bewerken</h2>
        <form method="POST" action="{{ route('profiel.update', $speler->id) }}">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Voornaam</label>
                    <input type="text" name="voornaam" value="{{ $speler->voornaam }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Achternaam</label>
                    <input type="text" name="achternaam" value="{{ $speler->achternaam }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $speler->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
            </div>
            <div class="flex justify-end mt-6 space-x-4">
                <button type="button" id="cancelEditProfile" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Annuleren</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Opslaan</button>
            </div>
        </form>
    </div>
</div>

<div id="deleteAccountModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Account Verwijderen</h2>
        <p class="text-gray-600 mb-6">Weet je zeker dat je je account wilt verwijderen? Dit kan niet ongedaan worden gemaakt.</p>
        <div class="flex justify-end space-x-4">
            <button id="cancelDeleteAccount" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Annuleren</button>
            <form method="POST" action="{{ route('account.delete', $speler->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Verwijderen</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('editProfileButton').addEventListener('click', () => {
        document.getElementById('editProfileModal').classList.remove('hidden');
    });

    document.getElementById('cancelEditProfile').addEventListener('click', () => {
        document.getElementById('editProfileModal').classList.add('hidden');
    });

    document.getElementById('deleteAccountButton').addEventListener('click', () => {
        document.getElementById('deleteAccountModal').classList.remove('hidden');
    });

    document.getElementById('cancelDeleteAccount').addEventListener('click', () => {
        document.getElementById('deleteAccountModal').classList.add('hidden');
    });
</script>

@include('bovenenbeneden.footer')
