<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('imagenesTienda/favicon.ico')); ?>" sizes="64x64" type="image/x-icon">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <section class="container-fluid navegacion">
        <nav class="navbar bg-light fixed-top d-flex justify-content-center">
            <a class="navbar-brand color-nav d-flex" href="/pawsTails">
                <img src="<?php echo e(asset('imagenesTienda/imagen sin fondo.png')); ?>" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <section class="container d-flex justify-content-center align-items-center contenedor-formulario">
        <form action="/pawsTails/comprobarLogin" method="post" class="w-50">
            <?php echo csrf_field(); ?>
            <section class="card">
                <section class="card-body borde-formulario">
                    <h2 class="text-center">Acceder</h2>
                    <?php if(session('exito')): ?>
                        <section class="alert alert-success" role="alert"><?php echo e(session('exito')); ?></section>
                    <?php endif; ?>
                    <?php if(session('error')): ?>
                        <section class="alert alert-danger" role="alert"><?php echo e(session('error')); ?></section>
                    <?php endif; ?> 
                    <span><img src="<?php echo e(asset('imagenesTienda/iconos/mail.png')); ?>" width="25" height="25" alt="Logo de una direccion de correo"></span>
                    <section class="form-floating mb-3">
                        <input type="text" class="form-control color-enfoque" id="correo" placeholder="Correo electrónico"
                            name="correo" value="<?php echo e(old('correo')); ?>" required>
                        <label for="correo">Correo electrónico</label>
                    </section>
                    <span><img src="<?php echo e(asset('imagenesTienda/iconos/lock.png')); ?>" width="25" height="25" alt="Logo de un candado"></span>
                    <section class="form-floating mb-3">
                        <input type="password" class="form-control color-enfoque" id="contrasenia" placeholder="Contraseña"
                            name="contrasenia" required>
                        <label for="contrasenia">Contraseña</label>
                    </section>
                    <section class="mt-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-formulario">Acceder</button>
                    </section>
                </section>
            </section>
        </form>
    </section>


    <section class="container-fluid d-flex justify-content-center">
        <p>¿No tienes una cuenta?<a href="/pawsTails/crearCuenta" class="marron">CREAR UNA</a></p>
    </section>





    <!--Footer de la página-->
    <footer class="footer mt-auto p-3 bg-light text-center fixed-bottom">
        <section class="container">
            <section class="text-muted">© 2024 Paws & Tails. Todos los derechos reservados.</section>
        </section>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/identificacion/inicioSesion.blade.php ENDPATH**/ ?>