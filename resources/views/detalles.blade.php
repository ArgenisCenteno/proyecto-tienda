@extends('layouts.app')

@section('content')
<section class="content">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <div class="container mt-5">
        <div class="row">
            <!-- Galería de imágenes -->
            <div class="col-md-6">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($producto->imagenes as $imagen)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                <img class="d-block w-100 border rounded" src="{{ asset($imagen->url) }}" alt="Product Image">
                            </div>
                        @endforeach
                    </div>
                    @if(count($producto->imagenes) > 1)
                    <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Detalle del producto -->
            <div class="col-md-6">
                <h1 class="h4" style="color: #3E2F5B;">{{ $producto->nombre }}</h1>
                <p class="text-muted">{{ $producto->subcategoria->nombre }} - {{ $producto->subcategoria->categoria->nombre }}</p>

                @php
                    $precioDescuento = null;
                @endphp

                @foreach ($producto->promocion as $promocion)
                    @if ($promocion->fecha_inicio <= now() && $promocion->fecha_fin >= now())
                        @php
                            $precioDescuento = $producto->precio_venta - ($producto->precio_venta * $promocion->descuento / 100);
                            break;
                        @endphp
                    @endif
                @endforeach

                @if ($precioDescuento)
                    <h2 class="text-danger">
                        {{ number_format($precioDescuento, 2, '.', ',') }} $
                        <small>(Descuento aplicado)</small>
                    </h2>
                    <p class="text-muted"><s>{{ number_format($producto->precio_venta, 2, '.', ',') }} $</s></p>
                @else
                    <h2 class="text-success">{{ number_format($producto->precio_venta, 2, '.', ',') }} $</h2>
                @endif

                <p><strong>Equivalente en bolívares:</strong> {{ number_format($producto->precio_venta * $dollar, 2, '.', ',') }} BS</p>

                <!-- Selección de tallas -->
                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST" id="formAgregarCarrito">
    @csrf
    <div class="mt-4">
        <h5>Selecciona una o más tallas:</h5>
        @foreach ($producto->tallas as $talla)
            <div class="form-check">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    name="tallas[]" 
                    id="talla{{ $talla->id }}" 
                    value="{{ $talla->talla }}" 
                    {{ $talla->cantidad == 0 ? 'disabled' : '' }}
                    {{ $loop->first && $talla->cantidad > 0 ? 'checked' : '' }}
                >
                <label class="form-check-label {{ $talla->cantidad == 0 ? 'text-muted' : '' }}" for="talla{{ $talla->id }}">
                    {{ $talla->talla }} - {{ $talla->cantidad }} disponibles
                </label>
            </div>
        @endforeach
    </div>

    <!-- Botón de compra -->
    <button type="submit" class="btn btn-primary mt-3 btn-lg w-100" style="background-color: #3E2F5B; border: none;">
        Añadir a la cesta
    </button>
</form>


                <!-- Botones de compartir -->
                <div class="mt-4">
                    <h6> </h6>
                    <a href="#" class="text-gray mr-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-gray mr-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-gray"><i class="fas fa-envelope fa-lg"></i></a>
                </div>
            </div>
        </div>

        <!-- Descripción del producto -->
        <div class="mt-5">
            <h4>Descripción del producto</h4>
            <p>{{ $producto->descripcion }}</p>
        </div>
    </div>
</section>
@endsection

@include('layout.script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function() {
    $('#formAgregarCarrito').on('submit', function(e) {
        let tallasSeleccionadas = $('input[name="tallas[]"]:checked');
        
        if (tallasSeleccionadas.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor selecciona al menos una talla disponible.',
            });
        } else if (tallasSeleccionadas.length > 3) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Limite de selección',
                text: 'Solo puedes seleccionar hasta 3 tallas.',
            });
        }
    });
});



</script>
