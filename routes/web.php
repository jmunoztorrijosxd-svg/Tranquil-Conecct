<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\GrupoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
| Rutas accesibles sin necesidad de iniciar sesión.
*/

Route::get('/', function () {
    return view('welcome');
});

// Procesar formulario especial (temporalmente pública)
Route::post('/guardar-formulario', [FormController::class, 'guardar'])
    ->name('mi.ruta.para.procesar');

// ===================================
// Rutas de GRUPOS (Públicas para Depuración)
// ===================================

Route::prefix('grupos')->group(function () {
    // Mostrar todos los grupos (necesario para cargar la lista inicial)
    Route::get('/', [GrupoController::class, 'index'])->name('grupos.index');

    // Mostrar formulario de creación (si se usa la vista)
    Route::get('/crear', [GrupoController::class, 'create'])->name('grupos.create');

    // Guardar nuevo grupo (Aquí estaba el bloqueo del middleware 'auth')
    Route::post('/', [GrupoController::class, 'store'])->name('grupos.store');
});

/*
|--------------------------------------------------------------------------
| Rutas Autenticadas
|--------------------------------------------------------------------------
| Estas rutas requieren que el usuario haya iniciado sesión ('auth', 'verified')
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Recursos de usuario
    Route::resource('user', UserController::class)->names('user');

    // Formulario especial (requiere usuario autenticado y verificado)
    Route::get('/formulario-especial', function () {
        return view('formularios.registro');
    })->name('formulario.especial');
});
