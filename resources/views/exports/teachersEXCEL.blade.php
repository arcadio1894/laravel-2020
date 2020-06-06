<h2><img src="../public/landing/images/logo.jpg"></h2><br>
<h2>Listado de profesores al {{ $date }}</h2>
<table>
    <thead>
    <tr>
        <th align="center" style="color:#000000; background: #95C6E5">N°</th>
        <th align="center" style="color:#000000; background: #95C6E5">PROFESOR</th>
        <th align="center" style="color:#000000; background: #95C6E5">ESPECIALIDAD</th>
        <th align="center" style="color:#000000; background: #95C6E5">EXPERIENCIA</th>
        <th align="center" style="color:#000000; background: #95C6E5">PAIS</th>
        <th align="center" style="color:#000000; background: #95C6E5">TELEFONO</th>
        <th align="center" style="color:#000000; background: #95C6E5">IMAGEN</th>
        <th align="center"  style="color:#000000; background: #95C6E5">CURSOS</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $teachers as $key=>$teacher )
        <tr>
            <th align="center" style="color:#000000; background: #00BE67">{{ $key = $key+1 }}</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $teacher->name }}</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $teacher->speciality }}</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $teacher->years }} años</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $teacher->country }}</th>
            <th align="center" style="color:#000000; background: #00BE67">{{ $teacher->phone }}</th>
            <th align="center"  style="color:#000000; background: #00BE67">
                @if( $teacher->image == null)
                    <img src="../public/images/courses/no_image.jpg" width="50px" height="50px" alt="">
                @else
                    <img src="../public/images/teachers/{{ $teacher->image }}" width="50px" height="50px" alt="">
                @endif
            </th>
            <th align="center" style="color:#000000; background: #00BE67">
                @foreach( $teacher->courses as $course )
                    <strong>Curso: </strong> {{ $course->name }} <br>
                @endforeach
            </th>
        </tr>
    @endforeach
    </tbody>
</table>
