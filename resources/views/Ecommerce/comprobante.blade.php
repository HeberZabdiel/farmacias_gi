<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>


    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

    <div class="col p-4 mx-4 " id="impDiv">
        <div class="row col my-4" style="text-align:left">
            <img src="{{ asset('img\logo.png') }}" alt="Editar" width="180px" height="70px">
        </div>
        <div class="row col text-left my-4 mb-4">
            <h2 class=" text-left"> FARMACIAS GI ZIMATLAN</h2>
        </div>
        
        <div class="col text-center mt-4">
            <h2 class=""> COMPROBANTE DE ENTREGA</h2>
        </div>
        <br/><br/><br/><br/>
        <div class="col mb-4">
            <h3 class="text-left"> ESTIMADO CLIENTE:</h3>
            <p class="h3" style="text-align:justify"> FARMACIAS GI ZIMATLAN, AGRADECE SU PREFERENCIA. A CONTINUACION, SE
                DETALLA INFORMACION DE SU PAQUETE.</p>
        </div>
        <br/>
        <div class="col h4 mt-4 border border-secondary rounded">
            <p class=""> NUMERO DE GUIA</p>
            <p>FECHA GENERADO PAQUETE</p>
            <p>FECHA PROGRAMADO DE ENTREGA</p>
            <p>FECHA DE ENTREGA</p>
            <p>RECIBIO</p>
            <p> DIRECCION DE ENTREGA</p>
        </div>
        <br/><br/> 

        <div class="col text-center mt-4 h4 text-center">
            <p class="h3">ATENTAMENTE</p>
            <br/><br/>
            <p> FARMACIAS GI SA DE C.V ZIMATLAN</p>
            <p>direccion</p>
            <p>telefono</p>
            <p>linkPagina</p>
            <p>farmaciasgizimatlan.epizy.com</p>
            <a href="">farmaciasgizimatlan.epizy.com</a>
        </div>


    </div>
</body>
<script>
    function imprimir() {

        window.print();
        myWindow.blur(); //
        myWindow.close(); //
        // document.getElementById("totalV").innerHTML = 
    }

    //let productos =json($productos);
    //alert(productos);
    //let fecha = new Date();
    //alert(fecha.toLocaleDateString();

    // impFinal();
    function impFinal() {
        var WinPrint = window.open('', '', 'width=900,height=650 ');
        WinPrint.document.write(document.getElementById('impDiv').outerHTML); //printContent.outerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
    }
</script>

</html>