<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Musculo; 

class MusculoController extends Controller
{
    

    /**
     *  Esta función se encarga de registrar un nuevo músculo en la base de datos.
     *  Primero valida los datos recibidos del formulario, asegurando que el nombre del músculo sea único
     *  y tenga al menos 3 caracteres. Luego crea una nueva instancia del modelo Musculo, asigna el nombre
     *  del músculo recibido del formulario a la propiedad correspondiente del modelo y guarda el músculo en la base de datos.
     *  Finalmente, redirecciona a la ruta 'dashboard'.
     */
    public function registrarMusculo(Request $request)
    {
        
        $request->validate([
            'nombre' => 'required|min:3|unique:musculos',
           
        ]);
       
        
        $musculo = new Musculo;
        $musculo->nombre = $request->nombre;   
        $musculo->save();
        
    
       
        return redirect()->route('dashboard');
    }


    /**
     * Esta función se encarga de eliminar un músculo existente de la base de datos.
     *  Busca el músculo por su ID, lo elimina y luego redirecciona a la ruta 'dashboard'.
     *
     * @param Request $request
     * @return void
     */
    public function eliminarMusculo(Request $request)
    {
        // Buscar el músculo por su ID y eliminarlo
        $musculo = Musculo::find($request->nombre);
        $musculo->delete();

        // Redirige al usuario a donde quieras que vaya después de eliminar el músculo
        return redirect()->route('dashboard');
    }

}
