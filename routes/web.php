<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login.post');

    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::post('/register', 'Auth\RegisterController@register');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'MainController@index')->name('home');

    Route::post('/light/1/{id}', 'MainController@lightOn')->name('light.on');
    Route::post('/light/0/{id}', 'MainController@lightOff')->name('light.off');

    Route::redirect('/', '/home');

    Route::get('/logout', function () {
        Auth::logout();

        return redirect()->route('login');
    });
});
