<style>
     button {
    width: 100%;
    height: 50px; /* Ajusta según sea necesario */
    padding: 10px 0; /* Asegúrate de que el padding no cambie drásticamente */
}
</style>

@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
@section('content')
<section class="content">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class=" p-4 col-12 col-sm-6 j">
                    <h3 class="my-3" style="color: #3E2F5B; !important">{{$producto->nombre}}</h3>
                    <p>{{$producto->descripcion}}</p>
                    <hr>
                   

                    <h4 class="mt-3 bold"><small> {{$producto->subcategoria->nombre}} de {{$producto->subcategoria->categoria->nombre}}</small></h4>

                    <div class="">
                        <h2 class="mb-0 text-success">
                            {{$producto->precio_venta}}
                        </h2>
                       
                    </div>
                    <div class="mt-4">
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="background-color: #3E2F5B; border:none; width: 100%; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                
                                Añadir a la cesta
                            </button>
                        </form>

                    </div>
                    <div class="mt-4 product-share">
                        <a href="#" class="text-gray">
                            <i class="fab fa-facebook-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fab fa-twitter-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fas fa-envelope-square fa-2x"></i>
                        </a>
                        <a href="#" class="text-gray">
                            <i class="fas fa-rss-square fa-2x"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h4 class="d-inline-block d-sm-none">{{$producto->nombre}}</h4>

                    <div class="col-12 w-100 h-100">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($producto->imagenes as $imagen)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block w-100" src="{{ asset($imagen->url) }}" alt="Product Image">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
@include('layout.script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>