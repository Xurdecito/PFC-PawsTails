<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="icon" href="{{ asset("imagenesTienda/favicon.ico") }}" sizes="64x64" type="image/x-icon">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <!--Menú de navegacion-->
    <section class="container-fluid navegacion">
        <nav class="navbar navbar-expand-sm bg-light container-fluid text-center fixed-top">
            <a class="navbar-brand" href="/pawsTails">
                <img src="{{ asset("imagenesTienda/imagen sin fondo.png") }}" class="img-fluid logo"
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
                        <a class="nav-link text-dark ms-auto dropdown-toggle color-nav" role="button"
                            data-bs-toggle="dropdown">
                            {{ $datosMenu["menu"] }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @foreach ($datosMenu["enlaces"] as $datos)
                                <li><a class="dropdown-item color-nav"
                                        href="{{ $datos["url"] }}">{{ $datos["texto"] }}</a></li>
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
                </nav>
            </section>
        </nav>
    </section>
    <section class="container-fluid">
    </section>


    <section class="container-fluid d-flex">
        <!-- Formulario de selección de categorías -->
        <form action="/pawsTails/productos" method="POST" class="d-flex mt-3">
            @csrf
            <section class="form-group d-flex">
                <label for="categoria" class="marron-oscuro p-2">Filtrar:</label>
                <select id="categoria" name="categoria" class="form-control color-enfoque" required>
                    @foreach ($categorias as $categoria)
                        {
                        <option value="{{ $categoria->id }}" @if (session("categoriaBuscada") == $categoria->id) selected @endif>
                            {{ $categoria->nombre }}</option>
                        }
                    @endforeach
                </select>
            </section>
            <button type="submit" class="btn btn-formulario">Aceptar</button>
        </form>

        <!-- Botón para agregar un producto (alineado a la derecha) -->
        @if (session("rol_usuario") == "administrador")
            <!-- Utilizamos el método url para generar la URL correctamente -->
            <button class="btn btn-formulario btn-catalogo ms-auto"><a href="{{ url("pawsTails/agregarProducto") }}"
                    class="nav-link">Agregar un producto</a></button>
        @endif
    </section>


    <!--Contenido de la página, donde se muestran todos los productos-->
    @if (session("info"))
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-success" role="alert">{{ session("info") }}<a
                    class="nav-link text-primary herramientas" href="/pawsTails/carrito">Ver carrito.</a></section>
        </section>
    @endif
    @if (session("infoAdmin"))
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-success" role="alert">{{ session("infoAdmin") }}</section>
        </section>
    @endif
    @if (session("error"))
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-danger" role="alert">{{ session("error") }}</section>
        </section>
    @endif
    <section class="container-fluid p-2">
        @php
            $categoriaBuscada = session("categoriaBuscada");
            $contador = 0;
        @endphp
        @foreach ($catalogo as $producto)
            @if (!$categoriaBuscada || $categoriaBuscada == $producto->categoria_id)
                @if ($contador % 3 == 0)
                    <section class="container-fluid row p-2">
                @endif
                <section class="col-4 p-0 d-flex justify-content-center align-items-center flex-column">
                    <img src="{{ Storage::url("public/imagenesCatalogo/" . $producto->imagen) }}" width="250"
                        height="250" class="img-fluid p-2 mt-2" alt="{{ $producto->nombre }}">
                    <p>{{ $producto->nombre }}</p>
                    <section>
                        <a href={{ "/pawsTails/productos/" . $producto->id }}
                            class="text-decoration-none text-white"><button
                                class="btn btn-formulario btn-marron p-2">Mas información</button></a>
                        <a href={{ "/pawsTails/productos/agregarCarrito/" . $producto->id }}><img
                                src="{{ asset("imagenesTienda/iconos/shopping-bag.png") }}" width="50"
                                height="50" class="img-fluid p-1 aumentoFoto"
                                alt="Icono de un carrito de la compra"></a>
                    </section>
                    @if (session("rol_usuario") == "administrador")
                        <section>
                            <a href="/pawsTails/editarProducto/{{ $producto->id }}"
                                class="text-primary text-decoration-none"><button
                                    class="btn btn-primary">Editar</button><img
                                    src="{{ asset("imagenesTienda/iconos/edit.png") }}" width="35"
                                    height="35" class="img-fluid p-1"></a>
                            <a href="#" class="text-danger text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#confirmarBorrar{{ $producto->id }}">
                                <button class="btn btn-danger">Borrar</button>
                                <img src="{{ asset("imagenesTienda/iconos/trash.png") }}" width="35"
                                    height="35" class="img-fluid p-1">
                            </a>

                            <!--Modal para confirmar la eliminacion del producto-->
                            <section class="modal fade" id="confirmarBorrar{{ $producto->id }}" tabindex="-1"
                                aria-labelledby="confirmarBorrarLabel{{ $producto->id }}" aria-hidden="true">
                                <section class="modal-dialog">
                                    <section class="modal-content">
                                        <section class="modal-header">
                                            <h5 class="modal-title" id="confirmarBorrarLabel{{ $producto->id }}">
                                                Confirmar eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </section>
                                        <section class="modal-body">
                                            ¿Estás seguro que deseas eliminar "{{ $producto->nombre }}"?.
                                        </section>
                                        <section class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <a href="/pawsTails/borrarProducto/{{ $producto->id }}"
                                                class="btn btn-danger">Eliminar</a>
                                        </section>
                                    </section>
                                </section>
                            </section>

                        </section>
                    @endif
                </section>
                @php
                    $contador++;
                @endphp
            @endif
            @if ($contador % 3 == 0)
    </section>
    @endif
    @endforeach
    @if ($contador == 0)
        <section class="container-fluid text-center productoNoEncontrado">
            <p class="display-6 text-center">¡Lo sentimos, pero no hemos encontrado ningun producto que enseñarte!.</p>
        </section>
    @endif
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
