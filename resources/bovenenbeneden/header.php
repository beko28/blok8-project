<header class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 text-white py-8 shadow-md">
    <div class="container mx-auto flex items-center justify-between px-6">
        <!-- Logo en titel -->
        <div class="flex items-center space-x-4">
            <img src="/images/logo.png" class="rounded-full" style="width: 50px; height: 50px;">
            <h1 class="text-4xl font-extrabold tracking-tight">Pro Football</h1>
        </div>
        
        <!-- Navigatie in het midden -->
        <nav class="flex-grow text-center">
            <ul class="inline-flex space-x-6">
                <li><a href="{{ route('spelers.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300">Spelers</a></li>
                <li><a href="#" class="hover:underline hover:text-yellow-400 transition duration-300">Poules</a></li>
                <li><a href="#" class="hover:underline hover:text-yellow-400 transition duration-300">Nieuws</a></li>
                <li><a href="#" class="hover:underline hover:text-yellow-400 transition duration-300">Contact</a></li>
            </ul>
        </nav>

        <!-- Login en Register rechts -->
        <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="bg-yellow-400 text-blue-800 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-300 transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="bg-yellow-400 text-blue-800 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-300 transition duration-300">Register</a>
                <a href="{{ route('logout') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-400 transition duration-300"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                </form>
        </div>
    </div>
</header>
