<aside class="app-sidebar bg-primary text-white shadow" data-bs-theme="dark" style="background-color: #3E2F5B !important"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand" style="border: none"> <!--begin::Brand Link--> <a href="{{route('home')}}" class="brand-link">
            <!--begin::Brand Image-->  <!--end::Brand Image--> <!--begin::Brand Text--> <span
                class="brand-text fw-light">Sharly Online</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
    <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{route('categorias.index')}}" class="nav-link">
                        <p>Categorías</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('subcategorias.index')}}" class="nav-link">
                        <p>Subcategorías</p>
                    </a>
                </li>

              

                <li class="nav-item">
                    <a href="{{route('almacen')}}" class="nav-link">
                        <p>Productos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pagos.index')}}" class="nav-link">
                        <p>Pagos</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('ventas.index')}}" class="nav-link">
                        <p>Ventas</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('compras.index')}}" class="nav-link">
                        <p>Compras</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('proveedores.index')}}" class="nav-link">
                        <p>Proveedores</p>
                    </a>
                </li>

           

                <li class="nav-item">
                    <a href="{{route('usuarios.index')}}" class="nav-link">
                        <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                           <p>Salir</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li> <!--end::Menu Footer-->
            </ul>
            <!--end::Sidebar Menu-->
        </nav>

    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar--> <!--begin::App Main-->