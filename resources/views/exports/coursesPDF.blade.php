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
<h2><img src="" alt=""> Listado de cursos al {{ $date }}</h2>
<table>
    <thead>
    <tr>
        <th align="center" style="color:#000000; background: #95C6E5">N°</th>
        <th align="centar" style="color:#000000; background: #95C6E5">CURSO</th>
        <th align="centar" style="color:#000000; background: #95C6E5">DESCRIPCIÓN</th>
        <th align="centar" style="color:#000000; background: #95C6E5">IMAGEN</th>
        <th align="centar" style="color:#000000; background: #95C6E5">PRECIO</th>
        <th align="centar" style="color:#000000; background: #95C6E5">MODIFICADO</th>
        <th align="centar" style="color:#000000; background: #95C6E5">HORARIO</th>
        <th align="centar" style="color:#000000; background: #95C6E5">PROFESOR(ES)</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $courses as $key=>$course )
        <tr>
            <th align="center" style="color:#000000; background: #00BE67">{{ $key = $key+1 }}</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $course->name }}</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $course->description }}</th>
            <th align="center" style="color:#000000; background: #00BE67">
                @if( $course->image == null)
                    <img src="../public/images/courses/no_image.jpg" width="50px" height="50px" alt="">
                @else
                    <img src="../public/images/courses/{{ $course->image }}" width="50px" height="50px" alt="">
                @endif
            </th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $course->price }}</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $course->update_humans }}</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $course->hours }}</th>
            <th align="center" style="color:#000000; background: #00BE67">
                @foreach( $course->teachers as $key2=>$teacher )
                    <p>Profesor: {{ $teacher->name }} </p>
                    <b></b>
                @endforeach
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
</body>

</html>