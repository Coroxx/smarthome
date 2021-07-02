<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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
    <div class="bg-gray-900 w-full h-screen">

        <div class="">
            <p class="text-gray-200 font-default text-center text-5xl py-2">SmartHome</p>
        </div>
        <div class="mx-4 text-white mt-4 grid grid-cols-4 gap-12 text-center">
            @foreach ($devices as $device)
                <div class="bg-gray-700 border-b-4 border-blue-600 rounded px-4 py-2">
                    <div class="text-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 inline-flex" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z" />
                        </svg>


                        <p class="inline-flex text-xl relative top-1">{{ $device->name }}</p>
                    </div>
                    <div class="pl-2.5 mt-2 w-full mb-12">
                        <label class="flex items-center cursor-pointer">
                            <div class="relative">
                                <input type="checkbox" data-id="{{ $device->id }}" onclick="toggleLight(this)"
                                    class="sr-only" />
                                <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                <div
                                    class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition">
                                </div>
                            </div>
                            <div class="ml-3 text-white font-bold text-lg">
                                Allumer
                            </div>
                        </label>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function toggleLight(e) {
            // console.log(Number(e.checked));
            window.axios({
                method: 'POST',
                url: `/light/${Number(e.checked)}/${e.dataset.id}`,
            }).then((response) => {
                // window.alert('d');
            });
        }
    </script>
</body>

</html>
