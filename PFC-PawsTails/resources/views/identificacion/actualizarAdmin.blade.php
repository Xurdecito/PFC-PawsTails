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
            <a class="navbar-brand color-nav d-flex" href="/pawsTails">
                <img src="{{ asset('imagenesTienda/imagen sin fondo.png') }}" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <section class="container d-flex justify-content-center align-items-center contenedor-formulario">
        <section class="container mt-5">
            <h1 class="mb-4">Perfil de Usuario de "{{$usuario->nombre}}"</h1>
            <h5>Puedes actualizar sus datos a excepción de su contraseña</h5>
    
            <form action="/pawsTails/editarUsuario/{{$usuario->id}}" method="POST">
                 <!--Se mostrara el mensaje de que los datos del usuario se han actualizado de manera correcta-->
                        @if (session("info"))
                            <section class="container-fluid d-flex justify-content-center">
                                <section class="alert alert-success mt-5" role="alert">{{ session("info") }}</section>
                            </section>
                        @endif
                @csrf
                <section class="form-group p-2">
                    <label for="nombre" class="marron-oscuro">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="{{ $usuario->nombre }}" class="form-control color-enfoque" required>
                    @error('nombre')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>
    
                <section class="form-group p-2">
                    <label for="correo" class="marron-oscuro">Correo electrónico:</label>
                    <input type="email" id="correo" name="correo" value="{{ $usuario->correo }}" class="form-control color-enfoque" required>
                    @error('correo')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>
    
                <section class="form-group p-2">
                    <label for="direccion" class="marron-oscuro">Dirección (Opcional):</label>
                    <input type="text" id="direccion" name="direccion" value="{{ $usuario->direccion }}" class="form-control color-enfoque">
                    @error('direccion')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>
    
                <section class="form-group p-2">
                    <label for="telefono" class="marron-oscuro">Teléfono (Opcional):</label>
                    <input type="tel" id="telefono" name="telefono" value="{{ $usuario->telefono }}" class="form-control color-enfoque">
                    @error('telefono')
                        <section class="text-danger">{{ $message }}</section>
                    @enderror
                </section>

                <section class="form-group p-2">
                    <label for="rol" class="marron-oscuro">Rol("Presione el valor para ver las diferentes opciones"):</label>
                    <select id="rol" name="rol" class="form-control color-enfoque" required>
                        <option value="usuario" @if($usuario->rol === "usuario") selected @endif>Usuario</option>
                        <option value="administrador" @if($usuario->rol === "administrador") selected @endif>Administrador</option>
                        <option value="refugio"  @if($usuario->rol === "refugio") selected @endif>Refugio</option>
                    </select>
                </section>                

                <section class="form-group p-2">
                    <button type="submit" class="btn btn-formulario w-100">Guardar Cambios</button>
                    <p><a href="/pawsTails/listarUsuarios"><img src="{{ asset("imagenesTienda/iconos/arrow-back.png") }}"
                        width="50" height="50" class="img-fluid p-1 aumentoFoto"
                        alt="Icono de una flecha para volver hacia atras"></a></p>
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
