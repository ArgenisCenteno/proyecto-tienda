@extends('layouts.app')

@section('content')
<section class="vh-120" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src=" {{ asset('imagenes/hero.webp') }}"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Sharli Online</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar sesión</h5>

                  <!-- Campo de Email -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required autofocus />
                    @error('email')
                      <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Campo de Contraseña -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="password">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                    @error('password')
                      <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                  </div>

                  <!-- Botón de Acceso -->
                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Acceder</button>
                  </div>

                  <!-- Enlaces -->
                  <a class="small text-muted" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">
                    ¿No tienes cuenta? <a href="{{ route('register') }}" style="color: #393f81;">Registrarse</a>
                  </p>
                  <a href="#!" class="small text-muted">Términos de uso.</a>
                  <a href="#!" class="small text-muted">Política de privacidad</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
