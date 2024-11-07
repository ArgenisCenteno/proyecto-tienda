@extends('layout.app')
@section('content')
<main class="app-main"> <!--begin::App Content Header-->
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
                                <h3 class="p-2 bold"> Promoción: {{ $promocion->nombre }}</h3>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('promociones.historia') }}"
                                    class="btn btn-primary  round mx-1">Regresar</a>
                            </div>
                        </div>
                        <div>

                            <div class="card-body">
                                <p><strong>Descuento:</strong> {{ $promocion->descuento }}%</p>
                                <p><strong>Fecha de Inicio:</strong> {{ $promocion->fecha_inicio }}</p>
                                <p><strong>Fecha de Fin:</strong> {{ $promocion->fecha_fin }}</p>
                                <hr>
                                <h4>Productos en esta Promoción:</h4>
                                <ul>
                                    @foreach ($promocion->productos as $producto)
                                        @php
                                            // Calculando el precio con descuento
                                            $precioConDescuento = $producto->precio_venta - ($producto->precio_venta * $promocion->descuento / 100);
                                        @endphp
                                        <li>
                                            {{ $producto->nombre }} 
                                            <br>
                                            <span><strong>Precio original:</strong> ${{ number_format($producto->precio_venta, 2, '.', ',') }}</span> 
                                            <br>
                                            <span><strong>Precio con descuento:</strong> ${{ number_format($precioConDescuento, 2, '.', ',') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection
