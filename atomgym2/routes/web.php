<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\EntrenamientoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $entrenamientos = $user->entrenamientos()->paginate(3);#Esta linea me lo pagina
   
    return view('dashboard', ['entrenamientos' => $entrenamientos]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/actualizar/{id}', [EntrenamientoController::class, 'edit'])->name('actualizar');
    Route::delete('/entrenamientos/{id}', [EntrenamientoController::class, 'destroy'])->name('entrenamientos.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware('auth')->group(function () {
    Route::get('/crear', function () {
        return view('crear');
    })->name('crear');
    Route::post('/actualizarEntrenamiento/{id}', [EntrenamientoController::class, 'update'])->name('actualizarEntrenamiento');
    Route::post('/registrarEntrenamiento', [EntrenamientoController::class, 'registrarEntrenamiento'])->name('registrarEntrenamiento');
    Route::get('/editar', function () {
        return view('editar');
    });
    Route::get('/eliminar', function () {
        return view('eliminar');
    });
});





// Route::get('usuarios/login', function () {
//     return view('usuarios.index');
// });
// Route::get('usuarios/registro', function () {
//     return view('usuarios.registro');
// });
// Route::resource('/usuarios', UsuarioController::class);
// Route::post('/registrarse', 'UsuarioController@registrarse')->name('registrarse');


Route::resource('/alumnos', AlumnoController::class);

require __DIR__.'/auth.php';
