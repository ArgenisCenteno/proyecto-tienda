<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>{{ config('app.name', 'Sharli') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Fonts -->
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        main {
    min-height: 100vh;  /* Asegura que el main ocupe al menos la altura de la pantalla */
}


        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

        body {
            font-family: "Roboto" !important;
        }

        .navbar-nav .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            /* Alinea el submenú con el menú principal */
            transition: 0.3s ease-in-out;
        }
        .bg-violet {
    background-color: #3E2F5B !important; /* Cambia el fondo */
    color: white;
}

.bg-violet a {
    color: white !important; /* Cambia el color de los enlaces a blanco */
}

.bg-violet .dropdown-menu {
    background-color: white !important; /* Cambia el fondo del dropdown a blanco */
    border-color: #3E2F5B !important; /* Si quieres que el borde sea del color de fondo */
}

.bg-violet .dropdown-menu a {
    color: #3E2F5B !important; /* Cambia el color de los enlaces dentro del dropdown a un color oscuro */
}

.bg-violet .dropdown-menu a:hover {
    color: #FFD700; /* Cambia el color del texto al pasar el mouse */
    background-color: #f8f9fa; /* Cambia el fondo al pasar el mouse */
}


    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('layout.head')
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-violet">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="{{ url('/') }}"> <strong class="navbar-brand text-white">Sharli Online</strong></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Search Button -->
                

                <!-- Category Dropdowns -->
                @foreach($categorias as $categoria)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           href="{{ route('productosPorCategoria', $categoria->id) }}"
                           id="dropdown{{ $categoria->id }}" role="button" aria-expanded="false">
                            {{ $categoria->nombre }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown{{ $categoria->id }}">
                            @foreach($categoria->subCategorias as $subCategoria)
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('productosPorSubcategoria', $subCategoria->id) }}">
                                        {{ $subCategoria->nombre }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

            <div class="d-flex align-items-center">
                <a class="text-reset me-3" href="#">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <a href="{{ route('carrito.show') }}" class="text-white me-3">
                    Carrito
                </a>
                @auth
                    <a href="{{ route('home') }}" class="nav-link text-white me-3">
                        Mi perfil
                    </a>
                    <a href="{{ route('logout') }}" class="nav-link text-white "
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Salir
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-white">Ingresar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>


        <!-- Navbar -->

        <main class="">
            @yield('content')
        </main>
    </div>
    <footer class="bg-black text-center py-5">
    <div class="container px-5">
      <div class="text-white-50 small">
        <div class="mb-2">&copy; Todos los derechos reservados</div>
        
      </div>
    </div>
  </footer>
</body>
@yield('js')
@include('layout.script')
@include('sweetalert::alert')
@include('layout.datatables_css')
@include('layout.datatables_js')

</html>