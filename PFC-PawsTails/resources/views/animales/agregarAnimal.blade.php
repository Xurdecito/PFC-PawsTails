<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Registrar Animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="icon" href="{{ asset("imagenesTienda/favicon.ico") }}" sizes="64x64" type="image/x-icon">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <section class="container-fluid navegacion">
        <nav class="navbar bg-light fixed-top d-flex justify-content-center">
            <a class="navbar-brand color-nav d-flex" href="/pawsTails">
                <img src="{{ asset("imagenesTienda/imagen sin fondo.png") }}" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <section class="container-fluid contenedor-formulario">
        <form action="/pawsTails/buscarNuevoHogar" method="POST" enctype="multipart/form-data">
            @csrf
            <h2 class="text-center">Registrar Animal</h2>
            @if (session("exito"))
            <section class="d-flex justify-content-center text-center">
                <section class="alert alert-success w-50" role="alert">{{ session("exito") }}</section>
            </section>
            @endif
            <section class="row justify-content-center">
                <section class="col-10">
                    <section class="card p-4 shadow rounded">
                        <section class="form-floating mb-3">
                            <input type="text" class="form-control color-enfoque" id="nombre" placeholder="Nombre del animal" name="nombre" value="{{ old("nombre") }}" required>
                            <label for="nombre">Nombre del animal</label>
                            @error("nombre")
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </section>
                        <section class="form-floating mb-3">
                            <select class="form-select color-enfoque" id="especie" name="especie" required>
                                <option value="" disabled selected>Seleccione una especie</option>
                                <option value="perro" @if(old("especie") == "perro") selected @endif>Perro</option>
                                <option value="gato" @if(old("especie") == "gato") selected @endif>Gato</option>
                            </select>
                            <label for="especie">Especie</label>
                            @error("especie")
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </section>
                        <section class="form-floating mb-3">
                            <textarea class="form-control color-enfoque" id="descripcion" placeholder="Descripción" name="descripcion" required>{{ old("descripcion") }}</textarea>
                            <label for="descripcion">Descripción</label>
                            @error("descripcion")
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </section>
                        <section class="form-group p-2">
                            <label for="imagen">Imagen:</label>
                            <input type="file" id="imagen" name="imagen" class="form-control color-enfoque" required>
                            @error("imagen")
                                <section class="text-danger">{{ $message }}</section>
                            @enderror
                        </section>
                        @if(session("rol_usuario")=="administrador")
                        <section class="form-group p-2">
                            <label for="id_refugio">Indique el id del refugio al que le deseas añadir este animal:</label>
                            <input type="number" id="id_refugio" name="id_refugio" class="form-control color-enfoque" value="{{ old("id_refugio") }}" required>
                            @error("id_refugio")
                                <section class="text-danger">{{ $message }}</section>
                            @enderror
                        </section>
                        @endif
                        <button type="submit" class="btn btn-formulario">Buscarles un nuevo hogar</button>
                        <p><a href="/pawsTails/animales"><img src="{{ asset("imagenesTienda/iconos/arrow-back.png") }}" width="50" height="50" class="img-fluid p-1 aumentoFoto" alt="Icono de una flecha para volver hacia atrás"></a></p>
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
