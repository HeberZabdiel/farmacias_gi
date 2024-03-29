@extends('header2')

@section('contenido')
@section('subtitulo')
SUBPRODUCTOS
@endsection

@section('opciones')
@endsection

<div class="row p-1 ">
    <!--CONSULTAR PRODUCTO -->
    <div class="row border border-dark m-2 w-100">
        <div class="row col-12 mx-2 mt-4">
            <label for="">
                <h5 class="text-primary">
                    <strong>
                        CONSULTAR SUBPRODUCTO: VENTAS MENUDEO
                    </strong>
                </h5>
            </label>
        </div>
        <div class="row col-12">
            <div class="col-2 border border-primary mt-2 mb-4 ml-4 mr-2">
                <br />
                <br /> <br />
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label text-primary" for="flexCheckChecked">
                        PROXIMOS A CADUCAR
                    </label>
                    <br />
                </div>
                <!--
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label" for="flexCheckChecked">
                    BAJOS DE EXISTENCIA
                </label>
            </div>
            -->
            </div>
            <!-- <div class="col border border-dark mt-4 mb-4 mr-4 ml-2">-->
            <div class="col-9  mt-1 mb-4 ml-4 mr-2">
                <div class="form-group w-100">
                    <div class="row my-2">
                        <div class="col-6 input-group">
                            <input type="text" class="form-control text-uppercase border-primary " size="15" placeholder="BUSCAR PRODUCTO" id="texto">
                            <!--div class="input-group-append">
                        <button class="btn btn-outline-secondary" id="buscarD" type="button" id="button-addon2">Buscar</button>
                        </div-->
                        </div>
                        <a title="buscar" href="" class="text-dark ">
                            <img src="{{ asset('img\busqueda.png') }}" class="img-thumbnail" alt="Regresar" width="40px" height="40px" /></a>
                        <div class="mt-2 mx-2">

                        </div>

                        <label for="" class="mx-3 mt-2">
                            <h6> BUSCAR POR:</h6>
                        </label>


                        <div class=" form-check mt-2">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                CODIGO
                            </label>
                        </div>
                        <div class="mx-4 form-check mt-2">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                NOMBRE
                            </label>
                        </div>

                    </div>
                </div>

                <!-- TABLA -->
                <div class="row" style="height:350px;overflow-y:auto;">
                    <table class="table table-bordered border-primary col-12 ">
                        <thead class="table-secondary text-primary">
                            <tr>
                                <th>#</th>
                                <th>PRODUCTO</th>
                                <th>PIEZAS</th>
                                <th>PRECIO INDIVIDUAL</th>
                                <th> EXISTENCIA</th>
                                <th>OBSERVACION</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpo2">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    let subproducto = @json($subproductos);
    let productos = @json($productos);
    let sucursal_prod = @json($sucursalProd);

    buscarSubproductos();

    function buscarSubproductos() {
        let cont=0;
        let cuerpo="";
        for (count in subproducto) {
            for (count2 in sucursal_prod) {
                console.log("hols");
                if(subproducto[count].idSucursalProducto == sucursal_prod[count2].id)
                    let idProd= sucursal_prod[count2].idProducto; 
                    let nombre="";
                    for(let x in productos)
                    {
                        if(productos[x].id == idProd)
                        {
                            nombre = productos[x].nombre;
                           // idProd =productos[x].id;
                        }
                    }
                    cont = cont+1;
                    cuerpo = cuerpo + `
                        <tr onclick="agregarProducto(` + idProd + `)" data-dismiss="modal">
                        <th >` + cont + `</th>
                        <td>` + nombre + `</td>
                        <td>` + subproducto[count].piezas + `</td>
                        <td>` + subproducto[count].precio + `</td>
                        <td>` + subproducto[count].existencia + `</td>
                        <td>` + subproducto[count].observacion + `</td>  
                    </tr>
                    `;
                }
            }
        
        document.getElementById("cuerpo2").innerHTML = cuerpo;
    };
</script>

@endsection