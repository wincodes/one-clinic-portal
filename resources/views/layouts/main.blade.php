<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Hospital and Clinic Management Software</title>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--Larvel Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!--Larvel Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!--Larvel Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">

        <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">

        <link rel="stylesheet" href="{{ asset('css/aos.css') }}">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    </head>
    <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
        <div class="site-wrap">
            <div class="site-mobile-menu site-navbar-target">
                <div class="site-mobile-menu-header">
                    <div class="site-mobile-menu-close mt-3">
                        <span class="icon-close2 js-menu-toggle"></span>
                    </div>
                </div>
                <div class="site-mobile-menu-body"></div>
            </div>
            <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="site-logo mr-auto w-25"><a href="{{ url('/') }}">Clinic Portals</a></div>
              
                        <div class="mx-auto text-center">
                          <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                              <li><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                              <li><a href="#packages" class="nav-link">Packages</a></li>
                              <li><a href="/register" class="nav-link">Register</a></li>
                              
                              {{--<li><a href="#teachers-section" class="nav-link">Teachers</a></li>  --}}
                            </ul>
                          </nav>
                        </div>
              
                        <div class="ml-auto w-25">
                          <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                              <li class="cta"><a href="#contact-section" class="nav-link"><span>Contact Us</span></a></li>
                            </ul>
                          </nav>
                          <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
                        </div>
                    </div>
                
                        @if (session('status'))
                        <hr>
                            <div class="alert alert-success" role="alert">
                                {!! session('status') !!}
                            </div>
                        @endif
                </div>
            </header>
            @yield('content')

            <footer class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                      <div class="border-top pt-5">
                      <p>
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Classic Technologies </a>
                      </p>
                      </div>
                    </div>
                    
            </footer>
       
        </div> <!-- site-wrap -->

        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
        <script src="{{ asset('js/jquery-ui.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
        <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
        <script src="{{ asset('js/aos.js') }}"></script>
        <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
        <script src="{{ asset('js/jquery.sticky.js') }}"></script>
                 
        <script src="{{ asset('js/main.js') }}"></script>
          
    </body>
</html>