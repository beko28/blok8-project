@include('bovenenbeneden.header')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Poules</h1>

    <!-- Succesbericht -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('poules.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 mb-6 inline-block">
        Nieuwe Poule
    </a>

    <table class="table-auto w-full mt-6 border border-gray-300 shadow-md">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Naam</th>
                <th class="px-4 py-2 text-left">Eigenaar</th>
                <th class="px-4 py-2 text-center">Deelnemers</th>
                <th class="px-4 py-2 text-center">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach($poules as $poule)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ $poule->naam }}</td>
                <td class="px-4 py-2">{{ $poule->eigenaar->name }}</td>
                <td class="px-4 py-2 text-center">{{ $poule->deelnemers->count() }}</td>
                <td class="px-4 py-2 text-center space-x-2">
                    <a href="{{ route('poules.edit', $poule->id) }}" class="bg-yellow-400 text-white px-4 py-2 rounded shadow hover:bg-yellow-500">
                        Bewerken
                    </a>
                    <form action="{{ route('poules.destroy', $poule->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-600"
                                onclick="return confirm('Weet je zeker dat je deze poule wilt verwijderen?')">
                            Verwijderen
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('bovenenbeneden.footer')
