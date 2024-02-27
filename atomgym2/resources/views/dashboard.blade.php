<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Menú') }}
        </h2>
    </x-slot>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                
                    @php
                        $roles = auth()->user()->roles;
                        $usuarios = \App\Models\User::all();
                    @endphp

                    @if($roles == 'admin')
                        <!-- Contenido para administradores -->
                        {{ __("Usuarios logueados") }}

                        <table>
                        <thead>
                            <tr>
                                <th>Nombre de usuario</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Roles</th>
                                
                            </tr>
                            </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                            <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->last_name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->roles }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </thead>


                    @elseif($roles == 'user')
                        <!-- Contenido para usuarios regulares -->
                                         
                    {{ __("Entrenamientos") }}
                    @if ($entrenamientos->isEmpty())
                        <p>No tienes ningún entrenamiento.</p>
                    @else
                    
                    <table>
                        <thead>
                            <tr>
                                <th>Músculo</th>
                                <th>Nombre del ejercicio</th>
                                <th>Series</th>
                                <th>Repeticiones</th>
                                <th>Descripción</th>
                                <th>Imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($entrenamientos as $entrenamiento)
                                <tr>
                                
                                    <td>{{ $entrenamiento->musculo->nombre}}</td>
                                    <td>{{ $entrenamiento->nombre_ejercicio }}</td>
                                    <td>{{ $entrenamiento->series }}</td>
                                    <td>{{ $entrenamiento->repeticiones }}</td>
                                    <td>{{ $entrenamiento->descripcion }}</td>
                                    <td> <img src="{{url('') . Storage::url($entrenamiento->imagen_ruta) }}" width="100" height="100"></td>
                                    <td>
                                    <a href="{{ route('actualizar', ['id' => $entrenamiento->id]) }}" 
                                    class="btn btn-warning btn-sm">Editar</a>
                                    </td>
                                   
                                    <td>
                                    <form action="{{ route('entrenamientos.destroy', $entrenamiento->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $entrenamientos->links() }}<!--#Muestra el menú de paginación-->
                    @endif

                </div>

                <a href="{{ route('crear') }}">
                    <button class="bg-gray-800 text-white font-bold py-2 px-4 rounded">
                       + Añadir tarea
                    </button>
                    
                </a>
                @endif


            </div>
        </div>
    </div>

</x-app-layout>