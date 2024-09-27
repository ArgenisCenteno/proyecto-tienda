<div class="venta-detalle-container">
    <!-- Información General de la Venta -->
    <section class="info-general">
        <h5>Información de la Venta</h5>
        <div class="info-grid">
            <div>
                <label for="vendedor">Vendedor</label>
                <p>{{ $venta->vendedor->name ?? 'S/D' }}</p>
            </div>
            <div>
                <label for="cliente">Cliente</label>
                <p>{{ $venta->user->name }}</p>
            </div>
            <div>
                <label for="monto_total">Monto Total</label>
                <p>{{ number_format($venta->pago->monto_total, 2) }}</p>
            </div>
            <div>
                <label for="monto_neto">Monto Neto</label>
                <p>{{ number_format($venta->pago->monto_neto, 2) }}</p>
            </div>
            <div>
                <label for="status_pago">Estado del Pago</label>
                <p>{{ $venta->pago->status }}</p>
            </div>
            <div>
                <label for="fecha_venta">Fecha de Venta</label>
                <p>{{ $venta->created_at->format('Y-m-d') }}</p>
            </div>
        </div>
    </section>

    <!-- Detalles de los Productos -->
    <section class="detalle-venta">
        <h5>Detalles de los Productos</h5>
        <table class="table-venta">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Impuesto</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalleVentas as $detalle)
                <tr>
                    <td>{{ $detalle->id }}</td>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ number_format($detalle->precio_producto, 2) }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ number_format($detalle->neto, 2) }}</td>
                    <td>{{ number_format($detalle->impuesto, 2) }}</td>
                    <td>{{ number_format($detalle->impuesto + $detalle->neto, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Información del Pago -->
    <section class="info-pago">
        <h5>Información del Pago</h5>
        <div class="info-grid">
            <div>
                <label>ID Pago</label>
                <p>{{ $venta->pago->id }}</p>
            </div>
            <div>
                <label>Monto Total</label>
                <p>{{ number_format($venta->pago->monto_total, 2) }}</p>
            </div>
            <div>
                <label>Monto Neto</label>
                <p>{{ number_format($venta->pago->monto_neto, 2) }}</p>
            </div>
            <div>
                <label>Impuestos</label>
                <p>{{ number_format($venta->pago->impuestos, 2) }}</p>
            </div>
          
            <div>
                <label>Fecha de Pago</label>
                <p>{{ $venta->pago->fecha_pago }}</p>
            </div>
        </div>
    </section>

    <!-- Métodos de Pago -->
    <section class="metodos-pago">
        <h5>Métodos de Pago</h5>
        <table class="table-metodos">
            <thead>
                <tr>
                    <th>Método</th> 
                    <th>Banco Origen</th>
                    <th>Banco Destino</th>
                    <th>Número de Referencia</th>
                    <th>Monto BS</th>
                    <th>Monto USD</th>
                </tr>
            </thead>
            <tbody>
                @foreach (json_decode($venta->pago->forma_pago) as $pago)
                <tr>
                    <td>{{ $pago->metodo }}</td>
                    <td>{{ $pago->banco_origen }}</td>
                    <td>{{ $pago->banco_destino }}</td>
                    <td>{{ $pago->numero_referencia }}</td>
                    <td>{{ $pago->metodo == 'Divisa' ? number_format(0, 2) : number_format($pago->monto_bs, 2) }}</td>
                    <td>{{ $pago->metodo == 'Divisa' ? number_format($pago->monto_dollar, 2) : number_format(0, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>

<!-- CSS for new layout -->
<style>
    .venta-detalle-container {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    h2 {
        border-bottom: 2px solid #333;
        padding-bottom: 5px;
        margin-bottom: 20px;
    }
    .info-general, .detalle-venta, .info-pago, .metodos-pago {
        margin-bottom: 40px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .info-grid div {
        background: #f7f7f7;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    th {
        background: #f4f4f4;
    }
    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
