@extends('layouts/template')
@section('title', 'Login ')
@section('contenido')

<main>
<form method="POST" action="/login">
        @csrf
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Acceder">
    </form>
        <a href="{{url('usuarios/registro')}}">Registro</a>
</main>