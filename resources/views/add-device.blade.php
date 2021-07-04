@extends('layouts.header')

@section('title', 'Ajouter un appareil - Smarthome')


@section('content')
    <div class="w-11/12 h-auto m-auto text-center text-white bg-gray-800 rounded lg:text-lg lg:w-9/12">
        <form action="{{ route('device.add.post') }}" method="POST">

            <h2 class="py-2 text-2xl font-bold">Ajouter un appareil</h2>

            <div class="py-2 font-semibold">
                <p class="lg:inline">Type :</p>
                <select name="type"
                    class="px-2 py-1 m-auto my-2 bg-gray-600 rounded outline-none appearance-none lg:py-0 lg:my-0 focus:outline-none">
                    <option value="" selected>- Selectionner un appareil -</option>
                    <option value="daikin">Climatisation - Daikin</option>
                    <option value="foscam">Caméra - Foscam</option>
                    <option value="yeelight">Lumière - Yeelight</option>
                </select>
                <br>
            </div>
            <div class="py-2 mt-4 font-semibold">
                <label for="inputName">Nom de l'appareil :</label>
                <input type="text" id="inputName" class="px-2 py-0.5 m-auto bg-gray-600 rounded focus:outline-none"
                    name="name" required>
                <div class="py-4">
                    <label for="inputIp">Adresse ip de l'appareil : </label>
                    <input type="text" id="inputIp" class="px-2 py-0.5 m-auto bg-gray-600 rounded focus:outline-none"
                        name="ip" required>
                </div>
            </div>

            <div id="password" class="mt-12 font-semibold">

                <p class="py-1 mb-4 text-xl font-bold"> Identification (Optionnel)</p>
                <label for="inputUsername">Nom d'utilisateur :</label>
                <input type="text" id="inputUsername" class="px-2 py-0.5 m-auto bg-gray-600 rounded focus:outline-none"
                    name="username">
                <div class="py-2">
                    <label for="inputPassword">Mot de passe : </label>
                    <input type="text" id="inputPassword" class="px-2 py-0.5 m-auto bg-gray-600 rounded focus:outline-none"
                        name="password">
                </div>
            </div>

        </form>
    </div>
@endsection
