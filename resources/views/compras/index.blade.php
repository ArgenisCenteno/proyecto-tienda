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
                            <h3 class="p-2 bold">Compras</h3>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                                <a href="{{route('compras.comprar')}}" class="btn btn-primary  round mx-1" >Nueva Compra</a>
                        </div>
                    </div>
                    <div >
                  
                        @include('compras.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main> <!--end::App Main--> <!--begin::Footer-->
@endsection
