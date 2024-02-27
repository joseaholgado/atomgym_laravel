<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('usuarios.index');
    }
    public function login()
    {
        
        return view('usuarios.index');
    }

    public function registro()
    {
        
        return view('registro.index');
    }

    public function registrarse(Request $request)
    {
        
        $request->validate([#validaciones de los campos
            'nombre'=>'required|max:20',
            'apellido'=>'required|max:20',
            'email'=>'required | email | unique:usuarios',
            'password'=>'required |min:4',
            'password_confirmation'=>'required| same:password',
            'roles'=>'required'
            
        ]);

        $usuario = new Usuario();	
        $usuario->nombre = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->email = $request->input('email');
        $usuario->password = bcrypt($request->input('password')); // Hashea la contraseña
        $usuario->roles = 'user';#asigna el rol de usuario
        $usuario->save();#guarda el registro
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
