<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Saludando</title>
</head>

<body>
    <h1>Este es un saludo</h1>
    <p>Hola, {{$nombre}}</p>
</body>

</html>