@extends('header2')
@section('contenido')
@section('subtitulo')
CLIENTES
@endsection
@php
use App\Models\Sucursal_empleado;
$vC = ['verCliente','modificarCliente','eliminarCliente','crearCliente','admin'];
$mC= ['modificarCliente','admin'];
$cC= ['crearCliente','admin'];
$eC= ['eliminarCliente','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
$modificarC = $sE->hasAnyRole($mC);
$crearC = $sE->hasAnyRole($cC);
$eliminarC = $sE->hasAnyRole($eC);
$verC = $sE->hasAnyRole($vC);
@endphp
@section('opciones')
<!-- BOTON DEVOLUCION-->

<div class="ml-3 my-auto ">
    <a class="btn btn-outline-secondary ml-2 my-auto border-0 " href="{{ url('/puntoVenta/cliente')}}">
        <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>NUEVO CLIENTE</small></p>
    </a>
</div>

<div class="col-6 ml-4"></div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="/puntoVenta/venta">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>

<!--div class="ml-3 my-auto ">
    <a class="btn btn-outline-secondary ml-3 my-auto border-0 " href="{ url('/puntoVenta/credito')}}">
        <img src="{ asset('img\deudor.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>DEUDORES</small></p>
    </a>
    </a>
</div-->
@endsection
<div class="row p-1">
    <div class="row border border-dark m-2 my-2 w-100">
        <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
            <div class="px-3 py-3 m-0">
                <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                <h4 class="row my-1 mx-1" style="color:#4388CC">ACTIVOS</h4>

                <div>
                    <input type="text" class=" form-control text-uppercase  my-1" placeholder="BUSCAR" id="texto">
                    <h6 class=" text-uppercase  my-1 text-secondary"> <small>SELECCIONA UNO PARA VER INFORMACION
                            ADICIONAL, EDITAR O ELIMINAR </small> </h6>
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
            <!--EDIT-->
            @if(isset($d))
            <div class="row px-3 py-3 m-0">
                <form class="w-100" method="post" action="{{url('/puntoVenta/cliente/'.$d->id)}}" enctype="multipart/form-data">
                    <div class="form-group">
                        {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <label for="ndepartamento">
                            <h4 style="color:#4388CC"> EDITAR</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h4>{{$d->nombre}}</h4>
                        </label>
                        <div class="form-row w-100">
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" value="{{$d->nombre}}" required>
                                    <label for="apellidoPaterno">
                                        APELLIDO PATERNO
                                    </label>
                                    <input type="text" class="form-control" name="apellidoPaterno" id="apellidoPaterno" value="{{$d->apellidoPaterno}}" required>
                                    <label for="apellidoMaterno">
                                        APELLIDO MATERNO
                                    </label>
                                    <input type="text" class="form-control" name="apellidoMaterno" id="apellidoMaterno" value="{{$d->apellidoMaterno}}" required>
                                    <label for="telefono" class="mt-2">
                                        TELEFONO
                                    </label>
                                    <input type="tel" class="form-control @error('telefono') is-invalid @enderror" placeholder="TEL 8-10 DIGITOS" name="telefono" id="telefono" value="{{$d->telefono}}" pattern="[0-9]{8,10}" required>

                                    <label for="telefono" class="mt-2">
                                        DOMICILIO
                                    </label>
                                    <textarea name="domicilio" id="domicilio" class="form-control @error('domicilio') is-invalid @enderror" value="" required>{{$d->domicilio}}</textarea>
                                    
                                </div>
                            </div>
                            <div class="col-4">
                                @error('mensajeError')
                                <div class="alert alert-danger my-auto" role="alert">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            @if($modificarC)
                            <button class="btn btn-outline-secondary  ml-1" type="submit" onclick="return confirm('¿DESEA EDITAR ESTE CLIENTE?');">
                                <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                                GUARDAR CAMBIOS
                            </button>
                            <a class="btn btn-outline-secondary  ml-3 " href="{{ url('/puntoVenta/cliente')}}">
                                <img src="{{ asset('img\darBaja.png') }}" alt="Editar" width="30px" height="30px">
                                CANCELAR
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
                <!--
                    <form method="post" action="{{url('/puntoVenta/cliente/'.$d->id)}}">
                        {{csrf_field()}}
                        {{ method_field('DELETE')}}
                        <button class="btn btn-outline-danger my-3 ml-1" type="submit" onclick="return confirm('DESEA ELIMINAR ESTE CLIENTE?');">
                            <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                            DAR DE BAJA
                        </button>
                    </form>
                    -->
                @if($eliminarC)
                <button class="btn btn-outline-danger my-2" onclick="veriEliminar('{{$d->id}}')" type="button">
                    <img src="{{ asset('img\eliReg.png') }}" alt="Editar" width="25px" height="25px">
                    ELIMINAR
                </button>
                @endif
            </div>
            @else
            <div class="row px-3 py-3 m-0">
                <form class="w-100" method="post" action="{{url('/puntoVenta/cliente')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <label for="nempleado">
                        <h4 style="color:#4388CC">CREAR CLIENTE
                            <img src="{{ asset('img\agregar.png') }}" alt="Editar" width="25px" height="25px">
                        </h4>
                    </label>
                    <br />
                    <label for="Nombre">
                        <h5>NUEVO</h5>
                    </label>
                    <div class="form-row w-100">
                        <div class="col-7">
                            <div class="form-group">
                                <label for="nombre">
                                    NOMBRE
                                </label>
                                <input type="text" class="text-uppercase  form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" placeholder="NOMBRE" required>
                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="apellidoPaterno">
                                    APELLIDO PATERNO
                                </label>
                                <input type="text" class="form-control @error('apellidoPaterno') is-invalid @enderror" name="apellidoPaterno" id="apellidoPaterno" value="" required placeholder="apellido paterno">
                                <label for="apellidoMaterno">
                                    APELLIDO MATERNO
                                </label>
                                <input type="text" class="form-control @error('apellidoMaterno') is-invalid @enderror" name="apellidoMaterno" id="apellidoMaterno" value="" required placeholder="apellido materno">

                                <label for="telefono">
                                    TELEFONO
                                </label>
                                <input type="tel" class="text-uppercase  form-control @error('telefono') is-invalid @enderror" name="telefono" id="telefono" placeholder="TEL 8-10 DIGITOS" pattern="[0-9]{8,10}" required>
                                <label for="domicilio">
                                    DOMICILIO
                                </label>
                                <textarea name="domicilio" id="domicilio" class="form-control @error('domicilio') is-invalid @enderror" placeholder="INGRESAR DOMICILIO COMPLETO" required></textarea>

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            @error('mensajeConf')
                            <div class="alert alert-success my-auto" role="alert">
                                {{$message}}
                            </div>
                            @enderror
                        </div>


                    </div>
                    @if($crearC)
                    <button class="btn btn-outline-secondary" type="submit" onclick="return confirm('¿AGREGAR NUEVO CLIENTE?');">
                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                        AGREGAR
                    </button>
                    @else
                    <button class="btn btn-outline-secondary" type="button" onclick="return alert('USTED NO TIENE PERMISOS PARA REALIZAR ESTA ACCION')">
                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar" width="30px" height="30px">
                        AGREGAR
                    </button>
                    @endif
                </form>
            </div>
            @endif
        </div>
    </div>
</div>


<script>
    let presionar = 0;
    const texto = document.querySelector('#texto');

    function filtrar() {
        document.getElementById("resultados").innerHTML = "";
        fetch(`{{url('/puntoVenta/cliente/buscador')}}?texto=${texto.value}`, {
                method: 'get'
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById("resultados").innerHTML = html
            })
    };
    $("input[name='telefono']").bind('keypress', function(tecla) {
        if (this.value.length >= 10) return false;
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });

    async function veriEliminar(id) {
        let conf_Eli = confirm('¿DESEA ELIMINAR ESTE CLIENTE?');
        if (conf_Eli) {
            let response = "Sin respuesta";
            try {
                response = await fetch(`{{url('/puntoVenta/cliente/destroy2')}}/${id}`);

                if (response.ok) {
                    let respuesta = await response.text();
                    if (respuesta.length == 1) {
                        //recargar la pag
                        alert("EL CLIENTE SE HA ELIMINADO");
                        location.href = "{{url('/puntoVenta/cliente')}}";
                    } else {
                        clienOcup = alert("ESTE CLIENTE ESTÁ ACTIVO EN EL SISTEMA Y NO SE PUEDE ELIMINAR");
                        // if (clienOcup) {
                        // location.href = `{url('/puntoVenta/cliente/baja/${id}')}}`;

                        // }
                    }
                }
            } catch (err) {
                console.log("Error al realizar la petición AJAX: " + err.message);
            }
        }
    };

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    texto.addEventListener('keyup', filtrar);
    filtrar();
</script>
@endsection