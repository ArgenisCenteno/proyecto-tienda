@extends('layout.app')
@section('content')
<main class="app-main"> <!--begin::App Content Header-->
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-0 my-5">
                        <div class="px-2 row">
                            <div class="col-lg-12">
                                @include('flash::message')
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Promociones</h3>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{route('promociones.create')}}" class="btn btn-primary  round mx-1">Crear promoción</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descuento (%)</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promociones as $promocion)
                                        <tr>
                                            <td>{{ $promocion->id }}</td>
                                            <td>{{ $promocion->nombre }}</td>
                                            <td>{{ $promocion->descuento }}</td>
                                            <td>{{ $promocion->fecha_inicio }}</td>
                                            <td>{{ $promocion->fecha_fin }}</td>
                                            <td>
                                                <a href="{{ route('promociones.show', $promocion->id) }}"
                                                    class="btn btn-info">Ver</a>
                                                <!-- Opción para agregar botón de editar o eliminar -->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Paginar las promociones (si es necesario) -->
                            {{ $promociones->links() }}
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