@include('bovenenbeneden.header')
<div class="container mx-auto p-8 bg-gradient-to-r from-blue-50 to-white rounded-lg shadow-lg">
    <h1 class="text-4xl font-extrabold mb-6 text-center text-gray-900">Overzicht van Spelers</h1>

    <div class="mb-4 flex justify-center">
        <form method="GET" action="{{ route('spelers.index') }}" class="flex">
            <input type="text" name="search" placeholder="Zoek op naam of email"
                class="border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                value="{{ request('search') }}">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600 transition">
                Zoek
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6 shadow">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if($spelers->isEmpty())
        <div class="text-center">
            <p class="text-gray-500 text-lg italic">Er zijn geen spelers gevonden.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <div class="overflow-hidden rounded-lg shadow-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-100 to-blue-200 text-gray-900 uppercase text-sm font-semibold">
                        <tr>
                            <th class="px-6 py-3 text-center whitespace-nowrap">#</th>
                            <th class="px-6 py-3 text-left whitespace-nowrap">Voornaam</th>
                            <th class="px-6 py-3 text-left whitespace-nowrap">Achternaam</th>
                            <th class="px-6 py-3 text-left whitespace-nowrap">Email</th>
                            <th class="px-6 py-3 text-left whitespace-nowrap">Team</th>
                            <th class="px-6 py-3 text-left whitespace-nowrap">Positie</th>
                            <th class="px-6 py-3 text-center whitespace-nowrap">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($spelers as $speler)
                            <tr class="hover:bg-blue-50 transition duration-200">
                                <td class="px-6 py-4 text-center text-sm font-semibold text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $speler->voornaam }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $speler->achternaam }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $speler->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    @if($speler->acceptedTeams->isNotEmpty())
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">
                                            {{ $speler->acceptedTeams->first()->naam }}
                                        </span>
                                    @elseif($speler->role === 'eigenaar' && $speler->teamEigenaar)
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-bold">
                                            Eigenaar van: {{ $speler->teamEigenaar->naam }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic">Geen team</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-bold capitalize">
                                        {{ $speler->positie }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('spelers.show', $speler->id) }}"
                                       class="bg-indigo-500 text-white px-3 py-1 rounded-full text-xs font-semibold hover:bg-indigo-600 transition">
                                        Bekijk
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if(method_exists($spelers, 'links'))
            <div class="mt-6">
                {{ $spelers->links() }}
            </div>
        @endif
    @endif
</div>
@include('bovenenbeneden.footer')
