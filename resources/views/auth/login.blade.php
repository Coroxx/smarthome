@extends('layouts.header')
@section('title', 'Connexion')

@section('content')
    <div class="w-full h-auto m-auto mt-12 text-center rounded">
        <div class="py-1 text-3xl">
            <p class="font-bold text-white font-default ">Identifiants</p>
        </div>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mt-6 text-xl font-semibold">
                <input type="text"
                    class="px-3 py-0.5 focus:outline-none text-center rounded placeholder-gray-700 font-default"
                    placeholder="Nom d'utilisateur" name="name">
            </div>
            <div class="pt-2 pb-3 text-xl font-semibold font-default">
                <input type="password" class="py-0.5 px-3 focus:outline-none text-center rounded placeholder-gray-700"
                    placeholder="Mot de passe" name="password">
            </div>
            @error('password')
                <div class="pt-2 font-bold text-red-500">
                    <p>Identifiants incorrects</p>
                </div>
            @enderror

            <input type="submit" value="Se connecter"
                class="text-lg mt-8 px-1.5 py-1 cursor-pointer rounded placeholder-gray-700">
        </form>
    </div>
@endsection
