<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
use App\Models\Device;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>


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
                <p class="py-4 text-3xl text-center text-gray-200 xl:text-5xl lg:text-4xl font-default">SmartHome <img
                        src="{{ asset('assets/light.png') }}" alt="emoji" class="inline w-12 h-12 mb-1 -ml-2"></p>
            </div>
            <div class="mb-10">
                <div class="px-1 py-1 m-auto text-center text-black bg-gray-300 rounded w-44">
                    <a href=""> Ajouter un appareil + </a>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-12 mx-4 mt-4 text-center text-white xl:grid-cols-4 lg:grid-cols-2">
                @foreach ($devices as $device)
                    <div class="px-4 py-2 bg-gray-800 border-b-4 border-yellow-300 rounded">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-flex w-8 h-8" fill="none"
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
                                    <input type="checkbox" data-id="{{ $device->id }}" @if ($device->type == 'yeelight') onclick="toggleLight(this)" @elseif($device->type == 'daikin') onclick="togglePower(this)" @endif data-ip="{{ $device->ip }}" class="sr-only" @if ($device->status)
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
                        <option value="16711680" selected>Rouge</option>
                        <option value="65280">Vert</option>
                        <option value="255">Bleu</option>
                        <option value="10490623">Violet</option>
                        <option value="16187136">Jaune</option>
                    </select>
                </div>
            @elseif ($device->type == 'daikin')
                <br>
                <div class="font-bold text-left">
                    <p>Température intérieure : {{ $device->current_temp_indoor }} </p>
                    <p>Température extérieure : {{ $device->current_temp_outside }} </p>
                </div>

            @endif

        </div>


    </div>
    @endforeach
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

            });
        }

        function luminosity(e) {
            window.axios({
                method: 'POST',
                url: `/luminosity/${Number(e.value)}/${e.dataset.id}`,
            }).then((response) => {
                e.disabled = false;

            });
        }

        function color(e) {
            window.axios({
                method: 'POST',
                url: `/color/${e.value}/${e.dataset.id}`,
            }).then((response) => {
                e.disabled = false;

                console.log(response);
            });
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


        function togglePower(e) {
            // e.disabled = true;


            if (e.checked) {
                document.getElementById(e.dataset.id + 'Box').classList.replace('circle-red', 'circle-green')
            } else {
                document.getElementById(e.dataset.id + 'Box').classList.replace('circle-green', 'circle-red')
            }

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var response = JSON.parse(xmlhttp.responseText);
                        console.log('good!');
                        control_response = response;
                        control_response_handler(response);
                    }
                }
            };
            xmlhttp.open("GET", `http://${e.dataset.ip}/aircon/get_control_info`, true);
            xmlhttp.setRequestHeader("Content-type", "application/json");

            xmlhttp.send();




            request = "POST";
            target = `/daikin/power/${e.dataset.ip}`;
            console.log(e.dataset.po);
            console.log(JSON.parse(e.dataset.po));
            let temp = minimize_opt(e.dataset.po);
            temp.pow == "0" ? 1 : 0;

            console.log(temp);

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
                        var response = JSON.parse(xmlhttp.responseText);
                        console.log(response);
                    } else {
                        console.log("Error: send control request failed");
                    }
                } else {
                    //alert(xmlhttp.readyState);
                }
            };


            xmlhttp.open(request, target, true);
            xmlhttp.setRequestHeader("Content-type", "application/json");
            xmlhttp.send(JSON.stringify(temp));
        }
    </script>
</body>

</html>
