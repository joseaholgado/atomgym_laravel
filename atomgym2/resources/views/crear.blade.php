<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear entrenamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{route ('registrarEntrenamiento')}}" enctype="multipart/form-data">
                        @csrf
                        <?php
                        $musculos = DB::table('musculos')->select('id', 'nombre')->get();
                        ?>
                        <label for="musculo_id">Músculo:</label><br>
                        <select name="musculo_id" id="musculo_id" class="form-select" required>
                        <option value="">Seleccione un músculo</option>
                        @foreach ($musculos as $musculo) #Me recorre el array de musculos en el select
                        <option value="{{$musculo->id}}">{{$musculo->nombre}}</option>
                        @endforeach
                        </select><br>

                        <label for="nombre_ejercicio">Nombre de ejercicio:</label><br>
                        <input type="text" id="nombre_ejercicio" name="nombre_ejercicio" required><br>
                       
                        <label for="series">Series:</label><br>
                        <input type="number" id="series" name="series" required><br>

                        <label for="repeticiones">Repeticiones:</label><br>
                        <input type="number" id="repeticiones" name="repeticiones" required><br>
                        
                        <label for="descripcion">Descripción:</label><br>
                        <textarea id="descripcion" name="descripcion" required></textarea><br>

                        <label for="imagen_ruta">Imagen:</label><br>
                        <input type="file" id="imagen_ruta" name="imagen_ruta"><br>

                        <input type="submit" value="registrarse">
                    </form>

                </div>

                <a href="{{ route('crear') }}">
                    <button class="bg-gray-800 text-white font-bold py-2 px-4 rounded">
                        Añadir tarea
                    </button>
                </a>
                {{ auth()->user()->name }}


            </div>
        </div>
    </div>

</x-app-layout>