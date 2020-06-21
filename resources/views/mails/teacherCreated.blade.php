<html>

<head></head>

<body>
    <img src="{{ $message->embed(public_path().'/landing/images/logo.jpg') }}" alt="">
    <h2> Hola, Super Administrador </h2> <br>
    <strong> El administrador con nombre </strong> {{ $user->name }} ha registrado un nuevo profesor<br>
    <strong> El profesor registrado es </strong> {{ $teacher->name }}<br>
    <strong> En la fecha  </strong> {{ $teacher->created_at }}<br>
</body>

</html>
