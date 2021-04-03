@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
<div class="col-0 my-2 p-1">
    <form method="get" action="{{url('/puntoVenta/departamento/')}}">
        <button class="btn btn-secondary ml-4 p-1" type="submit">
            <img src="{{ asset('img\departamento.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
            DEPARTAMENTOS
        </button>
    </form>
</div>
<div class="col-7 "></div>
<div class="my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/producto">
        <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="30px" height="30px">
    </a>
</div>
@endsection

<form method="post" action="{{url('/puntoVenta/producto')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    @include('Producto.form', ['Modo' => 'crear'])
</form>

@endsection