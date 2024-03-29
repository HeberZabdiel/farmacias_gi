@extends('layouts.headerProcesoCompra')
@section('contenido')
<div class="row col-12">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-transparent h5">
            <li class="breadcrumb-item"><a href="{{url('/')}}">INICIO</a></li>
            <li class="breadcrumb-item"><a href="{{url('/carrito')}}">CARRITO-COMPRAS</a></li>
            <li class="breadcrumb-item"><a href="{{url('/direccionEnvio')}}">DIRECCION</a></li>
            <li class="breadcrumb-item"><a href="{{url('/metodoPago')}}">METODO DE PAGO</a></li>
            <li class="breadcrumb-item active" aria-current="page">Revisar y confirmar compra</li>
        </ol>
    </nav>
</div>
<div class=" row col-12 px-4  py-2 my-2 input-group text-center mx-auto alert-secondary " style="background:#D5DBDB">
    <button id="btnGenerarPed" class="btn btn-outline-secondary col  text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\posicion.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-success">Dirección de envio</p>
    </button>
    <div class=" h1 my-auto text-success">
        <p class="d-none d-md-block">..............</p>
        <p class="d-block d-md-none">.....</p>
    </div>
    <!--PASO DOS -->
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\tarjeta2.png') }}" alt="Editar" width="35px" height="35px">
        <p class="h6 my-auto mx-2 text-success">Medios de pago</p>
    </button>

    <div class="h1 my-auto text-success">
        <p class="d-none d-md-block">..............</p>
        <p class="d-none d-sm-block d-md-none">.....</p>
    </div>
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\revision.png') }}" alt="Editar" width="35px" height="35px">
        <p class="h6 my-auto mx-2 text-primary">Revisar y confirmar compra</p>
    </button>

    <div class="h1 my-auto text-primary">
        <p class="d-none d-md-block">..............</p>
        <p class="d-block d-md-none">.....</p>
    </div>
    <!--PASO TRES-->
    <button class="btn btn-outline-secondary col   text-center  p-1 border-0" type="submit" disabled>
        <img class="" src="{{ asset('img\pedidoConfirmado.png') }}" alt="Editar" width="30px" height="30px">
        <p class="h6 my-auto mx-2 text-secondary">Pedido Generado exitosamente</p>
    </button>
</div>
<div class="row col-12 mx-0 px-0">
    <div class="row col-md-9 mx-auto px-1 py-1 mb-auto border-bottom border-dark ">
        <div class="col-2 col-md-1 my-auto my-md-1 mx-md-auto px-0 py-0">
            <img class="col-md-10 mx-auto my-0 img-fluid" src="{{ asset('img\lupa.png') }}" alt="FORMA DE PAGO" />
        </div>
        <h4 class="row col mx-auto my-auto py-auto px-1 text-left alert-info">Revisión de su compra</h4>
        <!--h6 class="row col mx-auto my-auto py-auto px-1 text-left alert-info d-block d-sm-none display-4">Revisión de su compra</h6-->
    </div>
    <div class="row col-12 mx-auto mt-1  mb-4  ">
        <p class="col-auto mx-auto text-secondary alert-warning  h5"><small><strong> Revise que la forma de pago, dirección, y productos sean correctos </strong> </small></p>
    </div>
    <!--aqui-->
    
    <div class="col-md-9 mx-md-auto border-bottom border-dark">
        <div class="row col-12 mx-auto px-0 mb-auto">
            <div class="col-3 col-md-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\login.png') }}" alt="UBICACION" />
            </div>
            <h4 class="row col-auto my-auto px-0 text-left">Cliente</h4>
        </div>
    </div>
    <div class="row col-md-9 mx-md-auto px-0 mb-4 py-2 mb-auto">
        
        <div class="col-md-4 mx-4">
            <p class="row col-12  h5 my-auto "> Telefono:</p>
            <p class="row col-12 h5 my-auto "><strong>{{$cliente->telefono}} </strong></p>
        </div>
        <div class="col-md-4">
            <p class="row col-12  h5 my-auto "> Cliente:</p>
            <p class="row col-12 h5 my-auto "><strong> {{$cliente->nombre}} {{$cliente->apellidoPaterno}} {{$cliente->apellidoMaterno}} </strong></p>
        </div>

    </div>

    <!--aqui-->
    <div class="col-md-9 mx-md-auto mt-2 border-bottom border-dark">
        <div class="row col-12 mx-auto px-0 mb-auto">
            <div class="col-3 col-md-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\tarjeta.png') }}" alt="UBICACION" />
            </div>
            <h4 class="row col-auto my-auto px-0 text-left">Forma de pago</h4>
        </div>
    </div>
    <div class="row col-md-9 mx-md-auto px-0 py-2 mb-auto">
        <div class=" col-md-4">
            <h5 class="row col-12 input-group mx-2"> Forma de pago seleccionado: <h5> <strong>
                        <p id="opc" class="mx-4"></p>
                    </strong></h5>
            </h5>
        </div>
        <div class="col-md-4">
            <h5 class="row col-12 input-group mx-2"> Usted paga con: <h5> <strong>
                        <p id="pagando2" class="mx-4"></p>
                    </strong></h5>
            </h5>
        </div>
        <div class="col-md-4">
            <h5 class="row col-12 input-group mx-2">Cambio a entregarle: <h5> <strong>
                        <p id="cambio" class="mx-4"></p>
                    </strong></h5>
            </h5>
        </div>
    </div>
    <!--
            <div class="col-3 border border-warning">
                <div class="row mb-auto p-1 border">
                    <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                        <h4 class="col-12 mx-auto my-1 py-0 text-center text-primary">Resumen de compra</h4>
                    </div>
                    <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                        <h5 class="mr-auto my-1 text-center">Subtotal</h5>
                        <h5 class="ml-auto my-1 text-center" id="subtotal">$ 0.00</h5>
                    </div>
                    <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                        <h5 class="mr-auto my-1 text-center">Costo del envío</h5>
                        <h5 class="ml-auto my-1 text-center" id="envio">*por calcular</h5>
                    </div>
                    <div class="row col-12 mx-auto mt-1  py-0 border-bottom">
                        <h5 class="mr-auto my-1 text-center">Total</h5>
                        <h3 class="ml-auto my-1 text-center" id="total">$0.00</h3>
                    </div>
                    
                    if(session()->has('idCliente'))
                    <a class="btn btn-outline-success my-auto btn-lg btn-block" href="http:/google.com">Pagar</a>
                    else
                    <a class="btn btn-outline-success my-auto btn-lg btn-block" href="{{url('/loginCliente')}}">Pagar</a>
                    endif
                    -->
</div>
<div class="row col-12 mx-0 mt-4 mb-1 px-0">
    <div class="col-md-9 mx-0 mx-md-auto">
        <div class="row col-12 mx-0 px-0 mb-auto border-bottom border-dark">
            <div class="col-3 col-md-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\ubicacion.png') }}" alt="UBICACION" />
            </div>
            <h4 class="col-auto mx-0 my-auto px-0 text-left">Dirección De Envío</h4>
        </div>
        <div class="row col-auto mx-0 px-0 py-2 ">
            <div class="col-md-10 mb-auto">

                <div class="row col-12 mx-0 px-md-0">
                    <p class="h6">{{$domicilio->calle}} {{$domicilio->numeroExterior}},
                        @if(isset($domicilio->numeroInterior)){{$domicilio->numeroInterior}}, @else @endif
                        {{$domicilio->codigoPostal}}
                        , {{$domicilio->colonia}}, Zimatlán de Álvarez, Oaxaca
                    </p>
                </div>
                <div class="row col-12">
                    <p class="h6">Tel: {{$telefono}}</p>
                </div>
            </div>
            <!--
            <div class="row col-2 mt-0 mx-auto mb-auto">
                <button class="btn btn-outline-danger border-0" id="editarDireccion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                    </svg>
                </button>
                <form method="post" action="{{url('/eliminarDireccion')}}" class="">
                    {{csrf_field()}}
                    <button class="btn btn-outline-danger border-0" id="eliminarDireccion">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </button>
                </form>
            </div>
            -->
        </div>
        <div class="row col-12 mx-auto px-0 mb-auto border-bottom border-primary">
            <div class="col-3 col-md-1 my-1 mx-0 px-0">
                <img class="col-10 mx-0 img-fluid" src="{{ asset('img\camion.png') }}" alt="UBICACION" />
            </div>
            <h4 class="col-9 col-md-11 mx-auto mr-md-auto ml-md-0 my-auto px-0 text-left">Detalle De Envío: productos
            </h4>
        </div>
        <!--
        <div class="row col-12 mt-0 mx-auto mb-auto border-bottom border-dark">
            @foreach($carrito as $p)
            <div class="row col-12 border-bottom">
                <div class="row col-2 mx-0">
                    @if(!empty($p['imagen']))
                    <img src="{{ asset('storage').'/'.$p['imagen']}}" alt="" class="img-fluid">
                    @else
                    <img src="{{ asset('img/imagenNoDisponible.jpg') }}" alt="" class="img-fluid">
                    @endif
                </div>
                <div class="row col-3 mx-0">
                    <p class="my-auto mx-auto text-center">{{$p['nombre']}}</p>
                    <p class="my-auto mx-auto text-center">Cantidad: {{$p['cantidad']}}</p>
                </div>
            </div>
            @endforeach
        </div>
        -->
        <div class="row col-12 mt-0 mx-auto mb-auto border-bottom border-dark">
            <div class="row col-12 mx-auto border-bottom">
                <div class="row col-8 col-md-5 mx-0">
                    <p class="my-auto mx-auto text-center"><strong> Producto </strong></p>
                </div>
                <div class="row col-4 col-md-3 mx-0">
                    <p class="my-auto mx-auto text-center"><strong>Cantidad </strong></p>
                </div>
            </div>
            @foreach($carrito as $p)
            <div class="row col-12 mx-auto border-bottom">
                <div class="row col-8 col-md-5 mx-0">
                    <p class="my-auto mx-auto text-center">{{$p['nombre']}}</p>
                </div>
                <div class="row col-4 col-md-3 mx-0">
                    <p class="my-auto mx-auto text-center">{{$p['cantidad']}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class=" row col-12  mx-auto mt-3">
        <div class="row col-md-6 mx-auto text-center mb-auto p-1 border">
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h4 class="col-12 mx-auto my-1 py-0 text-center text-primary">Resumen de compra</h4>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Subtotal</h5>
                <h5 class="ml-auto my-1 text-center" id="subtotal">$ 0.00</h5>
            </div>
            <div class="row col-12 mx-auto mt-1 mb-auto py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Costo del envío</h5>
                <h5 class="ml-auto my-1 text-center" id="envio">*por calcular</h5>
            </div>
            <div class="row col-12 mx-auto mt-1  py-0 border-bottom">
                <h3 class="mr-auto my-1 text-center">Total</h3>
                <h3 class="ml-auto my-1 text-center" id="total">$0.00</h3>
            </div>
            <div class="row col-12 mx-auto mt-1  py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Pagar con</h5>
                <h5 class="ml-auto my-1 text-center" id="pagaCon">$0.00</h5>
            </div>
            <div class="row col-12 mx-auto mt-1  py-0 border-bottom">
                <h5 class="mr-auto my-1 text-center">Su cambio</h5>
                <h5 class="ml-auto my-1 text-center" id="cambioR">$0.00</h5>
            </div>
            <!--
            @if(session()->has('idCliente'))
            <a class="btn btn-outline-success my-auto btn-lg btn-block" href="http:/google.com">Pagar</a>
            @else
            <a class="btn btn-outline-success my-auto btn-lg btn-block" href="{{url('/loginCliente')}}">Pagar</a>
            @endif
            -->
        </div>
    </div>
    <div class="col-12 text-right  text-center mx-auto my-md-4">
        <p class="h6 text-danger">Si usted ya verificó la información de su compra<mark> presione el boton
                Confirmar compra </mark> para generar su pedido en este momento.
        </p>
    </div>
    <div class="col-12 text-right  text-center mx-auto my-4">
        <!--<a class="btn btn-success btn-lg" href="{{url('/metodoPago')}}">Confirmar compra</a>-->
        <button class="btn btn-success btn-lg" onclick=" return enviarCompra2()" type="submit">Confirmar compra</button>
    </div>
</div>
<script>
    let productosVenta = [];
    let formaPago = @json($formaPago);
    let pagaCon2 = @json($pagaCon);
    let envioCosto = 15;
    let totalCompra = 0;
    $('#editarDireccion').click(function() {
        location.href = "{{url('/direccionEnvio?domicilio=false')}}";
    });

    function pagoContEnt() {

        var label2 = document.getElementById("label");
        var input2 = document.getElementById("pagaCon");
        if (label2 == null || input2 == null) {
            document.getElementById("opc").innerHTML = "Contra Entrega";
            document.getElementById("descPaypal").innerHTML = "";
            var label = document.createElement("h5");
            // var newContent = document.createTextNode("Selecciona cómo harás tu pago contra entrega");
            var newContent = document.createTextNode(
                "Escriba la cantidad de efectivo con la que va a pagar para preparar su cambio");
            label.appendChild(newContent); //añade texto al div creado.
            label.id = 'label'
            var input = document.createElement("INPUT");
            //aquí indicamos que es un input de tipo text
            input.type = 'number';
            input.id = 'pagaCon';

            var boton = document.createElement("button");
            boton.id = "btnSeguir";
            boton.innerHTML = 'Continuar';
            //  boton.setAttribute.class = 'btn btn-success'
            // boton.style.backgroundColor = '#009900';


            //let btn = document.getElementById("btnSeguir");
            var div = document.createElement("div");
            div.id = 'divN'

            //  input.setAttribute.require;
            //   let divPrinc = document.getElementById()
            document.getElementById("elementos").appendChild(label);
            //  document.getElementById("elementos").appendChild(input);
            document.getElementById("elementos").appendChild(div);

            let boton3 = `
            <div class ="input-group">
            <h5 class="my-auto mx-1">$</h5>
            <input class="col-3 form-control my-auto mt-4" type="number" id="pagando" name="pago" data-decimals="" min="0" placeholder="0" value="0" required>
            </div>
            <button type="button" id="btnContinuar" name="pagaCon" class="btn btn-primary mt-4">Continuar</button>`;
            document.getElementById("divN").innerHTML = boton3;

            //Validar pago con 
            var number = document.getElementById('pagando');
            number.onkeypress = function(e) {
                if (!((e.keyCode > 95 && e.keyCode < 106) ||
                        (e.keyCode > 47 && e.keyCode < 58) ||
                        e.keyCode == 8 || e.keyCode == 46)) {
                    return false;
                }
            }
            let suma = totalCompra + envioCosto;
            console.log("Si los agrego ok");
            $("#btnContinuar").click(function() {
                let pago2 = $('#pagando').val();
                console.log("El pago ingresado", pago2);
                if (pago2 < suma) {
                    return alert(`EL pago mínimo que usted debe preparar es: ` + suma);
                }
                location.href = "{{url('/puntoVenta/detalleCompra')}}";
            });

            //y por ultimo agreamos el componente creado al padre
            //  padre.appendChild(input);
        }
    }

    function pagoPaypal() {
        // let btn = document.getElementById("btnPaypal");
        // document.getElementById("btnPaypal").style.background = 'green';
        //  btn.setAttribute.class = 'btn btn-success input-group';
        document.getElementById("opc").innerHTML = " Paypal";
        var label2 = document.getElementById("label");
        var input2 = document.getElementById("pagaCon");
        var divNuevo = document.getElementById("divN");
        if (label2 != null || input2 != null || divNuevo != null) {
            document.getElementById("label").remove()
            document.getElementById("pagaCon").remove();
            document.getElementById("divN").remove();
        }
        let element = `<div class="col-8 mb-auto">
                <p class="h5">Paga de manera sencilla con tus tarjetas de débito o crédito registradas en tu cuenta
                    PayPal.</p>
            </div>
            <div class="col-9 mb-auto px-0">
                <img class="col-2 img-fluid my-2 mx-0" src="{{ asset('img/paypal.png') }}" alt="FORMA DE PAGO" />
            </div>
            <div class=" col-12">
            <a class="btn btn-success btn-lg" href="">Continuar con PayPal</a>
            </div>
            `;

        document.getElementById("descPaypal").innerHTML = element;

    };
    async function calcularTotal() {
        if (carrito == null)
            return;
        //let totalCompra = 0;
        totalCompra = 0;
        let cuerpoCarrito = "";
        let contador = 0;
        for (let i in carrito) {
            if (carrito[i].sucursal == sucursal) {
                contador++;
                totalCompra = totalCompra + (carrito[i].precio * carrito[i].cantidad);
            }
        }
        // envioCosto = 15;
        if (contador != 0) {
            $('#subtotal').html(`$ ${totalCompra}`);
            $('#envio').html(`$ ${envioCosto}`);
            let suma = totalCompra + envioCosto;
            $('#total').html(`$ ${suma}`);
            $('#pagaCon').html(`$ ${pagaCon2}`);
            let cambio2 = pagaCon2 - suma;
            console.log("cambio: ", cambio);
            $('#cambioR').html(`$ ${cambio2}`);
            $('#cambio').html(`$ ${cambio2}`);
            return;
        }
    }
    calcularTotal();
    /*
    function enviarCompra() {
        let formulario = `
                <form method="post" action="{{url('/revisionCompra')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <!--El name debe ser igual al de la base de datos-->
                <div class="input-group">
                <h5 class="my-auto mx-1">$</h5>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando" name="formaPago" value ="` + +` " data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando1" name="pagaCon" data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando2" name="cambio" data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando3" name="direccion" data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando4" name="cliente" data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando5" name="productos" data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando6" name="subtotal" data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando7" name="costoEnvio" data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                <input class="col-3 form-control my-auto mt-4" type="number" id="pagando8" name="total" data-decimals="" min="0" placeholder="0" value="0" autofocus required>
                </div>
                <button type="submit" id="btnContinuar" class="btn btn-success mt-4">Continuar</button>
                </form>
                `;
    }
    */

    function productosCarrito() {
        console.log(carrito);

        for (let j in carrito) {
            let producto = {
                //   id: productosVenta.length + 1,
                idProducto: carrito[j].id,
                idSucursal: carrito[j].sucursal,
                cantidad: carrito[j].cantidad,
                precio: carrito[j].precio,
                subtotal: carrito[j].cantidad * carrito[j].precio
            };
            productosVenta.push(producto);

        }
    }

    async function enviarCompra2() {
        productosCarrito();
        let json = JSON.stringify(productosVenta);

        let direccion = `{{$domicilio->calle}} {{$domicilio->numeroExterior}},
                        @if(isset($domicilio->numeroInterior)){{$domicilio->numeroInterior}}, @else @endif
                        {{$domicilio->codigoPostal}}, {{$domicilio->colonia}}, Zimatlán de Álvarez, Oaxaca`;
        let suma = totalCompra + envioCosto;

        let cambio2 = pagaCon2 - suma;
        let datosFormulario = new FormData();
        datosFormulario.append("formaPago", formaPago);
        datosFormulario.append("pagaCon", parseFloat(pagaCon2));
        datosFormulario.append("cambio", parseFloat(cambio2));
        datosFormulario.append("direccion", String(direccion));
        //  datosFormulario.append("idCliente", "Groucho");
        //  datosFormulario.append("productos", "Groucho");
        datosFormulario.append("subtotal", parseFloat(totalCompra));
        datosFormulario.append("costoEnvio", parseFloat(envioCosto));
        //datosFormulario.append("costoEnvio", envioCosto);
        datosFormulario.append("total", parseFloat(suma));
        datosFormulario.append("datos", json);

        datosFormulario.append("_token", "{{ csrf_token() }}");
        //datosFormulario.append('ajax', true);
        //console.log('formulario', datosFormulario);

        try {
            let funcion = $.ajax({
                // metodo: puede ser POST, GET, etc
                method: "POST",
                // la URL de donde voy a hacer la petición
                url: `{{url('/prueba')}}`,
                contentType: false,
                processData: false,
                cache: false,
                // los datos que voy a enviar para la relación
                data: datosFormulario,

                //  id: idSucProd

                // si tuvo éxito la petición
            }).done(function(respuesta) {
                console.log("La respuesta despues ins:", respuesta); //JSON.stringify(respuesta));
                let paga = respuesta['pagaCon'];
                let folio = respuesta['folioPedido'];
                location.href = `{{url('/resumenFinal')}}/${paga},${folio}`;
            });
        } catch (err) {
            console.log("Error al realizar la petición AJAX: " + err.message);
        }
        /////////////////
    }

    document.getElementById("opc").innerHTML = formaPago;
    $('#pagando2').html(`$ ${pagaCon2}`);
</script>
@endsection