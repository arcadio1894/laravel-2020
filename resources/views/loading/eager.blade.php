@foreach( $courses as $course )
    <p>{{ $course->name }}</p>
    <p>{{ $course->description }}</p>
    <p>Docentes: </p>
    @foreach( $course->teachers as $teacher )
        <p>{{ $teacher->name }}</p>
    @endforeach
@endforeach

{{--
@foreach( $courses as $course )
    <p>{{ $course->name }}</p>
    <p>{{ $course->description }}</p>
    <p>Temas: </p>
    @foreach( $course->subjects as $subject )
        <p>{{ $subject->name }}</p>
    @endforeach
@endforeach--}}
