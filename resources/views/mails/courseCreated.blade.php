<html>

<head></head>

<body>
    <img src="{{ $message->embed(public_path().'/landing/images/logo.jpg') }}" alt="">
    <h2> Hola, Super Administrador </h2> <br>
    <strong> El administrador con nombre </strong> {{ $user->name }} ha creado un nuevo curso<br>
    <strong> El curso creado es </strong> {{ $course->name }}<br>
    <strong> En la fecha  </strong> {{ $course->created_at }}<br>
</body>

</html>
