<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
use App\Models\Device;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="200">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vanillatoasts.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vanillatoasts.js') }}"></script>


    <link rel="icon" type="image/png" href="{{ asset('assets/house.png') }}" />

    <title>SmartHome</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .circle-green {
            background-color: rgb(0, 251, 134);
            border-radius: 50%;
            animation: pulse-green 2s infinite;
            height: 22px;
            width: 22px;
        }

        .circle-red {
            background-color: rgb(251, 0, 0);
            border-radius: 50%;
            animation: pulse-red 2s infinite;
            height: 22px;
            width: 22px;
        }


        @keyframes pulse-green {
            0% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(50, 244, 127, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(255, 82, 82, 0);
            }

            100% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
            }
        }

        @keyframes pulse-red {
            0% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(212, 0, 0, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(255, 82, 82, 0);
            }

            100% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
            }
        }

        @keyframes notification {
            0% {
                display: block;
                opacity: 0.1;
            }

            40% {
                opacity: 0.7;
            }

            80% {
                opacity: 1;
            }

            100% {
                display: none;
                opacity: 0;
            }


        }

        .notification {
            animation: notification 5s ease-in forwards;
        }

    </style>
</head>

<style>
    /* Toggle A */
    input:checked~.dot {
        transform: translateX(100%);
        background-color: #00ff2a;
    }

</style>

<body>
    <div class="w-full h-screen bg-gray-900">
        <div class="fadeIn">
            <div class="">
                <p class="py-4 text-3xl font-extrabold text-center text-gray-200 xl:text-5xl lg:text-4xl font-default">
                    SmartHome <img src="{{ asset('assets/light.png') }}" alt="emoji"
                        class="inline w-12 h-12 mb-1 -ml-2"></p>
            </div>
            <div class="mb-10">
                <div class="px-1 py-1 m-auto text-center text-black bg-gray-300 rounded w-44">
                    <a href=""> Ajouter un appareil + </a>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-12 mx-8 mt-4 text-center text-white xl:grid-cols-3 lg:grid-cols-2">
                @foreach ($devices as $device)
                    <div class="relative px-4 pt-2 bg-gray-800 border-b-4 @if ($device->type ==
                    'yeelight') border-yellow-300 @elseif($device->type =='daikin')
                        border-blue-500 @endif rounded">
                        <div class="text-left">
                            @switch($device->type)
                                @case('yeelight')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex w-10 h-10"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z" />
                                    </svg>
                                @break
                                @case('daikin')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex w-8 h-8 ml-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>

                                @break
                                @default

                            @endswitch


                            <p class="relative inline-flex text-xl top-1">{{ $device->name }}</p>
                            @if ($device->status)
                                <div class="relative inline-flex top-2 left-0.5">
                                    <div class="@if ($device->status == 'on') circle-green
                                    @else circle-red @endif" id="{{ $device->id . 'Box' }}"></div>
                                </div>

                            @else
                                <div>
                                    <p class="ml-2 font-bold text-red-600">Hors ligne</p>
                                </div>
                            @endif
                        </div>
                        <div class="pl-2.5 mt-2 w-full mb-12">
                            <label class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input type="checkbox" data-id="{{ $device->id }}" @if ($device->type == 'yeelight') onclick="toggleLight(this)" @elseif($device->type == 'daikin') onclick="togglePower(this)" @endif class="sr-only" @if ($device->status)
                                    @if ($device->status === 'on')
                                    checked @endif @else disabled
                @endif />
                <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                <div class="absolute w-6 h-6 transition bg-white rounded-full shadow dot -left-1 -top-1">
                </div>
            </div>
            <div class="ml-3 text-lg font-bold text-white">
                Allumer
            </div>

            </label>
            @if ($device->type == 'yeelight')
                <div class="text-left mt-2 -ml-0.5 text-white">
                    <div class="inline font-bold">
                        Luminositée :
                    </div>
                    <select name="luminosity" data-id="{{ $device->id }}" onchange='luminosity(this)'
                        class="px-2 bg-gray-600 rounded outline-none appearance-none focus:outline-none"
                        id="luminosity">
                        <option value="100" @if ($device->bright == '100') selected @endif>100%</option>
                        <option value="75" @if ($device->bright == '75') selected @endif>75%</option>
                        <option value="50" @if ($device->bright == '50') selected @endif>50%</option>
                        <option value="25" @if ($device->bright == '25') selected @endif>25%</option>
                    </select>
                </div>

                <div class="text-left mt-2 -ml-0.5 text-white">
                    <div class="inline font-bold">
                        Couleur :
                    </div>
                    <select name="color" data-id="{{ $device->id }}" onchange='color(this)'
                        class="px-2 bg-gray-600 rounded outline-none appearance-none focus:outline-none" id="color">
                        <option selected>Sélectionner</option>
                        <option value="16711680">Rouge</option>
                        <option value="1441536">Vert</option>
                        <option value="5631">Bleu</option>
                        <option value="10490623">Violet</option>
                        <option value="16187136">Jaune</option>
                        <option value="16551939">Orange</option>
                    </select>
                </div>
            @elseif ($device->type == 'daikin')
                <br>
                <div class="font-bold text-left">
                    <div class="pb-4">
                        <p class="inline">Température selectionnée : </p>
                        <input type="text" maxlength="4" pattern="\d+[\.]?\d+"
                            class="inline px-2 bg-gray-600 rounded py-0.5 focus:outline-none w-12"
                            value='{{ $device->current_target_temp }}' id="{{ $device->id }}_current_temp"
                            data-id="{{ $device->id }}"> °C
                        <div class="inline" onclick="targetTemp('{{ $device->id }}_current_temp')">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="inline cursor-pointer relative left-0.5 w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>

                    <p>Température intérieure : {{ $device->current_temp_indoor }} </p>
                    <p>Température extérieure : {{ $device->current_temp_outside }} </p>
                </div>

            @endif

            <div class="absolute pt-1 bottom-3 right-3" onclick="deleteDevice(this)">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 cursor-pointer" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </div>

        </div>


    </div>
    @endforeach
    </div>
    <div id="notification" class="absolute z-20 text-white bg-green-400 rounded bottom-10 right-5"
        style="display : none ; opacity : 1">
        <p id="messagePopup" class="px-2 py-1"></p>
    </div>
    </div>
    <script>
        function toggleLight(e) {
            e.disabled = true;
            if (e.checked) {
                document.getElementById(e.dataset.id + 'Box').classList.replace('circle-red', 'circle-green')
            } else {
                document.getElementById(e.dataset.id + 'Box').classList.replace('circle-green', 'circle-red')
            }
            window.axios({
                method: 'POST',
                url: `/light/${Number(e.checked)}/${e.dataset.id}`,
            }).then((response) => {
                e.disabled = false;
                let word = e.checked ? 'allumée' : 'éteinte';
                if (response.status == 200) {
                    VanillaToasts.create({
                        title: 'Mise à jour réussie',
                        positionClass: 'bottomRight',
                        type: 'success',
                        timeout: 3000,
                        text: `Lumière ${word}`,
                    });
                } else {
                    VanillaToasts.create({
                        title: 'Oups..',
                        positionClass: 'bottomRight',
                        type: 'error',
                        timeout: 3000,
                        text: `On dirait qu'une erreur s'est produite...`,
                    });
                }
            });
        }

        function luminosity(e) {
            window.axios({
                method: 'POST',
                url: `/luminosity/${Number(e.value)}/${e.dataset.id}`,
            }).then((response) => {
                e.disabled = false;

                if (response.stauts == 200) {
                    VanillaToasts.create({
                        title: 'Mise à jour réussie',
                        positionClass: 'bottomRight',
                        type: 'success',
                        timeout: 3000,
                        text: `Luminositée de la lumière mise sur ${e.value}%`,
                    });
                } else {
                    VanillaToasts.create({
                        title: 'Oups..',
                        positionClass: 'bottomRight',
                        type: 'error',
                        timeout: 3000,
                        text: `On dirait qu'une erreur s'est produite...`,
                    });
                }
            });


        }

        function popup(message) {
            document.getElementById('notification').style.display = 'block';
            document.getElementById('notification').style.animation = 'opacity 4s 2';
            document.getElementById('messagePopup').innerHTML = message;

            setTimeout(function() {
                document.getElementById('notification').style.display = 'none';
            }, (1500));
        }

        function color(e) {
            window.axios({
                method: 'POST',
                url: `/color/${e.value}/${e.dataset.id}`,
            }).then((response) => {
                e.disabled = false;

                console.log(response);
            });

            let color = parseInt(e.value);

            if (color) {
                VanillaToasts.create({
                    title: 'Mise à jour réussie',
                    positionClass: 'bottomRight',
                    type: 'success',
                    timeout: 3000,
                    text: `Couleur de la lumière changée en <div class="relative inline-flex w-4 h-4 rounded left-1 top-1" style="background-color : #${color.toString(16)}"> </div>`,
                });
            }


        }

        function minimize_opt(opt) {
            var min_opt = {};

            for (var x in opt) {
                if (
                    x == "pow" ||
                    x == "mode" ||
                    x == "stemp" ||
                    x == "shum" ||
                    x == "f_rate" ||
                    x == "f_dir"
                ) {
                    min_opt[x] = opt[x];
                }
            }

            return min_opt;
        }

        function deleteDevice(e) {
            let r = confirm('Souhaitez-vous vraiment supprimer ce phériphérique ?')

            if (r == true) {
                window.axios.post('http://smarthome.localhost/daikin/');
            }
        }

        function targetTemp(id) {
            let temp = parseFloat(document.getElementById(id).value);

            window.axios.post('http://smarthome.localhost/daikin/' + document.getElementById(id).dataset.id +
                    '/target_temp/' +
                    temp)
                .then(
                    (r) => {
                        console.log(r.data);

                        if (r.status == 200) {
                            VanillaToasts.create({
                                title: 'Mise à jour réussie',
                                positionClass: 'bottomRight',
                                type: 'success',
                                timeout: 3000,
                                text: `Température de l'appareil paramétré sur ${temp}°C`,
                            });

                        } else {
                            VanillaToasts.create({
                                title: 'Oups..',
                                positionClass: 'bottomRight',
                                type: 'error',
                                timeout: 3000,
                                text: `On dirait qu'une erreur s'est produite...`,
                            });
                        }

                    })


        }


        function togglePower(e) {
            e.disabled = true;

            document.getElementById(e.dataset.id + 'Box').classList.replace(e.checked ? 'circle-red' : 'circle-green', e
                .checked ? 'circle-green' : 'circle-red')

            window.axios.post('http://smarthome.localhost/daikin/' + e.dataset.id + '/power').then(
                (r) => {
                    if (r.status == 200) {
                        let word = e.checked ? 'allumée' : 'éteinte';

                        VanillaToasts.create({
                            title: 'Mise à jour réussie',
                            positionClass: 'bottomRight',
                            type: 'success',
                            timeout: 3000,
                            text: `Appareil ${word}`,
                        });
                    } else {
                        VanillaToasts.create({
                            title: 'Oups..',
                            positionClass: 'bottomRight',
                            type: 'error',
                            timeout: 3000,
                            text: `On dirait qu'une erreur s'est produite...`,
                        });
                    }
                })

            setTimeout(function() {
                e.disabled = false;
            }, (1000));
        }
    </script>
</body>

</html>
