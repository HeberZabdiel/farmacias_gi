<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FarmaciasGI') }}</title>
    
    @yield('recursos')
    <!-- Scripts -->
    <!--script src="{ asset('js/app.js') }}"></script-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css\bootstrap.min.css') }}">
    <script src="{{ asset('js\jquery-3.5.1.min.js') }}"></script>


    <script src="{{ asset('js\popper.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    
    @php
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
    @endphp
</head>

<body>
    <!--div class="border border-danger m-0" style="transform:scale(100%,90%) translate(0%, -5%) perspective(170px); margin:0;"-->
    <nav class="navbar navbar-expand-md m-0 p-0 " style="background-color: #3366FF;">

        <!--div class="navbar navbar-expand-lg w-100 m-0 p-0 border border-warning"-->

        <ul class="navbar-nav mx-auto ml-xl-auto my-xl-0">
            <li class="nav-item">
                <h5 class="text-white text-uppercase d-none d-md-block ">{{session('sucursalNombre')}}
                </h5>
                <h6 class="text-white text-uppercase text-center mx-auto my-1 d-md-none">
                    {{session('sucursalNombre')}}
                </h6>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto ml-sm-0 m-1 border border-light rounded">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item border">
                <a class="nav-link text-white" href="{{ url('puntoVenta/login') }}">{{ __('Login') }}</a>
            </li>
            <!--if (Roudte:d:has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{ route('register') }}">{ __('Register') }}</a>
                        </li>
                        endif-->
            @else
            <li class="nav-item dropdown">
                <!--div class="dropdown"-->
                <a id="navbarDropdown" class="nav-link  dropdown-toggle text-white p-1 p-sm-auto" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <strong>{{ Auth::user()->username }}</strong>
                </a>
                <div class="dropdown-menu dropdown-menu-right border " aria-labelledby="navbarDropdown">
                    <a class="dropdown-item " class="text-white" href="{{ url('puntoVenta/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <img src="{{ asset('img\salir.png') }}" alt="Editar" height="30px">

                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ url('puntoVenta/logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <!--/div-->
            </li>
            @endguest
        </ul>
        <!--/div-->
    </nav>
    @yield('content')
    <script src="{{ asset('js\mayusculas.js') }}"></script>


    <!--/div-->
</body>

</html>