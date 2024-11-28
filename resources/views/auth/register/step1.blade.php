@include('bovenenbeneden.header')

<div class="w-full bg-gray-200 h-1">
    <div id="progress-bar" class="bg-indigo-600 h-1" style="width: 33%;"></div>
</div>

<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">Stap 1: Basisgegevens</h2>
        <form method="POST" action="{{ route('register.step1') }}">
            @csrf
            <label class="block mb-2">
                <span class="text-gray-700">Ik wil me registreren als:</span>
                <select name="role" required
                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="speler">Speler</option>
                    <option value="eigenaar">Eigenaar van een team</option>
                </select>
            </label>

            <label class="block mb-2">
                <span class="text-gray-700">Email</span>
                <input type="email" name="email" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>

            <label class="block mb-2">
                <span class="text-gray-700">Wachtwoord</span>
                <input type="password" name="password" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Bevestig wachtwoord</span>
                <input type="password" name="password_confirmation" required
                       class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </label>

            <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Volgende
            </button>
        </form>
    </div>
</div>

@include('bovenenbeneden.footer')
