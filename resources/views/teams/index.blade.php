@include('bovenenbeneden.header')

<div class="container mx-auto p-8 bg-white rounded-lg shadow-md">
    <h1 class="text-4xl font-bold mb-6 text-center text-gray-800">Overzicht van Teams</h1>

    @if($teams->isEmpty())
        <p class="text-gray-500 text-center">Er zijn momenteel geen teams beschikbaar.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-md shadow">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 text-sm uppercase font-bold">
                        <th class="px-6 py-3 border-b-2 border-gray-300">#</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Teamnaam</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Teamleider</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-left">Aantal spelers</th>
                        <th class="px-6 py-3 border-b-2 border-gray-300 text-center">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                        <tr class="hover:bg-gray-100 transition duration-300">
                            <td class="px-6 py-4 text-center border-b border-gray-200">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $team->naam }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $team->eigenaar ? $team->eigenaar->achternaam : 'Geen leider' }}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{ $team->spelers->count() }}</td>
                            <td class="px-6 py-4 border-b border-gray-200 text-center">
                                <a href="{{ route('teams.show', $team->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Bekijken
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

@include('bovenenbeneden.footer')
