<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'externo'])->group(function () {
    Route::get('/catalogo', function () {
        return view('catalogo');
    });
});

Route::get('/login', function () {
    if (Auth::check()) {
        return Auth::user()->hasRole(User::ROLE_EXTERNO)
            ? redirect('/catalogo')
            : redirect('/');
    }

    return view('auth.login');
});

Route::get('/register', function () {
    if (Auth::check()) {
        return Auth::user()->hasRole(User::ROLE_EXTERNO)
            ? redirect('/catalogo')
            : redirect('/');
    }

    return view('auth.register');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});
