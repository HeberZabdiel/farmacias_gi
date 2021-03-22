@extends('header2')
@section('contenido')
@section('subtitulo')
PRODUCTOS
@endsection

@section('opciones')
<div class="col-0  p-1">
    <form method="get" action="{{url('/puntoVenta/departamento/')}}">
        <button class="btn btn-outline-secondary  ml-4 p-1 border-0" type="submit">
            <img src="{{ asset('img\depto.svg') }}" alt="Editar" width="33px" height="33px">
            <br />
            <p class="h6 my-auto text-dark"><small>DEPARTAMENTOS</small></p>
        </button>
    </form>
</div>
<!--BOTON CREAR EMPLEADO-->
<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/puntoVenta/producto/create')}}">
        <img src="{{ asset('img\nuevoReg.png') }}" alt="Editar" width="33px" height="33px">
        <p class="h6 my-auto text-dark"><small>NUEVO PRODUCTO </small></p>
    </a>
    </a>
</div>
<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary  p-1 border-0" href="{{ url('/puntoVenta/producto/stock')}}">
        <img src="{{ asset('img/stock.svg') }}" alt="Editar" width="32px" height="32px">
        <p class="h6 my-auto text-dark"><small>AGREGAR DE STOCK</small></p>
    </a>
</div>

<div class="col-0  ml-3 p-1 ">
    <button type="button" class="btn btn-outline-secondary p-1 border-0" data-toggle="modal" href=".modal_altaProductos_SucursalLogeado" id="altaProd" onclick=" return productosEnBajaSucursal()" value="">
        <img src="{{ asset('img\alta2.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>DAR ALTA</small></p>

    </button>
</div>

<div class="col-0  ml-3 p-1 ">
    <a class="btn btn-outline-secondary p-1 border-0" href="{{ url('/puntoVenta/productosCaducidad')}}">
        <img src="{{ asset('img\calendario.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>PROXIMOS A CADUCAR</small></p>
    </a>
</div>

<div class="col-2  ml-3 p-1 ">
    <a class="btn btn-outline-secondary p-1 border-0" href="{{ url('/puntoVenta/oferta')}}">
        <img src="{{ asset('img\ofertas.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto text-dark"><small>OFERTAS</small></p>
    </a>
</div>
<!-- COMENTADO TEMPORAL
<div class="col-1 my-2  p-1 ">
    <button type="button" class="btn btn-secondary p-1" data-toggle="modal"  href="{{ url('/producto/create')}}" id="altaProd"  value="">
        <img src="{{ asset('img\agregar.png') }}" class="img-thumbnail" alt="Editar" width="25px" height="25px">
        OFERTAS
    </button>
</div>
-->
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">

        <div class="row col-12 mx-2 mt-2 mb-2 ">
            <h5 class="text-primary">
                <strong>
                    CONSULTAR PRODUCTOS
                </strong>
            </h5>
        </div>

        <div class="row col-12 px-0 mx-0">
            <div class="col-2 border border-primary  mb-4">
                <h6 class="text-primary mt-4">
                    FILTRAR POR:
                </h6>
                <select class="mt-1" name="idDepartamento" id="idDepartamento" onchange="buscarFiltroNombre2()" required>
                    <option value="">DEPARTAMENTO</option>
                    @foreach($d as $departamento)
                    <option value="{{ $departamento['id']}}"> {{$departamento['nombre']}}</option>
                    @endforeach
                </select>
                <div class=" input-group-text mt-4 px-0 py-auto ">
                    <input type="checkbox" value="existencia" name="bajosExistencia" id="bajosExistencia" onchange="buscarFiltroNombre2()">
                    <label class="text-primary ml-1 my-auto h6" for="bajosExistencia">
                        BAJOS DE EXISTENCIA
                    </label>
                </div>
            </div>
            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-10 mx-0 mb-4 px-0">
                <div class="form-group mx-4">
                    <div class="row mx-auto my-auto ">
                        <div class="col-4  text-center ">
                            <h6 class=" text-primary"> COSTO DEL INVENTARIO: </h6>
                            <p class="h3 mb-2" id="costoInv">$ 0.00</p>
                        </div class="text-center">
                        <div id="" class="col-4 mx-auto text-center">
                            <h6 class=" text-primary"> PRECIO DEL INVENTARIO </h6>
                            <p class="h3 mb-2" id="precioInv">$ 0.00</p>
                        </div>
                        <div class="col-4 text-center">
                            <h6 class=" text-primary"> CANTIDAD DE PRODUCTOS EN INVENTARIO: </h6>
                            <div id="cantProdInv" class="h3"> 0.0</div>
                        </div>
                    </div>
                    <div class="row my-0 mx-0 mt-3">
                        <input class="form-control text-uppercase  col-4" type="text" placeholder="Buscar producto" id="busquedaProducto" onkeyup="buscarFiltroNombre2()">
                        <a title="buscar" href="" class="text-dark ">
                            <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                        <div class="mt-2 mx-2"> </div>
                        <h6 class="mx-3 mt-2"> BUSCAR POR:</h6>
                        <div class=" input-group-text my-auto">
                            <input type="radio" value="folio" name="checkbox2" onchange="buscarFiltroNombre2()" id="codigoBusq">
                            <label class="ml-1 my-0" for="codigoBusq">
                                CODIGO
                            </label>
                        </div>
                        <div class=" input-group-text  ml-1 my-auto ">
                            <input type="radio" value="nombre" name="checkbox2" onchange="buscarFiltroNombre2()" id="nombreBusq" checked>
                            <label class="ml-1 my-0" for="nombreBusq">
                                NOMBRE
                            </label>
                        </div>

                    </div>
                </div>

                <!-- TABLA -->
                <div class="row border mx-0 px-0 border-dark mx-4" style="height:500px;overflow-y:auto;">
                    <table class="table table-bordered table-responsive-lg  border-primary  text-center table-hover" id="productos">
                        <thead class="table-secondary text-dark">
                            <tr>
                                <th>#</th>
                                <th>TIPO</th>
                                <th>CODIGO BARRAS</th>
                                <th>NOMBRE</th>
                                <th>DEPARTAMENTO</th>
                                <th>COSTO</th>
                                <th>PRECIO VENTA</th>
                                <th>EXISTENCIA</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="consultaBusqueda" class="text-uppercase ">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- MODAL-->

<!-- MODAL-->
<div class="modal fade bd-example-modal-lg" id="detalleProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;">
            <div class="modal-header w-100 ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 text-center mx-auto "  style="color:#FFFFFF" >
                            INFORMACION DEL PRODUCTO
                        </h6>
                    </div>
                    <div class="row" style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 mx-auto text-center"  style="color:#FFFFFF">
                            PRODUCTO
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body  col-12" id="">
                <div class="row  " id="resultados">
                </div>
                <div id="subAgregar" class="col mx-auto mt-4 text-center"></div>
                <div>
                </div>

                <div class="col modal-footer input-group">

                    <button type="button" class="btn btn-secondary ml-4" data-dismiss="modal" onclick="">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL CAMBIAR PRECIO COSTO-->
<div class="modal fade modal_precio_venta" id="modal_precio_venta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-small " role="document">
        <div class="modal-content" style="width:500px;">
            <div class="modal-header  ">
                <!--ENCABEZADO -->
                <div class="container-fluid">
                    <div class="row" style="background:#3366FF">
                        <h6 class="font-weight-bold my-2 ml-4 px-1 mx-auto text-center" id="titulo"  style="color:#FFFFFF">
                            
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body col-8 mx-4 text-center mx-auto" id="">
                <div class="row  " id="modiPrecioCosto">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="actPrecioCosto">GUARDAR</button>
                <button type="button" class="btn btn-secondary" id="volverInfo4" data-dismiss="modal">CANCELAR</button>

            </div>
        </div>
    </div>
</div>

<!-- END MODAL-->
<!--MODAL PARA CARGAR PRODUCTOS DADOS DE BAJA EN SUCURSAL LOGEADO-->
<div class="modal fade modal_altaProductos_SucursalLogeado" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content" style="width:900px;height:500px;">
            <div class="modal-header w-100 ">
                <!--ENCABEZADO -->
                <div class="container-fluid ">
                    <div class="row" style="background:#3366FF">
                        <br />
                    </div>
                    <div class="row " style="background:#ED4D46">
                        <h6 class="font-weight-bold my-2  px-1 mx-auto " style="color:#FFFFFF">
                            PRODUCTOS DADOS DE BAJA EN ESTA SUCURSAL
                        </h6>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span>-->
                </button>
            </div>
            <div class="modal-body  col-12" id="">
                <!-- TABLA -->
                <div id="vacio" class="text-center my-auto">
                    <div class="row w-100 " style="height:300px;overflow-y:auto;">
                        <table class="table table-bordered border-primary ml-5  ">
                            <thead class="table-secondary text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>CODIGO BARRA</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>DEPARTAMENTO</th>
                                    <th>RECETA</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="filaTablas">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="">Close</button>
            </div>
        </div>
    </div>
</div>

<!--POP UP-->

<!-- SCRIPT-->
<script>
    const productos = @json($datosP);
    const d = @json($depa);

    let opcFolioNombre = "";
    let opcBajosE = "";
    let productosSucursal = @json($productosSucursal);
    let productosList = [];
    let depaBandera = true;
    let bajosExisBandera = true;
    let folioNombreBandera = true;
    let subproductos = @json($subproducto);
    //  let nombreBandera = true;

    let prod_baja = "";

    // nombreOpc();
    buscarFiltroNombre2();

    /*
     function folioNombreOpc() {

         filtroProducto();
     }

     function deptoOpc() {
         // folioNombreBandera = false;
         depaBandera = true;
         // bajosExisBandera = false;
         // nombreBandera = false; //checar
         filtroProducto();
     }

     function bajosExisOpc() {
         //  folioNombreBandera = false;
         //   depaBandera = false;
         bajosExisBandera = true;
         //   nombreBandera = false; //checar
         filtroProducto();
     }

     function nombreOpc() {
         //  folioNombreBandera = false;
         //  depaBandera = false;
         //  bajosExisBandera = false;
         // nombreBandera = true; //checar

         buscarFiltroNombre();
     }

     */
    function buscarFiltroNombre2() {
        productosList = [];
        const palabraBusqueda = document.querySelector('#busquedaProducto');
        for (let x in productosSucursal) {
            for (count5 in productos) {
                if (productos[count5].id === productosSucursal[x].idProducto) {
                    //BUSCAR POR FOLIO NOMBRE 
                    let seleccion = document.querySelector("input[name='checkbox2']:checked");
                    let opcFolioNombre = seleccion.value;
                    folioNombreBandera = true;
                    if (opcFolioNombre === 'nombre') {
                        $("#idDepartamento").prop('disabled', false);
                        $("#bajosExistencia").prop('disabled', false);

                        //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRES
                        if (productos[count5].nombre.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                            //BUSCAR POR DEPARTAMENTO
                            //     if (depaBandera == true) { // SI LA OPCION DEPARTAMENTO SE HABILITO 
                            let depa = document.querySelector('#idDepartamento');
                            if (depa.value != "") {
                                if (productos[count5].idDepartamento === parseInt(depa.value)) {
                                    //Cargar datos encontrados filtrado depto, nombre
                                    //BUSCAR PRODUCTOS BAJOS DE EXISTENCIA
                                    let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                                    if (seleccion != null) {
                                        opcBajosE = seleccion.value; //VARIABLE opcBajosE?
                                        if (opcBajosE === 'existencia') {
                                            console.log("si entra");
                                            if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                                //PRODUCTOS POR NOMBRE, DEPTO Y BAJOS EXISTENCIA
                                                let departamento = "";
                                                for (count21 in d) {
                                                    if (productos[count5].idDepartamento === d[count21].id) {
                                                        departamento = d[count21].nombre;
                                                    }
                                                }
                                                let id = productos[count5].id;
                                                let productosAdd = {
                                                    id: id,
                                                    codigoBarras: productos[count5].codigoBarras,
                                                    nombre: productos[count5].nombre,
                                                    existencia: productosSucursal[x].existencia,
                                                    idDepartamento: productos[count5].idDepartamento
                                                };
                                                productosList.push(productosAdd);


                                            }
                                        }
                                    } else {
                                        //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRE, DEPTO
                                        // buscarFiltroNombre();
                                        let departamento = "";
                                        for (count21 in d) {
                                            if (productos[count5].idDepartamento === d[count21].id) {
                                                departamento = d[count21].nombre;
                                            }
                                        }
                                        let id = productos[count5].id;
                                        let productosAdd = {
                                            id: id,
                                            codigoBarras: productos[count5].codigoBarras,
                                            nombre: productos[count5].nombre,
                                            existencia: productosSucursal[x].existencia,
                                            idDepartamento: productos[count5].idDepartamento
                                        };
                                        productosList.push(productosAdd);
                                    }
                                }
                            } else {
                                //VERIFICAR BAJOS EXISTENCIA 
                                //BUSCAR PRODUCTOS POR NOMBRE, BAJOS DE EXISTENCIA
                                let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                                if (seleccion != null) {
                                    opcBajosE = seleccion.value; //VARIABLE opcBajosE?
                                    if (opcBajosE === 'existencia') {
                                        console.log("si entra");
                                        if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                            //PRODUCTOS POR NOMBRE Y BAJOS EXISTENCIA
                                            let departamento = "";
                                            for (count21 in d) {
                                                if (productos[count5].idDepartamento === d[count21].id) {
                                                    departamento = d[count21].nombre;
                                                }
                                            }
                                            let id = productos[count5].id;
                                            let productosAdd = {
                                                id: id,
                                                codigoBarras: productos[count5].codigoBarras,
                                                nombre: productos[count5].nombre,
                                                existencia: productosSucursal[x].existencia,
                                                idDepartamento: productos[count5].idDepartamento
                                            };
                                            productosList.push(productosAdd);
                                        }
                                    }
                                } else {
                                    //BUSCAR PRODUCTOS DE ESTA SUCURSAL POR NOMBRE
                                    let departamento = "";
                                    for (count21 in d) {
                                        if (productos[count5].idDepartamento === d[count21].id) {
                                            departamento = d[count21].nombre;
                                        }
                                    }
                                    let id = productos[count5].id;
                                    let productosAdd = {
                                        id: id,
                                        codigoBarras: productos[count5].codigoBarras,
                                        nombre: productos[count5].nombre,
                                        existencia: productosSucursal[x].existencia,
                                        idDepartamento: productos[count5].idDepartamento
                                    };
                                    productosList.push(productosAdd);
                                }
                            }
                            //  }
                        } else {
                            // MENSAJE PRODUCTOS NO ENCONTRADOS
                        }


                    } else if (opcFolioNombre === 'folio') {
                        $("#idDepartamento").prop('disabled', true);
                        $("#bajosExistencia").prop('disabled', true);


                        if (productos[count5].codigoBarras.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                            let departamento = "";
                            for (count21 in d) {
                                if (productos[count5].idDepartamento === d[count21].id) {
                                    departamento = d[count21].nombre;
                                }
                            }
                            let id = productos[count5].id;
                            let productosAdd = {
                                id: id,
                                codigoBarras: productos[count5].codigoBarras,
                                nombre: productos[count5].nombre,
                                existencia: productosSucursal[x].existencia,
                                idDepartamento: productos[count5].idDepartamento
                            };
                            productosList.push(productosAdd);
                        }
                    }


                }
            }
        }
        rellenar();
    };
    /*

    function filtroProducto() {
        productosList = [];
        const palabraBusqueda = document.querySelector('#busquedaProducto');

        //BUSCAR POR DEPARTAMENTO
        if (depaBandera == true) {
            for (let x in productosSucursal) {
                for (count5 in productos) {
                    if (productos[count5].id === productosSucursal[x].idProducto) {

                        let depa = document.querySelector('#idDepartamento');
                        // if (depa.value != "0") {
                        if (depa.value != "") {
                            if (productos[count5].idDepartamento === parseInt(depa.value)) {

                                let departamento = "";
                                for (count21 in d) {
                                    if (productos[count5].idDepartamento === d[count21].id) {
                                        departamento = d[count21].nombre;
                                    }
                                }
                                let id = productos[count5].id;
                                let productosAdd = {
                                    id: id,
                                    codigoBarras: productos[count5].codigoBarras,
                                    nombre: productos[count5].nombre,
                                    existencia: productosSucursal[x].existencia,
                                    idDepartamento: productos[count5].idDepartamento
                                };

                                productosList.push(productosAdd);

                            }
                        } else {
                            buscarFiltroNombre();
                        }
                    }
                }
            }

            rellenar();

        } else if (folioNombreBandera == true) {
            for (let x in productosSucursal) {
                for (count5 in productos) {
                    if (productos[count5].id === productosSucursal[x].idProducto) {

                        //BUSCAR POR FOLIO NOMBRE 
                        let seleccion = document.querySelector("input[name='checkbox2']:checked");
                        let opcFolioNombre = seleccion.value;
                        folioNombreBandera = true;
                        if (opcFolioNombre === 'nombre') {
                            //BUSCAR PRODUCTOS SUCURSAL TODOS SIN FILTRO
                            buscarFiltroNombre();
                        } else if (opcFolioNombre === 'folio') {
                            if (productos[count5].codigoBarras.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                                let departamento = "";
                                for (count21 in d) {
                                    if (productos[count5].idDepartamento === d[count21].id) {
                                        departamento = d[count21].nombre;
                                    }
                                }
                                let id = productos[count5].id;
                                let productosAdd = {
                                    id: id,
                                    codigoBarras: productos[count5].codigoBarras,
                                    nombre: productos[count5].nombre,
                                    existencia: productosSucursal[x].existencia,
                                    idDepartamento: productos[count5].idDepartamento
                                };
                                productosList.push(productosAdd);
                            }
                        }
                    }
                }
            }
            rellenar();

        } else if (bajosExisBandera == true) {
            for (let x in productosSucursal) {
                for (count5 in productos) {
                    if (productos[count5].id === productosSucursal[x].idProducto) {

                        //BUSCAR BAJOS EXISTENCIA
                        let seleccion = document.querySelector('input[name="bajosExistencia"]:checked');
                        if (seleccion != null) {
                            opcBajosE = seleccion.value;
                            if (opcBajosE === 'existencia') {
                                console.log("si entra");
                                if (productosSucursal[x].existencia <= productosSucursal[x].minimoStock) {
                                    // if (productos[count20].idDepartamento.toUpperCase().includes(palabraBusqueda.value.toUpperCase())) {
                                    let departamento = "";
                                    for (count21 in d) {
                                        if (productos[count5].idDepartamento === d[count21].id) {
                                            departamento = d[count21].nombre;
                                        }
                                    }
                                    let id = productos[count5].id;
                                    let productosAdd = {
                                        id: id,
                                        codigoBarras: productos[count5].codigoBarras,
                                        nombre: productos[count5].nombre,
                                        existencia: productosSucursal[x].existencia,
                                        idDepartamento: productos[count5].idDepartamento
                                    };
                                    productosList.push(productosAdd);
                                }
                            }
                        } else {
                            //BUSCAR PRODUCTOS SUCURSAL TODOS SIN FILTRO
                            buscarFiltroNombre();

                        }
                    }
                }
            }
            rellenar();
        } else {
            buscarFiltroNombre();
        }
    };
    */

    function rellenar() {
        let cuerpo = "";
        let contador = 0;
        let costo_inventario = 0;
        let precio_inventario = 0;
        let cantProdInventario = 0;

        let departamento = "";
        for (let t in productosList) {
            console.log("prod list");
            for (let z in productosSucursal) {
                if (productosList[t].id === productosSucursal[z].idProducto) {
                    if (productosSucursal[z].status === 1) {
                        for (count8 in d) {
                            if (productosList[t].idDepartamento === d[count8].id) {
                                departamento = d[count8].nombre;
                            }
                        }
                        let costoTemporal = productosSucursal[z].costo * productosList[t].existencia;
                        let precioTemporal = productosSucursal[z].precio * productosList[t].existencia;
                        costo_inventario = costo_inventario + costoTemporal;
                        precio_inventario = precio_inventario + precioTemporal;
                        cantProdInventario = cantProdInventario + productosList[t].existencia;
                        contador = contador + 1;
                        cuerpo = cuerpo + `
                            <tr onclick="" data-dismiss="modal">
                                <th scope="row">` + contador + `</th>
                                <td >` + "NORMAL" + `</td>
                                <td>` + productosList[t].codigoBarras + `</td>
                                <td>` + productosList[t].nombre + `</td>
                                <td>` + departamento + `</td>
                                <td>` + productosSucursal[z].costo + `</td>
                                <td class="text-success">` + productosSucursal[z].precio + `</td>
                                <td>` + productosList[t].existencia + `</td>
                                <td>` +
                            ` <button type="button" class="btn btn-outline-secondary border-0" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return info4( ` + productosList[t].id + `)" value="` + productosList[t].id + `">
                                <img src="{{ asset('img/vermas2.png') }}" alt="Editar" width="30px" height="30px">
                                </button>
                                </td>            
                            </tr>
                            `;
                    }

                }
            }
        }
        //MOSTRAR SUBPRODUCTOS
        for (let y in subproductos) {
            for (let z in productosSucursal) {
                if (subproductos[y].idSucursalProducto == productosSucursal[z].id) {

                    for (let p in productos) {
                        if (productos[p].id == productosSucursal[z].idProducto) {
                            for (count8 in d) {
                                if (productos[p].idDepartamento === d[count8].id) {
                                    departamento = d[count8].nombre;
                                }
                            }
                            let costoSubp = productosSucursal[z].costo / subproductos[y].piezas;
                            contador = contador + 1;
                            cuerpo = cuerpo + `
                            <tr class="table-warning" onclick="" data-dismiss="modal">
                                <th scope="row">` + contador + `</th>
                                <td >` + "SUBPRODUCTO" + `</td>
                                <td>` + productos[p].codigoBarras + `</td>
                                <td>` + productos[p].nombre + `</td>
                                <td>` + departamento + `</td>
                                <td>` + Number(costoSubp.toFixed(2)) + `</td>
                                <td class="text-success">` + subproductos[y].precio + `</td>
                                <td>` + subproductos[y].existencia + `</td>
                                <td>` +
                                ` <button type="button" class="btn btn-outline-secondary border-0" data-toggle="modal" href=".bd-example-modal-lg" id="ver" onclick=" return infoSubproducto( ` + productos[p].id + `)" value="` + productos[p].id + `">
                                <img src="{{ asset('img/vermas2.png') }}" alt="Editar" width="30px" height="30px">
                                </button>
                                </td>            
                            </tr>
                            `;
                        }

                    }


                }

            }

        }

        document.getElementById("consultaBusqueda").innerHTML = cuerpo;
        document.getElementById("costoInv").innerHTML = costo_inventario;
        document.getElementById("precioInv").innerHTML = precio_inventario;
        document.getElementById("cantProdInv").innerHTML = cantProdInventario;
    };

    function info4(id) {
        //Modal
        //let x1= 0;
        let btnAgregarSubprod = "";
        let datosProduct = "";
        let cambiarCostoPrecio = "";
        let imagen = "";
        let departamento = "";
        let idProdSuc = 0;
        let ms = 0;
        for (let j in productosSucursal) {
            for (count10 in productos) {
                if (productos[count10].id === productosSucursal[j].idProducto) {
                    if (productos[count10].id === id) {
                        for (count11 in d) {
                            if (productos[count10].idDepartamento === d[count11].id) {
                                departamento = d[count11].nombre;
                            }
                        }
                        x1 = productos[count10].id;
                        x = productos[count10].id;
                        idProdSuc = productosSucursal[j].id;
                        console.log(x);
                        ms = productosSucursal[j].minimoStock;
                        let urlImagen = "";
                        if (productos[count10].imagen != null)
                            urlImagen = "{{asset('storage')}}" + "/" + productos[count10].imagen;
                        console.log(urlImagen);
                        datosProduct =
                            `
                                    <div class="col-3">
                                            
                                            <label for="codigoBarras">
                                                <h6 class="ml-4"> {{'CODIGO DE BARRAS'}}</h6>
                                            </label>
                                        <br/>
                                            <label for="Nombre">
                                                <h6  class="ml-4 mt-4">{{'NOMBRE'}}</h6>
                                            </label>
                                            <br /><br/>
                                            <label for="Descripcion">
                                                <h6  class="ml-4"> {{'DESCRIPCION'}} </h6>
                                            </label>
                                            <br /><br /> <br/> <br/>
                                            <label for="MinimoStock">
                                                <h6  class="ml-4"> {{'MINIMO STOCK'}}</h6>
                                            </label>
                                            <br /> <br/>
                                            <label for="Receta">
                                                <h6  class="ml-4"> {{'RECETA MEDICA'}} </h6>
                                            </label>
                                            <br /><br />
                                            <label for="idDepartamento">
                                                <h6  class="ml-4"> {{'DEPARTAMENTO'}}</h6>
                                            </label>
                                            <br />
                                        </div>
                                        <div class="col-5">
                                            <!--El name debe ser igual al de la base de datos-->
                                            <input type="text" name="codigoBarras" id="codigoBarras" class="form-control text-uppercase " placeholder="Ingresar codigo de barras" value="` + productos[count10].codigoBarras + `" required autocomplete="codigoBarras" autofocus disabled>
                                            <br />
                                            <input type="text" name="nombre" id="nombre" class="form-control text-uppercase" placeholder="Nombre productos" value="` + productos[count10].nombre + ` " autofocus required disabled>
                                            <br />
                                            <textarea name="descripcion" id="descripcion" class="form-control text-uppercase" placeholder="Descripcion del producto" rows="3" cols="23" required disabled>` + productos[count10].descripcion + `</textarea>
                                            <br />
                                            <input type="number" name="minimoStock" id="minimoStock" class="form-control text-uppercase" placeholder="Ingrese el minimo de productos permitidos" value="` + ms + `" autofocus required disabled>
                                            <br />
                                            <select class="form-control text-uppercase" name="Receta" id="Receta"  disabled>
                                                <option value="" selected>` + productos[count10].receta + ` </option>
                                            </select>
                                            <br />
                                            <select class="form-control text-uppercase" name="Depa" id="Depa"  disabled>
                                                <option value="" selected>` + departamento + ` </option>
                                            </select>
                                        </div>
                                        <div class="col-4 text-center">
                                            <label for="Imagen">
                                                <h5 class="mb-1"> <strong>{{'FOTO '}}</strong></h5>
                                            </label>
                                            <br/>
                                            <img class="mb-2" src="${urlImagen}" alt="" width="200">
                                            
                                            <a class="btn btn-outline-primary mb-2 " href="{{ url('/puntoVenta/producto/` + x + `/edit')}}" onclick="return confirm('¿EDITAR ESTE PRODUCTO?')"> 
                                            <img src="{{ asset('img/edit.png') }}" alt="Editar" width="25px" height="25px" >
                                            EDITAR  </a>
                                            <br/> 
                                            <button type="button" class="btn btn-outline-primary mb-2 " data-toggle="modal" href=".modal_precio_venta"  onclick=" return modificarPrecio( ` + idProdSuc + `)" value="` + idProdSuc + `">
                                           EDITAR PRECIO
                                            </button>
                                            <button type="button" class="btn btn-outline-primary mb-2 " data-toggle="modal" href=".modal_precio_venta"  onclick=" return modificarCosto( ` + idProdSuc + `)" value="` + idProdSuc + `">
                                           EDITAR COSTO
                                            </button>
                                            <br/>
                                            <button type="button" class="btn btn-outline-primary mb-4 " data-toggle="modal" href=".modal_precio_venta"  onclick=" return agregarProducto( ` + idProdSuc + `)" value="` + idProdSuc + `">
                                            AGREGAR PRODUCTO
                                            </button>
                                            <br/>
                                            <a class="btn btn-outline-danger mb-2 mt-4" data-method="delete" onclick="return confirm('¿DESEA DAR DE BAJA ESTE PRODUCTO?')"  href="{{ url('/puntoVenta/productoEli3/` + x + `', [` + x + `])}}"> 
                                            <img src="{{ asset('img/eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                             DAR DE BAJA </a> 
                                        </div>

                                        <br/>
                                    `;

                        btnAgregarSubprod =
                            ` <a class="btn btn-outline-primary "   href="#" onclick="subproductoExiste(` + x + `);">
                                             <img src="{{ asset('img/agregarReg.png') }}" alt="Editar" width="25px" height="25px">
                                             AGREGAR A SUBPRODUCTO </a> 
                                             `
                    }
                }
            }
        }
        document.getElementById("subAgregar").innerHTML = btnAgregarSubprod;
        document.getElementById("resultados").innerHTML = datosProduct;
    };

    function modificarPrecio(idSP) {
        let cambiarPrecio = "";
        let idProd = 0;
        let idSucPro = 0;
        let nombreProd = "";
        for (let j in productosSucursal) {
            if (productosSucursal[j].id === idSP) {
                idProd = productosSucursal[j].idProducto;
                idSucPro = productosSucursal[j].id;
                for(let x in productos){
                    if(productos[x].id == idProd)
                    nombreProd = productos[x].nombre;
                }
                console.log("entra");
                cambiarPrecio = `
                                <h6>PRECIO ACTUAL DEL PRODUCTO</h6>
                                <input type="number" name="" id="" class="form-control mb-2 text-center" placeholder="" value="` + productosSucursal[j].precio + `" autofocus required disabled>
                                <h6 >INGRESAR NUEVO PRECIO DEL PRODUCTO</h6>        
                                <input type="number" name="precio_nuevo" id="precio_nuevo" class="form-control text-center" placeholder="PRECIO NUEVO" value="" autofocus required>
                                    `;
            }
        }
        $("#volverInfo4").click(function() {
            info4(idProd);
        });
        $("#actPrecioCosto").click(function() {
            actPrecio(idSucPro);
        });
        document.getElementById("titulo").innerHTML = nombreProd;
        document.getElementById("modiPrecioCosto").innerHTML = cambiarPrecio;
        $("input[name='precio_nuevo']").bind('keypress', function(tecla) {
        let code = tecla.charCode;
        if (code == 8) { // backspace.
            return true;
        } else if (code >= 48 && code <= 57) { // is a number.
            return true;
        } else { // other keys.
            return false;
        }
    });
    }

    function modificarCosto(idSP) {
        let cambiarCosto = "";
        let idProd = 0;
        let idSucPro = 0;
        let nombreProd = "";
        for (let j in productosSucursal) {
            if (productosSucursal[j].id === idSP) {
                idProd = productosSucursal[j].idProducto;
                idSucPro = productosSucursal[j].id;
                for(let x in productos){
                    if(productos[x].id == idProd)
                    nombreProd = productos[x].nombre;
                }
                console.log("entra");
                cambiarCosto = `
                                <h6>COSTO ACTUAL DEL PRODUCTO</h6>
                                <input type="number" name="" id="" class="form-control mb-2 text-center " placeholder="" value="` + productosSucursal[j].costo + `" autofocus required disabled>
                                <h6>INGRESAR NUEVO COSTO DEL PRODUCTO</h6>        
                                <input type="number" name="costo" id="costo_nuevo" class="form-control text-center" placeholder="PRECIO NUEVO" value="" autofocus required>
                                    `;
            }
        }
        $("#volverInfo4").click(function() {
            info4(idProd);
        });
        $("#actPrecioCosto").click(function() {
            actCosto(idSucPro);
        });
        
        // document.getElementById("modiPrecioCosto").innerHTML = cambiarCostoPrecio;
        document.getElementById("titulo").innerHTML = nombreProd;
        document.getElementById("modiPrecioCosto").innerHTML = cambiarCosto;
        $("input[name='costo']").bind('keypress', function(tecla) {
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
    }

    function agregarProducto(idSP) {
        let cambiarCantidad = "";
        let idProd = 0;
        let idSucPro = 0;
        let nombreProd = "";
        for (let j in productosSucursal) {
            if (productosSucursal[j].id === idSP) {
                idProd = productosSucursal[j].idProducto;
                idSucPro = productosSucursal[j].id;
                for(let x in productos){
                    if(productos[x].id == idProd)
                    nombreProd = productos[x].nombre;
                }
                console.log("entra");
                cambiarCantidad = `
                                <h6>EXISTENCIA ACTUAL DEL PRODUCTO</h6>
                                <input type="number" name="" id="" class="form-control mb-2 text-center " placeholder="" value="` + productosSucursal[j].existencia + `" autofocus required disabled>
                                <h6>CANTIDAD DE PRODUCTO A AGREGAR</h6>        
                                <input type="number" name="cantidad" id="cantidad" class="form-control text-center" placeholder="CANTIDAD DE PRODUCTO" value="" min="0" autofocus required>
                                    `;
            }
        }
        $("#volverInfo4").click(function() {
            info4(idProd);
        });
        $("#actPrecioCosto").click(function() {
            actExistencia(idSucPro);
        });
        

        // document.getElementById("modiPrecioCosto").innerHTML = cambiarCostoPrecio;
        document.getElementById("titulo").innerHTML = nombreProd;
        document.getElementById("modiPrecioCosto").innerHTML = cambiarCantidad;
        $("input[name='cantidad']").bind('keypress', function(tecla) {
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
    }


    async function actPrecio(idSucProd) {
        console.log("entroade");
        try {
            //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
            const precio = document.querySelector('#precio_nuevo');
            /*
            if (pago.value.length === 0)
                return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
            let funcion = $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `/puntoVenta/productoSuc/actPrecio/${idSucProd}`,
                // los datos que voy a enviar para la relación
                data: {
                    precio: parseFloat(precio.value),
                    _token: "{{ csrf_token() }}"
                    //  id: idSucProd
                }
                // si tuvo éxito la petición
            }).done(function(respuesta) {
                //alert(respuesta);
                console.log(respuesta); //JSON.stringify(respuesta));
            });
            $('#modal_precio_venta').modal('hide');
            $('#detalleProducto').modal('hide');
            alert("COSTO ACTUALIZADO CORRECTAMENTE");
            refrescar();
            // await cargarProductosSucursal();
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }
    async function actCosto(idSucProd) {
        try {
            //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
            const costo = document.querySelector('#costo_nuevo');
            /*
            if (pago.value.length === 0)
                return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
            let funcion = $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `/puntoVenta/productoSuc/actCosto/${idSucProd}`,
                // los datos que voy a enviar para la relación
                data: {
                    costo: parseFloat(costo.value),
                    _token: "{{ csrf_token() }}"
                    //  id: idSucProd
                }
                // si tuvo éxito la petición
            }).done(function(respuesta) {
                //alert(respuesta);
                console.log(respuesta); //JSON.stringify(respuesta));
            });
            $('#modal_precio_venta').modal('hide');
            $('#detalleProducto').modal('hide');
            alert("COSTO ACTUALIZADO CORRECTAMENTE");
            refrescar();
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }

    async function actExistencia(idSucProd) {
        try {
            //  let respuesta = await fetch(`/puntoVenta/empleado/claveEmpleado/${clave}`);
            const costo = document.querySelector('#cantidad');
            /*
            if (pago.value.length === 0)
                return alert('NO HA INGRESADO UNA CANTIDAD VALIDA');
            if (parseFloat(pago.value) < parseFloat(total))
                return alert('EL PAGO EN EFECTIVO NO DEBE SER MENOR AL TOTAL A COBRAR');
           */
            let funcion = $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `/puntoVenta/productoSuc/actExistencia/${idSucProd}`,
                // los datos que voy a enviar para la relación
                data: {
                    cantidad: parseInt(cantidad.value),
                    _token: "{{ csrf_token() }}"
                    //  id: idSucProd
                }
                // si tuvo éxito la petición
            }).done(function(respuesta) {
                //alert(respuesta);
                console.log(respuesta); //JSON.stringify(respuesta));
            });
            $('#modal_precio_venta').modal('hide');
            $('#detalleProducto').modal('hide');
            alert("EXISTENCIA ACTUALIZADA CORRECTAMENTE");
            refrescar();
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    }


    function infoSubproducto(id) {
        //Modal
        //let x1= 0;
        let datosProduct = "";
        let imagen = "";
        let departamento = "";
        let ms = 0;
        for (let j in productosSucursal) {
            for (count10 in productos) {
                if (productos[count10].id === productosSucursal[j].idProducto) {
                    if (productos[count10].id === id) {
                        for (count11 in d) {
                            if (productos[count10].idDepartamento === d[count11].id) {
                                departamento = d[count11].nombre;
                            }
                        }
                        x1 = productos[count10].id;
                        x = productos[count10].id;
                        console.log(x);
                        ms = productosSucursal[j].minimoStock;
                        datosProduct =
                            `
                                    <div class="col-3">
                                            <br/>
                                            <label for="codigoBarras">
                                                <h6 class="ml-4"> {{'CODIGO DE BARRAS'}}</h6>
                                            </label>
                                        <br/>
                                            <label for="Nombre">
                                                <h6  class="ml-4 mt-4">{{'NOMBRE'}}</h6>
                                            </label>
                                            <br /><br/>
                                            <label for="Descripcion">
                                                <h6  class="ml-4"> {{'DESCRIPCION'}} </h6>
                                            </label>
                                            <br /><br /> <br/> <br/>
                                            <label for="MinimoStock">
                                                <h6  class="ml-4"> {{'MINIMO STOCK'}}</h6>
                                            </label>
                                            <br /> <br/>
                                            <label for="Receta">
                                                <h6  class="ml-4"> {{'RECETA MEDICA'}} </h6>
                                            </label>
                                            <br /><br />
                                            <label for="idDepartamento">
                                                <h6  class="ml-4"> {{'DEPARTAMENTO'}}</h6>
                                            </label>
                                            <br />
                                        </div>
                                        <div class="col-5">
                                            <br />
                                            <!--El name debe ser igual al de la base de datos-->
                                            <input type="text" name="codigoBarras" id="codigoBarras" class="form-control text-uppercase " placeholder="Ingresar codigo de barras" value="` + productos[count10].codigoBarras + `" required autocomplete="codigoBarras" autofocus disabled>
                                            <br />
                                            <input type="text" name="nombre" id="nombre" class="form-control text-uppercase" placeholder="Nombre productos" value="` + productos[count10].nombre + ` " autofocus required disabled>
                                            <br />
                                            <textarea name="descripcion" id="descripcion" class="form-control text-uppercase" placeholder="Descripcion del producto" rows="3" cols="23" required disabled>` + productos[count10].descripcion + `</textarea>
                                            <br />
                                            <input type="number" name="minimoStock" id="minimoStock" class="form-control text-uppercase" placeholder="Ingrese el minimo de productos permitidos" value="` + ms + `" autofocus required disabled>
                                            <br />
                                            <select class="form-control text-uppercase" name="Receta" id="Receta"  disabled>
                                                <option value="" selected>` + productos[count10].receta + ` </option>
                                            </select>
                                            <br />
                                            <select class="form-control text-uppercase" name="Depa" id="Depa"  disabled>
                                                <option value="" selected>` + departamento + ` </option>
                                            </select>
                                        </div>
                                        <div class="col-4 text-center">
                                            <br/>
                                            <label for="Imagen">
                                                <h5> <strong>{{'FOTO aqui'}}</strong></h5>
                                            </label required>
                                            <br />
                                            
                                            
                                            <br /><br />
                                            <a class="btn btn-outline-primary" href="{{ url('/puntoVenta/producto/` + x + `/edit')}}" onclick="return confirm('¿EDITAR ESTE PRODUCTO?')"> 
                                            <img src="{{ asset('img/edit.png') }}" alt="Editar" width="25px" height="25px" >
                                            EDITAR  </a>
                                            <br/><br/>
                                            
                                            <a class="btn btn-outline-danger mb-4" data-method="delete" onclick="return confirm('¿DESEA DAR DE BAJA ESTE PRODUCTO?')"  href="{{ url('/puntoVenta/productoEli3/` + x + `', [` + x + `])}}"> 
                                            <img src="{{ asset('img/eliReg.png') }}" alt="Editar" width="25px" height="25px">
                                             DAR DE BAJA </a> 
                                             <div class="mt-4 mb-4"> </div>

                                             <a class="btn btn-outline-primary mt-4"   href="#" onclick="subproductoExiste(` + x + `);return false;">
                                             <img src="{{ asset('img/agregarReg.png') }}" alt="Editar" width="25px" height="25px">
                                             AGREGAR A SUBPRODUCTO </a>
                                        </div>

                                        <br/>
                                    `;
                    }
                }
            }
        }
        document.getElementById("resultados").innerHTML = datosProduct;
    };

    function refrescar() {
        console.log("refrescar");
        location.reload();
    };

    async function subproductoExiste(id) {
        let preguntar = confirm("¿AGREGAR SUBPRODUCTO?");
        if (preguntar) {
            let response = "Sin respuesta";
            let response2 = "Sin respuesta";
            try {
                response = await fetch(`/puntoVenta/veriUniqueSubproducto/?id=${id}`);
                if (response.ok) {
                    Suc_Inac = await response.json();
                    // let idProd =Suc_Inac['idProd'];
                    let productosNue = Suc_Inac['producto'];
                    let producto_sucursal = Suc_Inac['productosSucursal']; //retornar 1 dato
                    let subproductos = Suc_Inac['subproducto'];
                    let bandera = true;
                    for (let y in producto_sucursal) {
                        for (let x in subproductos) {
                            if (subproductos[x].idSucursalProducto == producto_sucursal[y].id) {
                                bandera = false;
                                return redirect(`/puntoVenta/subproducto/actExistencia/?idSucProd=${producto_sucursal[y].id}`);
                                //return alert("Este producto ya está activo en subproducto y no se puede volver a agregar");
                            }
                        }
                    }

                    if (bandera) {
                        redirect(id);
                        // response2 = await fetch(`/puntoVenta/subproducto/create/?id=${id}`);
                    }
                    console.log(Suc_Inac);
                } else {
                    // Suc_Inac = "";
                    console.log("No responde :'v");
                    console.log(response);
                    throw new Error(response.statusText);
                }
            } catch (err) {
                console.log("Error al realizar la petición AJAX: " + err.message);
            }
        }
    };

    function redirect(id) {
        window.location = `/puntoVenta/subproducto/create/?id=${id}`;
    }

    //
    async function productosEnBajaSucursal() {
        let cuerpo = "";
        let cont = 0;
        await productos0();

        console.log(prod_baja);
        for (let t in prod_baja) {
            for (let x in productos) {
                if (productos[x].id === prod_baja[t].idProducto) {
                    cont = cont + 1;
                    cuerpo = cuerpo + `
                    <tr>
                    <th >` + cont + `</th>
                    <td>` + productos[x].codigoBarras + `</td>
                    <td>` + productos[x].nombre + `</td>
                    <td>` + productos[x].descripcion + `</td>
                    <td>` + productos[x].idDepartamento + `</td>
                    <td>` + productos[x].receta + `</td>
                    <td>` +
                        ` 
                    <a class="btn btn-primary" href="{{ url('/puntoVenta/altaProducto/` + productos[x].id + `')}}"> ALTA </a>
                    </td>        
                    </tr>
                     `;
                }
            }
        }
        if (cuerpo === "") {
            let sin = ` <h3 class= "text-danger my-auto"> NO HAY PRODUCTOS DADOS DE BAJA EN ESTA SUCURSAL </h3>`;
            document.getElementById("vacio").innerHTML = sin;
        } else {
            document.getElementById("filaTablas").innerHTML = cuerpo;
        }
    };
    //reucperar sucursales inactivas
    async function productos0() {
        let response = "Sin respuesta";
        try {
            response = await fetch(`/puntoVenta/productos_baja`);
            if (response.ok) {
                prod_baja = await response.json();
            } else {
                console.log("No responde :v");
                console.log(response);
                throw new Error(response.statusText);
            }
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
    };
</script>

@endsection