<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Mi Carrito</title>
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

    <section class="container-fluid">
        <h6 class="display-6 separacion">Mi carrito</h6>
        @if (session('info'))
            <section class="container-fluid d-flex justify-content-center">
                <section class="alert alert-success" role="alert">{{ session('info') }}</section>
            </section>
        @endif
        @php
            $numUnidades = 0;
            $total = 0;
        @endphp
        <section class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th>Artículo</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Unidades</th>
                        <th>Total</th>
                        <th>Eliminar producto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrito as $articulo)
                        @php
                            $numUnidades++;
                            $total += $articulo->producto->precio * $articulo->cantidad;
                        @endphp
                        <tr>
                            <td><img src="{{ Storage::url('public/imagenesCatalogo/' . $articulo->producto->imagen) }}"
                                    width="100" height="100" alt="{{ $articulo->producto->nombre }}"></td>
                            <td>{{ $articulo->producto->nombre }}</td>
                            <td>{{ $articulo->producto->precio }}</td>
                            <td>{{ $articulo->cantidad }}</td>
                            <td>@php echo(number_format($articulo->producto->precio * $articulo->cantidad,2,",",".")) @endphp €</td>
                            <td>
                                <a href="" class="text-danger p-2 herramientas" data-bs-toggle="modal"
                                    data-bs-target="#confirmarModalCarrito">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-x" id="iconoBorrar">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                </a>

                                <!--Modal para preguntar al usuario si de verdad quiere borrar el o los articulos del carrito -->
                                <section class="modal" tabindex="-1" id="confirmarModalCarrito">
                                    <section class="modal-dialog">
                                        <section class="modal-content">
                                            <section class="modal-header">
                                                <h5 class="modal-title">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </section>
                                            <section class="modal-body">
                                                ¿Estás seguro de que deseas eliminar "{{ $articulo->producto->nombre }}"
                                                del carrito?.
                                            </section>
                                            <section class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <a href="/pawsTails/eliminaruno/{{ $articulo->id }}"
                                                    class="btn btn-danger">Eliminar</a>
                                            </section>
                                        </section>
                                    </section>
                                </section>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($numUnidades == 0)
                <section class="container-fluid d-flex justify-content-center">
                    <p class="display-5">Cuando agregues productos a tu carrito se mostraran aquí.</p>
                </section>
            @endif
        </section>
    </section>
    <section class="container-fluid d-flex flex-column justify-content-center text-center">
        <section>
            <p>Total de articulos: {{ $numUnidades }}, con un precio total de:
                {{ number_format($total, 2, ',', '.') }}€.</p>
        </section>
        <section class="d-flex justify-content-center">
            <p><a href="/pawsTails/productos"><img src="{{ asset('imagenesTienda/iconos/arrow-back.png') }}"
                width="50" height="50" class="img-fluid p-1 aumentoFoto"
                alt="Icono de una flecha para volver hacia atras"></a></p>
            <a href="/pawsTails/carrito/realizarPedido"><button type="button" class="btn btn-formulario col-2 w-100">Realizar Pedido</button></a>
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
