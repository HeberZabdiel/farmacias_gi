@extends('header2')
@section('contenido')
@section('subtitulo')
PAGOS
@endsection
@php
use App\Models\Sucursal_empleado;
$compra= ['crearCompra','admin'];
$sE = Sucursal_empleado::findOrFail(session('idSucursalEmpleado'));
@endphp

@section('opciones')
@if($sE->hasAnyRole($compra))
<div class="ml-4">
    <form method="get" action="{{url('/puntoVenta/compra/create/')}}">
        <button class="btn btn-outline-secondary p-1 border-0" type="submit">
            <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="25px" height="25px">
            <p class="h6 my-auto mx-2 text-dark"><small>CREAR COMPRA</small></p>
        </button>
    </form>
</div>
@endif
<div class="col-6 ml-4"></div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="{{url('/puntoVenta/compra')}}">
        <img src="{{ asset('img\anterior.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>
<div class=" ml-3 my-auto">
    <a class="btn btn-outline-secondary my-auto p-1 border-0" href="{{url('/puntoVenta/venta')}}">
        <img src="{{ asset('img\casa.png') }}" alt="Editar" width="35px" height="35px">
    </a>
</div>
@endsection

<div class="row col-12 mx-0 my-auto py-1">
    <h5 class="text-dark">
        <strong>
            LISTA DE PAGOS A COMPRAS
        </strong>
    </h5>

</div>
<div class="row border border-dark mb-2 ml-2 mr-2 px-3" id="pagina">
    <div class="row col-12 mb-2 mt-4 mx-0 p-0">
        <div class="row mx-auto px-0 form-group input-group my-auto w-75">
            <input type="text" class="form-control border-primary pr-0 py-0 my-auto mr-0 col-6" size="15" placeholder="BUSCAR PAGO" id="busquedaPago" onkeyup="buscarPago()">
            <button type="button" title="buscar" onclick="buscarPago()" class="btn text-dark p-0">
                <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></button>
            <div class="row col my-auto ml-2 p-0" id="modoBusqueda">
                <label for="modoBusqueda" class="mx-3 mt-2">
                    <h6> BUSCAR POR:</h6>
                </label>

                <!--div class="input-group-prepend m-0"-->
                <div class="input-group-text my-auto">
                    <input type="radio" value="folio" onchange="seleccion()" name="btnRadio" id="btnFolio" checked>
                    <label class="ml-1 my-0 " for="btnFolio">FOLIO
                    </label>
                </div>
                <!--/div-->
                <div class="input-group-text ml-1 my-auto">
                    <input type="radio" value="proveedor" onchange="seleccion()" name="btnRadio" id="btnProveedor">
                    <label class="ml-1 my-0" for="btnProveedor">
                        PROVEEDOR
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div class="row mx-auto mb-5 p-0 border border-ligth w-75" style="height:300px;overflow-y:auto;">
        <table class="table table-bordered table-bordered" id="productos">
            <thead class="table-secondary text-primary text-center">
                <tr>
                    <th>#</th>
                    <th>FOLIO COMPRA</th>
                    <th>MONTO</th>
                    <th>FECHA PAGO</th>
                    <th>PROVEEDOR</th>
                </tr>
            </thead>
            <tbody class="text-center" id="consultaBusqueda">

            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('js\app.js') }}"></script>
<script>
    let pagosCompra = @json($pagosCompra);
    let compras = @json($compras);
    let proveedores = @json($proveedores);
    let pagosActuales = pagosCompra;
    let tipoBusqueda = "folio";
    //console.log(pagosCompra);

    function cargarPagosCompra() {

    }

    function mostrarPagosCompra() {
        let cuerpo = "";
        for (let i in pagosActuales) {
            let fecha = new Date(pagosActuales[i].created_at);
            const compraPago = compras.find(compra => compra.id === pagosActuales[i].idCompra);
            //console.log('compraPago',pagosActuales);
            
            const proveedorPago = proveedores.find(proveedor => proveedor.id === compraPago.idProveedor);
            console.log(proveedorPago);
            cuerpo = cuerpo +
                `<tr>
            <th>` + (parseInt(i) + 1) + `</th>
            <td>` + pagosActuales[i].idCompra + `</td>
            <td>` + pagosActuales[i].monto + `</td>
            <td>` + fecha.toLocaleDateString() + `</td>
            <td>` + proveedorPago.nombre + `</td>
        </tr>`
        }
        document.querySelector('#consultaBusqueda').innerHTML = cuerpo;
    }
    mostrarPagosCompra();

    function buscarPago() {
        const palabraBusqueda = document.querySelector('#busquedaPago');
        if (palabraBusqueda.value.length > 0) {
            pagosActuales = [];
            if (tipoBusqueda == "folio") {
                for (let i in pagosCompra) {
                    if (pagosCompra[i].idCompra == palabraBusqueda.value) {
                        pagosActuales.push(pagosCompra[i]);
                    }
                }
            }
            if (tipoBusqueda == "proveedor") {
                for (let i in pagosCompra) {
                    const compraPago = compras.find(compra => compra.id === pagosCompra[i].idCompra);
                    const proveedorPago = proveedores.find(proveedor => proveedor.id === compraPago.idProveedor);

                    if (proveedorPago.nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                        pagosActuales.push(pagosCompra[i]);
                    }
                }
            }

        } else {
            pagosActuales = pagosCompra;
        }
        mostrarPagosCompra();
    }

    function seleccion() {
        let btn = document.querySelector('input[name="btnRadio"]:checked');
        tipoBusqueda = btn.value;
        console.log(tipoBusqueda);
        buscarPago();
        //buscarPago();
        //console.log(btn);
        //alert(btn.value);
    }
</script>
@endsection