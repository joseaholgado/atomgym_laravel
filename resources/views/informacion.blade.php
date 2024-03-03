<style>
    .card {
    display: flex;
    justify-content: space-around;
    word-wrap: break-word;
    align-items: flex-end;
}



.card-img-top {
    width: 50%; /* Ajusta este valor según tus necesidades */
    object-fit: cover; /* Esto asegura que la imagen se redimensione correctamente */
    border-radius: 15px;
}

.card-body {
    width: 30%; /* Ajusta este valor según tus necesidades */
}
h5,li,p{
    color: white;
    font-weight: 500;

}
h5{
    font-size: inherit;
}
</style>

<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información del ejercicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style=" background-color: #66583D;">
                    
                    <div class="container">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset("storage/". $entrenamiento->imagen_ruta) }}" alt="Imagen del entrenamiento">
                            <div class="card-body" >
                                <h5 class="card-title" style="font-size:2em; color:#FFA500">Ejercicio: {{ $entrenamiento->nombre_ejercicio}}</h5>
                                <p class="card-text"> Descripción: {{ $entrenamiento->descripcion }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Repeticiones: {{ $entrenamiento->repeticiones }}</li>
                                <li class="list-group-item">Series: {{ $entrenamiento->series }}</li>
                                <li class="list-group-item">Tipo de músculo: {{ $entrenamiento->musculo->nombre }}</li>
                            </ul>
                        </div>
                    </div>

                </div>

                


            </div>
        </div>
    </div>
</x-app-layout>