@extends('layouts.app')

@section('content')
<section class="vh-100 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h3 class="my-2">{{ __('Actualizar contraseña') }}</h3>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ $email ?? old('email') }}" readonly required 
                                    placeholder="Ingresar email" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="form-label">{{ __('Nueva Contraseña') }}</label>
                                <input id="password" type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required placeholder="Ingresar contraseña" 
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                                <input id="password-confirm" type="password" 
                                    class="form-control" name="password_confirmation" 
                                    required placeholder="Confirmar contraseña" 
                                    autocomplete="new-password">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <small>Back to Login</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
