<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use File;
class EntrenamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function registrarEntrenamiento(Request $request)
    {
       
        $request->validate([#validaciones de los campos
        'musculo_id' =>'required|',
        'nombre_ejercicio'=>'required|min:1',
        'series'=>'required|min:1',
        'repeticiones'=>'required |min:1',
        'descripcion'=>'required |min: 1 ',
        
        
    ]);
    if ($request->hasFile('imagen_ruta')) {
        $request->validate([#validaciones de los campos
            'imagen_ruta'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
   
    $entrenamiento = new Entrenamiento();
    $entrenamiento->musculo_id = $request->input('musculo_id');
    $entrenamiento->nombre_ejercicio = $request->input('nombre_ejercicio');
    $entrenamiento->series = $request->input('series');
    $entrenamiento->repeticiones = $request->input('repeticiones');
    $entrenamiento->descripcion = $request->input('descripcion'); 
    $entrenamiento->user_id = auth()->user()->id;#asigna el id del usuario autenticado
    if ($request->hasFile('imagen_ruta')) {
        $path = $request->file('imagen_ruta')->store('images');
        $entrenamiento->imagen_ruta = $path;
    
        $publicPath = public_path('storage/images/' . basename($path));
        if (!File::copy(storage_path('app/' . $path), $publicPath)) {
            throw new Exception('Failed to copy file to ' . $publicPath);
        }
    }
    $entrenamiento->save();#guarda el registro

    return redirect()->route('dashboard');#redirecciona a la vista dashboard
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
    public function informacion($id)
    {
        return view('informacion', ['entrenamiento' => Entrenamiento::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('actualizar', ['entrenamiento' => Entrenamiento::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([#validaciones de los campos
        'musculo_id' =>'required|',
        'nombre_ejercicio'=>'required|min:1',
        'series'=>'required|min:1',
        'repeticiones'=>'required |min:1',
        'descripcion'=>'required |min: 1 ',
        
        
    ]);
        $entrenamiento = Entrenamiento::find($id);
        $entrenamiento->musculo_id = $request->input('musculo_id');
        $entrenamiento->nombre_ejercicio = $request->input('nombre_ejercicio');
        $entrenamiento->series = $request->input('series');
        $entrenamiento->repeticiones = $request->input('repeticiones');
        $entrenamiento->descripcion =$request->input('descripcion');
        $entrenamiento->save();
        return redirect('/dashboard')->with('success', 'Entrenamiento actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        
            $entrenamiento = Entrenamiento::find($id);
            $entrenamiento->delete();
        
            return redirect('/dashboard')->with('success', 'Entrenamiento eliminado con éxito');
        
    }
}
