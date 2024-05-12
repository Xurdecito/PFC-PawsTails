<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Registrar Refugio</title>
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

    <section class="container-fluid contenedor-formulario">
        <form action="/pawsTails/agregarRefugio" method="POST">
            @csrf
            <h2 class="text-center">Registra al Refugio</h2>
            <section class="row justify-content-center">
                <section class="col-10">
                    <section class="card p-4 shadow rounded">
                        <section class="form-floating mb-3">
                            <input type="text" class="form-control color-enfoque" id="nombre" placeholder=" " name="nombre" value="{{ old('nombre') }}" required>
                            <label for="nombre">Nombre del refugio</label>
                            @error('nombre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </section>
                        <section class="form-floating mb-3">
                            <input type="email" class="form-control color-enfoque" id="correo" placeholder=" " name="correo" value="{{ old('correo') }}" required>
                            <label for="correo">Correo electrónico</label>
                            @error('correo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </section>
                        <section class="form-floating mb-3">
                            <input type="password" class="form-control color-enfoque" id="contrasenia" placeholder=" " name="contrasenia" required>
                            <label for="contrasenia">Contraseña</label>
                            @error('contrasenia')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </section>
                        <section class="form-floating mb-3">
                            <input type="text" class="form-control color-enfoque" id="direccion" placeholder=" " name="direccion" value="{{ old('direccion') }}">
                            <label for="direccion">Dirección (Opcional)</label>
                            @error('direccion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </section>
                        <section class="form-floating mb-3">
                            <input type="number" class="form-control color-enfoque" id="telefono" placeholder=" " name="telefono" value="{{ old('telefono') }}">
                            <label for="telefono">Teléfono (Opcional)</label>
                            @error('telefono')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </section>
                        <button type="submit" class="btn btn-formulario">Registrar Refugio</button>
                        <p><a href="javascript:history.back()"><img src="{{ asset("imagenesTienda/iconos/arrow-back.png") }}"
                            width="50" height="50" class="img-fluid p-1 aumentoFoto"
                            alt="Icono de una flecha para volver hacia atras"></a></p>
                    </section>
                </section>
            </section>
        </form>
    </section>
    




    <!--Footer de la página-->
    <footer class="footer mt-auto p-3 bg-light text-center">
        <section class="container">
            <section class="text-muted">© 2024 Paws & Tails. Todos los derechos reservados.</section>
        </section>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
