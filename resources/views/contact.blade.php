@include('bovenenbeneden.header')

<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-4">Neem contact op</h1>

    <!-- Succesbericht -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validatie fouten -->
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Contactformulier -->
    <form action="{{ route('contact.send') }}" method="POST" class="bg-white shadow-md rounded p-6">
        @csrf
        <div class="mb-4">
            <label for="naam" class="block font-semibold mb-2">Naam</label>
            <input type="text" name="naam" id="naam" class="border rounded w-full p-2" value="{{ old('naam') }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-2">E-mail</label>
            <input type="email" name="email" id="email" class="border rounded w-full p-2" value="{{ old('email') }}" required>
        </div>
        <div class="mb-4">
            <label for="bericht" class="block font-semibold mb-2">Bericht</label>
            <textarea name="bericht" id="bericht" rows="5" class="border rounded w-full p-2" required>{{ old('bericht') }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Verstuur</button>
    </form>
</div>
@include('bovenenbeneden.footer')
