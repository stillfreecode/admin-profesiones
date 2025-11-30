@extends('layout')
@section('title', 'Usuarios')
@section('content')

<h1>Editar usuario</h1>
@if ($errors->any())
<div class="alert alert-danger">
    <h6>Por favor corrige los errores debajo:</h6>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{url("usuarios/{$user->id}")}}" method="POST">
    {{ method_field('PUT') }}
    {{csrf_field()}}
  
    <label for="name">Nombre:</label>
    <input type="text" name="name" placeholder="Nombre" value="Nombre Apellido" value="{{ old('name'), $user->name }}">
    <br>
    <label for="email">Correo Electronico</label>
    <input type="email" name="email" placeholder="email" value="nombre@mail.com" value="{{ old('email'), $user->email }}">
    <br>
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" placeholder="Mayor a 6 caracteres">
    <br>
    <button type="submit">Actualizar usuario</button>
</form>
<p>
    <a href="{{ route('users.index')}}">
        Regresar al listado de usuarios</a>
</p>
@endsection