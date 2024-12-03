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
            <button id="editProfileButton" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600 transition">Gegevens bewerken</button>
            <button id="deleteAccountButton" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Account verwijderen</button>
        </div>
    </div>
    
    <!-- Modal -->
    <div id="editProfileModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white w-full max-w-lg p-6 rounded shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Gegevens Bewerken</h2>
            <form method="POST" action="{{ route('profiel.update', $speler->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Naam</label>
                    <input type="text" name="naam" value="{{ $speler->naam }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Achternaam</label>
                    <input type="text" name="achternaam" value="{{ $speler->achternaam }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ $speler->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="cancelEditProfile" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition mr-2">Annuleren</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Opslaan</button>
                </div>
            </form>
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
<div id="deleteAccountModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white w-full max-w-md p-6 rounded shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Account Verwijderen</h2>
        <p class="text-gray-600 mb-6">Weet je zeker dat je je account wilt verwijderen? Dit kan niet ongedaan gemaakt worden.</p>
        <div class="flex justify-end">
            <button id="cancelDeleteAccount" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition mr-2">Annuleren</button>
            <form method="POST" action="{{ route('account.delete', $speler->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Ja, verwijderen</button>
            </form>
        </div>
    </div>
</div>


<script>
    const deleteAccountButton = document.getElementById('deleteAccountButton');
    const deleteAccountModal = document.getElementById('deleteAccountModal');
    const cancelDeleteAccount = document.getElementById('cancelDeleteAccount');
    
    deleteAccountButton.addEventListener('click', () => {
        deleteAccountModal.classList.remove('hidden');
    });
    
    cancelDeleteAccount.addEventListener('click', () => {
        deleteAccountModal.classList.add('hidden');
    });
    const editProfileButton = document.getElementById('editProfileButton');
    const editProfileModal = document.getElementById('editProfileModal');
    const cancelEditProfile = document.getElementById('cancelEditProfile');
    
    editProfileButton.addEventListener('click', () => {
        editProfileModal.classList.remove('hidden');
    });

    cancelEditProfile.addEventListener('click', () => {
        editProfileModal.classList.add('hidden');
    });
</script>

@include('bovenenbeneden.footer')
