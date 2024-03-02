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
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
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
     * Delete the user's account.
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
                // $user = Auth::user();
        // $busqueda = $request->input('busqueda');
        // $entrenamientos = [];

        // if ($busqueda && strlen($busqueda) >= 2) {
        //     $entrenamientos = $user->entrenamientos()
        //         ->where('nombre_ejercicio', 'like', '%' . $busqueda . '%')
        //         ->orWhereHas('musculo', function ($query) use ($busqueda) {
        //             $query->where('nombre', 'like', '%' . $busqueda . '%');
        //         })
        //         ->paginate(2);
        // } else {
        //     $entrenamientos = $user->entrenamientos()->paginate(2);
        // }

        // return view('dashboard', ['entrenamientos' => $entrenamientos, 'busqueda' => $busqueda]);
    }
}
