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
     * Esta función se encarga de registrar un nuevo entrenamiento en la base de datos. Primero valida los datos recibidos del formulario,
     *  luego crea una nueva instancia del modelo Entrenamiento, asigna los valores de los campos recibidos del formulario a las propiedades
     *  del modelo y guarda la imagen asociada al entrenamiento si se proporcionó una. Finalmente, redirecciona a la ruta 'dashboard'.
     *
     * @param Request $request
     * @return void
     */
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
     * Esta función muestra la información de un entrenamiento específico. Recupera el entrenamiento con el ID proporcionado y lo pasa a la vista 'informacion'.
     */
    public function informacion($id)
    {
        return view('informacion', ['entrenamiento' => Entrenamiento::find($id)]);
    }

    /**
     * Esta función muestra el formulario para editar un entrenamiento específico.
     *  Recupera el entrenamiento con el ID proporcionado y lo pasa a la vista 'actualizar'
     */
    public function edit($id)
    {
        return view('actualizar', ['entrenamiento' => Entrenamiento::find($id)]);
    }

    /**
     * Esta función actualiza un entrenamiento existente en la base de datos.
     *  Primero valida los datos recibidos del formulario, luego recupera el entrenamiento con el ID proporcionado, actualiza sus propiedades
     *  con los nuevos valores recibidos del formulario y guarda los cambios.
     *  Finalmente, redirecciona a la ruta '/dashboard' con un mensaje de éxito..
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
     * Esta función elimina un entrenamiento específico de la base de datos. 
     * Recupera el entrenamiento con el ID proporcionado y lo elimina. Luego redirecciona a la ruta '/dashboard' con un mensaje de éxito.
     */
    public function destroy( $id)
    {
        
            $entrenamiento = Entrenamiento::find($id);
            $entrenamiento->delete();
        
            return redirect('/dashboard')->with('success', 'Entrenamiento eliminado con éxito');
        
    }
}
