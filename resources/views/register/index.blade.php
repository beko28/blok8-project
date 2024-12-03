@include('bovenenbeneden.header')

<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-8">
        <!-- Stappenteller -->
        <div class="flex items-center justify-between mb-6">
    <div class="w-full bg-gray-300 rounded-full h-2.5">
        <div class="bg-blue-600 h-2.5 rounded-full"
             style="
                 @if($step == 1)
                     width: 33%;
                 @elseif($step == 2)
                     width: 66%;
                 @elseif($step == 3)
                     width: 100%;
                 @endif
             ">
        </div>
    </div>
    <span class="ml-2 text-sm font-medium text-gray-700">Stap {{ $step }} van 3</span>
</div>


        <form method="POST" action="{{ route('register.step', ['step' => $step]) }}" class="space-y-6">
            @csrf

            <!-- Error berichten -->
            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="hidden" name="role" value="{{ session('registration.role') }}">

            @if ($step == 1)
                <h2 class="text-2xl font-bold text-center text-gray-800">Stap 1: Basisgegevens</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ik wil me registreren als:</label>
                        <select name="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                            <option value="speler" {{ old('role') == 'speler' ? 'selected' : '' }}>Speler</option>
                            <option value="eigenaar" {{ old('role') == 'eigenaar' ? 'selected' : '' }}>Eigenaar van een team</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" class="mt-1 block w-full rounded-md border-gray-500 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                        <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bevestig Wachtwoord</label>
                        <input type="password" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                    </div>
                </div>
            @elseif ($step == 2 && $role === 'speler')
                <h2 class="text-2xl font-bold text-center text-gray-800">Stap 2: Spelergegevens</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Voornaam</label>
                        <input type="text" name="voornaam" value="{{ old('voornaam') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Achternaam</label>
                        <input type="text" name="achternaam" value="{{ old('achternaam') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Leeftijd</label>
                        <input type="number" name="leeftijd" value="{{ old('leeftijd') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rugnummer (optioneel)</label>
                        <input type="number" name="rugnummer" value="{{ old('rugnummer') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Positie (optioneel)</label>
                        <input type="text" name="positie" value="{{ old('positie') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;">
                    </div>
                </div>
            @elseif ($step == 2 && $role === 'eigenaar')
                <h2 class="text-2xl font-bold text-center text-gray-800">Stap 2: Eigenaargegevens</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Voornaam</label>
                        <input type="text" name="voornaam" value="{{ old('voornaam') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Achternaam</label>
                        <input type="text" name="achternaam" value="{{ old('achternaam') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                    </div>
                </div>
            @elseif ($step == 3)
                <h2 class="text-2xl font-bold text-center text-gray-800">Stap 3: Laatste details</h2>
                <div class="space-y-4">
                    @if ($role === 'speler')
                        <p class="text-gray-700 text-center">Welkom! Je registratie is bijna afgerond.</p>
                    @elseif ($role === 'eigenaar')
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Teamnaam</label>
                            <input type="text" name="teamnaam" value="{{ old('teamnaam') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Adres</label>
                            <input type="text" name="adres" value="{{ old('adres') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Maximale aantal spelers</label>
                            <input type="number" name="max_spelers" value="{{ old('max_spelers') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" style="height: 40px; background-color:#ebf2fc;" required>
                        </div>
                    @endif
                </div>
            @endif

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow hover:bg-indigo-700 transition duration-150">
                {{ $step < 3 ? 'Volgende' : 'Voltooien' }}
            </button>
        </form>
    </div>
</div>

@include('bovenenbeneden.footer')
