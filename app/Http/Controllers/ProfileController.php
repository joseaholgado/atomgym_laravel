<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    public $busqueda= '';
    /**
     * Esta función muestra el formulario para que el usuario edite su perfil. Retorna la vista 'profile.edit' 
     * y pasa el usuario actual autenticado como una variable llamada 'user'.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Esta función actualiza la información del perfil del usuario. Primero valida los datos recibidos del formulario utilizando un objeto de tipo ProfileUpdateRequest, luego actualiza el modelo del usuario con los datos validados. Si el usuario ha cambiado su correo electrónico, la marca de tiempo de verificación de correo electrónico se establece en null. Finalmente,
     *  redirecciona al usuario a la ruta 'profile.edit' con un mensaje de estado 'profile-updated'..
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Esta función elimina un usuario y todos sus entrenamientos asociados. Busca al usuario por su ID, elimina todos sus entrenamientos y luego elimina al usuario. Finalmente,
     *  redirecciona a la ruta 'dashboard' con un mensaje de éxito o error, dependiendo si se encontró o no el usuario.
     */
    public function eliminarUsuario($id)
    {
        $user = \App\Models\User::find($id);

        if ($user) {
            // Delete the user's entrenamientos
            foreach ($user->entrenamientos as $entrenamiento) {
                $entrenamiento->delete();
            }

            // Delete the user
            $user->delete();

            return redirect()->route('dashboard')->with('success', 'User and their entrenamientos deleted successfully');
        } else {
            return redirect()->route('dashboard')->with('error', 'User not found');
        }
    }

    /**
     * Esta función elimina un usuario y todos sus entrenamientos asociados. Busca al usuario por su ID, elimina todos sus entrenamientos y luego elimina al usuario. Finalmente,
     *  redirecciona a la ruta 'dashboard' con un mensaje de éxito o error, dependiendo si se encontró o no el usuario.
     */

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Esta función muestra la vista 'dashboard' con los entrenamientos y usuarios que coinciden con la búsqueda.
     *  Si el usuario es un administrador, se mostrarán los usuarios que coinciden con la búsqueda. Si el usuario no es un
     *  administrador, se mostrarán los entrenamientos que coinciden con la búsqueda. Si no se proporciona una búsqueda, se mostrarán
     *  todos los entrenamientos y usuarios.
     */

    public function render(Request $request)
    {

        $user = Auth::user();
        $busqueda = $request->input('busqueda');
        $entrenamientos = collect([]);
        $usuarios = collect([]);

        if ($user->roles == 'admin' && $busqueda && strlen($busqueda) >= 2) {
            $usuarios = User::where('name', 'like', '%' . $busqueda . '%')->paginate(3)->appends(['busqueda' => $busqueda]);
        } else if ($busqueda && strlen($busqueda) >= 2) {
            $entrenamientos = $user->entrenamientos()
                ->where('nombre_ejercicio', 'like', '%' . $busqueda . '%')
                ->orWhereHas('musculo', function ($query) use ($busqueda) {
                    $query->where('nombre', 'like', '%' . $busqueda . '%');
                })
                ->paginate(2)->appends(['busqueda' => $busqueda]);
        } else {
            $entrenamientos = $user->entrenamientos()->paginate(2)->appends(['busqueda' => $busqueda]);
            $usuarios = User::paginate(3)->appends(['busqueda' => $busqueda]);
        }

        return view('dashboard', ['entrenamientos' => $entrenamientos, 'usuarios' => $usuarios, 'busqueda' => $busqueda]);
        
    }
}
