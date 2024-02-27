<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar entrenamiento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{route ('actualizarEntrenamiento',
                    ['id'=>$entrenamiento->id])}}"> <!--#Este est un caso especial por error de formulario-->
                        @csrf
                        <input type="hidden" name="id" value="{{$entrenamiento->id}}">
                        <label for="nombre_ejercicio">Nombre de ejercicio:</label><br>
                        <input type="text" id="nombre_ejercicio" name="nombre_ejercicio"
                        value="{{$entrenamiento->nombre_ejercicio}}" required><br>
                       
                        <label for="series">Series:</label><br>
                        <input type="number" id="series" name="series"
                        value="{{$entrenamiento->series}}" required><br>

                        <label for="repeticiones">Repeticiones:</label><br>

                        <input type="number" id="repeticiones" name="repeticiones"
                        value="{{$entrenamiento->repeticiones}}" required><br>

                        <label for="descripcion">Descripción:</label><br>
                        <textarea id="descripcion" name="descripcion"
                        required>{{$entrenamiento->descripcion}}</textarea><br>

                        <input type="submit" value="actualizar">
                    </form>

                </div>

                


            </div>
        </div>
    </div>
</x-app-layout>