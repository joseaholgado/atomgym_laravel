<style>
    .contenedor{
        display: flex;
        justify-content: center;
    }
    .input{
        width: 220px;
        border-radius: 20px;
    }
    
    .formulario {
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #66583D;
    width: 50%;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    border-radius: 30px;
    }

    .formulario:hover {
        box-shadow: 0 34px 48px rgba(0, 0, 0, 0.25), 0 20px 20px rgba(0, 0, 0, 0.22);
       
    }
    .label_titulo{
        font-size: larger;
        color: white;
        border-bottom: 2px solid #FFA500;
    }
    .boton [type="submit"]{
        background-color: #FFA500;
    }
    
    .boton {
    margin-bottom:3vh;
    background-color: #99793D;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.5s ease;
    position: relative;
    overflow: hidden;
    background-color: #99793D;
    }

    .boton:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        background-color: #332F29;
        transition: width 0.5s ease;
        z-index: 1;
    }

    .boton:hover:before {
        width: 100%;
    }

    .boton span {
        position: relative;
        z-index: 2;
        transition: color 0.5s ease;
    }

    .boton:hover span {
        color: #FFA500;
    }
    .borrar{
        margin-top:16px;
    }
    textarea{
        width: 420px;
        height: 200px;
    }
</style>
<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear entrenamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg " >
                <div class="p-6 text-gray-900 contenedor">
                    <form class="formulario" method="POST" action="{{route ('registrarEntrenamiento')}}" enctype="multipart/form-data">
                        @csrf
                        <?php
                        $musculos = DB::table('musculos')->select('id', 'nombre')->get();
                        ?>
                        <label class="label_titulo" for="musculo_id">Músculo:</label><br>
                        <select class="select" name="musculo_id" id="musculo_id" class="form-select" style="border-radius:15px;" required>
                        <option value="">Seleccione un músculo</option>
                         @foreach ($musculos as $musculo) <!--#Me recorre el array de musculos en el select -->
                        <option value="{{$musculo->id}}">{{$musculo->nombre}}</option>
                        @endforeach
                        </select><br>

                        <label class="label_titulo" for="nombre_ejercicio">Nombre de ejercicio:</label><br>
                        <input class="input" type="text" id="nombre_ejercicio" name="nombre_ejercicio" style="border-radius:15px;" required><br>
                       
                        <label class="label_titulo" for="series">Series:</label><br>
                        <input class="input" type="number" id="series" name="series" style="border-radius:15px;" required><br>

                        <label class="label_titulo" for="repeticiones">Repeticiones:</label><br>
                        <input class="input" type="number" id="repeticiones" name="repeticiones" style="border-radius:15px;" required><br>
                        
                        <label class="label_titulo" for="descripcion">Descripción:</label><br>
                        <textarea id="descripcion" name="descripcion" style="border-radius:15px;" required></textarea><br>

                        <label class="label_titulo" for="imagen_ruta">Imágen:</label><br>
                        <input type="file" id="imagen_ruta" name="imagen_ruta"><br>

                        <button class="boton" type="submit" value="registrarse" style="border:2px solid #FFA500; border-radius:15px;">
                            <span>Añadir</span>
                        </button>
                    </form>

                </div>

                


            </div>
        </div>
    </div>

</x-app-layout>