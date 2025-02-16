<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('nombre', 'Nombre:', ['class' => 'bold']) !!}
        {!! Form::text('nombre', $producto->nombre, ['class' => 'form-control round', 'required']) !!}
    </div>

    <!-- Descripción Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('descripcion', 'Descripción:', ['class' => 'bold']) !!}
        {!! Form::textarea('descripcion', $producto->descripcion, ['class' => 'form-control round', 'rows' => 3, 'required']) !!}
    </div>

    <!-- Precio Compra Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('precio_compra', 'Precio Compra:', ['class' => 'bold']) !!}
        {!! Form::number('precio_compra', $producto->precio_compra, ['class' => 'form-control round', 'step' => '0.01', 'id' => 'precio_compra', 'required']) !!}
        <p id="precio_compra_error" style="color: red; display: none;">El precio de compra no puede ser negativo.</p>
    </div>
</div>

<div class="row">
<div class="form-group col-sm-12 col-md-4">
        {!! Form::label('cantidad', 'Minimo Stock:', ['class' => 'bold']) !!}
        {!! Form::number('cantidad', $producto->cantidad, ['class' => 'form-control round', 'id' => 'cantidad', 'required']) !!}
        <p id="cantidad" style="color: red; display: none;">El precio de venta no puede ser negativo.</p>
    </div>
    <!-- Precio Venta Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('precio_venta', 'Precio Venta:', ['class' => 'bold']) !!}
        {!! Form::number('precio_venta', $producto->precio_venta, ['class' => 'form-control round', 'step' => '0.01', 'id' => 'precio_venta', 'required']) !!}
        <p id="precio_venta_error" style="color: red; display: none;">El precio de venta no puede ser negativo.</p>
    </div>

    <!-- Aplica IVA Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('aplica_iva', 'IVA:', ['class' => 'bold']) !!}
        {!! Form::select('aplica_iva', ['1' => 'Sí', '0' => 'No'], $producto->aplica_iva, ['class' => 'form-control round', 'required']) !!}
    </div>

    
</div>

<div class="row">
    <!-- Subcategoría Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('sub_categoria_id', 'Subcategoría:', ['class' => 'bold']) !!}
        {!! Form::select('sub_categoria_id', $subcategorias, $producto->sub_categoria_id, ['class' => 'form-control round', 'placeholder' => 'Selecciona una subcategoría', 'required']) !!}
    </div>

    <!-- Disponible Field -->
    <div class="form-group col-sm-12 col-md-4">
        {!! Form::label('disponible', 'Disponible:', ['class' => 'bold']) !!}
        {!! Form::select('disponible', ['1' => 'Disponible', '0' => 'No Disponible'], $producto->disponible, ['class' => 'form-control round', 'required']) !!}
    </div>



    <div class="row mt-4">
    <!-- Imágenes Existentes -->
    <div class="form-group col-sm-12 col-md-6">
        <div class="row">
            @foreach($imagenes as $imagen)
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset($imagen->url) }}" class="card-img-top img-thumbnail" alt="Imagen del producto" style="width: 200px; height: auto;">
                        <div class="card-body d-flex justify-content-center">
                            <button type="button" class="btn btn-danger btn-sm btn-remove-image"
                                data-url="{{ route('removerImagen', ['id' => $imagen->id]) }}">
                                <span>Eliminar</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Input para subir nuevas imágenes -->
    <div class="form-group col-sm-12 col-md-6">
        {!! Form::label('imagenes', 'Seleccionar Nuevas Imágenes:', ['class' => 'bold']) !!}
        {!! Form::file('imagenes[]', ['class' => 'form-control round', 'accept' => 'image/*', 'multiple' => true, 'id' => 'imagenes2']) !!}
        <small class="text-muted">Puedes subir hasta 5 nuevas imágenes.</small>
        <div class="form-group mt-3" id="imagenes-preview2"></div>
    </div>
</div>


<!-- Contenedor para previsualizar las imágenes -->
<div class="form-group col-sm-12 col-md-12" id="imagenes-preview"></div>
<div class="row" id="tallas_container">
    <!-- Itera sobre las tallas existentes y muestra un campo para cada una -->
    @foreach($producto->tallas as $index => $talla)
        <div class="row mb-2 talla-row" data-index="{{ $index }}">
            <div class="col-md-5">
                <select name="tallas[{{ $index }}][talla]" class="form-control talla-select" required>
                    <option value="">Seleccione una talla</option>
                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $opcionTalla)
                        <option value="{{ $opcionTalla }}" {{ $talla->talla == $opcionTalla ? 'selected' : '' }}>
                            {{ $opcionTalla }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <input type="number" name="tallas[{{ $index }}][cantidad]" class="form-control" placeholder="Cantidad" min="1" value="{{ $talla->cantidad }}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-talla">Eliminar</button>
            </div>
        </div>
    @endforeach
</div>

<!-- Botón para agregar una nueva talla -->
<div class="float-start">
<button type="button" id="add_talla" class="btn btn-success mt-3 mb-3">Agregar Talla</button>

</div>
<!-- Botones de acción -->
<div class="float-end">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary round', 'id' => 'submit_btn', 'disabled' => false]) !!}
</div>

<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let imagenesInput = document.getElementById('imagenes2');
        let previewContainer = document.getElementById('imagenes-preview2');
        let imagenesError = document.getElementById('imagenes_error2');

        // Función para manejar la previsualización y eliminación de imágenes
        imagenesInput.addEventListener('change', function (event) {
            let files = event.target.files;
            let maxFiles = 5; // Máximo de archivos permitidos

            // Limpiar la previsualización actual
            previewContainer.innerHTML = '';


            // Mostrar previsualización de cada imagen seleccionada
            Array.from(files).forEach((file) => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let imgContainer = document.createElement('div');
                    imgContainer.style.position = 'relative';
                    imgContainer.style.display = 'inline-block';
                    imgContainer.style.margin = '5px';

                    let img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';

                    let removeBtn = document.createElement('button');
                    removeBtn.innerText = 'Quitar';
                    removeBtn.classList.add('btn', 'btn-danger');

                    removeBtn.style.cursor = 'pointer';

                    removeBtn.addEventListener('click', function () {
                        imgContainer.remove();
                        let dt = new DataTransfer();
                        for (let i = 0; i < files.length; i++) {
                            if (files[i] !== file) {
                                dt.items.add(files[i]);
                            }
                        }
                        imagenesInput.files = dt.files;
                    });

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    previewContainer.appendChild(imgContainer);
                }
                reader.readAsDataURL(file);
            });
        });

        // Manejar eliminación de imágenes actuales
        $('.btn-remove-image').click(function (event) {
            event.preventDefault();
            var url = $(this).data('url');

            // Mostrar SweetAlert para confirmar la eliminación
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará la imagen permanentemente.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la petición AJAX para eliminar la imagen
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            Swal.fire(
                                '¡Eliminado!',
                                'La imagen ha sido eliminada exitosamente.',
                                'success'
                            );
                            location.reload(); // Recargar la página después de eliminar la imagen
                        },
                        error: function (error) {
                            console.error('Error al eliminar la imagen:', error);
                            Swal.fire(
                                'Error',
                                'Hubo un error al intentar eliminar la imagen.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let tallasContainer = document.getElementById('tallas_container');
        let addTallaBtn = document.getElementById('add_talla');

        // Inicializa el índice a partir de las tallas existentes
        let tallaIndex = {{ $producto->tallas->count() }};
        let tallasSeleccionadas = [];

        // Llena `tallasSeleccionadas` con las tallas actuales
        document.querySelectorAll('.talla-select').forEach(function (select) {
            if (select.value) tallasSeleccionadas.push(select.value);
        });

        // Función para agregar un nuevo campo de talla y cantidad
        addTallaBtn.addEventListener('click', function () {
            if (tallasSeleccionadas.length >= 5) {
                alert("Todas las tallas disponibles ya han sido seleccionadas.");
                return;
            }

            let tallaRow = document.createElement('div');
            tallaRow.classList.add('row', 'mb-2', 'talla-row');
            tallaRow.innerHTML = `
                <div class="col-md-5">
                    <select name="tallas[${tallaIndex}][talla]" class="form-control talla-select" required>
                        <option value="">Seleccione una talla</option>
                        ${['S', 'M', 'L', 'XL', 'XXL']
                            .filter(talla => !tallasSeleccionadas.includes(talla))
                            .map(talla => `<option value="${talla}">${talla}</option>`)
                            .join('')}
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="number" name="tallas[${tallaIndex}][cantidad]" class="form-control" placeholder="Cantidad" min="1" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-talla">Eliminar</button>
                </div>
            `;

            tallasContainer.appendChild(tallaRow);
            tallaIndex++;

            const selectTalla = tallaRow.querySelector('.talla-select');
            selectTalla.addEventListener('change', function () {
                const selectedTalla = selectTalla.value;

                if (selectedTalla && !tallasSeleccionadas.includes(selectedTalla)) {
                    tallasSeleccionadas.push(selectedTalla);
                } else {
                    selectTalla.value = "";
                    alert("Esta talla ya ha sido seleccionada. Elija otra.");
                }
            });

            tallaRow.querySelector('.remove-talla').addEventListener('click', function () {
                const tallaValue = selectTalla.value;
                tallaRow.remove();

                tallasSeleccionadas = tallasSeleccionadas.filter(talla => talla !== tallaValue);
            });
        });

        // Maneja las tallas existentes y evita duplicados en cambios
        document.querySelectorAll('.talla-row .talla-select').forEach(select => {
            select.addEventListener('change', function () {
                const selectedTalla = select.value;

                if (selectedTalla && !tallasSeleccionadas.includes(selectedTalla)) {
                    tallasSeleccionadas.push(selectedTalla);
                } else {
                    select.value = "";
                    alert("Esta talla ya ha sido seleccionada. Elija otra.");
                }
            });
        });

        // Maneja la eliminación de tallas existentes
        document.querySelectorAll('.remove-talla').forEach(button => {
            button.addEventListener('click', function () {
                const tallaValue = this.closest('.talla-row').querySelector('.talla-select').value;
                this.closest('.talla-row').remove();

                tallasSeleccionadas = tallasSeleccionadas.filter(talla => talla !== tallaValue);
            });
        });
    });
</script>
