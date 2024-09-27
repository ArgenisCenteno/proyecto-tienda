@extends('layouts.app')

@section('content')

<section class="h-100 py-5">
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-lg-9 mb-4">


                @if (session('cart') && count(session('cart')) > 0)
                    <section class="h-100 h-custom"
                        style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; border-radius: 16px">
                        <div class="container py-5 h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-12">
                                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                                        <div class="card-body p-0">
                                            <div class="p-5">
                                                <div class="d-flex justify-content-between align-items-center mb-5">
                                                    <h1 class="fw-bold mb-0" style="color: #3E2F5B">Mi cesta</h1>
                                                    <h6 class="mb-0 text-muted">{{ count(session('cart')) }} items</h6>
                                                </div>
                                                <hr class="my-4">

                                                @foreach (session('cart') as $key => $item)
                                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                                            <img src="{{ $item['imagen'] }}" class="img-fluid rounded-3"
                                                                alt="{{ $item['nombre'] }}">
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                                            <h6 class="text-muted">{{ $item['nombre'] }}</h6>
                                                            <h6 class="mb-0">{{ $item['nombre'] }}</h6>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                            <button type="button" class="btn btn-link px-2"
                                                                onclick="changeQuantity({{ $key }}, -1, '{{ addslashes($item['nombre']) }}', {{ $item['precio'] }});">
                                                                <i class="fas fa-minus">-</i>
                                                            </button>

                                                            <input id="quantity-{{ $key }}" min="1" name="quantity"
                                                                value="{{ $item['cantidad'] }}" type="number"
                                                                class="form-control form-control-sm" readonly />

                                                            <button type="button" class="btn btn-link px-2"
                                                                onclick="changeQuantity({{ $key }}, 1, '{{ addslashes($item['nombre']) }}', {{ $item['precio'] }});">
                                                                <i class="fas fa-plus">+</i>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                            <h6 class="mb-0">{{ number_format($item['precio'], 2) }}
                                                                <small>Bs</small>
                                                            </h6>
                                                        </div>
                                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                            <a href="#!" class="text-muted"
                                                                onclick="removeFromCart({{ $key }});"><i
                                                                    class="fas fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                    <hr class="my-4">
                                                @endforeach

                                                <div class="pt-5">
                                                    <h6 class="mb-0"><a href="#!" class="text-body"><i
                                                                class="fas fa-long-arrow-alt-left me-2"></i>Seguir
                                                            comprando</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @else
                    <p>Your cart is empty.</p>
                @endif


            </div>

            <div class="col-lg-3 bg-body-tertiary">
                <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Mi cuenta</h3>
                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="text-uppercase">Items
                            @if (session('cart') && count(session('cart')) > 0)
                                {{ count(session('cart')) }}
                            @else
                                0
                            @endif
                        </h5>
                        <h5> {{ number_format($total, 2) }} BS</h5>
                    </div>

                   

                    <h5 class="text-uppercase mb-3">Código de cupon</h5>

                    <div class="mb-5">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" id="promoCode" class="form-control form-control-lg" />
                            <label class="form-label" for="promoCode">Ingresa el código</label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-5">
                        <h5 class="text-uppercase">Total a pagar</h5>
                        <h5> {{ number_format($total + 5, 2) }} BS</h5> <!-- Assuming standard shipping fee -->
                    </div>

                    <a href="{{ route('pagar') }}" class="btn btn-dark btn-block btn-lg" style="background-color: #3E2F5B; width: 100%">
                        Pagar
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
@include('layout.script')
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script>

    function updateSubtotal(index, price) {

        // Obtener cantidad
        var quantity = document.getElementById('quantity-' + index).value;

        // Calcular el nuevo subtotal
        var subtotal = quantity * price;
        // changeQuantity(index, quantity, product, price)
        // Actualizar la visualización del subtotal
        document.getElementById('subtotal-' + index).innerText = 'Subtotal: ' + subtotal.toFixed(2) + ' Bs';

    }

    function changeQuantity(index, change, product, price) {
        // Obtener el input de cantidad
        var quantityInput = document.getElementById('quantity-' + index);
        //console.log(product)

        // Calcular la nueva cantidad
        var newQuantity = parseInt(quantityInput.value) + change;

        // Asegurarse de que la cantidad no sea menor a 1
        if (newQuantity < 1) {
            newQuantity = 1;
        }

        // Actualizar el valor del input
        quantityInput.value = newQuantity;

        // Llamar a la función para actualizar el subtotal
        updateSubtotal(index, price);

        // Hacer la solicitud AJAX para actualizar la cantidad en la sesión
        fetch('{{ route("carrito.actualizar") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product: product,
                cantidad: newQuantity
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message);
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>