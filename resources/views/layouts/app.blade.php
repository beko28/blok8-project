<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Voetbal App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white p-6">
        <a href="/home"><h1 class="text-3xl font-bold text-center">Voetbal App</h1></a>
    </header>
    <nav class="bg-white shadow-md">
        <ul class="flex justify-center space-x-6 py-4">
            <li><a href="{{ route('spelers.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Spelers</a></li>
            <li><a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">Poules</a></li>
            <li><a href="#" class="text-blue-600 hover:text-blue-800 font-semibold">Nieuws</a></li>
        </ul>
    </nav>
    <main class="container mx-auto p-8">
        @yield('content')
    </main>
    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; 2024 Voetbal App</p>
    </footer>
</body>
</html>
