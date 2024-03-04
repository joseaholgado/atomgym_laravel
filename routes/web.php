<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\EntrenamientoController;
use App\Http\Controllers\MusculoController;


    /**
     * Este archivo define las rutas necesarias para las diferentes funcionalidades de la aplicación,
     *  incluyendo el perfil de usuario, la gestión de entrenamientos y músculos, y las funcionalidades de autenticación.
     *  Las rutas están agrupadas según el middleware de autenticación y verificación para garantizar que solo
     *  los usuarios autenticados y verificados puedan acceder a ellas
     */

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'render'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/actualizar/{id}', [EntrenamientoController::class, 'edit'])->name('actualizar');
    Route::delete('/entrenamientos/{id}', [EntrenamientoController::class, 'destroy'])->name('entrenamientos.destroy');
    Route::delete('/profile/{id}', [ProfileController::class, 'eliminarUsuario'])->name('user.eliminarUsuario');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/informacion/{id}', [EntrenamientoController::class, 'informacion'])->name('informacion');
    Route::view('/crear', 'crear')->name('crear');
    Route::view('/crearMusculo', 'crearMusculo')->name('crearMusculo');
    Route::post('/actualizarEntrenamiento/{id}', [EntrenamientoController::class, 'update'])->name('actualizarEntrenamiento');
    Route::post('/registrarEntrenamiento', [EntrenamientoController::class, 'registrarEntrenamiento'])->name('registrarEntrenamiento');
    Route::post('/registrarMusculo', [MusculoController::class, 'registrarMusculo'])->name('registrarMusculo');
    Route::post('/eliminarMusculo', [MusculoController::class, 'eliminarMusculo'])->name('eliminarMusculo');
    Route::view('/editar', 'editar');
    Route::view('/eliminar', 'eliminar');
});


require __DIR__.'/auth.php';