@include('bovenenbeneden.header')

<div class="container mx-auto mt-10 px-4">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Gebruikersbeheer</h1>

    <div class="flex justify-between items-center mb-5">
        <a href="{{ route('admin.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md shadow-md flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
            Nieuwe gebruiker
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-300 shadow-md rounded-md">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Naam</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Rol</th>
                    <th class="px-4 py-2 text-center">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t border-gray-300 hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center space-x-2">
                            <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?')" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md shadow-md flex items-center justify-center" style="height: 40px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12H4.5" />
                                    </svg>
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('bovenenbeneden.footer')
