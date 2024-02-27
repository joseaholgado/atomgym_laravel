@extends('layouts/template')
@section('title', 'Registrar Alumno | Escuela')
@section('contenido')

<main>
    <div class="container py-4">
        <h2>Registrar Alumnos</h2>

         @if ($errors->any())
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
         @endif
        <form action="{{url('alumnos')}}" method="post">
            @csrf

            <div class="mb-3 row">
                <label for="matricula" class="col-sm-2 col-form-label">Matricula</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="matricula" name="matricula" value="{{old('matricula')}}"
                        required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre completo:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{old('nombre')}}"
                        required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="fecha" class="col-sm-2 col-form-label">Fecha de nacimiento:</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{old('fecha')}}"
                        required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="telefono" class="col-sm-2 col-form-label">Telefono:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{old('telefono')}}"
                        required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}"
                        required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nivel" class="col-sm-2 col-form-label">Nivel:</label>
                <div class="col-sm-5">

                    <select name="nivel" id="nivel" class="form-select" required>
                    <option value="">Seleccione un nivel</option>
                    @foreach ($niveles as $nivel) #Me recorre el array de niveles en el select
                    <option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <a href="{{url('alumnos')}}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar</button>


        </form>
    </div>
</main>