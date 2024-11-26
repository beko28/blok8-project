@include('bovenenbeneden.header')

<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold text-center mb-4">Mijn Profiel</h1>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <strong>Naam:</strong> {{ $user->name }}
            </div>
            <div>
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div>
                <strong>Rol:</strong> {{ $user->role }}
            </div>
            <div>
                <strong>Aangemaakt op:</strong> {{ $user->created_at->format('d-m-Y') }}
            </div>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-400 transition duration-300">
                Profiel Bewerken
            </a>
        </div>
    </div>
</div>
@include('bovenenbeneden.footer')
