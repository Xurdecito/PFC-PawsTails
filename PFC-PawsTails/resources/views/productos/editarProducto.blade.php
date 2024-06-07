<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Editar Producto</title>
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

    <section class="container d-flex justify-content-center align-items-center contenedor-formulario">
        <section class="container">
            <h1 class="mb-4">Editar Producto "{{$producto->nombre}}"</h1>
            <h5>Rellene todos los campos</h5>

            <form action="/pawsTails/editarProducto/{{$producto->id}}" method="post" enctype="multipart/form-data">
                <!--Se mostrara el mensaje de que el producto se ha agregado de manera correcta-->
                @if (session("info"))
                    <section class="container-fluid d-flex justify-content-center">
                        <section class="alert alert-success mt-5" role="alert">{{ session('info') }}</section>
                    </section>
                @endif
                @csrf
                <section class="form-group p-2">
                    <label for="nombre" class="marron-oscuro">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control color-enfoque"
                        value="{{ $producto->nombre }}" required>
                    @error("nombre")
                        <!--Se coloca cada uno de estos, para en caso de que la funcion validate en el controlador de error, redirige a la pagina anterior,
                                    y mostramos el error por pantalla para informar al usuario-->
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="descripcion" class="marron-oscuro">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control color-enfoque" maxlength="500" required>{{ $producto->descripcion }}</textarea>
                    @error("descripcion")
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="categoria" class="marron-oscuro">Categoría del producto:</label>
                    <select id="categoria" name="categoria" class="form-control color-enfoque" required>
                        @foreach ($categorias as $categoria)
                            {
                            <option value="{{ $categoria->id }}" @if ($categoria->id == $producto->categoria_id) selected @endif>{{ $categoria->nombre }}</option>
                            }
                        @endforeach
                    </select>
                    @error("nombreCategoria")
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="imagen" class="marron-oscuro">Imagen (Selecciona una solo si deseas cambiar la imagen actual):</label><br>
                    <img src="{{ Storage::url("public/imagenesCatalogo/" . $producto->imagen) }}" width="150"
                    height="150" class="img-fluid p-2 mt-2" alt="{{ $producto->nombre }}">
                    <input type="file" id="imagen" name="imagen" class="form-control color-enfoque">
                    @error("imagen")
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="precio" class="marron-oscuro">Precio:</label>
                    <input type="text" id="precio" name="precio" class="form-control color-enfoque"
                        value="{{ $producto->precio }}" required>
                    @error('precio')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>


                <section class="form-group p-2">
                    <a href="/pawsTails/productos"><img src="{{ asset("imagenesTienda/iconos/arrow-back.png") }}" width="50" height="50"  class="img-fluid p-1 aumentoFoto"
                        alt="Icono de una flecha para volver hacia atras" title="Volver al catalogo"></a>
                    <button type="submit" class="btn btn-formulario">Actualizar producto</button>
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
