
<style>
    td, th {
        padding: 0 15px;
    }
    tbody{
        text-align: center;
    }
    .titulo{
        font-size:2em;
    }
    .buscador{
        margin-left:98vh;
    }
    .tabla{
        margin-left:25vh;
        margin-top:3vh;
    }
    .boton {
    margin-left:50vh;
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
    svg:hover{
        border-radius: 50%;
        transition: box-shadow 0.3s ease;
        box-shadow: 0px 0px 15px 5px #FFA500;
    }

    
</style>


<x-app-layout >
    <x-slot name="header" >
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" >
            {{ __('Menú') }}
        </h2>
    </x-slot>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">     
                          
                <div class="p-6 text-gray-900">
                
                    <!-- @php
                        $roles = auth()->user()->roles;
                        $usuarios = \App\Models\User::all();
                    @endphp -->

                    @if($roles == 'admin')
                    
                        <!-- Contenido para administradores -->
                        <h1 class="titulo">{{ __("Usuarios logueados") }}</h1>
                        <div class="buscador">@livewire('search-component')</div>
                        <div class="tabla">
                        <table >
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
                                    <td>
                                    <form action="{{ route('user.eliminarUsuario', $usuario->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm borrar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#99793D" class="w-6 h-6">
                                                <path class="icono" stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>

                                        </button>
                                    </form>
                                    </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        
                        </thead>

                        </table>
                        </div>
                        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <!-- El resto de tu código... -->

                            @push('scripts')
                                <script>
                                    window.addEventListener('alert', event => {
                                        Swal.fire({
                                            icon: event.detail.type,
                                            title: '¡Éxito!',
                                            text: event.detail.message,
                                            confirmButtonText: 'OK'
                                        })
                                    })
                                </script>
                            @endpush
                        </div>
                        @if ($usuarios instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $usuarios->appends(['busqueda' => $busqueda])->links() }}
                        @endif
                        <button class="boton" style="border:2px solid #FFA500; border-radius:15px;">
                            <a href="{{ route('crearMusculo') }}">
                                <span>
                                    Añadir o eliminar Músculo
                                </span>
                            </a>
                        </button>
                    @elseif($roles == 'user')
                        <!-- Contenido para usuarios regulares -->
                    
                    <h1 class="titulo">{{ __("Entrenamientos") }}</h1>
                    <div class="buscador">@livewire('search-component')</div>
                    
                    @if ($entrenamientos->isEmpty())
                        <p>No tienes ningún entrenamiento.</p>
                    @else
                    
                    <table class="tabla">
                        <thead>
                            <tr>
                                <th>Músculo</th>
                                <th>Nombre del ejercicio</th>
                                <th>Series</th>
                                <th>Repeticiones</th>
                                <th>Imagen</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($entrenamientos as $entrenamiento)
                                <tr>
                                
                                    <td>{{ $entrenamiento->musculo->nombre}}</td>
                                    <td>{{ $entrenamiento->nombre_ejercicio }}</td>
                                    <td>{{ $entrenamiento->series }}</td>
                                    <td>{{ $entrenamiento->repeticiones }}</td>
                                    <td> <img src="{{url('') . Storage::url($entrenamiento->imagen_ruta) }}" width="100" height="100"></td>
                                    <td>
                                    <a href="{{ route('informacion', ['id' => $entrenamiento->id]) }}" 
                                    class="btn btn-warning btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#99793D" class="w-6 h-6">
                                            <path class="icono" stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>

                                    </a>
                                    

                                    </td>
                                    <td>
                                    <a href="{{ route('actualizar', ['id' => $entrenamiento->id]) }}" 
                                    class="btn btn-warning btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#99793D" class="w-6 h-6">
                                            <path class="icono" stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>    
                                    </a>
                                    </td>
                                   
                                    <td>
                                    <form action="{{ route('entrenamientos.destroy', $entrenamiento->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm borrar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#99793D" class="w-6 h-6">
                                                <path class="icono" stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                            </svg>

                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $entrenamientos->appends(['busqueda' => $busqueda])->links() }}<!--#Muestra el menú de paginación-->
                    @endif

                </div>

                <a href="{{ route('crear') }}">
                    <button class="boton">
                        <span>
                            + Añadir Ejercicio
                        </span>
                       
                    </button>
                    
                </a>
                @endif


            </div>
        </div>
    </div>

</x-app-layout>