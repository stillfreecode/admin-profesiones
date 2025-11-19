    @extends('layout')

    @section('content')
    <div class="row mt-5">
        <div class="col-8">
            <h1 class="mt-2">{{ $title }}</h1>
            <hr>

            @if ($variable->isNotEmpty())
                <ul>
                    @foreach ($variable as $user)
                    <li>{{ $user->name }}, ({{ $user->email }})</li>
                    <a href="{{route('users.show',$user)}}">ver detalles</a>
                    @endforeach
                </ul>
            @else
                <p>No hay usuarios registrados</p>
            @endif

        </div>

        <div class="col-4">
            @include("sidebar")
        </div>
        
    </div>
    @endsection