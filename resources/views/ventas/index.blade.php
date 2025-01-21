@extends('layout.app')
@section('content')
<main class="app-main"> <!--begin::App Content Header-->
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class=" border-0 my-5">
                    <div class="px-2 row">
                        <div class="col-lg-12">
                            @include('flash::message')
                        </div>
                        <div class="col-md-6 col-6">
                            <h3 class="p-2 bold">Ventas Generadas</h3>
                        </div>
                        @if(Auth::user()->hasRole('superAdmin|empleado'))
                        <form action="{{ route('ventas.export') }}" method="GET">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="start_date">Fecha Inicio</label>
                                        <input type="date" id="start_date" name="start_date" class="form-control"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="end_date">Fecha Fin</label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" required>
                                        <input type="hidden" value="EXCEL" name="type">

                                    </div>
                                    <div class="col">
                                    <label for="end_date">Acción</label>
                                    <button type="submit" class="btn btn-success form-control">Exportar</button>
                                       
                                    </div>
                                </div>
                               
                            </form>
                            @endif
                    </div>
                    <div>
                  
                        @include('ventas.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection
