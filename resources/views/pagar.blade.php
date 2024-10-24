@extends('layout.app')

@section('content')

<section class="h-100 py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white" style="background-color: #2C3E50;">
                        <h3 class="fw-bold mb-0 text-center">Pago de Orden</h3>
                    </div>
                    <div class="card-body px-4 py-5">
                        <form action="{{route('pagarCuenta')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label for="metodo" class="form-label text-muted">Método de Pago</label>
                                    <select class="form-select border-0 shadow-sm p-3" id="metodo" name="metodo"
                                        required style="background-color: #ECF0F1;">
                                        <option value="" disabled selected>Seleccione un método de pago</option>
                                        <option value="Pago movil">Pago móvil</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Efectivo">Efectivo (Pagar en tienda)</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="banco_origen" class="form-label text-muted">Banco de Origen</label>
                                    <select class="form-select border-0 shadow-sm p-3" id="banco_origen"
                                        name="banco_origen" required style="background-color: #ECF0F1;">
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
                                    <select class="form-select border-0 shadow-sm p-3" id="banco_destino"
                                        name="banco_destino" required style="background-color: #ECF0F1;">
                                        <option value="" disabled selected>Selecciona tu banco de destino</option>
                                        <option value="Mercantil">Mercantil</option>
                                        <option value="Banco de Venezuela">Banco de Venezuela</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="numero_referencia" class="form-label text-muted">Número de
                                        Referencia</label>
                                    <input type="text" class="form-control border-0 shadow-sm p-3"
                                        id="numero_referencia" name="numero_referencia" maxlength="8"
                                        placeholder="12345678" pattern="\d{8}" title="Debe tener 8 dígitos" required
                                        style="background-color: #ECF0F1;">
                                </div>

                                <div class="col-md-12">
                                    <label for="comprobante" class="form-label text-muted">Comprobante de Pago</label>
                                    <input type="file" class="form-control border-0 shadow-sm p-3" id="comprobante"
                                        name="comprobante" required style="background-color: #ECF0F1;">
                                </div>
                            </div>
                            <div class="row g-4 mt-4">
                                <div class="col-md-4 text-center">
                                    <p class="fw-bold mb-0 text-muted">Total:</p>
                                    <p class="text-primary mb-0 fw-bold">{{ number_format($total * $dollar->valor, 2) }}
                                        Bs</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <p class="fw-bold mb-0 text-muted">Impuesto:</p>
                                    <p class="text-primary mb-0 fw-bold">
                                        {{ number_format($impuesto * $dollar->valor, 2) }} Bs</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    <p class="fw-bold mb-0 text-muted">Monto a Pagar:</p>
                                    <p class="text-primary mb-0 fw-bold">
                                        {{ number_format($montoTotal * $dollar->valor, 2) }} Bs</p>
                                    <input type="hidden" name="montoTotal" value="{{ $montoTotal * $dollar->valor }}">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm mt-4">Realizar
                                Pago</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@include('layout.script')
<script src="{{asset('js/sweetalert2.js')}}"></script>