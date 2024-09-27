@extends('layouts.app')

@section('content')
<!-- Section: Design Block -->
<section class="text-center" style="margin-top: 100px">
  <div class="mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
        margin-top: -100px;
        backdrop-filter: blur(30px);
        ">
    <div class="py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Formulario de Registro</h2>

          <!-- Formulario de registro -->
          <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf <!-- Token CSRF para Laravel -->

            <!-- Nombre y Correo Electrónico -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <label class="form-label" for="name"><strong>Nombre Completo</strong></label>
                  <input type="text" id="name" name="name" class="form-control" required />
                  @error('name')
                  <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
                  @enderror
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <label class="form-label" for="email"><strong>Correo Electrónico</strong></label>
                  <input type="email" id="email" name="email" class="form-control" required />
                  @error('email')
                  <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
                  @enderror
                </div>
              </div>
            </div>

            <!-- Cédula de Identidad -->
            <div class="form-outline mb-4">
              <label class="form-label" for="cedula"><strong>Cédula de Identidad</strong></label>
              <input type="text" id="cedula" name="cedula" class="form-control" required />
              <p class="text-danger" id="cedulaError" style="display: none;">Cédula inválida.</p>
              @error('dni')
              <p class="text-danger">{{ $message }}</p> <!-- Mostrar error de validación -->
              @enderror
            </div>

            <!-- Sector, Calle y Casa -->
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="form-outline">
                  <label class="form-label" for="sector"><strong>Sector</strong></label>
                  <input type="text" id="sector" name="sector" class="form-control" />
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-outline">
                  <label class="form-label" for="calle"><strong>Calle</strong></label>
                  <input type="text" id="calle" name="calle" class="form-control" />
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-outline">
                  <label class="form-label" for="casa"><strong>Casa</strong></label>
                  <input type="text" id="casa" name="casa" class="form-control" />
                </div>
              </div>
            </div>

            <!-- Teléfono -->
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="form-outline">
                  <label class="form-label" for="area_code"><strong>Código de Área</strong></label>
                  <select id="area_code" name="area_code" class="form-control" required>
                    <option value="">Seleccione</option>
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0426">0426</option>
                    <!-- Agregar más códigos de área según sea necesario -->
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-outline">
                  <label class="form-label" for="phone"><strong>Número de Teléfono</strong></label>
                  <input type="text" id="phone" name="phone" class="form-control" required />
                </div>
              </div>
            </div>

            <!-- 2 columnas para Contraseña y Confirmar Contraseña -->
            <div class="row">
              <div class="col-md-6 mb-4">
                <div class="form-outline position-relative">
                  <label class="form-label" for="password"><strong>Contraseña</strong></label>
                  <input type="password" id="password" name="password" class="form-control" required />
                  <span class="position-absolute top-50 end-0 translate-middle-y mt-4 me-3" style="cursor: pointer;" onclick="togglePasswordVisibility('password')">
                    <i class="material-icons">visibility</i>
                  </span>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                <div class="form-outline position-relative">
                  <label class="form-label" for="confirm_password"><strong>Confirmar Contraseña</strong></label>
                  <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
                  <span class="position-absolute top-50 end-0 translate-middle-y mt-4 me-2" style="cursor: pointer;" onclick="togglePasswordVisibility('confirm_password')">
                    <i class="material-icons">visibility</i>
                  </span>
                  <p class="text-danger" id="passwordError" style="display: none;">Las contraseñas no coinciden.</p>
                </div>
              </div>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary btn-block mb-4">
              Registrarse
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->

<!-- Scripts para validar cédula y contraseñas -->
<script>
  document.getElementById('registerForm').addEventListener('submit', function (event) {
    // Obtener valores
    const cedula = document.getElementById('cedula').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    let valid = true;

    // Validar cédula (7 u 8 dígitos, sin letras, y no puede empezar con cero)
    const cedulaPattern = /^[1-9][0-9]{6,7}$/;
    if (!cedulaPattern.test(cedula)) {
      valid = false;
      document.getElementById('cedulaError').style.display = 'block';
    } else {
      document.getElementById('cedulaError').style.display = 'none';
    }

    // Validar que las contraseñas coincidan
    if (password !== confirmPassword) {
      valid = false;
      document.getElementById('passwordError').style.display = 'block';
    } else {
      document.getElementById('passwordError').style.display = 'none';
    }

    // Prevenir el envío del formulario si hay errores
    if (!valid) {
      event.preventDefault();
    }
  });

  // Función para alternar la visibilidad de la contraseña
  function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  }
</script>
@endsection
