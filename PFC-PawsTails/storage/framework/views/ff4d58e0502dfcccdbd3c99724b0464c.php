<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Crear cuenta</title>
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

    <section class="container separacion">
        <section class="row justify-content-center">
            <section class="col-md-8">
                <section class="card">
                    <section class="card-body borde-formulario">
                        <form action="/pawsTails/crearCuenta" method="post" class="w-100">
                            <?php echo csrf_field(); ?>
                            <h2 class="text-center">Crear Cuenta</h2>
                            <span><img src="<?php echo e(asset('imagenesTienda/iconos/user.png')); ?>" width="25" height="25"
                                    alt="Logo de una silueta de una persona"></span>
                            <section class="form-floating mb-3">
                                <input type="text" class="form-control color-enfoque" id="nombre"
                                    placeholder="Nombre" name="nombre" value="<?php echo e(old('nombre')); ?>" required>
                                <label for="nombre">Nombre</label>
                                <?php $__errorArgs = ['nombre'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </section>
                            <span><img src="<?php echo e(asset('imagenesTienda/iconos/mail.png')); ?>" width="25" height="25"
                                    alt="Logo de una direccion de correo"></span>
                                    <?php $__errorArgs = ['correo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <small class="text-danger"><?php echo e($message); ?></small>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <section class="form-floating mb-3">
                                <input type="email" class="form-control color-enfoque" id="correo"
                                    placeholder="Correo electrónico" name="correo" value="<?php echo e(old('correo')); ?>"
                                    required>
                                <label for="correo">Correo electrónico</label>
                                <span><img src="<?php echo e(asset('imagenesTienda/iconos/lock.png')); ?>" width="25"
                                        height="25" alt="Logo de un candado"></span>
                                        <?php $__errorArgs = ['contrasenia'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <section class="form-floating mb-3">
                                    <input type="password" class="form-control color-enfoque" id="contrasenia"
                                        placeholder="Contraseña" name="contrasenia" value="<?php echo e(old('contrasenia')); ?>"
                                        required>
                                    <label for="contrasenia">Contraseña</label>
                                </section>
                                <span><img src="<?php echo e(asset('imagenesTienda/iconos/directions.png')); ?>" width="25"
                                        height="25" alt="Logo de una direccion"></span>
                                <section class="form-floating mb-3">
                                    <input type="text" class="form-control color-enfoque" id="direccion"
                                        placeholder="Dirección" name="direccion" value="<?php echo e(old('direccion')); ?>">
                                    <label for="direccion">Dirección (Opcional)</label>
                                    <?php $__errorArgs = ['direccion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </section>
                                <span><img src="<?php echo e(asset('imagenesTienda/iconos/phone.png')); ?>" width="25"
                                        height="25" alt="Logo de un telefono"></span>
                                        <?php $__errorArgs = ['telefono'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <small class="text-danger"><?php echo e($message); ?></small>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <section class="form-floating mb-3">
                                    <input type="number" class="form-control color-enfoque" id="telefono"
                                        placeholder="Teléfono" name="telefono" value="<?php echo e(old('telefono')); ?>">
                                    <label for="telefono">Teléfono (Opcional)</label>
                                </section>
                                <section class="mt-3 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-formulario">Crear cuenta</button>
                                </section>
                        </form>
                    </section>
                </section>
            </section>
        </section>
    </section>



    <section class="container-fluid d-flex justify-content-center">
        <p>¿Ya tienes una cuenta?<a href="/pawsTails/login" class="marron">ACCEDER</a></p>
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
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/identificacion/crearCuenta.blade.php ENDPATH**/ ?>