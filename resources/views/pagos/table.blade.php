<form id="taxesForm" action="{{ route('eliminarMultiplesPagos') }}" method="POST">
@csrf 
<div class="d-flex justify-content-end mb-3"> 
                        <button id="submitBtn" style="display: none;" class="btn btn-danger round">Eliminar multiples registros</button>
                        </div>

<div class="table-responsive">
    <table class="table table-hover" id="ventas-table">
        <thead class="bg-light">
            <tr>
                <th>#</th>
                <th></th>
                <th>Tipo</th>
                <th>Creado por</th>
                <th>Monto Total</th>  
                <th>Fecha</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>


</div>
</form>
@section('js')
@include('layout.script')
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>

<script type="text/javascript">
   $(document).ready(function() {
        $('#ventas-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('pagos.index') }}",
            dataType: 'json',
            type: "POST",
            columns: [
                {
                    data: 'status', // Utilizar el campo 'status' para obtener el estado y decidir si mostrar el checkbox
                    render: function (data, type, full, meta) {

                        return `<input type="checkbox" class="taxes-checkbox" style="transform: scale(1.5); margin-right: 5px; cursor: pointer; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); border: 2px solid #d1d1d1;" name="selected_taxes[]" value="${full.id}">`;

                    },
                    orderable: false,
                    searchable: false
                },
                { data: 'id', name: 'id' },
                { data: 'tipo', name: 'tipo' },
                { data: 'user', name: 'user' },
                { data: 'monto_total', name: 'monto_total' },
                { data: 'fecha', name: 'fecha' },
                { data: 'status', name: 'status' },
                { data: 'actions', name: 'actions', searchable: false, orderable: false }
            ],
            order: [[0, 'desc']],
            language: {
                lengthMenu: "Mostrar _MENU_ Registros por Página",
                zeroRecords: "Sin resultados",
                info: "",
                infoEmpty: "No hay Registros Disponibles",
                infoFiltered: "Filtrado _TOTAL_ de _MAX_ Registros Totales",
                search: "Buscar",
                paginate: {
                    next: ">",
                    previous: "<"
                }
            }
        });

        // Manejar el evento submit del formulario de eliminación
        $('.btn-delete').on('submit', function(e) {
            e.preventDefault(); // Evita el envío del formulario por defecto

            var form = $(this); // Obtiene el formulario actual

            Swal.fire({
                title: '¿Está seguro?',
                text: "El registro se eliminará permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.off('submit').submit(); // Permite el envío del formulario si se confirma
                }
            });
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