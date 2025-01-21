<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Tipo</th>
         
            <th>Monto Total</th>
            <th>Monto Neto</th>
            <th>Descuento</th>
            <th>Forma de Pago</th>
            <th>Impuestos</th>
            <th>Metodo de Pago</th>
            <th>Usuario Creador</th>
            <th>Ventas Asociadas</th>
         
        </tr>
    </thead>
    <tbody>
        @foreach($pagos as $pago)
            <tr>
                <td>{{ $pago->id }}</td>
                <td>{{ $pago->fecha_pago }}</td>
                <td>{{ $pago->tipo }}</td>
                 
                <td>{{ $pago->monto_total }}</td>
                <td>{{ $pago->monto_neto }}</td>
                <td>{{ $pago->descuento }}</td>
                <td>{{ $pago->forma_pago }}</td>
                <td>{{ $pago->impuestos }}</td>
                <td>{{ $pago->user->name ?? 'N/A' }}</td>
                <td>
                    @foreach($pago->ventas as $venta)
                        Venta ID: {{ $venta->id }}, Monto: {{ $venta->monto_total }}<br>
                    @endforeach
                </td>
               
            </tr>
        @endforeach
    </tbody>
</table>
