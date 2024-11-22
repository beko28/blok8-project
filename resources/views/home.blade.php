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
    <?php include '/Users/bekir/Herd/voetbalapp/resources/bovenenbeneden/header.php'; ?>

    <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-4">Welkom bij de Voetbal App</h1>
            <p class="text-lg mb-6">Beheer spelers, poules, tags en nieuws eenvoudig in één applicatie!</p>
            <a href="{{ route('spelers.index') }}" class="bg-yellow-400 text-blue-800 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition duration-300">
                Start nu
            </a>
        </div>
    </div>

    <div class="container mx-auto p-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-4">Over de Voetbal App</h2>
            <p class="text-gray-600 mb-4">
                Deze applicatie helpt je om al je voetbalactiviteiten te beheren. Of je nu spelersinformatie wilt bijhouden, wedstrijden wilt organiseren, of op de hoogte wilt blijven van het laatste nieuws, de Voetbal App biedt alles wat je nodig hebt.
            </p>
            <ul class="list-disc pl-6 text-gray-600">
                <li>Voeg spelers toe en beheer hun gegevens.</li>
                <li>Organiseer en beheer poules en competities.</li>
                <li>Lees en deel voetbalnieuws met je team.</li>
                <li>Categoriseer en tag spelers en teams voor snelle toegang.</li>
            </ul>
        </div>
    </div>

    <div class="bg-gray-200 py-12">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Waarom kiezen voor de Voetbal App?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <i class="fas fa-users text-blue-500 text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Teambeheer</h3>
                    <p class="text-gray-600">Beheer eenvoudig je spelers en hun prestaties.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <i class="fas fa-trophy text-yellow-500 text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Competities</h3>
                    <p class="text-gray-600">Organiseer poules en bekijk standen in één overzicht.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6 text-center">
                    <i class="fas fa-newspaper text-green-500 text-4xl mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Nieuws</h3>
                    <p class="text-gray-600">Blijf altijd op de hoogte van het laatste voetbalnieuws.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-blue-600 text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Maak je voetbalbeheer eenvoudig en effectief</h2>
            <p class="text-lg mb-6">Start nu met de Voetbal App en ontdek hoe het je tijd en moeite bespaart.</p>
            <a href="{{ route('spelers.index') }}" class="bg-yellow-400 text-blue-800 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-300 transition duration-300">
                Begin Nu
            </a>
        </div>
    </div>

    <div class="bg-gray-100 py-12">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-8">Wat zeggen onze gebruikers?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="italic text-gray-600">"De Voetbal App heeft mijn teambeheer super makkelijk gemaakt. Het is geweldig!"</p>
                    <h3 class="font-bold text-blue-600 mt-4">- Jan Jansen, Teamcoach</h3>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="italic text-gray-600">"Ik gebruik deze app om mijn competities bij te houden. Heel handig en gebruiksvriendelijk."</p>
                    <h3 class="font-bold text-blue-600 mt-4">- Lisa de Vries, Wedstrijdcoördinator</h3>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <p class="italic text-gray-600">"Fantastisch om nieuws en updates over mijn favoriete teams te krijgen!"</p>
                    <h3 class="font-bold text-blue-600 mt-4">- Marco van der Meer, Voetbalfan</h3>
                </div>
            </div>
        </div>
    </div>


    <?php include '/Users/bekir/Herd/voetbalapp/resources/bovenenbeneden/footer.php'; ?>
</body>
</html>
