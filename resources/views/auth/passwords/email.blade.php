@extends('layouts.app')

@section('content')
<section class="vh-100 d-flex align-items-center justify-content-center" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h3 class="my-2">{{ __('Recuperar contraseña') }}</h3>
                    </div>
                    <div class="card-body p-4">
                        @if (session('status'))
                            <div class="alert alert-success text-center" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Email ') }}</label>
                                <input id="email" type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" required 
                                    placeholder="Ingresar email" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar') }}
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
