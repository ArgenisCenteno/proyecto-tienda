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
                                                                onclick="changeQuantity({{ $key }}, -1, {{ json_encode($item['nombre']) }}, {{ $item['precio'] }});">
                                                                <i class="fas fa-minus">-</i>
                                                            </button>

                                                            <input id="quantity-{{ $key }}" min="1" name="quantity"
                                                                value="{{ $item['cantidad'] }}" type="number"
                                                                class="form-control form-control-sm" readonly />

                                                            <button type="button" class="btn btn-link px-2"
                                                                onclick="changeQuantity({{ $key }}, 1, {{ json_encode($item['nombre']) }}, {{ $item['precio'] }});">
                                                                <i class="fas fa-plus">+</i>
                                                            </button>
                                                        </div>
                                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                            <h6 class="mb-0" id="subtotal-{{ $key }}">{{ number_format($item['precio'], 2) }} <small>Bs</small></h6>
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
                                                <div class="d-flex justify-content-between mb-5">
                                                    <h5 class="text-uppercase">Total a pagar</h5>
                                                    <h5 id="total-amount">{{ number_format($total, 2) }} BS</h5> <!-- Total with shipping -->
                                                </div>
                                                <a href="{{ route('pagar') }}" class="btn btn-dark btn-block btn-lg" style="background-color: #3E2F5B; width: 100%">
                                                    Pagar
                                                </a>
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
                        <h5>{{ number_format($total, 2) }} BS</h5>
                    </div>
                    
                    <hr class="my-4">
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
@include('layout.script')
<script src="{{ asset('js/sweetalert2.js') }}"></script>
<script>

    function updateSubtotal(index, price) {
        var quantity = document.getElementById('quantity-' + index).value;
        var subtotal = quantity * price;
        document.getElementById('subtotal-' + index).innerText = subtotal.toFixed(2) + ' Bs';
    }

    function updateTotalAmount() {
        let totalAmount = 0;
        const cartItems = document.querySelectorAll('[id^="quantity-"]'); // Select all quantity inputs

        cartItems.forEach(item => {
            const index = item.id.split('-')[1];
            const quantity = parseInt(item.value);
            const price = parseFloat(document.querySelector(`#subtotal-${index}`).innerText.split(' ')[0]); // Get the subtotal
            totalAmount += price * quantity; // Update the total
        });

        // Update the display for total amount
        document.getElementById('total-amount').innerText = totalAmount.toFixed(2) + ' BS'; // Update total display
    }

    function changeQuantity(index, change, product, price) {
        var quantityInput = document.getElementById('quantity-' + index);
        var newQuantity = parseInt(quantityInput.value) + change;

        if (newQuantity < 1) {
            newQuantity = 1;
        }

        quantityInput.value = newQuantity;
        updateSubtotal(index, price);
        updateTotalAmount(); // Update total amount when quantity changes

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

    function removeFromCart(index) {
        // Implement remove functionality
        console.log('Removing item at index:', index);
        // Make an AJAX call to remove item from the cart and refresh the page or update the cart view
    }

</script>
