<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\Nivel;
class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $alumnos =Alumno::all();

        return view('alumnos.index', ['alumnos'=>$alumnos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumnos.create', ['niveles'=>Nivel::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([#validaciones de los campos
            'matricula'=>'required|unique:alumnos|max:10',
            'nombre'=>'required | max:255',
            'fecha'=>'required | date',
            'telefono'=>'required |max:9',
            'email'=>'required|',
            'nivel'=>'required|'
        ]);

        $alumno = new Alumno();	
        $alumno->matricula = $request->input('matricula');
        $alumno->nombre = $request->input('nombre');
        $alumno->fecha_nacimiento = $request->input('fecha');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->nivel_id = $request->input('nivel');
        $alumno->save();#guarda el registro

        return view('alumnos.message',['message'=>'Registro guardado correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alumno = Alumno::find($id);
        return view('alumnos.edit', ['alumno'=>Alumno::find($id), 'niveles'=>Nivel::all()]);
    }
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([#validaciones de los campos
            'matricula'=>'required|max:10|unique:alumnos,matricula,'.$id, #Este campo con lo ultimo omite el registro con una excepcion
            'nombre'=>'required | max:255',
            'fecha'=>'required | date',
            'telefono'=>'required |max:9',
            'email'=>'required|',
            'nivel'=>'required|'
        ]);

        $alumno =  Alumno::find($id);#busca el registro en la base de datos por su id
        $alumno->matricula = $request->input('matricula');
        $alumno->nombre = $request->input('nombre');
        $alumno->fecha_nacimiento = $request->input('fecha');
        $alumno->telefono = $request->input('telefono');
        $alumno->email = $request->input('email');
        $alumno->nivel_id = $request->input('nivel');
        $alumno->save();#guarda el registro

        return view('alumnos.message',['message'=>'Registro modificado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alumno = Alumno::find($id);
        $alumno->delete();#elimina el registro

        return redirect('alumnos');
    }
}
