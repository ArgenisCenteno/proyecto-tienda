@extends('layout.app')
@section('content')


<main class="app-main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                <form id="taxesForm" action="{{ route('eliminarMultiplesPromociones') }}" method="POST">

                    <div class="card border-0 my-5">
                        <div class="px-2 row">
                            <div class="col-lg-12">
                                                            <form id="taxesForm" action="{{ route('eliminarMultiplesRegistros') }}" method="POST">

                                @include('flash::message')
                            </div>
                            <div class="col-md-6 col-6">
                                <h3 class="p-2 bold">Promociones</h3>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{route('promociones.create')}}" class="btn btn-primary round mx-1">Crear
                                    promoción</a>
                                    <button id="submitBtn" style="display: none;" class="btn btn-danger round">Eliminar
                                    multiples registros</button>
                            </div>
                        </div>
                        <div class="card-body">
                                @csrf
                                <div class="d-flex justify-content-end mb-3">
                                  
                                </div>
                                <table id="promociones-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th></th>
                                            <th>Nombre</th>
                                            <th>Descuento (%)</th>
                                            <th>Fecha de Inicio</th>
                                            <th>Fecha de Fin</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody> <!-- Vacío porque los datos se cargan por AJAX -->
                                </table>
                           
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('js')
@include('layout.script') 

<script>
    $(document).ready(function () {
        $('#promociones-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("promociones.historia") }}', // Ruta que devolverá los datos en formato JSON
            columns: [
                {
                    data: 'id', // Utilizar el campo 'status' para obtener el estado y decidir si mostrar el checkbox
                    render: function (data, type, full, meta) {

                        return `<input type="checkbox" class="taxes-checkbox" style="transform: scale(1.5); margin-right: 5px; cursor: pointer; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); border: 2px solid #d1d1d1;" name="selected_taxes[]" value="${full.id}">`;

                    },
                    orderable: false,
                    searchable: false
                },
                { data: 'id', name: 'id' },
                { data: 'nombre', name: 'nombre' },
                { data: 'descuento', name: 'descuento' },
                { data: 'fecha_inicio', name: 'fecha_inicio' },
                { data: 'fecha_fin', name: 'fecha_fin' },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                }

            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            order: [[0, 'desc']],
        });
    });
</script>
<script type="text/javascript">
    $(document).on('change', '.taxes-checkbox', function () {
        toggleSubmitButton();
    });

    function toggleSubmitButton() {
        // Verifica si al menos un checkbox está seleccionado
        if ($('.taxes-checkbox:checked').length > 0) {
            $('#submitBtn').show();
        } else {
            $('#submitBtn').hide();
        }
    }
</script>
@endsection