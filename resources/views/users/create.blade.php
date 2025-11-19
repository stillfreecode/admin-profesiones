@extends('layout')

@section('title', "Crear Usuario")
@section('content')

<h1>Crear usuario</h1>
<form action="{{url('usuarios/')}}" method="POST"></form>
{{csrf_field()}}
<button type="submit">Crear Usuario</button>
<p>
    <a href="{{ route('users.index')}}">
        Regresar al listado de usuarios</a>
</p>
@endsection