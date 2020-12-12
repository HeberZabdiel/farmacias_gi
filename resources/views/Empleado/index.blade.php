<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row" style="background:#3366FF">
            @include('header')
        </div>
        <div class="row" style="background:#ED4D46">
            <h3 class="font-weight-bold my-2 ml-4 px-1" style="color:#FFFFFF">EMPLEADOS</h3>
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
                    @if(isset($d))
                    <div class="row mx-1">
                        <div class="col-4">
                            <form method="get" action="{{url('/departamento')}}">
                                <button class="btn btn-outline-secondary my-3 ml-0" type="submit">
                                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    Nuevo Departamento
                                </button>
                            </form>
                        </div>
                        <div class="col-4">
                            <form method="post" action="{{url('/departamento/'.$d->id)}}">
                                {{csrf_field()}}
                                {{ method_field('DELETE')}}
                                <button class="btn btn-outline-secondary my-3" type="submit">
                                    <img src="{{ asset('img\eliminar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    Eliminar Departamento
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="row">

                        <form method="post" action="{{url('/departamento/'.$d->id)}}" enctype="multipart/form-data">
                            <div class="form-group">
                                {{ csrf_field() }}
                                {{ method_field('PATCH')}}
                                <label for="Nombre">
                                    <h2>Editar Departamento</h2>
                                </label>
                                <br />
                                <label for="Nombre">
                                    <h3>{{$d->nombre}}</h3>
                                </label>
                                <br>
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                    value="{{$d->nombre}}">
                                <br />
                                <button class="btn btn-outline-secondary" type="submit">
                                    <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    Guardar Departamento
                                </button>
                            </div>
                        </form>
                    </div>
                    @else
                    <div class="row px-3 py-3 m-0">
                        <form class="w-100" method="post" action="{{url('departamento')}}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label for="nempleado">
                                <h4 style="color:#4388CC">CREAR EMPLEADO</h4>
                            </label>
                            <br />
                            <label for="Nombre">
                                <h5>NUEVO EMPLEADO</h5>
                            </label>
                            <div class="form-row w-100">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">
                                            NOMBRE
                                        </label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            APELLIDOS
                                        </label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            DOMICILIO
                                        </label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CURP
                                        </label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CORREO
                                        </label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CLAVE
                                        </label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">
                                            USUARIO
                                        </label>
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CONTRASEÑA
                                        </label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">
                                            CONFIRMAR CONTRASEÑA
                                        </label>
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row w-100 d-flex flex-row-reverse">
                                <div class="form-group">
                                    <button class="btn btn-outline-secondary d-flex" type="submit">
                                        <img src="{{ asset('img\guardar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                        Guardar Departamento
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
    <script>
    const texto = document.querySelector('#texto');

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
    </script>


</body>

</html>