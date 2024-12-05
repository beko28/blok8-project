<script src="https://cdn.tailwindcss.com"></script>
<link rel="icon" href="/images/logo.png" type="image/png">
<header class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 text-white py-8 shadow-md">
    <div class="container mx-auto flex items-center justify-between px-6">
        <div class="flex items-center space-x-4">
            <img src="/images/logo.png" class="rounded-full" style="width: 50px; height: 50px;">
            <a href="/home">
                <h1 class="text-4xl font-extrabold tracking-tight">Pro Football</h1>
            </a>
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
                <li><a href="{{ route('poules.index') }}" class="hover:underline hover:text-yellow-400 transition duration-300"><button>Poules</button></a></li>
                <li><a href="#" class="hover:underline hover:text-yellow-400 transition duration-300"><button>Nieuws</button></a></li>
                <li><a href="{{ route('contact.show') }}" class="hover:underline hover:text-yellow-400 transition duration-300"><button>Contact</button></a></li>
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

    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
