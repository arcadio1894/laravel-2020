@extends('layouts.appLanding')

@section('header-page')
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url({{ asset('landing/images/bg_1.jpg')}})">
        <div class="container">
            <div class="row align-items-end justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="mb-0">{{ $course->name }}</h2>
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
            <a href="{{ route('landing.courses') }}">Courses</a>
            <span class="mx-3 icon-keyboard_arrow_right"></span>
            <span class="current">{{ $course->name }}</span>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <p>
                    @if ( $course->image == null )
                        <img src="{{ asset('images/courses/no_image.jpg') }}"  alt="Image" class="img-fluid ">
                    @else
                        <img src="{{ asset('images/courses/'.$course->image) }}" alt="Image" class="img-fluid ">
                    @endif
                </p>
            </div>
            <div class="col-lg-5 ml-auto align-self-center">
                <h2 class="section-title-underline mb-5">
                    <span>Detalles del curso</span>
                </h2>

                <p><strong class="text-black d-block">Docentes:
                    @foreach( $course->teachers as $teacher )
                    </strong> {{ $teacher->name }}<br>
                    @endforeach
                </p>
                <p class="mb-5"><strong class="text-black d-block">Horario:</strong> {{ $course->hours }}</p>
                <p>{{ $course->description }}</p>

                <ul class="ul-check primary list-unstyled mb-5">
                    <li>Lorem ipsum dolor sit amet consectetur</li>
                    <li>consectetur adipisicing  </li>
                    <li>Sit dolor repellat esse</li>
                    <li>Necessitatibus</li>
                    <li>Sed necessitatibus itaque </li>
                </ul>

                <p>
                    <a href="{{ route('send.course.enrolled', $course->id ) }}" class="btn btn-primary rounded-0 btn-lg px-5">Inscribirse</a>
                </p>

            </div>
            <div class="col-md-12 align-self-center">
                <h2 class="section-title-underline mb-2">
                    <span>Comentarios</span>
                </h2>
            </div>

            <my-comments-component v-bind:course_id="{{ json_encode( $course->id ) }}"></my-comments-component>

        </div>
    </div>
@endsection
