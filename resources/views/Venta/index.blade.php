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
                            onclick="buscarProducto()" data-toggle="modal" data-target="#exampleModal"
                            value="informacion" id="boton">
                            <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px"
                                height="25px">
                            BUSCAR PRODUCTO
                        </button>
                    </div>
                </div>
                <div class="row m-0 px-0 border border-dark" style="height:300px;overflow-y:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
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
                                onclick="verificarVenta()" value="informacion" id="boton">
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
                            <tr class="text-center">
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

<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-labelledby="confirmarVentaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="confirmarVentaModalLabel">CONFIRMAR VENTA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">

                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>COBRAR</h1>
                        </div>
                        <div class="col-12">
                            <p class="text-center">TOTAL A COBRAR</p>
                        </div>
                        <div class="col-12">
                            <h1 class="text-center" id="totalCobrar">$ 0.00</h1>
                        </div>
                    </div>
                </div>
                <!--div class="col-12 d-flex justify-content-center">
                    <div class="row">
                        <div class="col">
                            <button class="btn mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/efectivo.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;">
                                <--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                            <--img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"->
                        </div>
                        <div class="col">
                            <button class="btn mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;">
                                <--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"->
                            </button>
                            <h6 class="mx-auto">CREDITO</h6>
                            <--img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"->
                        </div>
                    </div>
                </div-->
                <div class="col-12">
                    <ul class="nav nav-pills mb-3  d-flex justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item mx-2" role="presentation">
                            <button class="btn nav-link active mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/efectivo.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                            <!--a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true"><img src="{{ asset('img\efectivo.png') }}" class="img-thumbnail" alt="Editar"
                                    width="25px" height="25px"><h6 class="mx-auto">EFECTIVO</h6></a-->
                        </li>
                        <li class="nav-item mx-2" role="presentation">
                            <button class="btn nav-link mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="true">
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">CREDITO</h6>
                            <!--a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a-->
                        </li>
                        <!--li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                        </li-->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="col-6 mx-auto">
                                <div class="row">
                                    <div class="col-5">
                                        <p>PAGÓ CON: </p>
                                    </div>
                                    <div class="col-7">
                                        <input type="number" class="form-control" data-decimals="2" oninput="calcularCambio()" id="pago"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <p>SU CAMBIO: </p>
                                    </div>
                                    <div class="col-7">
                                        <p id="cambio">$ 0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="col-8 mx-auto">
                                <div class="row">
                                    <div class="col-3">
                                        <p>CLIENTE: </p>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control" />
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-3">
                                        <p>PAGÓ CON:</p>
                                    </div>
                                    <div class="col-9">
                                        <input type="number" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <p>AUN DEBE: </p>
                                    </div>
                                    <div class="col-9">
                                        <p>0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">...</div-->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">COBRAR E IMPRIMIR TICKET</button>
                    <button type="button" class="btn btn-primary">SOLO COBRAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let productosVenta = [];
const productos = @json($datosP);

function agregarProductoAVenta(id, codigoBarras, nombre, existencia, precio, cantidad, subtotal) {
    //console.log(id);
    let productos = {
        id: id,
        codigoBarras: codigoBarras,
        nombre: nombre,
        existencia: existencia,
        precio: precio,
        cantidad: cantidad,
        subtotal: subtotal
    };
    productosVenta.push(productos);
    console.log(productosVenta);
};
let total=0;
function calcularTotal() {
    //let total = 0.00;
    for (count0 in productosVenta) {
        total = total + productosVenta[count0].subtotal;

    }
    document.getElementById("total").innerHTML = "$ " + total;
    document.getElementById("totalCobrar").textContent = "$ " + total;

}

function mostrarProductos() {
    let cuerpo = "";
    let contador = 1;
    for (count1 in productosVenta) {
        cuerpo = cuerpo + `
        <tr class="text-center">
            <th scope="row">` + contador++ + `</th>
            <td>` + productosVenta[count1].codigoBarras + `</td>
            <td>` + productosVenta[count1].nombre + `</td>
            <td>` + productosVenta[count1].existencia + `</td>
            <td>` + productosVenta[count1].precio + `</td>
            <td><input  value="` + productosVenta[count1].cantidad + `" 
                onchange="cantidad(` + productosVenta[count1].id + `)"  
                id="valor` + productosVenta[count1].id + `" min="1" max="` + productosVenta[count1].existencia +
            `" type="number"/></td>
            <td id="importe` + productosVenta[count1].id + `">` + productosVenta[count1].subtotal + `</td>
        </tr>
        `;
    }
    document.getElementById("info").innerHTML = cuerpo;
    $("input[type='number']").inputSpinner();
    calcularTotal();
    //min="1" max="` + productosVenta[count].existencia+`"
};

function buscarProductoEnVenta(idProducto) {
    for (count2 in productosVenta) {
        if (productosVenta[count2].id === idProducto) {
            if (productosVenta[count2].existencia > productosVenta[count2].cantidad) {
                productosVenta[count2].cantidad++;
                productosVenta[count2].subtotal = productosVenta[count2].cantidad * productosVenta[count2].precio;
                mostrarProductos();
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
        if (productos[count3].codigoBarras === codigo.value) {

            //agregarProductoAVenta(id,codigoBarras,nombre,existencia,precio,cantidad,subtotal)
            /*agregarProductoAVenta(productos[count].id,productos[count].codigoBarras,productos[count].nombre,
            productos[count].existencia,productos[count].precio,1,productos[count].precio);*/
            if (!buscarProductoEnVenta(productos[count3].id)) {
                if (productos[count3].existencia > 0) {
                    agregarProductoAVenta(productos[count3].id, productos[count3].codigoBarras, productos[count3]
                        .nombre,
                        productos[count3].existencia, productos[count3].precio, 1, productos[count3].precio);
                    mostrarProductos();
                } else
                    alert('PRODUCTO SIN EXISTENCIA');
            }
        }

    }

    codigo.value = "";


};

function agregarProducto(id) {
    for (let count4 in productos) {
        if (productos[count4].id === id) {
            /*agregarProductoAVenta(productos[count].id,productos[count].codigoBarras,productos[count].nombre,
                productos[count].existencia,productos[count].precio,1,productos[count].precio);*/
            console.log(id);
            console.log(productos[count4].id);
            if (!buscarProductoEnVenta(productos[count4].id)) {
                if (productos[count4].existencia > 0) {
                    agregarProductoAVenta(productos[count4].id, productos[count4].codigoBarras,
                        productos[count4].nombre,
                        productos[count4].existencia, productos[count4].precio, 1, productos[count4].precio);
                    mostrarProductos();
                } else
                    alert('PRODUCTO SIN EXISTENCIA');
            }
            /*if(!buscarProductoEnVenta(id))
            {
                console.log(productos[count4].id);
                agregarProductoAVenta(productos[count4].id,productos[count4].codigoBarras,productos[count4].nombre,
                productos[count4].existencia,productos[count4].precio,1,productos[count4].precio);
            }
            console.log(productos[count4].id);  
            mostrarProductos();*/
            //productosVenta.push(productos[count]);
        }
    }
    const palabraBusqueda = document.querySelector('#busquedaProducto');
    palabraBusqueda.value = "";
    //venta();
};


function buscarProducto() {

    const palabraBusqueda = document.querySelector('#busquedaProducto');
    let cuerpo = "";
    let contador = 1;
    for (count5 in productos) {
        if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
            cuerpo = cuerpo + `
        <tr onclick="agregarProducto(` + productos[count5].id + `)" data-dismiss="modal">
            <th scope="row">` + productos[count5].id + `</th>
            <td>` + productos[count5].codigoBarras + `</td>
            <td>` + productos[count5].nombre + `</td>
            <td>` + productos[count5].existencia + `</td>
            <td>` + productos[count5].idDepartamento + `</td>
        </tr>
        `;
        }
    }
    document.getElementById("consultaBusqueda").innerHTML = cuerpo;

};

function cantidad(id) {
    //alert('Si entro en la funcion'+id);
    const valorProducto = document.querySelector('#valor' + id);
    //alert(valorProducto.value);
    if (valorProducto.value >= valorProducto.min && valorProducto.value <= valorProducto.max) {

        for (count6 in productosVenta) {
            if (productosVenta[count6].id === id) {
                productosVenta[count6].cantidad = valorProducto.value;
                productosVenta[count6].subtotal = productosVenta[count6].precio * productosVenta[count6].cantidad;
            }
        }
        mostrarProductos()

    }
    //const importeProducto = document.querySelector('#importe'+id);
}

function realizarVenta() {
    let json = JSON.stringify(productosVenta)
    $.ajax({
        // metodo: puede ser POST, GET, etc
        method: "POST",
        // la URL de donde voy a hacer la petición
        url: '/venta',
        // los datos que voy a enviar para la relación
        data: {
            datos: json,
            no: 'no se que le pasa',
            //_token: $("meta[name='csrf-token']").attr("content")
            _token: "{{ csrf_token() }}"
        }
        // si tuvo éxito la petición
    }).done(function(respuesta) {
        alert(respuesta);
        console.log(respuesta); //JSON.stringify(respuesta));
    });
}

function calcularCambio()
{
    
    const pago = document.querySelector('#pago');
    const cambio = document.querySelector('#cambio');
    if(parseFloat(pago.value)>total)
    {
        //alert('si entra');
        let diferencia = parseFloat(pago.value)-parseFloat(total);
        console.log(pago.value);
        console.log(total);
        cambio.textContent ="$" + diferencia;
        //cambio.value = parseFloat(pago.value)-total;
    }
    else{
        cambio.textContent ="$ 0.00"
    }

}

function verificarVenta()
{
    if(productosVenta.length===0)
    {
        alert('NO TIENE NINGUN PRODUCTO AGREGADO');
    }
    else
    {
        $('#confirmarVentaModal').modal('show');
    }
        
}


</script>
<script src="{{ asset('js\bootstrap-input-spinner.js') }}"></script>
<script>
//$("input[type='number']").inputSpinner()
</script>
@endsection