@extends('layouts/template')
@section('title', 'Alumnos | Escuela ')
@section('contenido')
<main>
    <div class="container py-4">
        <h2>{{$message}}</h2>
        <a href="{{url('alumnos')}}" class="btn btn-primary my-3"> Regresar</a>
    </div>
</main>