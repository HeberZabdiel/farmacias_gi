@extends('header2')
@section('contenido')
@section('subtitulo')
DEVOLUCION
@endsection
@section('opciones')
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row col-12 ml-2 w-100">

        <h4 class="text-primary ml-2 my-2">
            <strong>
                DEVOLUCION
            </strong>
        </h4>
    </div>
    <div class="row border border-dark m-2 ml-4 mr-4 col ">
        <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
        <div class="col mt-1 mb-4 ml-4 mr-4">
            <div class="row  px-0 col-8 input-group my-4">
                <h4 class="col-1 mx-0 px-0 my-auto"> FOLIO:</h4>
                <input type="number" min=0 class="form-control col-4 my-auto ml-3" size="15" placeholder="Folio" id="busquedaFolio" onkeyup="buscarFolio()">
                <a title="buscar" href="" class="text-dark ml-2 mr-5 my-auto">
                    <img src="{{ asset('img\search.svg') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                <div class="col-2 ml-5"> </div>
                <button class=" btn btn-outline-info my-auto " onclick="modalVenta()" data-toggle="modal" data-target="#buscarVenta" type="button">
                    BUSCAR VENTA
                    <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="35px" height="35px" />
                </button>
            </div>
            <div class="row ">
                <h5 id="sinResult" class="border mx-0 px-0"></h5>
            </div>

            <!-- TABLA -->
            <div class="row ">
                <h4 class="text-primary  mx-0 px-0 "> PRODUCTOS </h4>
            </div>


            <div class="row border" style="height:350px;overflow-y:auto;">

                <table class="table table-bordered border-primary  ">

                    <thead class="table-secondary text-primary">
                        <tr>
                            <th>#</th>
                            <th>CANTIDAD</th>
                            <th>PRODUCTO</th>
                            <th>PRECIO IND.</th>
                            <th> SUBTOTAL</th>
                            <th>DEVOLVER</th>
                        </tr>
                    </thead>
                    <tbody id="tablaProductos">

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
<!--MODAL TABLA DE VENTAS-->

<div class="modal fade" id="buscarVenta" tabindex="-1" aria-labelledby="detalleCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="modalVerMas"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group  my-auto p-1 col-4 mb-3 ml-4">
                    <div class=" input-group-text">
                        <input type="checkbox" name="fechaVenta" id="fechaVenta" onchange="filtrarCompras()">
                        <label class="ml-1 my-0" for="fechaVenta">
                            BUSCAR VENTAS POR FECHA
                        </label>

                    </div>
                    <div class="input-group my-1 mx-0">
                        <div class="input-group-prepend">
                            <label for="fechaInicio" class="input-group-text">DE: </label>
                        </div>
                        <input type="date" min="" id="fechaInicio" onchange="filtrarCompras()" class="form-control" />
                    </div>
                    <div class="input-group my-1 mx-0">
                        <div class="input-group-prepend">
                            <label for="fechaFinal" class="input-group-text">A: </label>
                        </div>
                        <input type="date" min="" onchange="filtrarCompras()" id="fechaFinal" class="form-control" />
                    </div>
                </div>
                <div class="row" style="height:200px;overflow:auto;">
                    <table class="table table-hover table-bordered" id="productos">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">FOLIO</th>
                                <th scope="col">EMPLEADO</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">PAGO</th>
                                <th scope="col">PRODUCTOS</th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">HORA</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="tablaVenta">
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

<!--MODAL DEVOLUCION-->


<div class="modal fade" id="devolucion" tabindex="-1" aria-labelledby="detalleCompraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title text-primary">DEVOLUCION</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">

                <div class="col-2"></div>
                <div class="row col-8">
                    <div class="col-3  mt-4">
                        <h6 class="mb-5 mt-1"> CANTIDAD:</h6>
                        <h6 class="mb-5"> DETALLE:</h6>
                        <p class="h6 mb-2  ">DEVOLUCION:</p>
                    </div>
                    <div class="col-9 mt-4 ">
                        <input type="number" class="form-control mb-2" oninput="calcularTotalD(idProductoD)" name="cantidad" id="cantidad" placeholder="" value=0 autofocus required>
                        <textarea name="detalleD" class="form-control mb-2" id="detalleD" placeholder="ESPECIFICAR DETALLE" rows="3" cols="23" required></textarea>
                        <p class="h5 mb-2" id="totalD">$ 0.00</p>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="devolver()">DEVOLVER</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- SCRIPT-->
<script>
    const ventas = @json($ventas);
    const detalleVenta = @json($detalleVenta);
    const productos = @json($productos);
    const empleados = @json($empleados);
    let idProductoD = 0;
    let idVentaD = 0;
    let cantTotal = 0;

    function buscarFolio() {
        let folioB = document.querySelector('#busquedaFolio');
        let num = parseInt(folioB.value);
        if (num >= 0) {

            const palabraBusqueda = document.querySelector('#busquedaFolio');
            let cuerpo = "";
            let contador = 1;
            let folio = parseInt(palabraBusqueda.value);
            //let idVenta = 0;
            let cont = 0;
            for (count in ventas) {
                if (ventas[count].id == folio) {
                    //  idVenta = ventas[count].id;
                    for (count2 in detalleVenta) {
                        if (detalleVenta[count2].idVentas == ventas[count].id) {
                            for (count3 in productos) {
                                if (productos[count3].id == detalleVenta[count2].idProductos) {
                                    document.getElementById("sinResult").innerHTML = "";
                                    cont = cont + 1;
                                    idProductoD = productos[count3].id;
                                    idVentaD = ventas[count].id
                                    cantTotal = detalleVenta[count2].cantidad;


                                    cuerpo = cuerpo + `
                    <tr onclick="" data-dismiss="modal">

                    <th scope="row">` + cont + `</th>
                    <td>` + detalleVenta[count2].cantidad + `</td>
                    <td>` + productos[count3].nombre + `</td>
                    <td>` + productos[count3].precio + `</td>
                    <td>` + detalleVenta[count2].subtotal + `</td> 
                    <td>` +
                                        `<button class="btn btn-light" onclick="" data-toggle="modal" data-target="#devolucion"
                type="button">DEVOLVER</button>
            </td>        
                </tr>
                `;
                                }
                            }

                        }
                    }
                } else {
                    //document.getElementById("sinResult").innerHTML = "Folio no encontrado";
                }
            }
            document.getElementById("tablaProductos").innerHTML = cuerpo;
        } else {
            //document.getElementById("busquedaFolio").innerHTML = "";
            $("input[id='busquedaFolio']").val("");
           // return alert("Folio invalido")
        }
    };

    function calcularTotalD(id) {
        totalDevolver = 0;
        let cantidad = document.querySelector('#cantidad');
        let cant = parseInt(cantidad.value); //AQUI//
        if (cant > 0) {
            for (count9 in productos) {
                if (productos[count9].id == id) {

                    totalDevolver = cant * productos[count9].precio;
                }
            }
        } else {
            //  return alert('CANTIDAD DEBE SER MAYOR A CERO');
        }
        document.getElementById("totalD").innerHTML = totalDevolver;
    };
    //CREAR DEVOLUCION
    function devolver() {

        let cantidad = document.querySelector('#cantidad');
        let detalle = document.querySelector('#detalleD');
        let total = document.querySelector('#totalD');
        let cant2 = parseInt(cantidad.value);
        let detalle2 = detalle.value;

        if (cant2 > 0) {
            if (cant2 <= cantTotal) {
                if (detalle2.length == 0) {
                    return alert('AGREGAR DETALLE DE LA DEVOLUCION');
                } else {

                    console.log(cant2);
                    console.log(detalle2);
                    console.log(parseFloat(total.textContent));

                    try {
                        let funcion = $.ajax({
                            // metodo: puede ser POST, GET, etc
                            method: "POST",
                            // la URL de donde voy a hacer la petición
                            url: '/devolucion',
                            // los datos que voy a enviar para la relación
                            data: {
                                cantidad: cant2,
                                detalle: detalle2,
                                total: parseFloat(total.textContent),
                                idVenta: idVentaD,
                                idProducto: idProductoD,
                                _token: "{{ csrf_token() }}"
                            }
                        }).done(function(respuesta) {
                            $('#confirmarVentaModal').modal('hide');
                            $("input[id='totalD']").val(0);
                            //location.reload();
                            console.log(respuesta); //JSON.stringify(respuesta));
                        });
                        console.log(funcion);
                    } catch (err) {
                        console.log("Error al realizar la petición AJAX: " + err.message);
                    }
                }
            } else {
                return alert('El máximo de productos adquiridos es: ' + cantTotal + ', ingrese una cantidad menor');
            }
        } else {
            return alert('DEBE INGRESAR UNA CANTIDAD VALIDA DE PRODUCTOS A DEVOLVER');
        }

    };

    function modalVenta() {
        let cuerpo = "";
        let cont = 0;
        let emple = "";
        let fecha = "";
        for (count5 in ventas) {
            let total = 0;
            fecha = new Date(ventas[count5].created_at);
            cont = cont + 1;
            for (count7 in detalleVenta) {
                if (detalleVenta[count7].idVentas == ventas[count5].id) {
                    total = total + detalleVenta[count7].subtotal
                }
            }
            for (count6 in empleados) {
                if (empleados[count6].id == ventas[count5].idEmpleado) {
                    emple = empleados[count6].nombre + " " + empleados[count6].apellidos
                }
            }
            cuerpo = cuerpo + `
                    <tr onclick="" data-dismiss="modal">

                    <th scope="row">` + cont + `</th>
                    <td>` + ventas[count5].id + `</td>
                    <td>` + emple + `</td>
                    <td>` + ventas[count5].estado + `</td>
                    <td>` + ventas[count5].pago + `</td>
                    <td>  </td>
                    <td>` + total + `</td> 
                    <td>` + fecha.toLocaleDateString() + `</td> 
                    <td>` + fecha.toLocaleTimeString() + `</td>   
                </tr>
                `;
        }
        document.getElementById("tablaVenta").innerHTML = cuerpo;
    };


    function filtrarCompras() {
        let cuerpo = "";
        let contador = 1;
        let cont = 0;
        let emple = "";
        let fecha = "";

        if (verificarFechas()) {
            console.log("Verifico ok");
            let fechaInicio = document.querySelector('#fechaInicio');
            let fechaFin = document.querySelector('#fechaFinal');
            let fechaI = new Date(fechaInicio.value);
            let fechaF = new Date(fechaFin.value);
            fechaI.setDate(fechaI.getDate() + 1);
            fechaF.setDate(fechaF.getDate() + 1);

            for (let j in ventas) {

                let total = 0;
                fecha = new Date(ventas[j].created_at);
                fecha.setDate(fecha.getDate() + 1);
                cont = cont + 1;
                console.log(fecha.toLocaleDateString());
                console.log(fechaI.toLocaleDateString());

                if (fecha.getTime() >= fechaI.getTime()) {
                    console.log("minimo");
                    if (fecha.getTime() <= fechaF.getTime()) {
                        console.log("maximo");

                        for (count21 in detalleVenta) {
                            if (detalleVenta[count21].idVentas == ventas[j].id) {
                                total = total + detalleVenta[count21].subtotal
                            }
                        }

                        for (count6 in empleados) {
                            if (empleados[count6].id == ventas[j].idEmpleado) {
                                emple = empleados[count6].nombre + " " + empleados[count6].apellidos
                            }
                        }
                        cuerpo = cuerpo + `
                        <tr onclick="" data-dismiss="modal">

                        <th scope="row">` + cont + `</th>
                        <td>` + ventas[j].id + `</td>
                        <td>` + emple + `</td>
                        <td>` + ventas[j].estado + `</td>
                        <td>` + ventas[j].pago + `</td>
                        <td>  </td>
                        <td>` + total + `</td> 
                        <td>` + fecha.toLocaleDateString() + `</td> 
                        <td>` + fecha.toLocaleTimeString() + `</td>   
                    </tr>
                    `;
                    }
                } else {
                    console.log("no entra");
                }
            }
        } else {
            console.log("No verifico bien");
        }
        document.getElementById("tablaVenta").innerHTML = cuerpo;
    };

    function verificarFechas() {
        let btn = document.querySelector('input[name="fechaVenta"]:checked');

        if (btn != null) {
            let fechaInicio = document.querySelector('#fechaInicio');
            let fechaFin = document.querySelector('#fechaFinal');
            $('input[id="fechaInicio"]').prop('disabled', false);
            if (fechaInicio.value.length > 0) {
                fechaFin.min = fechaInicio.value;
                $('input[id="fechaFinal"]').prop('disabled', false);
                if (fechaFin.value.length > 0) {
                    let fechaI = new Date(fechaInicio.value);
                    let fechaF = new Date(fechaFin.value);
                    if (fechaI.getTime() > fechaF.getTime()) {
                        $("input[id='fechaFinal']").val(fechaInicio.value);
                    }
                    return true;
                }
            }
        } else {
            $('input[id="fechaInicio"]').prop('disabled', true);
            $('input[id="fechaFinal"]').prop('disabled', true);
        }
        return false;
    };
</script>
@endsection