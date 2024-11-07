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

<div>
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
                                                <img src="{{ asset($producto->imagenes->first()->url ?? 'default-image.jpg') }}"
                                                    class="card-img-top" alt="Product Image" style="height: 400px;">
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