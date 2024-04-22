<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('imagenesTienda/favicon.ico') }}" sizes="64x64" type="image/x-icon">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <section class="container-fluid navegacion">
        <nav class="navbar bg-light fixed-top d-flex justify-content-center">
            <a class="navbar-brand color-nav d-flex" href="/pawsTails">
                <img src="{{ asset('imagenesTienda/imagen sin fondo.png') }}" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <section class="container d-flex justify-content-center align-items-center contenedor-formulario">
        <form action="/pawsTails/comprobarLogin" class="w-100" method="post">
            @csrf
            <h6 class="display-6 text-center">Acceder</h6>
            @if (session('exito'))
                <section class="container-fluid d-flex justify-content-center">
                    <section class="alert alert-success" role="alert">{{ session('exito') }}</section>
                </section>
            @endif
            @if (session('error'))
                <section class="container-fluid d-flex justify-content-center">
                    <section class="alert alert-danger" role="alert">{{ session('error') }}</section>
                </section>
            @endif
            <section class="row justify-content-center">
                <section class="col-7 formulario p-4">
                    <section class="form-group">
                        <label for="correo" class="col-form-label">Correo electrónico:</label>
                        <input type="text" class="form-control color-enfoque" placeholder="Correo electrónico"
                            name="correo" id="correo" value="{{old('correo')}}" required>
                    </section>
                    <section class="form-group">
                        <label for="contrasenia" class="col-form-label">Contraseña:</label>
                        <input type="password" class="form-control color-enfoque" placeholder="Contraseña"
                            name="contrasenia" id="contrasenia" required>
                    </section>
                    <section class="mt-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-formulario btn-block text-white">Acceder</button>
                    </section>
                </section>
            </section>
        </form>
    </section>
    <section class="container-fluid d-flex justify-content-center">
        <p>¿No tienes una cuenta?<a href="/pawsTails/crearCuenta" class="marron">CREAR UNA</a></p>
    </section>





    <!--Footer de la página-->
    <footer class="footer mt-auto p-3 bg-light text-center fixed-bottom">
        <section class="container">
            <section class="text-muted">© 2024 Paws & Tails. Todos los derechos reservados.</section>
        </section>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
