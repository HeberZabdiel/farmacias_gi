@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        EMPLEADOS
        @endsection
        @section('opciones')
        @if(isset($datosEmpleado))
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/puntoVenta/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    AGREGAR EMPLEADO
                </button>
            </form>
        </div>
        @endif
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                        height="25px">
                    EMPLEADOS DADOS DE BAJA
                </button>
            </form>
        </div>
        @endsection
    </div>
    <div class="row p-1 ">
        <div class="row border border-dark m-2 w-100">
            <div class="col-4 border border-dark mt-4 mb-4 ml-4 mr-2">
                <div class="row px-3 py-3 m-0">
                    <!--input type="text" id="buscador" class="form-control my-2">
                        <button class="btn btn-info mb-2" id="boton">Buscar</button-->

                    <h4 style="color:#4388CC">EMPLEADOS</h4>

                    <div class="input-group">
                        <input type="text" class="form-control my-1" placeholder="BUSCAR EMPLEADO" id="texto">
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
                @if(isset($datosEmpleado))
                <div class="row px-3 pt-3 m-0">
                    <form class="w-100" method="post" action="{{url('puntoVenta/empleado/'.$datosEmpleado->id)}}"
                        enctype="multipart/form-data">

                        <div class="form-group">
                            {{ csrf_field() }}
                            {{ method_field('PATCH')}}
                            <label for="nempleado">
                                <h4 style="color:#4388CC">EMPLEADO</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h5>{{$datosEmpleado->nombre}}</h5>
                            </label>
                            <fieldset disabled id="formEditar">

                                <div class="form-col w-100">
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                NOMBRE
                                            </label>
                                            <input type="text" id="nombre"
                                                class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                                value="{{$datosEmpleado->nombre}}" placeholder="Ingresar nombre(s)"
                                                required autocomplete="nombre" autofocus>
                                            @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                APELLIDOS
                                            </label>
                                            <input type="text"
                                                class="form-control @error('apellidos') is-invalid @enderror"
                                                name="apellidos" id="apellidos" value="{{$datosEmpleado->apellidos}}"
                                                placeholder="Ingresar apellidos" required autocomplete="apellidos"
                                                autofocus>
                                            @error('apellidos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                DOMICILIO
                                            </label>
                                            <!--input type="text" class="form-control @error('domicilio') is-invalid @enderror"
                                    name="domicilio" id="domicilio" value="{{ old('domicilio') }}" required
                                    autocomplete="domicilio" autofocus-->
                                            <textarea name="domicilio" id="domicilio"
                                                class="form-control @error('domicilio') is-invalid @enderror"
                                                placeholder="Ingresar domicilio completo"
                                                value="{{$datosEmpleado->domicilio}}" required autocomplete="domicilio"
                                                autofocus>{{$datosEmpleado->domicilio}}</textarea>
                                            @error('domicilio')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                CURP
                                            </label>
                                            <input type="text" class="form-control @error('curp') is-invalid @enderror"
                                                name="curp" id="curp" value="{{$datosEmpleado->curp}}"
                                                placeholder="Ingresar curp" required autocomplete="curp" autofocus>
                                            @error('curp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                EMAIL
                                            </label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email" value="{{$users->email}}"
                                                placeholder="Ingresar correo electronico" required autocomplete="email"
                                                autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="telefono">
                                                TELEFONO
                                            </label>
                                            <input type="text"
                                                class="form-control @error('telefono') is-invalid @enderror"
                                                name="telefono" id="telefono" value="{{$datosEmpleado->telefono}}"
                                                placeholder="Ingresar telefono" required autocomplete="telefono"
                                                autofocus>
                                            @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                CLAVE
                                            </label>
                                            <input type="text"
                                                class="form-control @error('claveE') is-invalid @enderror" name="claveE"
                                                id="claveE" value="{{$datosEmpleado->claveE}}"
                                                placeholder="Ingresar clave para operaciones" required
                                                autocomplete="claveE" autofocus>
                                            @error('claveE')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="nombre">
                                                USUARIO
                                            </label>
                                            <input type="text"
                                                class="form-control @error('username') is-invalid @enderror"
                                                name="username" id="username" value="{{$users->username}}"
                                                placeholder="Ingresar usuario" required autocomplete="username"
                                                autofocus>
                                            @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                            <div class="form-row d-flex flex-row-reverse px-1">
                                <a class="btn btn-outline-secondary" type="button" id="btnFormCancelar"
                                    href="{{url('puntoVenta/empleado/'.$datosEmpleado->id.'/edit/')}}">
                                    <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    CANCELAR
                                </a>
                                <button class="btn btn-outline-secondary mr-auto" type="submit" id="btnForm">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    GUARDAR CAMBIOS
                                </button>
                                <button class="btn btn-outline-secondary mr-auto" type="button" id="btnEditar"
                                    onclick="habilitar()">
                                    <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    EDITAR DATOS
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="row px-3 mb-4">
                    @if($datosEmpleado->status == 'alta')
                    <div class="col-auto ">
                        <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                            data-target="#modalPassword" value="SI">
                            <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px">
                            CAMBIAR CONTRASEÑA
                        </button>
                    </div>
                    <div class="col-auto ml-auto mr-0">
                        <form method="post" action="{{url('/puntoVenta/empleado/'.$datosEmpleado->id)}}">
                            {{csrf_field()}}
                            {{ method_field('PUT')}}
                            <input type="" id="status" name="status" value="baja" style="display:none">
                            <button class="btn btn-outline-secondary" type="submit" value="SI">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                DAR DE BAJA
                            </button>
                        </form>
                    </div>

                    @else
                    <div class="col-4">
                        <form method="post" action="{{url('/puntoVenta/empleado/'.$datosEmpleado->id)}}">
                            {{csrf_field()}}
                            {{ method_field('PUT')}}
                            <input type="" id="status" name="status" value="alta" style="display:none">

                            <button class="btn btn-outline-secondary" type="submit" value="SI">
                                <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                DAR DE ALTA
                            </button>
                        </form>
                    </div>
                    @endif
                    <!--button class="btn btn-outline-secondary my-3" type="button" onclick="habilitar()">
                        <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                            height="25px">
                        Habilitar
                    </button-->
                </div>
                @else
                <div class="row px-3 py-3 m-0">
                    <form class="w-100" method="post" action="{{url('puntoVenta/empleado')}}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label for="nempleado">
                            <h4 style="color:#4388CC">CREAR EMPLEADO</h4>
                        </label>
                        <br />
                        <label for="Nombre">
                            <h5>NUEVO EMPLEADO</h5>
                        </label>
                        <div class="form-col w-100">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        NOMBRE
                                    </label>
                                    <input type="text" id="nombre"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        id="nombre" value="{{ old('nombre') }}" placeholder="Ingresar nombre(s)"
                                        required autocomplete="nombre" autofocus>
                                    @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        APELLIDOS
                                    </label>
                                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror"
                                        name="apellidos" id="apellidos" value="{{ old('apellidos') }}"
                                        placeholder="Ingresar apellidos" required autocomplete="apellidos" autofocus>
                                    @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        DOMICILIO
                                    </label>
                                    <!--input type="text" class="form-control @error('domicilio') is-invalid @enderror"
                                    name="domicilio" id="domicilio" value="{{ old('domicilio') }}" required
                                    autocomplete="domicilio" autofocus-->
                                    <textarea name="domicilio" id="domicilio"
                                        class="form-control @error('domicilio') is-invalid @enderror"
                                        placeholder="Ingresar domicilio completo" value="{{ old('domicilio') }}"
                                        required autocomplete="domicilio" autofocus></textarea>
                                    @error('domicilio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-6">
                                    <label for="nombre">
                                        CURP
                                    </label>
                                    <input type="text" class="form-control @error('curp') is-invalid @enderror"
                                        name="curp" id="curp" value="{{ old('curp') }}" placeholder="Ingresar curp"
                                        required autocomplete="curp" autofocus>
                                    @error('curp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        EMAIL
                                    </label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}"
                                        placeholder="Ingresar correo electronico" required autocomplete="email"
                                        autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="telefono">
                                        TELEFONO
                                    </label>
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                        name="telefono" id="telefono" value="{{ old('telefono') }}"
                                        placeholder="Ingresar telefono" required autocomplete="telefono" autofocus>
                                    @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        CLAVE
                                    </label>
                                    <input type="text" class="form-control @error('claveE') is-invalid @enderror"
                                        name="claveE" id="claveE" value="{{ old('claveE') }}"
                                        placeholder="Ingresar clave para operaciones" required autocomplete="claveE"
                                        autofocus>
                                    @error('claveE')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        USUARIO
                                    </label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" id="username" value="{{ old('username') }}"
                                        placeholder="Ingresar usuario" required autocomplete="username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        CONTRASEÑA
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Ingresar contraseña" required
                                        autocomplete="new-password" autofocus>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="nombre">
                                        {{ __('CONFIRMAR CONTRASEÑA') }}

                                    </label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password-confirm" placeholder="Ingresar de nuevo contraseña" required
                                        autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="form-row w-100 d-flex flex-row-reverse">
                            <div class="form-group">
                                <button class="btn btn-outline-dark d-flex" type="submit">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    GUARDAR EMPLEADO
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
<div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center ml-auto" id="exampleModalLabel">@if(isset($datosEmpleado))
                    {{$datosEmpleado->nombre}} @endif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cuerpoModal">
                <div class="form-group m-2">
                    <label for="exampleInputEmail1">NUEVA CONTRASEÑA</label>
                    <div class="input-group has-validation mb-3">
                        <input type="password" id=passwordChange
                            class="form-control @error('passwordChange') is-invalid @enderror"
                            placeholder=" Ingrese su nueva contraseña" aria-label=" Recipient's username"
                            aria-describedby="button-addon2" required>

                        <div class="input-group-append">
                            <button class="btn btn-dark" onclick="mostrarPassword()">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="m-0 btn-dark" viewBox="0 0 16 16" id="iconPassword">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </button>

                        </div>

                        <div class="invalid-feedback">
                            La contraseña debe tener al menos 8 caracteres
                        </div>
                        <!--span class="invalid-feedback" role="alert">
                            <strong>Falla</strong>
                        </span-->

                    </div>
                    <div class="row mx-auto" id="alertaPassword">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                <button type="button" class="btn btn-primary" id="continuar" onclick="actualizarPassword()">CONTINUAR</button>
            </div>
        </div>
    </div>
</div>
<script>
const texto = document.querySelector('#texto');
//$('.svg').removeClass('fa fa-eye-slash').addClass('fa fa-eye');

function actualizarPassword() {
    let cambio = document.getElementById("passwordChange");
    
    if(cambio.value.length > 0)
    {
        document.getElementById("cuerpoModal").innerHTML = 
        `<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Contraseña actualizada</h4>
            <p>¡Tu contraseña se ha actualizado exitosamente!</p>
            <hr>
            <p class="mb-0">Cierre este mensaje para continuar</p>
        </div>`;
        $('#continuar').hide();
    }else{
        document.getElementById("alertaPassword").innerHTML = 
        `<div class="alert alert-danger" role="alert">
            La contraseña debe tener al menos 8 caracteres
        </div>`;
    }
    
}
function mostrarPassword() {

    var cambio = document.getElementById("passwordChange");
    if (cambio.type == "password") {
        cambio.type = "text";
        var cambioicono = document.getElementById("iconPassword").innerHTML =
            `<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path
                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                `;
        //$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        var cambioicono = document.getElementById("iconPassword").innerHTML =
            `<path
                                        d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.027 7.027 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.088z" />
                                    <path
                                        d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6l-12-12 .708-.708 12 12-.708.707z" />
            `;
        //$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}

function filtrar() {
    document.getElementById("resultados").innerHTML = "";
    fetch(`/empleado/buscadorEmpleado?texto=${texto.value}`, {
            method: 'get'
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById("resultados").innerHTML = html
        })
}
texto.addEventListener('keyup', filtrar);
filtrar();
$('#btnForm').hide();
$('#btnFormCancelar').hide();

function habilitar() {
    document.getElementById("formEditar").disabled = false;
    $('#btnForm').show()
    $('#btnFormCancelar').show()
    $('#btnEditar').hide()
    //document.getElementById("btnForm").show();
    //alert('Entra');
}
</script>

@endsection