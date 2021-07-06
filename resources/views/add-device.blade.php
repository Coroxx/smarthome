@extends('layouts.header')

@section('title', 'Ajouter un appareil - Smarthome')


@section('content')
    <div class="w-11/12 h-auto m-auto text-center text-white bg-gray-800 rounded lg:text-lg lg:w-9/12">
        <form action="{{ route('device.add.post') }}" method="POST">
            @csrf

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
                    name="name" value="{{ old('name') }}" required>
                <div class="py-4">
                    <label for="inputIp">Adresse ip de l'appareil : </label>
                    <input type="text" id="inputIp" class="px-2 py-0.5 m-auto bg-gray-600 rounded focus:outline-none"
                        name="ip" value="{{ old('ip') }}" required>
                </div>
            </div>

            <div id="password" class="mt-12 font-semibold">

                <p class="py-1 mb-4 text-xl font-bold"> Identification (Caméra...)</p>
                <label for="inputUsername">Nom d'utilisateur :</label>
                <input type="text" id="inputUsername"
                    class="px-2 py-0.5 m-auto bg-gray-600 placeholder-gray-300 rounded focus:outline-none" name="username"
                    placeholder="Facultatif" value="{{ old('username') }}">
                <div class="py-2">
                    <label for="inputPassword">Mot de passe : </label>
                    <input type="password" id="inputPassword"
                        class="px-2 py-0.5 m-auto placeholder-gray-300 bg-gray-600 rounded focus:outline-none"
                        name="password" placeholder="Facultatif">
                </div>
            </div>

            <div class="pb-3 mt-6 text-lg">
                <input type="submit" value="Ajouter" class="px-4 py-1 bg-gray-600 rounded cursor-pointer">
            </div>

        </form>
    </div>
@endsection



@section('javascript')
    {{-- <script>
        window.axios({
            // method: 'POST',
            url: `http://192.168.0.16:8080/#/LightSwitches/json.htm?type=command&param=switchlight&idx=5&switchcmd=On&level=0`,
            async: false,
            dataType: 'json',
        }).then((response) => {
            console.log(response);
            console.log(response.data);
        });
    </script> --}}
@endsection
