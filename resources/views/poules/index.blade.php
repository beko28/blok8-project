@include('bovenenbeneden.header')

<div class="container mx-auto mt-10 px-4">
    <h1 class="text-4xl font-bold mb-10 text-gray-900 text-center">Competities</h1>

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
                            
                            <table class="table-auto w-full text-sm">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-medium text-gray-600">Team</th>
                                        <th class="px-4 py-2 text-center font-medium text-gray-600">Positie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($poule->teams as $index => $team)
                                        <tr class="border-t hover:bg-gray-50 
                                            @if($team->eigenaar && $team->eigenaar->id == Auth::id())
                                                bg-yellow-200 font-bold
                                            @endif">
                                            <td class="px-4 py-2 text-gray-800">{{ $team->naam }}</td>
                                            <td class="px-4 py-2 text-center text-gray-800">{{ $index + 1 }}</td>
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

@include('bovenenbeneden.footer')
