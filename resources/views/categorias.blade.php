@extends('layouts.app')

@section('content')

<main>
    <div class="container-fluid bg-transparent my-4 p-3" style="position: relative;">
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
            @foreach ($productos as $similar)
                <div class="col "  >
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                        <img src="{{ $similar->imagenes->first()->url }}" class="card-img-top img-fluid" style="height: 250px; object-fit: cover;" alt="{{ $similar->nombre }}">
                        <div class="card-body">
                            <div class="clearfix mb-3">
                                <span class="float-start badge rounded-pill bg-primary">{{ $similar->nombre }}</span>
                                <span class="float-end price-hp">{{ $similar->precio_venta }} $</span>
                            </div>
                            <h5 class="card-title text-dark fw-bold">{{ $similar->descripcion }}</h5>
                         
                            @if($similar->tallas && $similar->tallas->count() > 0)
                                <div class="mb-3"> 
                                    <h6 class="text-white">-------------</h6>   <br>
                                    <ul class="list-unstyled mb-0">
                                        @foreach($similar->tallas as $talla)
                                            <li class="text-dark small">
                                                {{ $talla->talla }} ({{ $talla->cantidad }} disponibles)
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p class="text-muted">No hay tallas disponibles</p>
                            @endif
                            
                            <div class="text-center my-4">
    <a href="{{ route('detalles', $similar->id) }}" class="btn btn-warning">Ver detalles</a>
</div>

<!-- Botones para compartir -->
<div class="text-center">
    <a href="https://api.whatsapp.com/send?text={{ urlencode($similar->nombre . ' - ' . route('detalles', $similar->id)) }}" target="_blank" class="btn btn-info btn-sm">
        <i class="bi bi-whatsapp"></i> Compartir
    </a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('detalles', $similar->id)) }}" target="_blank" class="btn btn-primary btn-sm">
        <i class="bi bi-facebook"></i> Compartir
    </a>
    
</div>

                        </div>
                    </div>
                </div>
            @endforeach
            
            @if(count($productos) == 0)
                <div class="d-flex justify-content-center align-items-center">
                    <img src="{{ asset('imagenes/noproduct.jpg') }}" alt="Sin datos" class="img-fluid">
                </div>
            @endif
        </div>
    </div>
</main>

<style>
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-warning {
        transition: background-color 0.3s ease-in-out;
    }
    
    .btn-warning:hover {
        background-color: #ff9800;
    }
</style>

@endsection