<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Crear cuenta</title>
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
            <a class="navbar-brand color-nav" href="/pawsTails">
                <img src="{{ asset('imagenesTienda/imagen sin fondo.png') }}" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">Paws & Tails
            </a>
        </nav>
    </section>

    <section class="container d-flex justify-content-center align-items-center contenedor-formulario">
        <section class="container mt-5">
            <h1 class="mb-4">Añadir un nuevo producto</h1>
            <h5>Rellene todos los campos</h5>

            <form action="/agregarProducto" method="post" enctype="multipart/form-data">
                <!--Se mostrara el mensaje de que el producto se ha agregado de manera correcta-->
                @if (session('info'))
                    <section class="container-fluid d-flex justify-content-center">
                        <section class="alert alert-success mt-5" role="alert">{{ session('info') }}</section>
                    </section>
                @endif
                @csrf
                <section class="form-group p-2">
                    <label for="nombre" class="marron-oscuro">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control color-enfoque" value="{{old("nombre")}}" required>
                    @error('nombre')
                        <!--Se coloca cada uno de estos, para en caso de que la funcion validate en el controlador de error, redirige a la pagina anterior,
                        y mostramos el error por pantalla para informar al usuario-->
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="descripcion" class="marron-oscuro">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control color-enfoque" maxlength="500" required>{{old("descripcion")}}</textarea>
                    @error('descripcion')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="categoria" class="marron-oscuro">Categoría del producto:</label>
                    <select id="categoria" name="categoria" class="form-control color-enfoque" required>
                        @foreach ($categorias as $categoria)
                            {
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            }
                        @endforeach
                    </select>
                    @error('categoria')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="imagen" class="marron-oscuro">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" class="form-control color-enfoque" required>
                    @error('imagen')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="precio" class="marron-oscuro">Precio:</label>
                    <input type="text" id="precio" name="precio" class="form-control color-enfoque" value="{{old("precio")}}" required>
                    @error('precio')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <button type="submit" class="btn btn-formulario w-100">Agregar un nuevo producto</button>
                </section>
            </form>
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
