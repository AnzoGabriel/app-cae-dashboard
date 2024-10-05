<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'welcome');

Route::view('/login', 'auth.login')->name('login');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
