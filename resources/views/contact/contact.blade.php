@extends('layouts.appLanding')

@section('header-page')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url({{ asset('landing/images/bg_1.jpg')}})">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">Contacto</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('breadcrumns')
    <div class="custom-breadcrumns border-bottom">
        <div class="container">
            <a href="{{ url('/') }}">Inicio</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">Contacto</span>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('send_contact') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="fname">Nombres</label>
                    <input type="text" id="fname" name="fname" class="form-control form-control-lg">
                </div>
                <div class="col-md-6 form-group">
                    <label for="lname">Apellidos</label>
                    <input type="text" id="lname" name="lname" class="form-control form-control-lg">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="eaddress">Dirección de correo</label>
                    <input type="text" id="eaddress" name="eaddress" class="form-control form-control-lg">
                </div>
                <div class="col-md-6 form-group">
                    <label for="tel">Teléfono</label>
                    <input type="text" id="tel" name="tel" class="form-control form-control-lg">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" cols="30" rows="8" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Enviar mensaje" class="btn btn-primary btn-lg px-5">
                </div>
            </div>
        </form>
    </div>
@endsection
