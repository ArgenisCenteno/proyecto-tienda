@extends('layouts.app')

@section('content')

<section class="h-100 py-5">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            @foreach ($productos as $similar)
                <div class="col-md-4">
                    <a href="{{ route('detalles', $similar->id) }}" class="text-decoration-none">
                        <div class="card h-100 shadow-sm p-3">
                            <img src="{{ $similar->imagenes->first()->url }}" style="height: 400px;" 
                                class="card-img-top" alt="...">
                            <div class="label-top shadow-sm">{{ $similar->nombre }}</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $similar->descripcion }}</h5>
                                
                                <!-- Displaying sizes (tallas) if available -->
                                @if($similar->tallas && $similar->tallas->count() > 0)
                                    <div class="mb-3 text-right">
                                        <h6 class="text-muted">Tallas Disponibles:</h6>
                                        <ul class="list-unstyled">
                                            @foreach($similar->tallas as $talla)
                                                <li>{{ $talla->talla }} ({{ $talla->cantidad }} disponibles)</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <p class="text-muted">No hay tallas disponibles</p>
                                @endif

                                <div class="clearfix mb-1">
                                    <span class="float-end"><i class="fas fa-plus"></i></span>
                                    <span class="float-start"></span>
                                </div>
                                <div class="clearfix mb-3">
                                    <span class="float-end">{{ $similar->precio_venta }} $</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            @if(count($productos) == 0)
                <div style="display: flex; justify-content: center; align-items: center">
                    <img src="{{ asset('imagenes/noproduct.jpg') }}" alt="Sin datos">
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
@include('layout.script')
<script src="{{ asset('js/sweetalert2.js') }}"></script>
