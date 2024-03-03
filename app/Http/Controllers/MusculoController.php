<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Musculo; 

class MusculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registrarMusculo(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|min:3|unique:musculos',
           
        ]);
       
        // Si la validación pasa, entonces puedes crear el nuevo músculo
        $musculo = new Musculo;
        $musculo->nombre = $request->nombre;
        // Asigna aquí otros campos del formulario al modelo $musculo
        $musculo->save();
        
    
        // Redirige al usuario a donde quieras que vaya después de crear el músculo
        return redirect()->route('dashboard');
    }
    public function eliminarMusculo(Request $request)
    {
        // Buscar el músculo por su ID y eliminarlo
        $musculo = Musculo::find($request->nombre);
        $musculo->delete();

        // Redirige al usuario a donde quieras que vaya después de eliminar el músculo
        return redirect()->route('dashboard');
    }

}
