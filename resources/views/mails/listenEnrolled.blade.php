@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Echo.private('course-enrolled')
            .listen('CourseEnrolled', (e) => {
                alert(e.mensaje);
            });
    </script>
@endsection