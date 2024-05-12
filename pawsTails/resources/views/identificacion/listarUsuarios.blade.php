<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Crear cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link rel="icon" href="{{ asset("imagenesTienda/favicon.ico") }}" sizes="64x64" type="image/x-icon">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <section class="container-fluid navegacion">
        <nav class="navbar bg-light fixed-top d-flex justify-content-center d-flex">
            <a class="navbar-brand color-nav d-flex" href="/pawsTails">
                <img src="{{ asset("imagenesTienda/imagen sin fondo.png") }}" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <section class="container-fluid separacion justify-content-center text-center">
        <h6 class="display-6">Listado de usuarios registrados</h6>
        @if (session("info"))
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-success" role="alert">{{ session("info") }}</section>
        </section>
        @endif
        <table class="table table-bordered table-striped table-hover table-responsive">
            <tr>
                <th class="marronTabla">Nombre</th>
                <th class="marronTabla">Correo</th>
                <th class="marronTabla">Dirección</th>
                <th class="marronTabla">Teléfono</th>
                <th class="marronTabla">Rol</th>
                <th class="marronTabla">Herramientas</th>
            </tr>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{$usuario->correo}}</td>
                    <td>{{$usuario->direccion}}</td>
                    <td>{{$usuario->telefono}}</td>
                    <td>{{$usuario->rol}}</td>
                    <td><a href="/pawsTails/editarUsuario/{{$usuario->id}}" class="text-primary p-2 herramientas">Editar<img src="{{ asset("imagenesTienda/iconos/edit.png") }}" width="25" height="25"  class="img-fluid p-1"></a>
                        <a href="#" class="text-danger p-2 herramientas" data-bs-toggle="modal" data-bs-target="#confirmarBorrarUsuario{{$usuario->id}}">
                            Borrar <img src="{{ asset("imagenesTienda/iconos/trash.png") }}" width="25" height="25" class="img-fluid p-1">
                        </a>
                        
                        <!--Modal para pedir la confirmación para eliminar a un usuario-->
                        <section class="modal fade" id="confirmarBorrarUsuario{{$usuario->id}}" tabindex="-1" aria-labelledby="confirmarBorrarUsuarioLabel{{$usuario->id}}">
                            <section class="modal-dialog">
                                <section class="modal-content">
                                    <section class="modal-header">
                                        <h5 class="modal-title" id="confirmarBorrarUsuarioLabel{{$usuario->id}}">Confirmar eliminación de usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </section>
                                    <section class="modal-body">
                                        ¿Estás seguro que deseas eliminar al usuario: "{{$usuario->correo}}"?.
                                    </section>
                                    <section class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="/pawsTails/borrarUsuario/{{$usuario->id}}" class="btn btn-danger">Eliminar</a>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
    <p class="ml-auto"><a href="/pawsTails"><img src="{{ asset("imagenesTienda/iconos/arrow-back.png") }}" width="50" height="50"  class="img-fluid p-1 aumentoFoto"
        alt="Icono de una flecha para volver hacia atras"></a></p>
  
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
