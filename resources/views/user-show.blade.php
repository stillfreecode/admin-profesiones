@include('header')
<div class="row mt-5">
    <div class="col-8">
        <h1 class="mt-2">Usuario #{{$user->id}}</h1>
        <p class="lead">Mostrando detalle del usuario: {{$id}}</p>
    </div>
    <div class="col-4">
        @include("sidebar")
    </div>
</div>
@include('footer')