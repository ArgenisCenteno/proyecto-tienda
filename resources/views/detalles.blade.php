@extends('layouts.app')

<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>

@section('content')
<section class="content">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                <div class="p-4 col-12 col-sm-6">
                    <h3 class="my-3" style="color: #3E2F5B;">{{$producto->nombre}}</h3>
                    <p>{{$producto->descripcion}}</p>
                    <hr>

                    <h4 class="mt-3 bold">
                        <small>{{$producto->subcategoria->nombre}} de {{$producto->subcategoria->categoria->nombre}}</small>
                    </h4>

                    <div class="">
                        @php
                            $precioDescuento = null;
                        @endphp

                        @foreach ($producto->promocion as $promocion)
                            @if ($promocion->fecha_inicio <= now() && $promocion->fecha_fin >= now())
                                @php
                                    $precioDescuento = $producto->precio_venta - ($producto->precio_venta * $promocion->descuento / 100);
                                    break; // Salir del bucle al encontrar la primera promoción activa
                                @endphp
                            @endif
                        @endforeach

                        @if ($precioDescuento)
                            <h2 class="text-danger mb-0">
                                 {{ number_format($precioDescuento, 2, '.', ',') }}$ <small>(Descuento aplicado)</small>
                            </h2>
                            <h4 class="text-muted">
                                <s> {{ number_format($producto->precio_venta, 2, '.', ',') }} $</s>
                            </h4>
                        @else
                            <h2 class="text-success mb-0">
                                 {{ number_format($producto->precio_venta, 2, '.', ',')  }} $
                            </h2>
                        @endif

                        <h4 class="text-black">
                              {{ number_format($producto->precio_venta * $dollar, 2, '.', ',') }} BS
                        </h4>
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST" id="formAgregarCarrito">

                        <!-- Aquí añadimos el check de tallas -->
                        <div class="mt-3">
                            <h5 class="mb-3">Selecciona una talla:</h5>
                            @foreach ($producto->tallas as $talla)
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="radio" 
                                        name="talla" 
                                        id="talla{{ $talla->id }}" 
                                        value="{{ $talla->talla }}" 
                                        {{ $talla->cantidad == 0 ? 'disabled' : '' }}
                                        {{ $loop->first && $talla->cantidad > 0 ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label" for="talla{{ $talla->id }}">
                                        {{ $talla->talla }} - {{ $talla->cantidad }} disponibles
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="background-color: #3E2F5B; border:none; width: 100%; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
                                Añadir a la cesta
                            </button>
                        
                    </div>
                    </form>
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
                            <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#formAgregarCarrito').on('submit', function(e) {
            // Verificar si la talla seleccionada tiene cantidad cero
            let tallaSeleccionada = $('input[name="talla"]:checked');
            if (tallaSeleccionada.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor selecciona una talla disponible.',
                });
            } else {
                let cantidadDisponible = tallaSeleccionada.data('cantidad');
                if (cantidadDisponible === 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Sin Stock',
                        text: 'La talla seleccionada no tiene stock disponible.',
                    });
                }
            }
        });
    });
</script>

