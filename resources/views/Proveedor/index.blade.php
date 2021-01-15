@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">

        @section('subtitulo')
        PROVEEDORES
        @endsection

    </div>
    <div class="row p-1">
        <div class="row border border-dark m-2 w-100">
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                <div class="row px-3 py-3 m-0">
                    <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                    <h4 style="color:#4388CC">PROVEEDORES</h4>

                    <div class="input-group">
                        <input type="text" class="form-control my-1" placeholder="BUSCAR PROVEEDORES" id="texto">
                        <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                    </div>

                </div>
                <div class="row m-0 px-0" style="height:200px;overflow-y:auto;">
                    <div id="resultados" class="col btn-block h-100">
                    </div>
                </div>
            </div>
            <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">
                <!--#FFFBF2"-->
                @if(isset($d))
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/proveedor/'.$d->id)}}" enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="ndepartamento">
                                <h4 style="color:#4388CC">PROVEEDOR</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h5>{{$d->nombre}}</h5>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="nombre">
                                            NOMBRE
                                        </label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{$d->nombre}}">
                                        RFC
                                        </label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="rfc" id="rfc" value="{{$d->rfc}}">
                                        <label for="telefono">
                                            TELEFONO
                                        </label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="telefono" id="telefono" value="{{$d->telefono}}">
                                        <label for="direccion">
                                            DIRECCION
                                        </label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="direccion" id="direccion" value="{{$d->direccion}}">

                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-outline-secondary" type="submit">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                GUARDAR CAMBIOS
                            </button>
                        </div>
                    </form>
                    <div class="row px-3 my-0">
                        <form method="post" action="{{url('/proveedor/'.$d->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-secondary my-3" type="submit">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row mx-1 my-1 ">


                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('proveedor')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="nempleado">
                            <h4 style="color:#4388CC">CREAR PROVEEDOR</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h5>NUEVO PROVEEDOR</h5>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre">
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="rfc">
                                        RFC
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="rfc" id="rfc">
                                    <label for="telefono">
                                        TELEFONO
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="telefono" id="telefono">
                                    <label for="direccion">
                                        DIRECCION
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="direccion" id="direccion">
                                </div>
                            </div>

                        </div>
                        <div class="form-row w-100">
                            <div class="form-group">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                                    GUARDAR PROVEEDOR
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>

<script>
    const texto = document.querySelector('#texto');


    function filtrar() {
        document.getElementById("resultados").innerHTML = "";
        fetch(`/proveedor/buscador?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
    }
    texto.addEventListener('keyup', filtrar);
    filtrar();
</script>
@endsection