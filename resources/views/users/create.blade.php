@extends('layout')

@section('title', "Crear Usuario")
@section('content')

<h1>Crear usuario</h1>
<form action="{{url('usuarios/crear')}}" method="post"></form>
<button type="submit">Crear Usuario</button>
<p>
    <a href="{{ route('users.index')}}">
        Regresar al listado de usuarios</a>
</p>
@endsection