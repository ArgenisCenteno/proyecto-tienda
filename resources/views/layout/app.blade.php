<html>
@include('layout.head')
<style>
    .bg-primary {
        background-color: #3E2F5B !important; /* Cambia el fondo */
    }

    .btn-primary {
        background-color: #3E2F5B !important; /* Cambia el fondo de los botones */
        border-color: #3E2F5B !important; /* Cambia el borde de los botones */
    }

    .text-primary {
        color: #3E2F5B !important; /* Cambia el texto si usas .text-primary */
    }
</style>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary bg-white">
    <div class="app-wrapper"> <!--begin::Header-->
    
    @include('layout.menu')
    @yield('content')
    
    @stack('third_party_scripts')
    @stack('page_scripts')
</div>  
@yield('js')
@include('layout.script')
@include('sweetalert::alert')
@include('layout.datatables_css')
@include('layout.datatables_js')
</body>
</html>