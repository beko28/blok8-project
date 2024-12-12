@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-indigo-50 to-white flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Inloggen
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Heb je nog geen account?
            <a href="{{ route('register.step') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                Registreer hier
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-6 shadow-lg rounded-lg sm:px-10">
            @if($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mailadres</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               value="{{ old('email') }}">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                               placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Onthoud mij
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm 
                            font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none 
                            focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Inloggen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
