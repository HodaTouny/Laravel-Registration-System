<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthenticationController::class, 'registration']);
Route::post('/register_user', [AuthenticationController::class, 'registr'])->name('register_user');
