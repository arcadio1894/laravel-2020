<!DOCTYPE html>
<html lang="en">

<head>
    <title>Academics &mdash; Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('landing/fonts/icomoon/style.css') }}">

    <link rel="icon" type="image/ico" href="{{ asset('landing/images/icono.ico') }}" />

    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('landing/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('landing/css/jquery.fancybox.min.css') }}">

    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('landing/fonts/flaticon/font/flaticon.css') }}">

    <link rel="stylesheet" href="{{ asset('landing/css/aos.css') }}">
    <link href="{{ asset('landing/css/jquery.mb.YTPlayer.min.css') }}" media="all" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}">



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


    <div class="py-2 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 d-none d-lg-block">
                    <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Tienes una consulta?</a>
                    <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 966 514 574</a>
                    <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span> info@edesce.com</a>
                </div>
                <div class="col-lg-3 text-right">
                    <a href="{{ route('login') }}" class="small mr-3"><span class="icon-unlock-alt"></span> Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="small btn btn-primary px-4 py-2 rounded-0"><span class="icon-users"></span> Registro</a>
                </div>
            </div>
        </div>
    </div>
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

        <div class="container">
            <div class="d-flex align-items-center">
                <div class="site-logo">
                    <a href="{{ url('/') }}" class="d-block">
                        <img src="{{ asset('landing/images/logo.jpg') }}" alt="Image" class="img-fluid">
                    </a>
                </div>
                <div class="mr-auto">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                            <li>
                                <a href="{{ url('/') }}" class="nav-link text-left">Inicio</a>
                            </li>
                            <li class="has-children">
                                <a href="{{ url('/') }}" class="nav-link text-left">Acerca de Nosotros</a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/') }}">Nuestros profesores</a></li>
                                    <li><a href="{{ url('/') }}">Nuestra institución</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ url('/') }}" class="nav-link text-left">Admisiones</a>
                            </li>
                            <li>
                                <a href="{{ url('/') }}" class="nav-link text-left">Cursos</a>
                            </li>
                            <li>
                                <a href="{{ route('get_contact') }}" class="nav-link text-left">Contacto</a>
                            </li>
                        </ul>                                                                                                                                                                                                                                                                                          </ul>
                    </nav>

                </div>
                <div class="ml-auto">
                    <div class="social-wrap">
                        <a href="#"><span class="icon-facebook"></span></a>
                        <a href="#"><span class="icon-twitter"></span></a>
                        <a href="#"><span class="icon-linkedin"></span></a>

                        <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                                    class="icon-menu h3"></span></a>
                    </div>
                </div>

            </div>
        </div>

    </header>

    @yield('header-page')
    {{--<div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">Login</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>--}}

    @yield('breadcrumns')
    {{--<div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="index.html">Home</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Login</span>
        </div>
    </div>--}}

    <div class="site-section">
        <div class="container">

            {{-- START CONTENT --}}
            @yield('content')
            {{-- END CONTENT --}}

            {{--<div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="pword">Password</label>
                            <input type="text" id="pword" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Log In" class="btn btn-primary btn-lg px-5">
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </div>



    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <p class="mb-4"><img src="{{ asset('landing/images/logo.png') }}" alt="Image" class="img-fluid"></p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae nemo minima qui dolor, iusto iure.</p>
                    <p><a href="#">Learn More</a></p>
                </div>
                <div class="col-lg-3">
                    <h3 class="footer-heading"><span>Our Campus</span></h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Acedemic</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Our Interns</a></li>
                        <li><a href="#">Our Leadership</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Human Resources</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h3 class="footer-heading"><span>Our Courses</span></h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Math</a></li>
                        <li><a href="#">Science &amp; Engineering</a></li>
                        <li><a href="#">Arts &amp; Humanities</a></li>
                        <li><a href="#">Economics &amp; Finance</a></li>
                        <li><a href="#">Business Administration</a></li>
                        <li><a href="#">Computer Science</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h3 class="footer-heading"><span>Contact</span></h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Support Community</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Share Your Story</a></li>
                        <li><a href="#">Our Supporters</a></li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="copyright">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- .site-wrap -->

<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

<script src="{{ asset('landing/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('landing/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('landing/js/jquery-ui.js') }}"></script>
<script src="{{ asset('landing/js/popper.min.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('landing/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('landing/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('landing/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('landing/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('landing/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('landing/js/aos.js') }}"></script>
<script src="{{ asset('landing/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('landing/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('landing/js/jquery.mb.YTPlayer.min.js') }}"></script>




<script src="{{ asset('landing/js/main.js') }}"></script>

</body>

</html>