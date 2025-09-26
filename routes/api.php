<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrupoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas de Grupos - Moverlas a la API deshabilita la verificación CSRF.

// 1. Ruta para LEER todos los grupos (GET)
Route::get('/grupos/data', [GrupoController::class, 'data'])->name('api.grupos.data');

// 2. Ruta para GUARDAR un nuevo grupo (POST) - ¡LA QUE FALTABA!
Route::post('/grupos', [GrupoController::class, 'store'])->name('api.grupos.store'); 

