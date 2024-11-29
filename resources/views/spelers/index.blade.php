@include('bovenenbeneden.header')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-md">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">Overzicht van Spelers</h1>

    <!-- Search Bar -->
    <div class="mb-6 flex justify-center">
        <form method="GET" action="{{ route('spelers.index') }}" class="flex w-full max-w-md">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Zoek op naam..."
                class="w-full px-4 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600">
                Zoeken
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6 shadow-sm">
            <p class="font-semibold">{{ session('success') }}</p>
        </div>
    @endif

    @if($spelers->isEmpty())
        <div class="text-center">
            <p class="text-gray-500 text-lg">Er zijn geen spelers gevonden.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-md shadow">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 text-sm uppercase font-bold">
                        <th class="px-6 py-3 border-b-2 border-gray-300">#</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Naam</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Achternaam</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Email</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Team</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($spelers as $speler)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="px-6 py-4 text-center border-b border-gray-200">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $speler->naam }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $speler->achternaam }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $speler->email }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">
                                {{ $speler->team ? $speler->team->naam : 'Geen team' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@include('bovenenbeneden.footer')
