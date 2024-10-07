<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\EstudanteController;

Route::view('/', 'welcome')->name('home');
Route::view('/login', 'auth.login')->name('login');
Route::view('/import', 'dashboard.import.import')->name('import');

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
Route::post('/import', [ImportController::class, 'import'])->name('import');


Route::get('/estudantes', [EstudanteController::class, 'index'])->name('estudantes.list');

Route::get('/estudantes/{num_matricula}/rendimentos', [EstudanteController::class, 'showRendimentos'])->name('estudantes.rendimentos');
