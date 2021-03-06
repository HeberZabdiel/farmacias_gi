@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container-fluid align-self-center">
        <nav class="navbar navbar-expand-lg navbar-light w-100 " style="height: 100px;background-color:#3366FF;">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img\farmaciagilogo.png') }}" alt="Editar" height="50px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                          <!--  <button class="btn btn-light" >
                                VENTAS
                            </button>-->
                            <a class="btn btn-light" href="{{ url('/venta')}}"> VENTAS </a>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <button class="btn btn-light">
                                COMPRAS
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <button class="btn btn-light">
                                PRODUCTOS
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <button class="btn btn-light">
                                INVENTARIO
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <button class="btn btn-light">
                                EMPLEADOS
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <button class="btn btn-light">
                                CLIENTES
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <button class="btn btn-light">
                                CORTE
                            </button>
                            <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="{{ asset('img\salir.png') }}" alt="Editar" height="30px">
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!--div class="row" style="background:#4388CC">
        <div class="row m-4">
            <div class="col-3">
                <img src="{{ asset('img\farmaciagilogo.png') }}" alt="Editar"  height="50px">
            </div>
            <div class="col mx-auto my-2">
                <button class="btn btn-light">
                VENTA
                </button>
            </div>
            <div class="col mx-auto my-2">
                <button class="btn btn-light">
                COMPRA
                </button>
            </div>
            <div class="col mx-auto my-2">
                <button class="btn btn-light">
                PRODUCTOS
                </button>
            </div>
            <div class="col mx-auto my-2">
                <button class="btn btn-light">
                INVENTARIO
                </button>
            </div>
            <div class="col mx-auto my-2">
                <button class="btn btn-light">
                EMPLEADOS
                </button>
            </div>
            <div class="col mx-auto my-2">
                <button class="btn btn-light">
                CLIENTES
                </button>
            </div>
            <div class="col-1 mx-auto my-2">
                <button class="btn btn-light">
                CORTE
                </button>
            </div>
            <div class="col-1 mx-auto my-2">
                <button class="btn btn-secondary">
                Salir
                </button>
            </div>
        </div>                
    </div-->
</div>
@endsection