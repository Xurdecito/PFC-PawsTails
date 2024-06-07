<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Pedidos Tienda</title>
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
        <h6 class="display-6 separacion text-center">Pedidos realizados en la tienda: "{{ $totalPedidos }}" pedidos.</h6>
        <!--Formulario que permite buscar un pedido a traves de su id-->
        <section class="container-fluid">
            <form action="/pawsTails/buscarPedido" method="GET" class="d-flex justify-content-center mt-3 mb-3">
                <input type="number" name="pedidoBuscado" placeholder="Buscar por #id de pedido"
                    class="form-control color-enfoque me-2 w-25" min="0">
                <button type="submit" class="btn btn-formulario">Buscar</button>
            </form>
        </section>
        <p><a href="/pawsTails/productos"><img src="{{ asset('imagenesTienda/iconos/arrow-back.png') }}"
                    width="50" height="50" class="img-fluid p-1 aumentoFoto"
                    alt="Icono de una flecha para volver hacia atras"></a></p>
        @if (session('info'))
            <section class="container-fluid d-flex justify-content-center">
                <section class="alert alert-success" role="alert">{{ session('info') }}</section>
            </section>
        @endif
        @if (session('error'))
            <section class="container-fluid d-flex justify-content-center">
                <section class="alert alert-danger" role="alert">{{ session('error') }}</section>
            </section>
        @endif
        <section class="row d-flex justify-content-center">
            @php
                $totalProducto = 0;
                $totalPedido = 0;
                $pedidoBuscado = session('pedidoBuscado');
            @endphp
            @foreach ($datosPedidos as $pedido)
                @if (!$pedidoBuscado || $pedidoBuscado->id == $pedido['pedido']->id)
                    @php
                        $totalPedido = 0;
                    @endphp
                    <section class="col-md-4">
                        <section class="card">
                            <section class="card-body">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Id del pedido #{{ $pedido['pedido']->id }}</h5>
                                    <a href="" class="text-danger p-2 herramientas" data-bs-toggle="modal"
                                        data-bs-target="#confirmarModalPedido{{ $pedido['pedido']->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-x"
                                            id="iconoBorrar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                    </a>
                                </section>
                                <hr>
                                <!--Modal para preguntar al usuario si de verdad quiere borrar el o los articulos del carrito -->
                                <section class="modal" tabindex="-1"
                                    id="confirmarModalPedido{{ $pedido['pedido']->id }}">
                                    <section class="modal-dialog">
                                        <section class="modal-content">
                                            <section class="modal-header">
                                                <h5 class="modal-title">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </section>
                                            <section class="modal-body">
                                                ¿Estás seguro de que deseas eliminar el pedido con Id
                                                "#{{ $pedido['pedido']->id }}"?.
                                            </section>
                                            <section class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <a href="/pawsTails/borrarPedido/{{ $pedido['pedido']->id }}"
                                                    class="btn btn-danger">Eliminar</a>
                                            </section>
                                        </section>
                                    </section>
                                </section>

                                <ul class="list-group list-group-flush">
                                    @foreach ($pedido['productos'] as $producto)
                                        @php
                                            $totalProducto = $producto->precio * $producto->cantidad_producto;
                                            $totalPedido += $totalProducto;
                                        @endphp
                                        <li class="list-group-item">{{ $producto->nombre }}
                                            ({{ $producto->cantidad_producto }} unidades)
                                            - {{ $totalProducto }} €.</li>
                                    @endforeach
                                </ul>
                                <hr>
                                <ul class="list-group">
                                    <li class="list-group-item border-0 text-secondary">Cliente:</li>
                                    <li class="list-group-item border-0">Nombre: {{ $pedido['usuario']->nombre }}</li>
                                    <li class="list-group-item border-0">Dirección: {{ $pedido['usuario']->direccion }}
                                    </li>
                                </ul>
                                <hr>
                                <p class="card-text">Fecha: {{ $pedido['pedido']->created_at }}</p>
                                <p class="card-text"><strong>Total: </strong>{{ $totalPedido }} €.</p>
                            </section>
                        </section>
                    </section>
                @endif
            @endforeach
            @if ($totalPedido == 0)
                <section class="container-fluid d-flex justify-content-center">
                    <p class="display-5 separacion">Aún no se han realizado pedidos en la tienda.</p>
                </section>
            @endif
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
