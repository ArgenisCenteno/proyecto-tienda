@extends('layouts.app')

@section('content')
<section class="text-center" style="margin-top: 100px">
  <div class="mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="margin-top: -100px; backdrop-filter: blur(30px);">
    <div class="py-5 px-md-5">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold mb-5">Formulario de Registro</h2>

          <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Nombre Completo</strong></label>
                <input type="text" id="name" name="name" class="form-control w-100" required />
                @error('name') <p class="text-danger">{{ $message }}</p> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Correo Electrónico</strong></label>
                <input type="email" id="email" name="email" class="form-control w-100" required />
                @error('email') <p class="text-danger">{{ $message }}</p> @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Cédula de Identidad</strong></label>
                <input type="text" id="cedula" name="cedula" class="form-control w-100" maxlength="8" required />
                <p class="text-danger" id="cedulaError" style="display: none;">Cédula inválida.</p>
                @error('cedula') <p class="text-danger">{{ $message }}</p> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Número de Teléfono</strong></label>
                <div class="d-flex">
                  <select id="area_code" name="area_code" class="form-control w-25 me-2" required>
                    <option value="">Seleccione</option>
                    <option value="0412">0412</option>
                    <option value="0414">0414</option>
                    <option value="0424">0424</option>
                    <option value="0426">0426</option>
                  </select>
                  <input type="text" id="phone" name="phone" class="form-control w-75" maxlength="7" required />
                </div>
                <p class="text-danger" id="phoneError" style="display: none;">Teléfono inválido. Debe tener 7 dígitos.</p>
                @error('phone') <p class="text-danger">{{ $message }}</p> @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Contraseña</strong></label>
                <div class="d-flex">
                  <input type="password" id="password" name="password" class="form-control w-85" required />
                  <button type="button" class="btn btn-outline-secondary w-15" onclick="togglePassword('password', 'togglePasswordIcon1')">
                    <i id="togglePasswordIcon1" class="bi bi-eye"></i>
                  </button>
                </div>
                <p class="text-danger" id="passwordError" style="display: none;">Debe incluir al menos 1 número y 1 carácter especial.</p>
                @error('password') <p class="text-danger">{{ $message }}</p> @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Confirmar Contraseña</strong></label>
                <div class="d-flex">
                  <input type="password" id="confirm_password" name="confirm_password" class="form-control w-85" required />
                  <button type="button" class="btn btn-outline-secondary w-15" onclick="togglePassword('confirm_password', 'togglePasswordIcon2')">
                    <i id="togglePasswordIcon2" class="bi bi-eye"></i>
                  </button>
                </div>
                <p class="text-danger" id="confirmPasswordError" style="display: none;">Las contraseñas no coinciden.</p>
                @error('confirm_password') <p class="text-danger">{{ $message }}</p> @enderror
              </div>
            </div>

            <button type="submit" id="submitButton" class="btn btn-primary btn-block mb-4" disabled>Registrarse</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('registerForm');
    const cedula = document.getElementById('cedula');
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const submitButton = document.getElementById('submitButton');

    const cedulaError = document.getElementById('cedulaError');
    const phoneError = document.getElementById('phoneError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    function validateCedula() {
        const cedulaPattern = /^[1-9][0-9]{6,7}$/;
        if (!cedulaPattern.test(cedula.value)) {
            cedula.classList.add('is-invalid');
            cedulaError.style.display = 'block';
            return false;
        } else {
            cedula.classList.remove('is-invalid');
            cedulaError.style.display = 'none';
            return true;
        }
    }

    function validatePhone() {
        const phonePattern = /^[0-9]{7}$/;
        if (!phonePattern.test(phone.value)) {
            phone.classList.add('is-invalid');
            phoneError.style.display = 'block';  
            return false;
        } else {
            phone.classList.remove('is-invalid');
            phoneError.style.display = 'none';
            return true;
        }
    }

    function validatePassword() {
    const passwordPattern = /^(?=.*[0-9])(?=.*[\W_]).{7,12}$/;
    if (!passwordPattern.test(password.value)) {
        password.classList.add('is-invalid');
        passwordError.style.display = 'block';
        passwordError.textContent = 'Debe incluir al menos 1 número, 1 carácter especial y tener entre 7 y 12 caracteres.';
        return false;
    } else {
        password.classList.remove('is-invalid');
        passwordError.style.display = 'none';
        return true;
    }
}

    function validateConfirmPassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.classList.add('is-invalid');
            confirmPasswordError.style.display = 'block';
            return false;
        } else {
            confirmPassword.classList.remove('is-invalid');
            confirmPasswordError.style.display = 'none';
            return true;
        }
    }

    function validateForm() {
        let isCedulaValid = validateCedula();
        let isPhoneValid = validatePhone();
        let isPasswordValid = validatePassword();
        let isConfirmPasswordValid = validateConfirmPassword();

        submitButton.disabled = !(isCedulaValid && isPhoneValid && isPasswordValid && isConfirmPasswordValid);
    }

    cedula.addEventListener('input', validateCedula);
    phone.addEventListener('input', validatePhone);
    password.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validateConfirmPassword);
    form.addEventListener('input', validateForm);
  });

  function togglePassword(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    if (field.type === "password") {
        field.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        field.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    }
  }
</script>
@endsection
