<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('imagenesTienda/favicon.ico') }}" sizes="64x64" type="image/x-icon">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <!--Menú de navegacion-->
    <section class="container-fluid navegacion">
        <nav class="navbar navbar-expand-sm bg-light container-fluid text-center fixed-top">
            <a class="navbar-brand" href="/pawsTails">
                <img src="{{ asset('imagenesTienda/imagen sin fondo.png') }}" class="img-fluid logo"
                    alt="logo empresa Paws and Tails">
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#menu"><!--navbar-toggler indica que va a ser el boton que va a colapsar data-bs-toggle indica como lo va a hacer y target a quien va dirgido-->
                <section class="navbar-toggler-icon"></section><!--Simbolo para el boton de mostrar/ocultar nav-->
            </button>

            <section class="collapse navbar-collapse" id="menu">
                <!--Collapse indica que como se deben colapsar los elementos al visualizarlos en dispositivos pequeños-->
                <nav class="navbar-nav d-flex justify-content-start flex-grow-1">
                    <!--flex-grow-1 para que se comporte como se espera, ya que si no los cambios al usar justify-content no se aprecian-->
                    <a href="/pawsTails"
                        class="nav-link text-dark color-nav">Inicio</a><!--nav-link para el estilo de los enlaces sin subrayado... y text-dark para el color del texto-->
                    <a href="/pawsTails/productos" class="nav-link marron">Productos</a>
                    <a href="/pawsTails" class="nav-link text-dark color-nav">Adopción</a>
                    <a href="/pawsTails" class="nav-link text-dark color-nav">Contacto</a>

                    <!--Se mostrara Mi perfil solo si el usuario ha iniciado sesion, si no le dara la opcion para que cree una cuenta o inicie sesion-->
                    <section class="dropdown ms-auto">
                        <a class="nav-link text-dark ms-auto dropdown-toggle color-nav" role="button" data-bs-toggle="dropdown">
                            {{ $datosMenu["menu"] }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @foreach ($datosMenu["enlaces"] as $datos)
                                <li><a class="dropdown-item color-nav" href="{{ $datos["url"] }}">{{ $datos["texto"] }}</a></li>
                            @endforeach
                        </ul>
                    </section>
                    
                    <svg class="me-3 icon icon-tabler icons-tabler-outline icon-tabler-user-circle"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" stroke="#8b5025" />
                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" stroke="#8b5025" />
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" stroke="#8b5025" />
                    </svg>
                    </a>
                </nav>
            </section>
        </nav>
    </section>
    <section class="container-fluid">  
    </section>

    <!--Boton que se muestra solo a los administradores, y permite agregar un nuevo producto-->
    @if (@session("rol_usuario")=="administrador")
        <section class="container-fluid d-flex justify-content-end">
        <!--Utilizamos el metodo url, ya que estamos en otra ruta y sino se nos generaria mal-->
        <a href="{{url("pawsTails/agregarProducto")}}" class="nav-link"><button class="btn btn-formulario btn-catalogo">Agregar un producto</button></a>
        </section>
    @endif
    <!--Contenido de la página, donde se muestran todos los productos-->
    <section class="container-fluid row">
        @foreach ($catalogo as $producto)
            <section class="col-4 p-0 d-flex justify-content-center align-items-center flex-column">
                <img src="{{ Storage::url("public/imagenesCatalogo/".$producto->imagen) }}" width="250" height="250"  class="img-fluid p-1"
                    alt="{{$producto->nombre}}">
                <p>{{$producto->nombre}}</p>
                <section>
                    <a href={{"/pawsTails/productos/".$producto->id}}><button class="btn btn-formulario btn-marron">Mas información</button></a>
                    <a href={{"/pawsTails/productos/agregar/".$producto->id}}><img src="{{ asset("imagenesTienda/imagenesCatalogo/shopping-bag.png") }}" width="50" height="50"  class="img-fluid p-1"
                        alt="Icono de un carrito de la compra"></a>
                </section>
            </section>  
        @endforeach
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
