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
  <!-- App features section-->
  @foreach ($promociones as $promocion)
  <h4 class="mt-4 text-center">{{ $promocion->nombre }}</h4>
  <div class="row p-5">
    @foreach ($promocion->productos as $producto)
    @php
    // Calculating the discounted price
    $precioConDescuento = $producto->precio_venta - ($producto->precio_venta * $promocion->descuento / 100);
  @endphp
    <a href="{{ route('detalles', $producto->id) }}" class="text-decoration-none">

    <div class="col-md-4 col-sm-6 mb-4">
      <div class="card h-100 shadow-sm p-3">
      <img src="{{ asset($producto->imagenes->first()->url ?? 'default-image.jpg') }}" class="card-img-top"
      alt="Product Image" style="height: 400px;">
      <div class="card-body">

      <h5 class="card-title">{{ $producto->nombre }}</h5>
      <br>
      <div class="text-left">
      <br>
      <p><strong>Descuento:</strong> {{ $promocion->descuento }}%</p>
      <p><strong>Precio original:</strong>

        ${{ number_format($producto->precio_venta, 2, '.', ',') }}</p>
      <p><strong>Precio con descuento:</strong>
        ${{ number_format($precioConDescuento, 2, '.', ',') }}</p>

      @if($producto->tallas && $producto->tallas->count() > 0)
      <div class="mb-3 text-left">
      <h6 class="text-muted">Tallas Disponibles:</h6>
      <ul class="list-unstyled">
      @foreach($producto->tallas as $talla)
      <li>{{ $talla->talla }} ({{ $talla->cantidad }} disponibles)</li>
    @endforeach
      </ul>
      </div>
    @else
      <p class="text-muted">No hay tallas disponibles</p>
    @endif
      </div>
      </div>
      </div>
    </div>
    </a>
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