<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Listado de Productos</title>
</head>

<body>
    <h1>{{$title}}</h1>
    <hr>
    @if(!empty($variable))
    <ul>
        @foreach ($variable as $user)
        <li>{{$user}}</li>
        @endforeach
    </ul>
    @else
    <p>No hay productos registrados</p>
    @endif
</body>


</html>