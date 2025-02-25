@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

<body id="page-top">
  <!-- Navigation-->

  <!-- Mashead header-->
  <header class="masthead text-center" style="background: #fff; padding: 100px 0;">
  <div class="container px-5">
    <div class="row gx-5 align-items-center">
      <div class="col-lg-6">
        <!-- Texto principal -->
        <div class="mb-5 mb-lg-0 text-center text-lg-start">
          <h1 class="display-4 fw-bold mb-3 text-dark">Bienvenido a <span class="text-primary">Sharli Online</span></h1>
          <p class="lead fw-normal text-muted mb-4">
            Moda para todos los estilos. Descubre las últimas tendencias en ropa para mujeres, hombres y niños.
          </p>
          <a href="{{route('login')}}" class="btn btn-primary btn-lg px-4">Acceder</a> 
         
        </div>
      </div>
      <div class="col-lg-6">
        <!-- Imagen destacada -->
        <div class="text-center">
          <img src="https://images.pexels.com/photos/30628347/pexels-photo-30628347/free-photo-of-mujer-elegante-con-chaqueta-de-lentejuelas-negras-con-sombra.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" 
               alt="Moda en Sharli Online" 
               class="img-fluid rounded shadow" 
               style="max-width: 80%;">
        </div>
      </div>
    </div>
  </div>
</header>


  <!-- Quote/testimonial aside-->
  <aside class="text-center bg-gradient-primary-to-secondary">
    <div class="container px-5">
      <div class="row gx-5 justify-content-center">
        <div class="col-xl-8">
          <div class="h2 fs-1 text-white mb-4">"¡EXPLORA NUESTRAS OFERTAS!
             </div>
       
        </div>
      </div>
    </div>
  </aside>
  @foreach ($promociones as $promocion)
    <h4 class="mt-4 text-center text-primary fw-bold">{{ $promocion->nombre }}</h4>
    
    <div class="row p-5 justify-content-center">
        @foreach ($promocion->productos as $producto)
            @php
                // Calculando el precio con descuento
                $precioConDescuento = $producto->precio_venta - ($producto->precio_venta * $promocion->descuento / 100);
            @endphp

            <div class="col-lg-4 col-md-6 mb-4">
                <a href="{{ route('detalles', $producto->id) }}" class="text-decoration-none">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden product-card">
                        <div class="image-container">
                            <img src="{{ asset($producto->imagenes->first()->url ?? 'default-image.jpg') }}" 
                                class="card-img-top" alt="{{ $producto->nombre }}">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-dark">{{ $producto->nombre }}</h5>
                            <p class="text-muted mb-2">Descuento: <strong class="text-success">{{ $promocion->descuento }}%</strong></p>
                            <p class="text-muted"><del>${{ number_format($producto->precio_venta, 2, '.', ',') }}</del></p>
                            <p class="text-danger fw-bold h5">${{ number_format($precioConDescuento, 2, '.', ',') }}</p>
                            
                            @if($producto->tallas && $producto->tallas->count() > 0)
                                <div class="text-muted small">
                                    <h6 class="fw-bold">Tallas Disponibles:</h6>
                                    <ul class="list-inline mb-0">
                                        @foreach($producto->tallas as $talla)
                                            <li class="list-inline-item badge bg-secondary">{{ $talla->talla }} ({{ $talla->cantidad }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p class="text-muted small">No hay tallas disponibles</p>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endforeach
  <!-- Call to action section-->
  <section class="cta">
    <div class="cta-content">
      <div class="container px-5">
        <h2 class="text-white display-1 lh-1 mb-4">
         ¿Aún no estas registrado?
          <br />
         
        </h2>
        <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="{{route('register')}}" 
          target="_blank">Registrarse</a>
      </div>
    </div>
  </section>
  <!-- App badge section-->
  <section class="bg-gradient-primary-to-secondary" id="download">
    <div class="container px-5">
      <h2 class="text-center text-white font-alt mb-4"¡Estamos a la orden!</h2>
      <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center">
       
  
      </div>
    </div>
  </section>
  <!-- Footer-->
  
  <!-- Feedback Modal-->
  <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-gradient-primary-to-secondary p-4">
          <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Send feedback</h5>
          <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-0 p-4">
          <!-- * * * * * * * * * * * * * * *-->
          <!-- * * SB Forms Contact Form * *-->
          <!-- * * * * * * * * * * * * * * *-->
          <!-- This form is pre-integrated with SB Forms.-->
          <!-- To make this form functional, sign up at-->
          <!-- https://startbootstrap.com/solution/contact-forms-->
          <!-- to get an API token!-->
          <form id="contactForm" data-sb-form-api-token="API_TOKEN">
            <!-- Name input-->
            <div class="form-floating mb-3">
              <input class="form-control" id="name" type="text" placeholder="Enter your name..."
                data-sb-validations="required" />
              <label for="name">Full name</label>
              <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
            </div>
            <!-- Email address input-->
            <div class="form-floating mb-3">
              <input class="form-control" id="email" type="email" placeholder="name@example.com"
                data-sb-validations="required,email" />
              <label for="email">Email address</label>
              <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
              <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
            </div>
            <!-- Phone number input-->
            <div class="form-floating mb-3">
              <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890"
                data-sb-validations="required" />
              <label for="phone">Phone number</label>
              <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
            </div>
            <!-- Message input-->
            <div class="form-floating mb-3">
              <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..."
                style="height: 10rem" data-sb-validations="required"></textarea>
              <label for="message">Message</label>
              <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
            </div>
            <!-- Submit success message-->
            <!---->
            <!-- This is what your users will see when the form-->
            <!-- has successfully submitted-->
            <div class="d-none" id="submitSuccessMessage">
              <div class="text-center mb-3">
                <div class="fw-bolder">Form submission successful!</div>
                To activate this form, sign up at
                <br />
                <a
                  href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
              </div>
            </div>
            <!-- Submit error message-->
            <!---->
            <!-- This is what your users will see when there is-->
            <!-- an error submitting the form-->
            <div class="d-none" id="submitErrorMessage">
              <div class="text-center text-danger mb-3">Error sending message!</div>
            </div>
            <!-- Submit Button-->
            <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg disabled" id="submitButton"
                type="submit">Submit</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JS-->
   <!-- Core theme JS-->
 
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
  <!-- * *                               SB Forms JS                               * *-->
  <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
  <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
   
</body>
@include('layout.script')
<script>
  /*!
* Start Bootstrap - New Age v6.0.7 (https://startbootstrap.com/theme/new-age)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-new-age/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

// Activate Bootstrap scrollspy on the main nav element
const mainNav = document.body.querySelector('#mainNav');
if (mainNav) {
    new bootstrap.ScrollSpy(document.body, {
        target: '#mainNav',
        offset: 74,
    });
};

// Collapse responsive navbar when toggler is visible
const navbarToggler = document.body.querySelector('.navbar-toggler');
const responsiveNavItems = [].slice.call(
    document.querySelectorAll('#navbarResponsive .nav-link')
);
responsiveNavItems.map(function (responsiveNavItem) {
    responsiveNavItem.addEventListener('click', () => {
        if (window.getComputedStyle(navbarToggler).display !== 'none') {
            navbarToggler.click();
        }
    });
});

});

</script>
@endsection
<!-- Estilos personalizados -->
<style>
    /* Estilos para la tarjeta */
    .product-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .product-card:hover {
        transform: scale(1.05);
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
    }

    /* Estilos para la imagen */
    .image-container {
        overflow: hidden;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .image-container img {
        width: 100%;
        height: 350px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .image-container:hover img {
        transform: scale(1.1);
    }
</style>