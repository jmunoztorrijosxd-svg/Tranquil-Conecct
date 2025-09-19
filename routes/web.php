<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\User\Usercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->group(function () {
        Route::resource('user', Usercontroller::class)->names('user');
    });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/formulario-especial', function () {
    return view('formularios.registro');
})->middleware(['auth', 'verified'])->name('formulario.especial');
Route::post('/guardar-formulario', [FormController::class, 'guardar'])->name('mi.ruta.para.procesar');
