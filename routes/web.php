<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\LocaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthenticationController::class, 'registration']);
Route::post('/register_user', [AuthenticationController::class, 'registr'])->name('register_user');
Route::get('/actors/born-today', [ApiController::class, 'bornToday'])->name('actors.born_today');
Route::get('/locale/{lang}', [LocaleController::class, 'setLocale']);
