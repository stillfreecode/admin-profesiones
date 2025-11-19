@include('header')

<div class="row mt-5">
    <div class="col-8">
        <h1 class="mt-2">{{$title}}</h1>
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
    </div>
    <div class="col-4">
        @include("sidebar")
    </div>
</div>
@include('footer')