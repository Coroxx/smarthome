<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Connexion</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body>


    <div class="bg-gradient-to-t from-yellow-200 to-yellow-500 w-full h-screen">
        <p class="text-gray-200 font-default text-center text-4xl py-2 font-extrabold ">SmartHome <span
                class="text-3xl relative bottom-0.5">🏡</span>
            -
            Connexion</p>
        <div id="login">
            <div class="h-auto w-1/3 m-auto mt-12 rounded text-center">
                <div class="py-1 text-3xl">
                    <p class="font-default text-white font-bold ">Identifiants</p>
                </div>
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mt-6 text-xl">
                        <input type="text"
                            class="px-3 py-0.5 focus:outline-none text-center rounded placeholder-gray-700 font-default"
                            placeholder="Nom d'utilisateur" name="name">
                    </div>
                    <div class="pt-2 pb-3 text-xl font-default">
                        <input type="password"
                            class="py-0.5 px-3 focus:outline-none text-center rounded placeholder-gray-700"
                            placeholder="Mot de passe" name="password">
                    </div>
                    @error('password')
                        <div class="pt-2 font-bold text-red-500">
                            <p>Identifiants incorrects</p>
                        </div>
                    @enderror

                    <input type="submit" value="Se connecter"
                        class="text-lg mt-8 px-1.5 py-1 rounded placeholder-gray-700">
                </form>
            </div>
        </div>
    </div>

</body>

</html>
