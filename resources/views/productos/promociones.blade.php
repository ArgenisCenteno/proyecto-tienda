@extends('layout.app')

@section('content')
<div class="container">
    <h1>Crear Nueva Promoción</h1>

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

        <div class="form-group">
            <label for="nombre">Nombre de la Promoción</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descuento">Descuento (%)</label>
            <input type="number" name="descuento" class="form-control" min="0" max="100" value="{{ old('descuento') }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
        </div>

        <div class="form-group">
            <label for="productos">Seleccionar Productos</label>
            <select name="productos[]" class="form-control" multiple required>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Promoción</button>
    </form>
</div>
@endsection
