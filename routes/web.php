<?php

use App\Http\Controllers\SpelerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function(){
    return view('home');
});

Route::get('/home', function(){
    return view('home');
});

Route::resource('spelers', SpelerController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
