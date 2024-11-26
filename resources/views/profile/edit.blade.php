@include('bovenenbeneden.header')

<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold text-center mb-4">Profiel Bewerken</h1>
        
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Naam:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-400 transition duration-300">
                    Opslaan
                </button>
            </div>
        </form>
    </div>
</div>
@include('bovenenbeneden.footer')
