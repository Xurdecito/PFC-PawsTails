<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Realizar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset("css/style.css")); ?>">
    <link rel="icon" href="<?php echo e(asset("imagenesTienda/favicon.ico")); ?>" sizes="64x64" type="image/x-icon">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <section class="container-fluid navegacion">
        <nav class="navbar bg-light fixed-top d-flex justify-content-center">
            <a class="navbar-brand color-nav d-flex" href="/pawsTails">
                <img src="<?php echo e(asset("imagenesTienda/imagen sin fondo.png")); ?>" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <!--Si alguno de los cuatro primeros campos, estan alamcenados en la base de datos, el campo se deshabilita, y se debe cambiar en la pestaña de datos del usuario-->
    <section class="container-fluid separacion">
        <h2 class="mb-4">Información del Pedido</h2>
        <form action="/pawsTails/carrito/realizarPedido/<?php echo e($usuario->id); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <section class="row justify-content-center">
                <section class="col-6">
                    <section class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control campo-categoria" id="nombre" name="nombre" placeholder="Ingrese su nombre completo" value="<?php echo e(old("nombre", $usuario->nombre)); ?>" <?php if($usuario->nombre != null): ?> readonly <?php endif; ?> required>
                        <?php $__errorArgs = ["nombre"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </section>
                </section>
                <section class="col-6">
                    <section class="mb-3">
                        <label for="direccion" class="form-label">Dirección de Envío</label>
                        <input type="text" class="form-control campo-categoria" id="direccion" name="direccion" placeholder="Ingrese su dirección de envío" value="<?php echo e(old("direccion", $usuario->direccion)); ?>" <?php if($usuario->direccion != null): ?> readonly <?php endif; ?> required>
                        <?php $__errorArgs = ["direccion"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </section>
                </section>
                <section class="col-6">
                    <section class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control campo-categoria" id="email" name="email" placeholder="Ingrese su correo electrónico" value="<?php echo e(old("email", $usuario->correo)); ?>" <?php if($usuario->correo != null): ?> readonly <?php endif; ?> required>
                        <?php $__errorArgs = ["email"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </section>
                </section>
                <section class="col-6">
                    <section class="mb-3">
                        <label for="telefono" class="form-label">Teléfono de Contacto</label>
                        <input type="tel" class="form-control campo-categoria" id="telefono" name="telefono" placeholder="Ingrese su teléfono de contacto" value="<?php echo e(old("telefono", $usuario->telefono)); ?>" <?php if($usuario->telefono != null): ?> readonly <?php endif; ?> required>
                        <?php $__errorArgs = ["telefono"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </section>
                </section>
                <section class="col-6">
                    <section class="mb-3">
                        <label for="tarjeta" class="form-label">Número de Tarjeta</label>
                        <input type="text" class="form-control campo-categoria" id="tarjeta" name="tarjeta" placeholder="Ingrese el número de su tarjeta" value="<?php echo e(old("tarjeta")); ?>" required>
                        <?php $__errorArgs = ["tarjeta"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </section>
                </section>
                <section class="col-6">
                    <section class="mb-3">
                        <label for="vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="text" class="form-control campo-categoria" id="vencimiento" name="vencimiento" placeholder="MM/AA" value="<?php echo e(old("vencimiento")); ?>" required>
                        <?php $__errorArgs = ["vencimiento"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </section>
                </section>
                <section class="col-6">
                    <section class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control campo-categoria" id="cvv" name="cvv" placeholder="Ingrese el código CVV" value="<?php echo e(old("cvv")); ?>" required>
                        <?php $__errorArgs = ["cvv"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </section>
                </section>
            </section>
            <section class="text-center">
                <button type="submit" class="btn btn-formulario campo-categoria">Realizar Pedido</button>
            </section>
        </form>
        
    </section>
    

    <p><a href="/pawsTails/carrito"><button type="button" class="btn btn-success">Volver al carrito</button></a></p>
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
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/carrito/realizarPedido.blade.php ENDPATH**/ ?>