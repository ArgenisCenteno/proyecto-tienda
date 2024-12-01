@extends('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

@section('content')
<!-- Carousel wrapper -->
<div id="carouselBasicExample" class="carousel slide carousel-fade" data-mdb-ride="carousel" data-mdb-carousel-init>
  <!-- Indicators -->
  <div class="carousel-indicators">
    @foreach($productos as $index => $producto)
      <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="{{ $index }}" 
        class="{{ $loop->first ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
    @endforeach
  </div>

  <!-- Inner -->
  <div class="carousel-inner">
    @foreach($productos as $producto)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
        @php
          // Accede a la primera imagen del producto
          $imagen = $producto->imagenes->first();
        @endphp
        <img src="{{ $imagen ? asset($imagen->url) : asset('imagenes/default.png') }}" 
          class="d-block w-100" alt="{{ $producto->nombre }}" />
        <div class="carousel-caption d-none d-md-block">
          <h5>{{ $producto->nombre }}</h5>
          <p>{{ $producto->descripcion }}</p>
        </div>
      </div>
    @endforeach
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



  @foreach ($promociones as $promocion)
    <h4 class="mt-4 text-center">{{ $promocion->nombre }}</h4>
    <div class="row p-5">
    @foreach ($promocion->productos as $producto)
    @php
    // Calculating the discounted price
    $precioConDescuento = $producto->precio_venta - ($producto->precio_venta * $promocion->descuento / 100);
  @endphp
    <a href="{{ route('detalles', $producto->id) }}" class="text-decoration-none">

      <div class="col-md-4 col-sm-6 mb-4">
      <div class="card h-100 shadow-sm p-3">
      <img src="{{ asset($producto->imagenes->first()->url ?? 'default-image.jpg') }}" class="card-img-top"
      alt="Product Image" style="height: 400px;">
      <div class="card-body">

      <h5 class="card-title">{{ $producto->nombre }}</h5>
      <br>
      <div class="text-left">
        <br>
        <p><strong>Descuento:</strong> {{ $promocion->descuento }}%</p>
        <p><strong>Precio original:</strong>

        ${{ number_format($producto->precio_venta, 2, '.', ',') }}</p>
        <p><strong>Precio con descuento:</strong>
        ${{ number_format($precioConDescuento, 2, '.', ',') }}</p>

        @if($producto->tallas && $producto->tallas->count() > 0)
      <div class="mb-3 text-left">
      <h6 class="text-muted">Tallas Disponibles:</h6>
      <ul class="list-unstyled">
      @foreach($producto->tallas as $talla)
      <li>{{ $talla->talla }} ({{ $talla->cantidad }} disponibles)</li>
    @endforeach
      </ul>
      </div>
    @else
    <p class="text-muted">No hay tallas disponibles</p>
  @endif
      </div>
      </div>
      </div>
      </div>
    </a>
  @endforeach
    </div>
  @endforeach
</div>
<!-- Carousel wrapper -->





<!-- Footer -->

<!-- Footer -->

@endsection