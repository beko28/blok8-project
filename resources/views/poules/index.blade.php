@include('bovenenbeneden.header')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Poules</h1>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex flex-wrap gap-6">
        @foreach($poules as $poule)
        <div class="w-full sm:w-1/2 border border-gray-300 shadow-md rounded">
            <h2 class="bg-gray-200 text-gray-800 px-4 py-2 font-bold text-lg">
                {{ $poule->naam }}
            </h2>
            <table class="table-auto w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-2 py-1 text-left">Team</th>
                        <th class="px-2 py-1 text-center">Positie</th>
                        <th class="px-2 py-1 text-center">Punten</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($poule->teams->sortByDesc('punten') as $index => $team)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-2 py-1">{{ $team->naam }}</td>
                        <td class="px-2 py-1 text-center">{{ $index + 1 }}</td>
                        <td class="px-2 py-1 text-center">{{ $team->punten }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endforeach
    </div>
</div>
@include('bovenenbeneden.footer')
