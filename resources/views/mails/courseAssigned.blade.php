<html>

<head></head>

<body>
    <img src="{{ $message->embed(public_path().'/landing/images/logo.jpg') }}" alt="">
    <h2> Hola, {{ $NameTeacher }} </h2> <br>
    <strong> Usted ha sido asignado al curso: </strong> {{ $NameCourse }}<br>
    <p> En breves momentos estaremos enviándole el temario del curso </p>

</body>

</html>
