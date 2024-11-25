<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Pro Football</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="/images/logo.png" type="image/png">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    @include('bovenenbeneden.header')

    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold mb-6">Welkom bij de Voetbal App</h1>
            <p class="text-xl mb-8">Beheer spelers, poules, tags en nieuws eenvoudig in één applicatie!</p>
            <a href="{{ route('spelers.index') }}" class="bg-yellow-400 text-blue-800 px-8 py-4 rounded-full font-semibold shadow-lg hover:bg-yellow-300 transition duration-300 transform hover:scale-105">
                Start Nu
            </a>
        </div>
    </div>

    <div class="container mx-auto p-8">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h2 class="text-3xl font-semibold mb-6 text-center">Over de Voetbal App</h2>
            <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                Deze applicatie helpt je om al je voetbalactiviteiten te beheren. Of je nu spelersinformatie wilt bijhouden, wedstrijden wilt organiseren, of op de hoogte wilt blijven van het laatste nieuws, de Voetbal App biedt alles wat je nodig hebt.
            </p>
            <ul class="list-disc pl-6 text-gray-700 text-lg space-y-2">
                <li>Voeg spelers toe en beheer hun gegevens.</li>
                <li>Organiseer en beheer poules en competities.</li>
                <li>Lees en deel voetbalnieuws met je team.</li>
                <li>Categoriseer en tag spelers en teams voor snelle toegang.</li>
            </ul>
        </div>
    </div>

    <div class="bg-gray-200 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12">Waarom kiezen voor de Voetbal App?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-2xl transition duration-300">
                    <i class="fas fa-users text-blue-500 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-semibold mb-4">Teambeheer</h3>
                    <p class="text-gray-600">Beheer eenvoudig je spelers en hun prestaties.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-2xl transition duration-300">
                    <i class="fas fa-trophy text-yellow-500 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-semibold mb-4">Competities</h3>
                    <p class="text-gray-600">Organiseer poules en bekijk standen in één overzicht.</p>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-2xl transition duration-300">
                    <i class="fas fa-newspaper text-green-500 text-6xl mb-6"></i>
                    <h3 class="text-2xl font-semibold mb-4">Nieuws</h3>
                    <p class="text-gray-600">Blijf altijd op de hoogte van het laatste voetbalnieuws.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-blue-600 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-6">Maak je voetbalbeheer eenvoudig en effectief</h2>
            <p class="text-lg mb-8">Start nu met de Voetbal App en ontdek hoe het je tijd en moeite bespaart.</p>
            <a href="{{ route('spelers.index') }}" class="bg-yellow-400 text-blue-800 px-8 py-4 rounded-full font-semibold shadow-lg hover:bg-yellow-300 transition duration-300 transform hover:scale-105">
                Begin Nu
            </a>
        </div>
    </div>

    <div class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12">Wat zeggen onze gebruikers?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-2xl transition duration-300">
                    <p class="italic text-gray-600 mb-4">"Pro Football heeft mijn teambeheer super makkelijk gemaakt. Het is geweldig!"</p>
                    <h3 class="font-bold text-blue-600">- Jan Jansen, Teamcoach</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-2xl transition duration-300">
                    <p class="italic text-gray-600 mb-4">"Ik gebruik deze app om mijn competities bij te houden. Heel handig en gebruiksvriendelijk."</p>
                    <h3 class="font-bold text-blue-600">- Lisa de Vries, Wedstrijdcoördinator</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-8 text-center hover:shadow-2xl transition duration-300">
                    <p class="italic text-gray-600 mb-4">"Fantastisch om nieuws en updates over mijn favoriete teams te krijgen!"</p>
                    <h3 class="font-bold text-blue-600">- Marco van der Meer, Voetbalfan</h3>
                </div>
            </div>
        </div>
    </div>

    @include('bovenenbeneden.footer')
</body>
</html>
