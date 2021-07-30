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


    Route::post('/vacation/{bool}', 'MainController@vacation')->name('vacation.mode');


    Route::post('/light/1/{device}', 'MainController@lightOn')->name('light.on');
    Route::post('/light/0/{device}', 'MainController@lightOff')->name('light.off');

    Route::get('/addDevice', function () {
        return view('add-device');
    })->name('device.add');

    Route::get('/addProfile', 'AutomatizationController@index')->name('device.profile');
    Route::post('/addProfile', 'AutomatizationController@create')->name('device.profile.add');
    Route::post('/task/delete/{id}', 'AutomatizationController@delete')->name('device.profile.remove');

    Route::post('/addDevice', 'MainController@createDevice')->name('device.add.post');

    Route::post('/delete/{device}', 'MainController@deleteDevice')->name('device.delete');


    Route::post('/daikin/{device}/power', 'DaikinController@togglePower')->name('daikin.power.toggle');
    Route::post('/daikin/{device}/target_temp/{temp}', 'DaikinController@targetTemp')->name('daikin.temp.target');

    Route::post('/luminosity/{luminosity}/{device}', 'MainController@luminosity');
    Route::post('/color/{color}/{device}', 'MainController@color');

    Route::redirect('/', '/home');

    Route::get('/logout', function () {
        Auth::logout();

        return redirect()->route('login');
    });
});