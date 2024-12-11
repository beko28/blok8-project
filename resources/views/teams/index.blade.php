@include('bovenenbeneden.header')

<div class="container mx-auto p-8 bg-gradient-to-r from-gray-50 to-white rounded-lg shadow-lg">
    <h1 class="text-4xl font-extrabold mb-6 text-center text-gray-900">Overzicht van Teams</h1>

    <div class="mb-4 flex justify-center">
        <form method="GET" action="{{ route('teams.index') }}" class="flex">
            <input type="text" name="search" placeholder="Zoek op teamnaam"
                class="border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ request('search') }}">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600 transition">
                Zoek
            </button>
        </form>
    </div>

    @if($teams->isEmpty())
        <p class="text-gray-500 text-center text-lg italic">Er zijn momenteel geen teams beschikbaar.</p>
    @else
        <div class="overflow-hidden rounded-lg shadow-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-100 to-blue-200 text-gray-900 uppercase text-sm font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-center">#</th>
                        <th class="px-6 py-3 text-left">Teamnaam</th>
                        <th class="px-6 py-3 text-left">Teamleider</th>
                        <th class="px-6 py-3 text-center">Aantal spelers</th>
                        <th class="px-6 py-3 text-center">Acties</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($teams as $team)
                        <tr class="hover:bg-blue-50 transition duration-200">
                            <td class="px-6 py-4 text-center text-sm font-semibold text-gray-700">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $team->naam }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">
                                    {{ $team->eigenaar ? $team->eigenaar->achternaam : 'Geen leider' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-800">
                                {{ $team->spelers->where('pivot.status', 'geaccepteerd')->count() }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if(auth()->check() && auth()->user()->role === 'speler')
                                    <form method="POST" action="{{ route('teams.aanmelden', $team->id) }}">
                                        @csrf
                                        <button type="submit" class="relative px-6 py-3 font-bold text-white bg-gradient-to-r from-green-400 to-green-600 rounded-lg shadow-lg hover:from-green-500 hover:to-green-700 hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-105">
                                            <span class="absolute inset-0 flex items-center justify-center opacity-0 text-white text-sm font-semibold transition-opacity duration-200">
                                                Klik om aan te melden
                                            </span>
                                            <span class="relative">Aanmelden</span>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm italic">Alleen spelers kunnen zich aanmelden.</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@include('bovenenbeneden.footer')
