<form action="{{ route('pagos.update', $pago->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row mb-4">
        <div class="col-md-6">
            <label for="tipo" class="form-label text-muted">Tipo</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="tipo" value="{{ $pago->tipo }}" readonly
                style="background-color: #ECF0F1;">
        </div>
        <div class="col-md-6">
            <label for="fecha_pago" class="form-label text-muted">Fecha de Pago</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="fecha_pago"
                value="{{ $pago->fecha_pago }}" readonly style="background-color: #ECF0F1;">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <label for="monto_total" class="form-label text-muted">Monto Total</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="monto_total"
                value="{{ $pago->monto_total }}" readonly style="background-color: #ECF0F1;">
        </div>
        <div class="col-md-6">
            <label for="monto_neto" class="form-label text-muted">Monto Neto</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="monto_neto"
                value="{{ $pago->monto_neto }}" readonly style="background-color: #ECF0F1;">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <label for="descuento" class="form-label text-muted">Descuento</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="descuento" value="{{ $pago->descuento }}"
                readonly style="background-color: #ECF0F1;">
        </div>

    </div>

    <div class="mb-4">
        <label for="status" class="form-label text-muted">Estado</label>
        <select class="form-select border-0 shadow-sm p-3" id="status" name="status" required
            style="background-color: #ECF0F1;">
            <option value="Pendiente" {{ $pago->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Pagado" {{ $pago->status == 'Pagado' ? 'selected' : '' }}>Pagado</option>
            <option value="Rechazado" {{ $pago->status == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
        </select>
    </div>
    <div class="row g-4" id="campos-pagos" style="display: none">
        <div class="col-md-6">
            <label for="metodo" class="form-label text-muted">Método de Pago</label>
            <select class="form-select border-0 shadow-sm p-3" id="metodo" name="metodo" required
                style="background-color: #ECF0F1;">
                <option value="" disabled selected>Seleccione un método de pago</option>
                <option value="Pago movil">Pago móvil</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Efectivo">Efectivo</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="banco_origen" class="form-label text-muted">Banco de Origen</label>
            <select class="form-select border-0 shadow-sm p-3" id="banco_origen" name="banco_origen"
                style="background-color: #ECF0F1;">
                <option value="" disabled selected>Selecciona tu banco de origen</option>
                <option value="Banesco">Banesco</option>
                <option value="Banco de Venezuela">Banco de Venezuela</option>
                <option value="Mercantil">Mercantil</option>
                <option value="BBVA Provincial">BBVA Provincial</option>
                <option value="Bicentenario">Bicentenario</option>
                <option value="Banco Exterior">Banco Exterior</option>
                <option value="Banco del Tesoro">Banco del Tesoro</option>
                <option value="Banco Nacional de Crédito">Banco Nacional de Crédito</option>
                <option value="Banco Sofitasa">Banco Sofitasa</option>
                <option value="Banco del Caroní">Banco del Caroní</option>
                <option value="Banco Plaza">Banco Plaza</option>
                <option value="Bancrecer">Bancrecer</option>
                <option value="Banco Activo">Banco Activo</option>
                <option value="Banco Agrícola de Venezuela">Banco Agrícola de Venezuela</option>
                <option value="100% Banco">100% Banco</option>

            </select>
        </div>

        <div class="col-md-6">
            <label for="banco_destino" class="form-label text-muted">Banco de Destino</label>
            <select class="form-select border-0 shadow-sm p-3" id="banco_destino" name="banco_destino"
                style="background-color: #ECF0F1;">
                <option value="" selected>Selecciona tu banco de destino</option>
                <option value="Mercantil">Mercantil</option>
                <option value="Banco de Venezuela">Banco de Venezuela</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="numero_referencia" class="form-label text-muted">Número de
                Referencia</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="numero_referencia"
                name="numero_referencia" maxlength="8" placeholder="12345678" pattern="\d{8}"
                title="Debe tener 8 dígitos" style="background-color: #ECF0F1;">
        </div>
 
    </div>
    <div class="mb-4">
        <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm">Actualizar</button>

    </div>
</form>


<script>
     $(document).ready(function () {
        $('#status').change(function () {
            var selectedRole = $(this).val();

            // Show document upload fields if the selected role is "Conductor"
            if (selectedRole === 'Pagado') { // Make sure the value matches the role name
                $('#campos-pagos').show();
            } else {
                $('#campos-pagos').hide();
            }
        });
    });
</script>