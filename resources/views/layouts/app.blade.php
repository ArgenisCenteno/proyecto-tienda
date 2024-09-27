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
    <title>{{ config('app.name', 'Farmagarca') }}</title>

    <!-- Fonts -->
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
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

        .no-underline {
    text-decoration: none;
}

.no-underline:hover {
    text-decoration: none;
}
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('layout.head')
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #3E2F5B; color: white;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="{{ url('/') }}"> <strong class="navbar-brand text-white">Sharly</strong></a>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Damas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Caballeros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Niños</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Accesorios</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a class="text-reset me-3" href="#">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        <a href="{{ route('carrito.show') }}" class="text-white me-3 no-underline" >
                                Mi Cesta
                            </a>
                        @auth
                            <a href="{{ route('home') }}" class="text-white me-3 no-underline" >
                                Mi perfil
                            </a>
                            <a href="{{ route('logout') }}" class="text-white me-3 no-underline"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Salir
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white">Iniciar Sesión</a>
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
    <footer class="text-center bg-body-tertiary">
        <!-- Grid container -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-twitter"></i></a>

                <!-- Google -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-instagram"></i></a>

                <!-- Linkedin -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-linkedin"></i></a>
                <!-- Github -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->
        <div class="container-fluid mt-5" style="width: 100%; padding: 0;">
            <div class="card " style="width: 100%; background-color: #136F63; color: white">
                <div class="card-body">
                    <h5 class="card-title text-center">¡Simplifica tu experiencia de compra!</h5>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <i class="material-icons" style="font-size: 48px; color: white;">person_add</i>
                            <h6 class="mt-3">Regístrate</h6>
                            <p>Únete a nuestra comunidad y crea tu cuenta en minutos. Disfruta de promociones exclusivas
                                y acceso a ofertas especiales.</p>
                        </div>
                        <div class="col-md-4">
                            <i class="material-icons" style="font-size: 48px; color: white;">shopping_cart</i>
                            <h6 class="mt-3">Ordena</h6>
                            <p>Explora nuestra amplia gama de productos. Agrega tus artículos al carrito y realiza tu
                                pedido con facilidad.</p>
                        </div>
                        <div class="col-md-4">
                            <i class="material-icons" style="font-size: 48px; color: white;">local_shipping</i>
                            <h6 class="mt-3">Recibe tu pedido</h6>
                            <p>Disfruta de entregas rápidas y seguras directamente en tu puerta. ¡Es así de simple!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: #000F08; color: white;">
            © 2024 Copyright:
            <a class="text-body" href="#"> <span class="">Sharly Cuchi Moda C.A</span> </a>
        </div>
        <!-- Copyright -->
    </footer>
</body>
@yield('js')
@include('layout.script')
@include('sweetalert::alert')
@include('layout.datatables_css')
@include('layout.datatables_js')

</html>