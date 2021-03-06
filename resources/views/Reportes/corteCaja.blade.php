@extends('header2')
@section('contenido')
@section('subtitulo')
CORTE DE CAJA
@endsection
@section('opciones')
@endsection


<!--CONSULTAR PRODUCTO -->

<div class="row  border border-dark ml-0 mr-0 mb-4 mt-2 ">
    <h5 class=" row col-5 ml-1 mt-2 mb-4 mx-auto text-primary ">
        <strong>
            CORTE DE CAJA
        </strong>
    </h5>
    <br />
    <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
    <div class="row w-100   mr-2 ">
        <div class="row   form-group input-group  ml-4">
            <div class="row col-4 form-group input-group ml-4 mr-4">
                <h5 class=" my-0 mr-3">FECHA CORTE:</h5>
                <input type="date" min="" id="fechaCorte" class="form-control my-0" />
            </div>
            <div class="col-6 ml-4 form-group input-group ">
                <h5 class="mr-3 ml-3 my-0">CAJERO</h5>
                <select class="col-4 mt-1" name="idCajero" id="idCajero" onchange="" required>
                    <option value="0">TODOS</option>
                    @foreach($sucursalEmpleados as $cajero)
                    @foreach($empleados as $emp)
                    @if($cajero->idEmpleado == $emp->id)
                    <option value="{{$cajero['id']}}"> {{$emp['primerNombre']}} {{ $emp['segundoNombre']}} {{ $emp['apellidoPaterno']}} {{ $emp['apellidoMaterno'] }}</option>
                    @endif
                    @endforeach
                    @endforeach
                </select>
            </div>
        </div>
        <!-- BOTON CORTE-->
        <div class="row col-10  ml-4">
            <button class="btn btn-secondary ml-4 mx-auto" onclick="calcularCorte()">HACER CORTE
            </button>
        </div>


    </div>
    <div class="row mt-3 ml-5">
        <div class="col-3">
            <h6 class="text-primary">+ENTRADAS</h6>
            <h6 class="ml-3">+TOTAL VENTAS</h6>
            <h6 class="ml-3">+ABONO DEUDORES</h6>
            <h6 class="ml-4 mt-3 font-weight-bold"> SUBTOTAL ENTRADAS:</h6>
            <h6 class="text-primary mt-3">-SALIDAS</h6>
            <h6 class="mt-3 ml-3 ">-TOTAL DEVOLUCIONES</h6>
            <!--<h6 class="ml-3">-ABONO PROVEEDORES</h6>
            <h6 class="ml-3">-COMPRAS AL CONTADO</h6>
            -->
            <h6 class="ml-3 font-weight-bold">SUBTOTAL SALIDAS:</h6>
        </div>
        <div class="col-3 mb-4">
            <input type="number" id="totalVentas" class=" mt-4 my-0" style="height:23px" />
            <input type="number" id="abonoD" class=" mt-1 my-0" style="height:23px" />
            <input type="number" id="subtotalE" class=" mt-3 my-0" style="height:23px" />
            <input type="number" id="devolucionT" class=" mt-5 my-0" style="height:23px" />
            <!--<input type="number" onchange="filtrarCompras()" id="fechaFinal" class=" mt-1 my-0" style="height:23px" />
            <input type="number" onchange="filtrarCompras()" id="fechaFinal" class=" mt-1 my-0" style="height:23px" />
            -->
            <input type="number" id="subtotalS" class=" mt-1 my-0" style="height:23px" />
        </div>
        <div class="col-4 mt-5">
            <div class="form-group input-group text-primary mt-4 mb-5">
                <h5>TOTAL:</h5>
                <input type="number" id="total" class="ml-2" style="height:23px" />
            </div>
            <button class="btn btn-secondary ml-4 mb-5 mx-auto mt-5">IMPRIMIR CORTE
            </button>
            <div class="row form-group input-group">
                <h6 class="mt-3 text-primary">GANANCIA DEL DIA:</h6>
                <input type="number" id="fechaFinal" class="ml-2 mt-3 my-0" style="height:23px" />
            </div>
        </div>


        <div class="col-2"></div>
    </div>

</div>

<!--MODAL-->

<div class="modal fade" id="detalleCompraModal" tabindex="-1" aria-labelledby="detalleCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="modalVerMas"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">PRODUCTO</th>
                                <th scope="col">CANTIDAD</th>
                                <th scope="col">SUBTOTAL</th>
                                <th scope="col">PRECIO IND.</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="cuerpoModal">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL PARA ABONAR-->
<div class="modal fade" id="confirmarVentaModal" tabindex="-1" aria-labelledby="confirmarVentaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="confirmarVentaModalLabel">ABONO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">

                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>ABONAR</h1>
                        </div>
                        <div class="col-12">
                            <p class="text-center">DEBE</p>
                        </div>
                        <div class="col-12">
                            <h1 class="text-center" id="totalDebe">$ 0.00</h1>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <ul class="nav nav-pills mb-3  d-flex justify-content-center" id="pills-tab" role="tablist">

                        <li class="nav-item mx-2" role="presentation">
                            <button onclick="" class="btn nav-link mx-auto" type="button" value="informacion" id="boton" style="background-image: url(img/credito.png);width:80px;height:80px;
                            background-repeat:no-repeat;background-size:100%;" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true" disabled>
                                <!--img src="{{ asset('img\efectivo.png') }}"  class="img-fluid img-thumbnail" alt="Editar"-->
                            </button>
                            <h6 class="mx-auto">EFECTIVO</h6>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="col-8 mx-auto">

                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">ABONÓ:</p>
                                    </div>
                                    <div class="col-8">
                                        <input type="number" oninput="calcularDeudaCredito()" id="abono" data-decimals="2" value=0 class="form-control" />
                                    </div>
                                </div>
                                <div class="row my-1">
                                    <div class="col-4">
                                        <p class="h5">AUN DEBE: </p>
                                    </div>
                                    <div class="col-8">
                                        <p class="h5" id="restoDeuda">$ 0.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pieModal" class="modal-footer">
                    <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">COBRAR E IMPRIMIR
                        TICKET</button>
                    <button type="button" onclick="realizarVentaCredito()" class="btn btn-primary">SOLO COBRAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const ventas = @json($ventas);
    const pagos = @json($pagos);
    const devoluciones = @json($devoluciones);
    const pagoCompras = @json($pagoCompras);
    const compras = @json($compras);



    function calcularCorte() {
        console.log("si");
        let cuerpo = "";
        let contador = 1;
        let cont = 0;
        let emple = "";
        let fecha = "";
        let totalVentas = 0;
        let abonos = 0;
        let entradas = 0;
        let totalDev = 0;
        let abonoProveedores = 0;
        let comprasContado = 0;
        let salidas = 0;
        let total = 0;
        let idCajeroOK = 0;
        let fechaCo = document.querySelector('#fechaCorte');
        if (fechaCo.value.length > 0) {
            console.log("okVErifi");
            //VERIFIAR CAJERO
            let fechaC = document.querySelector('#fechaCorte');
            let fechaCorte = new Date(fechaC.value);
            //let fechaF = new Date(fechaFin.value);
            fechaCorte.setDate(fechaCorte.getDate() + 1);
            // fechaF.setDate(fechaF.getDate() + 1);
            let idCajer = document.querySelector('#idCajero');
            if (idCajer.value != "0") {
                idCajeroOK = parseInt(idCajer.value);
                // let idCajer2= parseInt(idCajer.value);
                for (let j in ventas) {
                    //TOTAL VENDIDO
                    if (ventas[j].tipo.toUpperCase().includes('EFECTIVO')) {

                        let fechaVC = new Date(ventas[j].created_at);
                        if (comparacionFecha(fechaCorte, fechaVC) && ventas[j].idEmpleado == idCajeroOK) {
                            totalVentas = totalVentas + ventas[j].pago;
                        }
                    }
                    //ABONO COMPLETADOS
                    for (let z in pagos) {
                        let fechaP = new Date(pagos[z].created_at);
                        if (ventas[j].id == pagos[z].idVenta) {
                            if (comparacionFecha(fechaCorte, fechaP) && ventas[j].idEmpleado == idCajeroOK) {
                                abonos = abonos + pagos[z].monto;
                            }

                        }
                    }
                    for (let x in devoluciones) {
                        let fechaD = new Date(devoluciones[x].created_at);
                        if (devoluciones[x].idVenta === ventas[j].id) {
                            if (comparacionFecha(fechaCorte, fechaD) && ventas[j].idEmpleado == idCajeroOK) {
                                totalDev = totalDev + devoluciones[x].totalDevolucion;
                            }

                        }
                    }



                }
                /*
                        for (let y in compras) {
                            for (count41 in pagoCompras) {
                                if (compras[y].id == pagoCompras[count41].idCompra) {
                                    let fechaPC = new Date(pagoCompras[count41].created_at);
                                    fechaPC.setDate(fechaPC.getDate() + 1);
                                    if (fechaCorte.getTime() === fechaPC.getTime()) {
                                        abonoProveedores = abonoProveedores + pagoCompras[count41].monto;
                                    }
                                }
                            }
                        }
                    */


            } else {

                for (let j in ventas) {
                    if (ventas[j].tipo.toUpperCase().includes('EFECTIVO')) {
                        let fechaVC = new Date(ventas[j].created_at);
                        if (comparacionFecha(fechaCorte, fechaVC)) {
                            totalVentas = totalVentas + ventas[j].pago;
                        }
                    }
                    //ABONO COMPLETADOS
                    for (let z in pagos) {
                        let fechaP = new Date(pagos[z].created_at);
                        if (ventas[j].id == pagos[z].idVenta) {
                            if (comparacionFecha(fechaCorte, fechaP)) {
                                abonos = abonos + pagos[z].monto;
                            }

                        }
                    }
                    for (let x in devoluciones) {
                        let fechaD = new Date(devoluciones[x].created_at);
                        if (devoluciones[x].idVenta === ventas[j].id) {
                            if (comparacionFecha(fechaCorte, fechaD)) {
                                totalDev = totalDev + devoluciones[x].totalDevolucion;
                            }

                        }
                    }



                }
            }
            entradas = totalVentas + abonos;
            // salidas = totalDev + abonoProveedores + comprasContado;
            salidas = totalDev;
            total = entradas - salidas;
        }
        // let tv= Number(totalVentas.toFixed(2));
        $("input[id='totalVentas']").val(Number(totalVentas.toFixed(2)));
        $("input[id='abonoD']").val(Number(abonos.toFixed(2)));
        $("input[id='subtotalE']").val(Number(entradas.toFixed(2)));
        $("input[id='devolucionT']").val(Number(totalDev.toFixed(2)));
        $("input[id='subtotalS']").val(Number(salidas.toFixed(2)));
        $("input[id='total']").val(Number(total.toFixed(2)));






        //document.getElementById("totalVentas").innerHTML = cuerpo;

    };

    function comparacionFecha(fechaI, fechaF) {
        console.log("si compara");
        if (fechaI.getFullYear() == fechaF.getFullYear()) {
            if (fechaI.getMonth() == fechaF.getMonth()) {
                if (fechaI.getDate() == fechaF.getDate())
                    return true;
            }
        }
        return false;
    };
</script>
@endsection