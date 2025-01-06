@extends('layout.app')
@section('content')

<main class="app-main">
    <!--begin::App Content Header-->

    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="container-fluid">
        <div class="row my-4">
            <!-- Welcome Card -->
            <div class="col-lg-12">
                <div class="card shadow-sm bg-light">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-4">
                            <h4>Hola de nuevo, {{Auth::user()->name}} </h4>
                            <p class="text-muted mb-0">Sharli Online, tu tienda de confianza.</p>
                        </div>
                        <i class="bi bi-speedometer2 text-primary display-4 ms-auto"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Stats Cards -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <i class="bi bi-graph-up display-4 text-primary"></i>
                        <h5 class="card-title mt-3">Ventas</h5>
                        <p class="card-text text-muted"> {{$ventas}} </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <i class="bi bi-people-fill display-4 text-success"></i>
                        <h5 class="card-title mt-3">Usuarios</h5>
                        <p class="card-text text-muted"> {{$usuarios}} </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <i class="bi bi-shop-window display-4 text-warning"></i>
                        <h5 class="card-title mt-3">Productos</h5>
                        <p class="card-text text-muted"> {{$productos}} </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <i class="bi bi-cash-stack display-4 text-danger"></i>
                        <h5 class="card-title mt-3">Pagos pendientes</h5>
                        <p class="card-text text-muted"> {{$pagos}} </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <!-- Chart and Table -->
            <div class="col-lg-6">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Promociones Recientes</h5>
        </div>
        <div class="card-body">
            @if ($promociones->isEmpty())
                <div class="alert alert-info text-center">
                    No hay promociones recientes.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descuento (%)</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                @if(Auth::user()->hasRole('superAdmin'))
                                    <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promociones as $promocion)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $promocion->nombre }}</td>
                                    <td>{{ $promocion->descuento }}%</td>
                                    <td>{{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d/m/Y') }}</td>
                                    @if(Auth::user()->hasRole('superAdmin'))
                                        <td>
                                            <a href="{{ route('promociones.show', $promocion->id) }}" class="btn btn-primary btn-sm">
                                                Ver
                                            </a>
                                            <!-- Botón para editar o eliminar -->
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $promociones->links() }}
                </div>
            @endif
        </div>
    </div>
</div>


            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Pagos Pendientes</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <th>Monto Total</th>
                                    <th>Usuario</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pagoPendientes as $pago)
                                    <tr>
                                        <td>{{ $loop->iteration + ($pagoPendientes->currentPage() - 1) * $pagoPendientes->perPage() }}
                                        </td>
                                        <td>{{ $pago->tipo }}</td>
                                        <td>{{ $pago->status }}</td>
                                        <td>${{ number_format($pago->monto_total, 2) }}</td>
                                        <td>{{ $pago->user->name ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-primary btn-sm">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No hay pagos pendientes</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $pagoPendientes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            // Example Chart.js script
            const ctx = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May'],
                    datasets: [{
                        label: 'Revenue',
                        data: [1200, 1900, 3000, 5000, 2400],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true
                }
            });
        </script>

</main>

<!--begin::Footer-->
@include('layout.script')
<script src="{{ asset('js/adminlte.js') }}"></script>

@endsection