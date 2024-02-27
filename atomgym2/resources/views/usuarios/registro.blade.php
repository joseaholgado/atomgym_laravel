@extends('layouts/template')
@section('title', 'Login ')
@section('contenido')

<main>
    <h2>Registrarse</h2>
    <form method="POST" action="{{route ('registrarse')}}">
        @csrf
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="password_confirmation">Confirmar Contraseña:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br>
        <input type="submit" value="registrarse">
    </form>
    <a href="{{url('usuarios/login')}}">Login</a>

</main>