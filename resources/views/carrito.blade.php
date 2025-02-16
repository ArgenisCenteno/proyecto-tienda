@extends('layouts.app')

@section('content')

<section class="h-100 py-5 mb-5">
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <!-- Carrito -->
            <div class="col-lg-9 mb-4">
                @if (session('cart') && count(session('cart')) > 0)
                    <section class="h-100 h-custom" style="box-shadow: rgba(0, 0, 0, 0.15) 0px 4px 12px; border-radius: 15px;">
                        <div class="container py-5 h-100">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card" style="border-radius: 15px;">
                                        <div class="card-body p-5">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h2 class="fw-bold" style="color: #3E2F5B">Tu Carrito</h2>
                                                <span class="text-muted">{{ count(session('cart')) }} items</span>
                                            </div>
                                            <hr>
                                            <!-- Productos en el carrito -->
                                            @foreach (session('cart') as $key => $item)
                                                <div class="row mb-4 align-items-center">
                                                    <div class="col-md-2 col-lg-2">
                                                        <img src="{{ $item['imagen'] }}" class="img-fluid rounded-3" alt="{{ $item['nombre'] }}">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3">
                                                        <h5 class="text-dark">{{ $item['nombre'] }}</h5>
                                                        <p class="text-muted mb-0">Talla: {{ $item['talla'] }}</p>
                                                    </div>
                                                    <div class="col-md-3 col-lg-2 d-flex">
                                                        <input id="quantity-{{ $key }}" min="1" name="quantity"
                                                            value="{{ $item['cantidad'] }}" type="number"
                                                            class="form-control"
                                                            oninput="updateQuantity({{ $key }}, this.value, {{ json_encode($item['nombre']) }}, {{ $item['precio'] }}, {{ json_encode($item['talla']) }});" />
                                                    </div>
                                                    <div class="col-md-2 col-lg-2 text-center">
                                                        <h6 id="subtotal-{{ $key }}" class="text-dark">
                                                            {{ number_format($item['precio'], 2) }} <small>$</small>
                                                        </h6>
                                                    </div>
                                                    <div class="col-md-2 col-lg-1 text-end">
                                                        <button onclick="removeFromCart({{ $key }})" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash"></i> Quitar
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach

                                            <!-- Resumen del pedido -->
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <a href="#" class="btn btn-link text-decoration-none">
                                                    <i class="fas fa-arrow-left"></i> Seguir comprando
                                                </a>
                                                <div>
                                                    <h4 class="text-dark mb-0">Total: 
                                                        <span id="total-amount" class="text-success">{{ number_format($total, 2) }} $</span>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @else
                    <div class="text-center py-5">
                        <h4 class="text-muted">Tu carrito está vacío</h4>
                        <a href="#" class="btn btn-outline-primary mt-3">Ir a comprar</a>
                    </div>
                @endif
            </div>

            <!-- Resumen y detalles del usuario -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">Tu carrito</h3>
                        @if(Auth::check())
                            <p class="mb-4">¡Hola, <strong>{{ Auth::user()->name }}</strong>!</p>
                        @endif
                        <hr>
                        <h5 class="text-muted">Detalles</h5>
                        <p class="mb-2">Items en el carrito: 
                            <strong>{{ session('cart') ? count(session('cart')) : 0 }}</strong>
                        </p>
                        <p class="mb-2">Tasa del dólar: 
                            <strong>{{ number_format($dollar, 2) }} $</strong>
                        </p>
                        <hr>
                        <a href="{{ route('pagar') }}" class="btn btn-lg btn-primary px-5" style="background-color: #3E2F5B;">
                                                    Pagar
                                                </a>
                    </div>
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