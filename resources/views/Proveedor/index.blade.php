@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">

        @section('subtitulo')
        PROVEEDORES
        @endsection
        @section('opciones')
        @if(isset($d))
        <div class="col my-2 ml-5 pl-1">
            <form method="get" action="{{url('/puntoVenta/proveedor')}}">
                <button class="btn btn-secondary" type="submit">
                    <img src="{{ asset('img\agregar2.png') }}" class="img-thumbnail" alt="Editar" width="30px"
                        height="30px">
                    NUEVO PROVEEDOR
                </button>
            </form>
        </div>
        @endif
        <div class=" my-2 ml-3 p-1 ">
            <button type="button" class="btn btn-secondary p-1" data-toggle="modal"
                onclick="mostrarProveedoresInactivos()" data-target="#proveedoresInactivosModal">
                <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
                ALTA PROVEEDORES
            </button>
        </div>
        @endsection
    </div>
    <div class="row p-1">
        <div class="row border border-dark m-2 mt-4 w-100">
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                <div class="row px-3 py-3 m-0">
                    <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                    <h4 style="color:#4388CC">PROVEEDORES</h4>

                    <div class="input-group">
                        <input type="text" class="form-control text-uppercase my-1" placeholder="BUSCAR PROVEEDORES"
                            id="texto">
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
                    <form class="w-100" method="post" action="{{url('/puntoVenta/proveedor/'.$d->id)}}"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="ndepartamento">
                                <h4 style="color:#4388CC">EDITAR PROVEEDOR</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h4 class="text-uppercase">{{$d->nombre}}</h4>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-7">
                                    <div class="form-group">
                                        <label for="nombre">
                                            NOMBRE
                                        </label>
                                        <input type="text" class="text-uppercase form-control " name="nombre"
                                            id="nombre" value="{{$d->nombre}}">
                                        RFC
                                        </label>
                                        <input type="text"
                                            class="text-uppercase form-control  @error('nombre') is-invalid @enderror"
                                            name="rfc" id="rfc" value="{{$d->rfc}}">
                                        <label for="telefono">
                                            TELEFONO
                                        </label>
                                        <input type="text"
                                            class="text-uppercase form-control @error('nombre') is-invalid @enderror"
                                            name="telefono" id="telefono" value="{{$d->telefono}}">
                                        <label for="direccion">
                                            DIRECCION
                                        </label>
                                        <input type="text"
                                            class="text-uppercase form-control @error('nombre') is-invalid @enderror"
                                            name="direccion" id="direccion" value="{{$d->direccion}}">

                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-outline-secondary" type="submit">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="30px" height="30px">
                                GUARDAR CAMBIOS
                            </button>
                        </div>
                    </form>
                    <div class="row px-3 my-0">
                        <form method="post" action="{{url('/puntoVenta/proveedor/'.$d->id)}}">
                            {{csrf_field()}}
                            {{ method_field('DELETE')}}
                            <button class="btn btn-outline-secondary my-3" type="submit">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="30px" height="30px">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row mx-1 my-1 ">


                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('/puntoVenta/proveedor')}}"
                        enctype="multipart/form-data">
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
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="nombre" id="nombre">
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="rfc">
                                        RFC
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="rfc" id="rfc">
                                    <label for="telefono">
                                        TELEFONO
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="telefono" id="telefono">
                                    <label for="direccion">
                                        DIRECCION
                                    </label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="direccion" id="direccion">
                                </div>
                            </div>

                        </div>
                        <div class="form-row w-100">
                            <div class="form-group">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="30px" height="30px">
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
<!-- Modal -->
<div class="modal fade" id="proveedoresInactivosModal" tabindex="-1" aria-labelledby="proveedoresInactivosModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proveedoresInactivosModalLabel">PROVEEDORES DADOS DE BAJA: INACTIVAS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModalProveedoresInactivos">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <!--button type="button" class="btn btn-primary">Save changes</button-->
            </div>
        </div>
    </div>
</div>

<script>
const texto = document.querySelector('#texto');

async function mostrarProveedoresInactivos() {
    try {
        let body = document.getElementById("cuerpoModalProveedoresInactivos");
        let respuesta = await fetch(`/puntoVenta/proveedor/baja`);
        let cuerpo = "";
        if (respuesta.ok) {
            let proveedoresBaja = await respuesta.json();
            for (let i in proveedoresBaja) {
                cuerpo = cuerpo + `<ul class="list-group list-group-horizontal-sm my-1 border border-dark">
                <li class="list-group-item text-uppercase col-7">` + proveedoresBaja[i].nombre + `</li>
                <li class="list-group-item text-uppercase col-5 mx-auto">` +
                    `<button class="btn btn-success" onclick="altaProveedor(` + proveedoresBaja[i].id +
                    `)">DAR DE ALTA</button>` +
                    `</li></ul>`;

            }
        }
        body.innerHTML = cuerpo;
        //console.log(await respuesta.json());
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }


}

async function altaProveedor(id) {
    try {
        const url = "{{url('/')}}/puntoVenta/proveedor/" + id;
        let respuesta = await $.ajax({
            url: url,
            type: 'PUT',
            data: {
                'status': 'alta',
                '_token': "{{ csrf_token() }}",
            },
            //processData: false,  // tell jQuery not to process the data
            //contentType: false,
            success: function(data) {
                //alert(data);                    }
            }
        });
        console.log(respuesta);
        if (respuesta == true) {
            await filtrar();
            $('#proveedoresInactivosModal').modal('hide');

        } 
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}

async function filtrar() {
    try {
    document.getElementById("resultados").innerHTML = "";
    await fetch(`/puntoVenta/proveedor/buscador?texto=${texto.value}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        });
    } catch (err) {
        console.log("Error al realizar la petición AJAX: " + err.message);
    }
}
texto.addEventListener('keyup', filtrar);
filtrar();
</script>
@endsection