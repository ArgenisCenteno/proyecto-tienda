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
                                                            <h6 class="mb-0">{{ $item['talla'] }}</h6>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">


                                                            <input id="quantity-{{ $key }}" min="1" name="quantity"
                                                                value="{{ $item['cantidad'] }}" type="number"
                                                                class="form-control form-control-sm"
                                                                oninput="updateQuantity({{ $key }}, this.value, {{ json_encode($item['nombre']) }}, {{ $item['precio'] }}, {{ json_encode($item['talla']) }});" />



                                                        </div>
                                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                            <h6 class="mb-0" id="subtotal-{{ $key }}">
                                                                {{ number_format($item['precio'], 2) }} <small>$</small>
                                                            </h6>
                                                        </div>
                                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                            <button onclick="removeFromCart({{ $key }})" class="btn btn-danger">
                                                                Quitar
                                                            </button>
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
                                                    <h5 id="total-amount">{{ number_format($total, 2) }} $</h5>
                                                    <!-- Total with shipping -->
                                                </div>
                                                <a href="{{ route('pagar') }}" class="btn btn-dark btn-block btn-lg"
                                                    style="background-color: #3E2F5B; width: 100%">
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
                    @if(Auth::check())
                        <p>, {{ Auth::user()->name }}!</p>
                    @endif

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="text-uppercase">Items
                            @if (session('cart') && count(session('cart')) > 0)
                                {{ count(session('cart')) }}
                            @else
                                0
                            @endif
                        </h5>

                    </div>
                    <br>
                    <h5>Tasa del Dollar {{ number_format($dollar, 2) }} $</h5>
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
        document.getElementById('subtotal-' + index).innerText = subtotal.toFixed(2) + ' $';
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
        document.getElementById('total-amount').innerText = totalAmount.toFixed(2) + ' $'; // Update total display
    }
    function changeQuantity(index, change, product, price, talla) {
    var quantityInput = document.getElementById('quantity-' + index);

    // Obtener la cantidad actual del input
    var currentQuantity = parseInt(quantityInput.value);

    // Calcular la nueva cantidad
    var newQuantity = currentQuantity + change || 1;

    // Validar y asegurar que la cantidad sea al menos 1
    if (isNaN(newQuantity) || newQuantity < 1) {
        newQuantity = 1;
    }

    // Actualizar el campo de entrada con la nueva cantidad inmediatamente
    quantityInput.value = newQuantity;

    // Evitar continuar si la nueva cantidad es nula o cero
    if (!newQuantity || newQuantity <= 0) {
        quantityInput.value = 1; // Restablecer a 1 si está vacío o inválido
        return;
    }

    // Actualizar subtotal y total
    updateSubtotal(index, price);
    updateTotalAmount();

    // Enviar la cantidad actualizada al servidor
    fetch('{{ route("carrito.actualizar") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product: product,
            cantidad: newQuantity,
            talla: talla
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data.message);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: data.message || 'Ocurrió un problema al actualizar la cantidad.',
                });

                // Revertir la cantidad al valor inicial
                quantityInput.value = currentQuantity;
                updateSubtotal(index, price);
                updateTotalAmount();
            }
        })
        .catch(error => {
            console.error('Error:', error);

            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'No se pudo actualizar la cantidad. Inténtalo de nuevo.',
            });

            // Revertir la cantidad al valor inicial
            quantityInput.value = currentQuantity;
            updateSubtotal(index, price);
            updateTotalAmount();
        });
}



    // Store initial quantities for each product in an object or attribute
    let initialQuantities = {};
    function updateQuantity(index, quantity, product, price, talla) {
    // Asegurarse de que la cantidad sea al menos 1
    quantity = Math.max(1, parseInt(quantity) || 1);

    // Guardar la cantidad inicial si no se ha guardado previamente
    if (!initialQuantities[index]) {
        initialQuantities[index] = document.getElementById('quantity-' + index).value;
    }

    var quantityInput = document.getElementById('quantity-' + index);
    quantityInput.value = quantity; // Actualizar el campo de entrada con la nueva cantidad

    // Actualizar el subtotal y el monto total
    updateSubtotal(index, price);
    updateTotalAmount();

    // Enviar la cantidad actualizada al servidor mediante AJAX
    fetch('{{ route("carrito.actualizar") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product: product,
            cantidad: quantity,
            talla: talla
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data.message);
            } else {
                // Mostrar mensaje de error si ocurre un problema en el servidor
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: data.message || 'Ocurrió un problema al actualizar la cantidad.',
                });

                // Revertir el campo de entrada a su valor inicial
                quantityInput.value = initialQuantities[index];

                // Actualizar subtotal y total con la cantidad revertida
                updateSubtotal(index, price);
                updateTotalAmount();
            }
        })
        .catch(() => {
            // Mostrar mensaje de error si ocurre un problema en la conexión
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: 'No hay suficiente stock disponible.',
            });

            // Revertir el campo de entrada a su valor inicial
            quantityInput.value = initialQuantities[index];

            // Actualizar subtotal y total con la cantidad revertida
            updateSubtotal(index, price);
            updateTotalAmount();
        });
}




</script>
<script>
    function removeFromCart(index) {
        fetch(`{{ url('/carrito/eliminar/') }}/${index}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Producto eliminado del carrito.',
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Error!',
                        text: data.message || 'No se pudo eliminar el producto.',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);

            });
    }
</script>