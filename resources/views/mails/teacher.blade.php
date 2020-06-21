<html>

<head></head>

<body>
    <img src="{{ $message->embed(public_path().'/landing/images/logo.jpg') }}" alt="">
    <h2> Datos del correo </h2> <br>
    <strong> Profesor: </strong> {{ $teacher->name }}<br>
    <strong> Email: </strong> {{ $user->email }}<br>
    <strong> Mensaje: </strong> {{ $mensaje }}<br>

</body>

</html>
