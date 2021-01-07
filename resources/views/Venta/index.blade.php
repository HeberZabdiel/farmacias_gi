@extends('header2')
@section('contenido')
<div class="container-fluid">
    <div class="row" style="background:#ED4D46">
        @section('subtitulo')
        VENTAS
        @endsection
        @section('opciones')
        @if(isset($datosEmpleado))
        <div class="col my-2 ml-5 px-1">
            <form method="get" action="{{url('/empleado')}}">
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
            @php
            $var = 1;
            @endphp
            <div class="col">
                <div class="row p-0 mt-1 ml-0 mr-0 mb-0">
                    <!--div class="col-9">
                    <form class="form-row" method=get action="{{url('venta?codigo=5')}}" enctype="multipart/form-data"-->
                    <div class="col-4 m-0 px-0 pt-2 pb-0 ">
                        <label for="nombre" class="font-weight-bold " style="color:#3366FF">
                            <h4>CODIGO DEL PRODUCTO</h4>
                        </label>
                    </div>
                    {{ csrf_field() }}
                    <div class="col m-0 px-0 pt-1 pb-0 ">
                        <input type="text" class="form-control @error('claveE') is-invalid @enderror"
                            name="codigoBarras" id="codigoBarras" value="{{ old('claveE') }}"
                            placeholder="Ingresar codigo de barras" required autocomplete="claveE" autofocus>
                        @error('claveE')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col m-1 ">
                        <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                            onclick="agregarPorCodigo()" value="informacion" id="botonAgregar">
                            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px">
                            AGREGAR PRODUCTO
                        </button>
                    </div>
                    <!--form>
                    </div-->
                    <div class="col m-1">
                        <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                            onclick="buscarProducto()" data-toggle="modal" data-target="#exampleModal" value="informacion"
                            id="boton">
                            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px">
                            BUSCAR PRODUCTO
                        </button>
                    </div>
                </div>
                <div class="row m-0 px-0 border border-dark" style="height:300px;overflow-y:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">IMPORTE</th>
                            </tr>
                        </thead>
                        <tbody id="info">
                            <tr>
                                <th scope="row">1</th>
                                <td>Jabon palmollive</td>
                                <td>asdasdasd</td>
                                <td>lopesdasdasda</td>
                                <td>lopesdasdasdafdfdflopesdasdasdafdfdflolopesdasdasdafdfdflopesdasdasdafdfdflopesdasdasdafdfdflpesdasdasdafdfdflopesdasdasd</td>
                                <td><input value="1" min="1" max="1000"
                                        type="number" /></td>
                                <td>lopesdasdasda</td>
                            </tr>
                            @if(isset($_GET["datosP"]))
                            {{$_GET["datosP"]}}
                            @endif
                            @if(isset($_GET["datosPs"]))
                            @php
                            $datosP =array();
                            $datosP=$_GET["datosP"];
                            @endphp
                            @endif
                            @if(isset($p))
                            @foreach($p as $productos)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$productos}}</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td colspan="1"><input type="number" /></td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="row m-0 px-0">
                    <div class="col my-2 ml-5 px-1">
                        <div class="row">
                            <form method="get" action="{{url('/empleado')}}">
                                <button class="btn btn-primary" type="submit" style="background-color:#3366FF">
                                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    AGREGAR TICKET
                                </button>
                            </form>
                            <form method="get" action="{{url('/empleado')}}">
                                <button class="btn btn-primary ml-5" type="submit" style="background-color:#3366FF">
                                    <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                        width="25px" height="25px">
                                    ELIMINAR TICKET
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col my-2 ml-5 mr-0 pr-0 ">
                        <div class="d-flex flex-row-reverse">
                            <h4 class="border border-dark ml-2 p-1" id="total">$ 0.00</h4>
                            <!--form method="get" action="{{url('/empleado')}}"-->
                            <!--{url('/departamento/'.$departamento->id.'/edit/')}}-->
                            <button class="btn btn-primary" type="button" style="background-color:#3366FF"
                                onclick="o()" value="informacion" id="boton">
                                <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px">
                                COBRAR
                            </button>
                            <!--/form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Ingresar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="text" class="form-control mx-2 my-3" placeholder="Buscar producto"
                        id="busquedaProducto" onkeyup="buscarProducto()">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">CODIGO_BARRAS</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">EXISTENCIA</th>
                                <th scope="col">DEPARTAMENTO</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let productosVenta = [];
const productos = @json($datosP);

function agregarProductoAVenta(id,codigoBarras,nombre,existencia,precio,cantidad,subtotal)
{
    //console.log(id);
    let productos = {id:id,codigoBarras:codigoBarras,nombre:nombre,
        existencia:existencia,precio:precio,cantidad:cantidad,subtotal:subtotal};
    productosVenta.push(productos);
    console.log(productosVenta);
};

function total()
{
    let total = 0.00;
    for(count0 in productosVenta)
    {
        total = total + productosVenta[count0].subtotal;
        
    }
    document.getElementById("total").innerHTML = "$ "+total;
}

function mostrarProductos()
{
    let cuerpo = "";
    let contador = 1;
    for(count1 in productosVenta)
    {
        cuerpo = cuerpo + `
        <tr>
            <th scope="row">` + contador++ + `</th>
            <td>` + productosVenta[count1].codigoBarras + `</td>
            <td>` + productosVenta[count1].nombre + `</td>
            <td>` + productosVenta[count1].existencia +`</td>
            <td>` + productosVenta[count1].precio + `</td>
            <td><input  value="`+productosVenta[count1].cantidad+`" 
                onchange="cantidad(`+productosVenta[count1].id+`)"  
                id="valor`+productosVenta[count1].id+`" min="1" max="` + productosVenta[count1].existencia+
                `" type="number"/></td>
            <td id="importe`+productosVenta[count1].id+`">`+productosVenta[count1].subtotal+`</td>
        </tr>
        `;
    }
    document.getElementById("info").innerHTML = cuerpo;
    $("input[type='number']").inputSpinner(); 
    total();
    //min="1" max="` + productosVenta[count].existencia+`"
};

function buscarProductoEnVenta(idProducto)
{
    for(count2 in productosVenta)
    {
        if(productosVenta[count2].id===idProducto)
        {
            if(productosVenta[count2].existencia>productosVenta[count2].cantidad)
            {
            productosVenta[count2].cantidad++;
            productosVenta[count2].subtotal = productosVenta[count2].cantidad * productosVenta[count2].precio;
            
            //console.log(idProducto);
            }
            return true;
        }
    }
    //alert('no entra a la funcion :c');
    //console.log(idProducto +'fuera');
    return false;
};

function agregarPorCodigo() {
    const codigo = document.querySelector('#codigoBarras');
    //location.href= location.href+'?codigo='+codigo.value;

    for (count3 in productos) {
        if (productos[count3].codigoBarras === codigo.value)
        {
            
            //agregarProductoAVenta(id,codigoBarras,nombre,existencia,precio,cantidad,subtotal)
            /*agregarProductoAVenta(productos[count].id,productos[count].codigoBarras,productos[count].nombre,
            productos[count].existencia,productos[count].precio,1,productos[count].precio);*/
            if(!buscarProductoEnVenta(productos[count3].id))
                agregarProductoAVenta(productos[count3].id,productos[count3].codigoBarras,productos[count3].nombre,
                6,22,1,22);
            mostrarProductos();
        }
            
    }
    
    codigo.value = "";


};

function agregarProducto(id) {
    for (count4 in productos) {
        if (productos[count4].id === id)
        {
        /*agregarProductoAVenta(productos[count].id,productos[count].codigoBarras,productos[count].nombre,
            productos[count].existencia,productos[count].precio,1,productos[count].precio);*/
            console.log(id);
                console.log(productos[count4].id);
            if(!buscarProductoEnVenta(id))
            {
                console.log(productos[count4].id);
                agregarProductoAVenta(productos[count4].id,productos[count4].codigoBarras,productos[count4].nombre,
            6,22,1,22);
            }
            console.log(productos[count4].id);  
            mostrarProductos();
            //productosVenta.push(productos[count]);
        }
    }
    const palabraBusqueda = document.querySelector('#busquedaProducto');
    palabraBusqueda.value = "";
    //venta();
};


function buscarProducto() {
    
<<<<<<< HEAD
    const palabraBusqueda = document.querySelector('#busquedaProducto');
    let cuerpo = "";
    let contador = 1;
    for(count5 in productos)
    {
        if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase()))
        {
        cuerpo = cuerpo + `
        <tr onclick="agregarProducto(` + productos[count5].id + `)" data-dismiss="modal">
            <th scope="row">` + productos[count5].id + `</th>
            <td>` + productos[count5].codigoBarras + `</td>
            <td>` + productos[count5].nombre + `</td>
            <td>` + productos[count5].existencia +`</td>
            <td>` + productos[count5].idDepartamento + `</td>
        </tr>
=======
    let productosInfo = ""; 
    var contador = 1;
    for(count in productos)
    {
        productosInfo = productosInfo +
        `
        <div class="row">
        <a class="nav-link btn-outline-secondary text-dark border border-dark my-1 col-12 " 
        data-dismiss="modal" onclick="agregarProducto(`+productos[count].id+`)">
            <div class="row">
                <div class="col-1">`+(contador++)+`</div>
                <div class="col-3">`+productos[count].codigoBarras+`</div>
                <div class="col-4">`+productos[count].nombre+`</div>
                <div class="col-1">`+productos[count].existencia+`</div>
                <div class="col-3">`+productos[count].idDepartamento+`</div>
            </div>
        </a>
        </div>
>>>>>>> 61f24fb0c045879e2548f644b14d6bad7b627e4a
        `;
        }
    }
    document.getElementById("consultaBusqueda").innerHTML = cuerpo;
    
};

function cantidad(id)
{
    //alert('Si entro en la funcion'+id);
    const valorProducto = document.querySelector('#valor'+id);
    //alert(valorProducto.value);
    if(valorProducto.value >= valorProducto.min && valorProducto.value <= valorProducto.max)
    {
        
        for(count6 in productosVenta)
        {
            if(productosVenta[count6].id===id)
            {
                productosVenta[count6].cantidad = valorProducto.value;
                productosVenta[count6].subtotal = productosVenta[count6].precio * productosVenta[count6].cantidad; 
            }
        }
        mostrarProductos()
        //document.getElementById("importe"+id).innerHTML = productosVenta[count6].subtotal;
        //total();

    }
    //const importeProducto = document.querySelector('#importe'+id);
}

function o()
{
    for(let c in productosVenta)
        alert('entra a la funcion :o');
}
</script>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
$("input[type='number']").inputSpinner()
</script>
@endsection