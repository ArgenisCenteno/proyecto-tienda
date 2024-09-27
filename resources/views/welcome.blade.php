@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

@section('content')
<!-- Carousel wrapper -->
<div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel" data-mdb-carousel-init>
  <!-- Indicators -->
  <div class="carousel-indicators">
    <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="active"
      aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <!-- Inner -->
  <div class="carousel-inner">
    <!-- Single item -->
    <div class="carousel-item active">
        <img src="{{ asset('imagenes/pexels-photo-794064.jpeg') }}" class="d-block w-100" alt="Outfit Elegante" />
        <div class="carousel-caption d-none d-md-block">
            <h5>Colección de Verano a la Moda</h5>
            <p>Descubre los últimos estilos para elevar tu guardarropa de verano.</p>
        </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
        <img src="{{ asset('imagenes/pexels-photo-1536619.jpeg') }}" class="d-block w-100" alt="Vestido Elegante" />
        <div class="carousel-caption d-none d-md-block">
            <h5>Vestuario Elegante para la Noche</h5>
            <p>Sal con estilo con nuestra exclusiva colección de noche.</p>
        </div>
    </div>

    <!-- Single item -->
    <div class="carousel-item">
        <img src="{{ asset('imagenes/pexels-photo-4874531.jpeg') }}" class="d-block w-100" alt="Moda Casual" />
        <div class="carousel-caption d-none d-md-block">
            <h5>Estilos Chic y Casuales</h5>
            <p>Mantente cómodo y a la moda con nuestra colección de ropa casual.</p>
        </div>
    </div>
</div>


  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- Carousel wrapper -->
<div class="container mt-4">
  <h2 class="text-center mt-4 mb-4">¡Nuestras Ofertas!</h2>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($productos as $producto) <!-- Itera sobre los productos -->
      <div class="col">
        <div class="card " style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
          <a href="{{ route('detalles', $producto->id) }}">
            <img src="{{ $producto->imagenes->first()->url }}" class="card-img-top" alt="{{ $producto->nombre }}" />
          </a>
          <div class="card-body">
            <h5 class="card-title">
              <a href="{{ route('detalles', $producto->id) }}" class="text-dark"><strong>{{ $producto->nombre }}</strong></a>
            </h5> <!-- Nombre del producto -->
            <br>
            <br>
            <p class="card-text text-success">Precio: <strong>{{ $producto->precio_venta }} BS</strong></p> <!-- Precio del producto -->
            <p class="card-text">{{ $producto->descripcion }}</p> <!-- Descripción del producto -->
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>




<!-- Footer -->

<!-- Footer -->

@endsection