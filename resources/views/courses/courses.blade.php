@extends('layouts.appLanding')

@section('header-page')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url({{ asset('landing/images/bg_1.jpg')}})">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">Courses</h2>
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
            <span class="current">Courses</span>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach( $courses as $course )
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="course-1-item">
                    <figure class="thumnail">
                        <a href="{{ route('landing.course', $course->id) }}">
                            @if ( $course->image == null )
                                <img src="{{ asset('images/courses/no_image.jpg') }}"  alt="Image" class="img-fluid course">
                            @else
                                <img src="{{ asset('images/courses/'.$course->image) }}" height="200px" alt="Image" class="img-fluid course">
                            @endif
                        </a>
                        <div class="price">{{ $course->price }}</div>
                        <div class="category"><h3>{{ $course->name }}</h3></div>
                    </figure>
                    <div class="course-1-content pb-4">
                        <h2>{{ substr($course->description, 0,  60) }} ...</h2>
                        <div class="rating text-center mb-3">
                            @switch( $course->stars )
                                @case( 1 )
                                <span class="icon-star text-warning"></span>
                                @break
                                @case( 2 )
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                @break
                                @case( 3 )
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                @break
                                @case( 4 )
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                @break
                                @case( 5 )
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                <span class="icon-star text-warning"></span>
                                @break
                            @endswitch
                        </div>
                        <p class="desc mb-4">{{ substr($course->hours, 0,  20) }}...</p>
                        <p><a href="{{ route('landing.course', $course->id) }}" class="btn btn-primary rounded-0 px-4">Inscribirse al curso</a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
