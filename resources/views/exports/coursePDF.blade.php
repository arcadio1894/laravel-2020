<!DOCTYPE html>
<html>
<head>
    <title>Cursos PDF</title>
    <style type="text/css">
        table{
            width: 100%;
            border:1px solid black;
        }
        td, th{
            border:1px solid black;
        }
    </style>
</head>

<body>
<h2><img src="../public/landing/images/logo.jpg"> Detalles del curso {{ $course[0]->name }} al {{ $date }}</h2>
<strong> Curso: </strong> {{ $course[0]->name }} <br>
<strong> Descripción: </strong> {{ $course[0]->description }} <br><br><br>
@if( $course[0]->image == null )
    <strong> Imagen: </strong> <img src="../public/images/courses/no_image.jpg" width="100px" height="100px"><br>
@else
    <strong> Imagen: </strong> <img src="../public/images/courses/{{ $course[0]->image }}" width="100px" height="100px"><br>
@endif
<strong> Precio referencial: </strong> {{ $course[0]->price }}<br>
<strong> Calificación: </strong> {{ $course[0]->stars }}<br>
<strong> Horario: </strong> {{ $course[0]->hours }}<br>
<strong> Docentes: </strong><br>
@foreach( $course[0]->teachers as $teacher )
    <strong> Docente: </strong> {{ $teacher->name }}<br>
    <strong> Especialidad: </strong> {{ $teacher->speciality }}<br>
    <strong> Tiempo de experiencia: </strong> {{ $teacher->years }}<br>
    <strong> Tiempo de experiencia: </strong> {{ $teacher->years }}<br>
    <strong> País: </strong> {{ $teacher->country }}<br><br>
    @if( $teacher->image == null )
        <strong> Image: </strong> <img src="../public/images/courses/no_image.jpg" width="50px" height="50px"><br>
    @else
        <strong> Image: </strong> <img src="../public/images/teachers/{{ $teacher->image }}" width="50px" height="50px">
        <br>
    @endif
@endforeach

</body>

</html>