@include('bovenenbeneden.header')

<div class="container mx-auto mt-10 px-4">
    <h1 class="text-4xl font-bold mb-10 text-gray-900 text-center">Competities</h1>

    @if(auth()->check() && auth()->user()->role === 'eigenaar')
    <div class="text-right mb-4">
            <button id="openModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Start een nieuwe poule
            </button>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    @foreach($competities as $competitie)
        <div class="mb-12 bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 text-white py-4 px-6">
                <h2 class="text-3xl font-bold">{{ $competitie->naam }}</h2>
                <p class="text-sm italic">{{ ucfirst($competitie->type) }}</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($competitie->poules as $poule)
                        <div class="bg-gray-100 border border-gray-300 rounded-lg shadow hover:shadow-lg transition duration-200">
                            <h3 class="bg-gray-200 text-gray-700 font-semibold text-lg px-4 py-2 rounded-t-lg border-b border-gray-300">
                                {{ $poule->naam }}
                            </h3>

                            <!-- Team toevoegen formulier -->
                            <div class="p-4">
                                <form action="{{ route('poules.voegTeamToe', $poule->id) }}" method="POST" class="mb-4">
                                    @csrf
                                    <div class="mb-2">
                                        <label for="team_id" class="block text-sm font-semibold text-gray-700">Team toevoegen</label>
                                        <select name="team_id" id="team_id" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                                            <option value="" disabled selected>Kies een team</option>
                                            @foreach($alleTeams as $team)
                                                <option value="{{ $team->id }}">{{ $team->naam }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Toevoegen</button>
                                </form>
                            </div>

                            <table class="table-auto w-full text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">Team</th>
                                        <th class="px-4 py-2 text-center font-medium text-gray-600">Positie</th>
                                        <th class="px-4 py-2 text-center font-medium text-gray-600">Acties</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($poule->teams as $index => $team)
                                        <tr class="border-t hover:bg-gray-50">
                                            <td class="px-4 py-2 text-gray-800">{{ $team->naam }}</td>
                                            <td class="px-4 py-2 text-center text-gray-800">{{ $index + 1 }}</td>
                                            <td class="px-4 py-2 text-center">
                                                <form action="{{ route('poules.verwijderTeam', [$poule->id, $team->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:underline">Verwijderen</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="bg-gray-200 text-gray-700 text-sm font-semibold py-2 px-4 rounded-b-lg">
                                {{ $poule->teams->count() }} teams
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Modal Background -->
<div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
        <div class="p-4 border-b">
            <h2 class="text-xl font-semibold text-gray-700">Nieuwe Poule Aanmaken</h2>
        </div>
        <div class="p-4">
            <!-- Formulier -->
            <form action="{{ route('poules.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="naam" class="block text-gray-600 font-semibold mb-2">Naam Poule</label>
                    <input type="text" name="naam" id="naam" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mb-4">
                    <label for="max_teams" class="block text-gray-600 font-semibold mb-2">Max aantal teams</label>
                    <input type="number" name="max_teams" id="max_teams" min="1" max="50" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeModal" class="text-gray-600 hover:text-gray-800 font-bold py-2 px-4">Annuleren</button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('modal');
    const openModal = document.getElementById('openModal');
    const closeModal = document.getElementById('closeModal');

    openModal.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>

@include('bovenenbeneden.footer')