
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"-->
    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script href="{{ asset('js\jquery-3.5.1.min.js') }}"></script>
    <script href="{{ asset('js\popper.min.js') }}"></script>
    <script href="{{ asset('js\bootstrap.min.js') }}"></script>
</head>
<body>
<br/><br/> 

<div class= "row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    <h3 class="p-3 mb-6  text-white" style="background:#ED4D46" >PRODUCTO</h3>
    </div>
    <div class="col-md-1"> </div>
    </div>

    <div class= "row">
    <div class="col-md-2"></div>
    <div class="col-md-8" style="background:#D5DBDB">
    <h5 class="blockquote text-center"> <strong>Consultar Producto</strong></h5>
    </div>
    
    <div class="col-md-2"> </div>
    </div>
    <br/>

    

    <div class= "row">
    <div class="col-md-1"></div>
    <div class="col-md-10" style="background:#0CC6CC">
<table class="table"  >
<!--"table table-hover"
"table table-bordered table-dark"

"table-active"
-->

<thead class="thead-dark" >
<tr>
<th>Numero</th>
<th>Codigo barras</th>
<th>Nombre</th>
<th>Descripcion</th>
<th>Departamento</th>
<th>Minimo stock</th>
<th>Existencia</th>
<th>Acciones</th>
</tr>
</thead>
<tbody>
@foreach($productos as $producto)
<tr>
<td>{{$loop->iteration}}</td>
<td>{{$producto->codigoBarras}}</td>
<td>{{$producto->nombre}}</td>
<td> {{$producto->descripcion}}</td>
<td> {{$producto->idDepartamento}}</td>
<td> {{$producto->minimo_stock}} </td>
<td> {{$producto->existencia}} </td>
<td> 
<a href="{{ url('/producto/'.$producto->id.'/edit')}}"> Editar </a>
 | 
<form method="post" action="{{ url('/producto/'.$producto->id)}}">
{{csrf_field()}}
{{method_field('DELETE')}}
<button type="submit" onclick= "return confirm('¿Borrar?');"> Borrar</button>
</form>
 </td>
</tr>
@endforeach
</tbody>
</table>


<a href="{{url('producto/create')}}"> Nuevo producto</a>

</div>
    <div class="col-md-1"> </div>
    </div>


</body>
</html>



