<html>

<head></head>

<body>
    <img src="{{ $message->embed(public_path().'/landing/images/logo.jpg') }}" alt="">
    <h2> Datos del contacto </h2> <br>
    <strong> Nombre completo: </strong> {{ $fullname }}<br>
    <strong> Dirección de correo: </strong> {{ $email}}<br>
    <strong> Teléfono: </strong> {{ $tel }}<br>
    <strong> Mensaje: </strong> {{ $mensaje }}<br>
</body>

</html>
