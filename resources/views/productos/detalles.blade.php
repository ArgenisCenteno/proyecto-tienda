@extends('layout.app')

@section('content')
<style>
    .card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transform: translateY(-5px); /* Un pequeño efecto de elevación */
}

.card-img-top {
    object-fit: cover; /* Hace que la imagen ocupe todo el espacio de la tarjeta */
    height: 200px; /* Ajusta la altura de la imagen si es necesario */
}

</style>
<main class="app-main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="border-0 my-5">
                        <div class="px-2 row">
                            <div class="col-lg-12">
                                @include('flash::message')
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Promoción: {{ $promocion->nombre }}</h3>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('promociones.historia') }}" class="btn btn-primary round mx-1">Regresar</a>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                <p><strong>Descuento:</strong> {{ $promocion->descuento }}%</p>
                                <p><strong>Fecha de Inicio:</strong> {{ $promocion->fecha_inicio }}</p>
                                <p><strong>Fecha de Fin:</strong> {{ $promocion->fecha_fin }}</p>
                                <hr>
                                <h4>Productos en esta Promoción:</h4>
                                <div class="row">
                                    @foreach ($promocion->productos as $producto)
                                        @php
                                            // Calculando el precio con descuento
                                            $precioConDescuento = $producto->precio_venta - ($producto->precio_venta * $promocion->descuento / 100);
                                        @endphp
                                        <div class="col-md-4">
                                            <!-- Card con efecto de sombra y enlace al editar producto -->
                                            <a href="{{ route('productos.edit', $producto->id) }}" class="text-decoration-none">
                                                <div class="card mb-4 shadow-sm hover-shadow-lg">
                                                    <img src="{{ $producto->imagenes->first()->url ?? asset('img/default-product.jpg') }}" class="card-img-top" alt="{{ $producto->nombre }}">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                                                        <p><strong>Precio original:</strong> ${{ number_format($producto->precio_venta, 2, '.', ',') }}</p>
                                                        <p><strong>Precio con descuento:</strong> ${{ number_format($precioConDescuento, 2, '.', ',') }}</p>
                                                        <p class="card-text">{{ $producto->descripcion }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
