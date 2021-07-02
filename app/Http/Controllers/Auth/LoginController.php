<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
	public function login()
    {
        request()->validate([
            'name' => 'required|string|exists:users',
            'password' => 'required',
        ], [
            'name.exists' => 'Ce nom d\'utilisateur n\'existe pas.',
        ]);
        $remember = true;

        $credentials = request()->only('name', 'password');

        if (Auth::attempt($credentials, $remember)) {
            request()->session()->regenerate();

            return redirect()->route('home');
        } else {
            return redirect()->route('login')->withErrors([
                'password' => 'Le mot de passe est incorrect.',
            ]);
        }   
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('genre.show', 'rap');
	}
}