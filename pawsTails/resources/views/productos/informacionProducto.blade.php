<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - {{$producto->nombre}}</title>
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
                <img src="{{ asset("imagenesTienda/imagen sin fondo.png") }}" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <section class="container-fluid separacion justify-content-center text-center">
        <!--Se mostrara el mensaje de que el producto se ha añadido de manera correcta-->
        @if (session("info"))
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-success" role="alert">{{ session("info") }}<a class="nav-link text-primary herramientas" href="/pawsTails/carrito">Ver carrito.</a></section>
        </section>
        @endif
        @if (session("error"))
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-danger" role="alert">{{ session("error") }}</section>
        </section>
        @endif
        <section class="row">
            <section class="col-1 d-flex align-items-center justify-content-center">
                @if (isset($anteriorProducto->id))
                <a href={{"/pawsTails/productos/".$anteriorProducto->id}}><img src="{{ asset("imagenesTienda/iconos/chevron-left.png") }}" width="50" height="50"  class="img-fluid p-1 aumentoFoto"
                    alt="Icono de una flecha para volver hacia atras" title="Producto anterior"></a>
                @endif
            </section>
            <section class="col-5">
                <img src="{{ Storage::url("public/imagenesCatalogo/".$producto->imagen) }}" class="img-fluid p-1 producto-informacion" alt="{{$producto->nombre}}">
            </section>
            <section class="col-5 text-start">
                <h2 class="display-5 marron">{{$producto->nombre}}</h2>
                <p class="fs-5">Categoría: {{$categoria->nombre}}</p>
                <p class="fw-bold fs-5">{{$producto->precio}}€</p>
                <p class="fs-5">{{$producto->descripcion}}</p>
                <button class="btn btn-formulario btn-marron"><a href={{"/pawsTails/productos/agregarCarrito/".$producto->id}} class="text-decoration-none text-white">Agregar al carrito</a></button>
                <p><a href="/pawsTails/productos"><img src="{{ asset("imagenesTienda/iconos/arrow-back.png") }}" width="50" height="50"  class="img-fluid p-1 aumentoFoto"
                    alt="Icono de una flecha para volver hacia atras"></a></p>
            </section>
            <section class="col-1 d-flex align-items-center justify-content-center">
                @if (isset($siguienteProducto->id))
                <a href={{"/pawsTails/productos/".$siguienteProducto->id}}><img src="{{ asset("imagenesTienda/iconos/chevron-right.png") }}" width="50" height="50"  class="img-fluid p-1 aumentoFoto"
                    alt="Icono de una flecha para volver hacia atras" title="Producto posterior"></a>
                @endif
            </section>
        </section>
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
