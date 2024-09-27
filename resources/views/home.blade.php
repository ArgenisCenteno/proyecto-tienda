@extends('layout.app')
@section('content')

<main class="app-main"> 
    <!--begin::App Content Header-->
   
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content2"> 
    <div class="container-fluid pt-4 text-white bg-info w-100" >

            <!--begin::Row for Stats-->
            <div class="row">
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">35,210.43 BS</h5>
                        <span class="description-text">TOTAL EN VENTAS</span>
                    </div>
                </div>
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">10,390.90 BS</h5>
                        <span class="description-text">TOTAL EN COMPRAS</span>
                    </div>
                </div>
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">24,813.53 BS</h5>
                        <span class="description-text">TOTAL EN INVENTARIO</span>
                    </div>
                </div>
                <div class="col-sm-3 col-6">
                    <div class="description-block">
                        <h5 class="description-header">1200</h5>
                        <span class="description-text">VENTAS</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">35</h5>
                        <span class="description-text">COMPRAS</span>
                    </div>
                </div>
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">66</h5>
                        <span class="description-text">PRODUCTOS</span>
                    </div>
                </div>
                <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                        <h5 class="description-header">24</h5>
                        <span class="description-text">USUARIOS</span>
                    </div>
                </div>
                <div class="col-sm-3 col-6">
                    <div class="description-block">
                        <h5 class="description-header">1200</h5>
                        <span class="description-text">PROVEEDORES</span>
                    </div>
                </div>
            </div>
            <!--end::Row for Stats-->

            <!--begin::Charts Section-->
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="text-center">Rendimiento de Ventas y Compras</h4>
                    <canvas id="salesChart" style="height: 300px;"></canvas>
                </div>
            </div>

            <!--begin::Recent Activities Section-->
           
            <!--end::Recent Activities Section-->

        </div>
    </div>
    <!--end::App Content-->
</main> 

<!--begin::Footer-->
@include('layout.script')
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Ventas',
                data: [30000, 50000, 40000, 60000, 55000, 70000],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
            },
            {
                label: 'Compras',
                data: [15000, 20000, 18000, 22000, 21000, 25000],
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
