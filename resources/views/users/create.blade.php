@extends('layout')

@section('title', "Crear Usuario")
@section('content')

<h1>Crear usuario</h1>
<form action="{{url('usuarios/')}}" method="POST">
{{csrf_field()}}
<label for="name">Nombre:</label>
<input type="text" name="name" placeholder="Nombre" value="Nombre Apellido">
<br>
<label for="email">Correo Electronico</label>
<input type="email" name="email" placeholder="email" value="nombre@mail.com">
<br>
<label for="password">Contraseña</label>
<input type="password" name="password" id="password" placeholder="Mayor a 6 caracteres">
<br>
<button type="submit">Crear Usuario</button>
</form>
<p>
    <a href="{{ route('users.index')}}">
        Regresar al listado de usuarios</a>
</p>
@endsection