<script src="https://cdn.tailwindcss.com"></script>
<link rel="icon" href="/images/logo.png" type="image/png">
<header class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 text-white py-8 shadow-md">
    <div class="container mx-auto flex items-center justify-between px-6">
        <div class="flex items-center space-x-4">
            <img src="/images/logo.png" class="rounded-full" style="width: 50px; height: 50px;">
            <a href="/home"><h1 class="text-4xl font-extrabold tracking-tight">Pro Football</h1></a>
        </div>
        
        <nav class="flex-grow text-center">
            <ul class="inline-flex space-x-6" style="margin-right: 100px;">
                <li><a href="{{ route('spelers.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300">Spelers</a></li>
                <li><a href="{{ route('teams.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300">Teams</a></li>
                <li><a href="{{ route('poules.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300">Poules</a></li>
                <li><a href="#" class="hover:underline hover:text-yellow-400 transition duration-300">Nieuws</a></li>
                <li><a href="{{ route('contact.show') }}" class="hover:underline hover:text-yellow-400 transition duration-300">Contact</a></li>
            </ul>
        </nav>

        <div class="flex space-x-4">
            @guest
                <a href="{{ route('login') }}" class="bg-yellow-400 text-blue-800 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-300 transition duration-300">Login</a>
                <a href="{{ route('register.step') }}" class="bg-yellow-400 text-blue-800 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-300 transition duration-300">Register</a>
            @endguest

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.index') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-400 transition duration-300">
                        Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('profile.show') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-400 transition duration-300">
                        Profiel
                    </a>
                @endif

                <a href="{{ route('logout') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-400 transition duration-300"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endauth
        </div>
    </div>
</header>
