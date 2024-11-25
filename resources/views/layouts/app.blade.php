<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div id="app">
        <!-- Navigatiebalk -->
        <nav class="bg-white border-b shadow-sm">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <!-- Logo -->
                <a class="text-lg font-semibold text-gray-800" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <!-- Navigatie -->
                <div>
                    <ul class="flex space-x-4">
                        @guest
                            @if (Route::has('login'))
                                <li>
                                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500">
                                        {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-500">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="relative">
                                <button class="text-gray-700 hover:text-blue-500">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="absolute right-0 mt-2 bg-white shadow rounded">
                                    <li>
                                        <a href="{{ route('logout') }}" 
                                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                </ul>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
