@extends('layouts.appLanding')

@section('header-page')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url({{ asset('landing/images/bg_1.jpg')}})">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">Teachers</h2>
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
            <span class="current">Teachers</span>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach( $teachers as $teacher )
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="course-1-item">
                    <figure class="thumnail">
                        <a href="#">
                            @if ( $teacher->image == null )
                                <img src="{{ asset('images/teachers/no_image.jpg') }}"  alt="Image" class="img-fluid course">
                            @else
                                <img src="{{ asset('images/teachers/'.$teacher->image) }}" height="200px" alt="Image" class="img-fluid course">
                            @endif
                        </a>
                        <div class="category"><h3>{{ $teacher->name }}</h3></div>
                        <div class="price"><h3>{{ $teacher->speciality }}</h3></div>
                    </figure>
                    <div class="course-1-content pb-4">
                        <h2>{{ $teacher->country }}</h2>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
