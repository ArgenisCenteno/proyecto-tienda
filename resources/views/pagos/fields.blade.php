<form action="{{ route('pagos.update', $pago->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row mb-4">
        <div class="col-md-6">
            <label for="tipo" class="form-label text-muted">Tipo</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="tipo" value="{{ $pago->tipo }}" readonly style="background-color: #ECF0F1;">
        </div>
        <div class="col-md-6">
            <label for="fecha_pago" class="form-label text-muted">Fecha de Pago</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="fecha_pago" value="{{ $pago->fecha_pago }}" readonly style="background-color: #ECF0F1;">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <label for="monto_total" class="form-label text-muted">Monto Total</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="monto_total" value="{{ $pago->monto_total }}" readonly style="background-color: #ECF0F1;">
        </div>
        <div class="col-md-6">
            <label for="monto_neto" class="form-label text-muted">Monto Neto</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="monto_neto" value="{{ $pago->monto_neto }}" readonly style="background-color: #ECF0F1;">
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <label for="descuento" class="form-label text-muted">Descuento</label>
            <input type="text" class="form-control border-0 shadow-sm p-3" id="descuento" value="{{ $pago->descuento }}" readonly style="background-color: #ECF0F1;">
        </div>
       
    </div>

    <div class="mb-4">
        <label for="status" class="form-label text-muted">Estado</label>
        <select class="form-select border-0 shadow-sm p-3" id="status" name="status" required style="background-color: #ECF0F1;">
            <option value="Pendiente" {{ $pago->status == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Pagado" {{ $pago->status == 'Pagado' ? 'selected' : '' }}>Pagado</option>
            <option value="Rechazado" {{ $pago->status == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
        </select>
    </div>

    <div class="mb-4">
        <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm">Actualizar</button>
      
    </div>
</form>
