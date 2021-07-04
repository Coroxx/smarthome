<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
use App\Models\Device;
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta-tag')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vanillatoasts.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/vanillatoasts.js') }}"></script>


    <link rel="icon" type="image/png" href="{{ asset('assets/house.png') }}" />

    <title>@yield('title')</title>

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

<body class="bg-gray-900">
    <div class="w-full h-screen">
        <div class="fadeIn">
            <div class="">
                <p class="py-4 text-3xl font-extrabold text-center text-gray-200 xl:text-5xl lg:text-4xl font-default">
                    SmartHome <img src="{{ asset('assets/light.png') }}" alt="emoji"
                        class="inline w-12 h-12 mb-1 -ml-2">
                </p>
            </div>
            @yield('content')

        </div>
    </div>

    @yield('script')
</body>

</html>
