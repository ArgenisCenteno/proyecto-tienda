@extends('layout.app')

@section('content')
<main class="app-main"> <!--begin::App Content Header-->
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class=" border-0 my-5">
                        <div class="px-2 row">
                            <div class="col-lg-12">
                                @include('flash::message')
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Nueva Promoción</h3>
                            </div>
                        </div>
                        <div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('promociones.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="nombre">Nombre de la Promoción</label>
                                        <input type="text" name="nombre" class="form-control"
                                            value="{{ old('nombre') }}" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="descuento">Descuento (%)</label>
                                        <input type="number" name="descuento" class="form-control" min="0" max="100"
                                            value="{{ old('descuento') }}" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="fecha_inicio">Fecha de Inicio</label>
                                        <input type="date" name="fecha_inicio" class="form-control"
                                            value="{{ old('fecha_inicio') }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="fecha_fin">Fecha de Fin</label>
                                        <input type="date" name="fecha_fin" class="form-control"
                                            value="{{ old('fecha_fin') }}" required>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <label for="productos">Seleccionar Productos</label>
                                        <select name="productos[]" id="productos" class="form-control" multiple size="5"
                                            required>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id }}" {{ in_array($producto->id, old('productos', [])) ? 'selected' : '' }}>
                                                    {{ $producto->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary">Crear Promoción</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection
@section('js')
@include('layout.script')
<script src="{{ asset('js/adminlte.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
<script src="{{asset('js/select2.js')}}"></script>

<script>
    $(document).ready(function () {
        $('#productos').select2({
            placeholder: 'Selecciona uno o más productos',
            allowClear: true
        });
    });

</script>

@endsection