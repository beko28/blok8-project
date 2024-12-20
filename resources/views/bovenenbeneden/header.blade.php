<script src="https://cdn.tailwindcss.com"></script>
<link rel="icon" href="/images/logo.png" type="image/png">

<header class="sticky top-0 z-50 bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 text-white py-8 shadow-md">
    <div class="container mx-auto flex items-center justify-between px-6">
        <div class="flex items-center space-x-4">
            <img src="/images/logo.png" class="rounded-full hover-bounce" style="width: 50px; height: 50px;">
            <a href="/home">
                <h1 class="text-4xl font-extrabold tracking-tight hover-bounce">Pro Football</h1>
            </a>
        </div>

        <div class="relative hidden lg:block">
            <form action="{{ route('search.index') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Zoek naar spelers of teams..." 
                    class="bg-white text-gray-800 py-2 px-4 rounded-full shadow-lg w-64 focus:outline-none focus:ring focus:ring-blue-300">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a7 7 0 100 14 7 7 0 000-14zM9 7a1 1 0 112 0v2a1 1 0 01-2 0V7zM9 11a1 1 0 112 0 1 1 0 01-2 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>


        <button id="menuToggle" class="lg:hidden focus:outline-none">
            <svg class="w-8 h-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <nav id="menu" class="hidden lg:flex flex-col lg:flex-row items-center lg:space-x-6 absolute lg:static inset-x-0 top-20 bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 lg:bg-transparent lg:p-0 lg:space-y-0 p-4 space-y-4 lg:w-auto w-full shadow-lg lg:shadow-none rounded-lg">
            <ul class="flex flex-col lg:flex-row lg:space-x-6 lg:space-y-0 space-y-4">
                <li><a href="{{ route('spelers.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300"><button>Spelers</button></a></li>
                <li><a href="{{ route('teams.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300"><button>Teams</button></a></li>
                <li><a href="{{ route('competities.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300"><button>Poules</button></a></li>
                <li><a href="{{ route('nieuws.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300"><button>Nieuws</button></a></li>
                <li><a href="{{ route('contact.show') }}" class="hover:underline hover:text-yellow-400 transition duration-300"><button>Contact</button></a></li>

                @auth
                <li>
                    <a href="{{ route('chat.show', auth()->user()->email) }}" class="hover:underline hover:text-yellow-400 transition duration-300">
                        <button>Chat</button>
                    </a>
                </li>
                    @if(auth()->user()->role === 'eigenaar')
                        <li>
                            <a href="{{ route('teammanager.index') }}" class="flex items-center space-x-2 hover:underline hover:text-yellow-400 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-300" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M11 17a1 1 0 102 0 1 1 0 00-2 0zm-4-7a2 2 0 11-4 0 2 2 0 014 0zm6-3a2 2 0 100 4 2 2 0 000-4zM5.657 4.343a2 2 0 010 2.828L4.828 8H3a1 1 0 000 2h1.828l.829.829a2 2 0 010 2.828L3 15v2a1 1 0 002 0v-1.172l.828-.829a2 2 0 012.828 0L10 18v1a1 1 0 002 0v-1l1.172-1.172a2 2 0 012.828 0L18 15.172V17a1 1 0 102 0v-2l-1.172-1.172a2 2 0 010-2.828l.829-.829H19a1 1 0 100-2h-1.172l-.829-.829a2 2 0 010-2.828L17 3V1a1 1 0 00-2 0v1.172l-1.172 1.172a2 2 0 01-2.828 0L10 2V1a1 1 0 10-2 0v1L6.343 4.343z" />
                                </svg>
                                <span><button>Teammanager</button></span>
                            </a>
                        </li>
                    @endif

                @endauth
            </ul>

            <div class="flex flex-col lg:flex-row lg:space-x-4 space-y-4 lg:space-y-0">
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
        </nav>
    </div>
</header>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const menu = document.getElementById('menu');
    const darkModeToggle = document.getElementById('darkModeToggle');

    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });

    darkModeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
    });
</script>

<style>
  .hover-bounce:hover {
    transform: scale(1.05);
    transition: transform 0.2s;
  }
</style>
