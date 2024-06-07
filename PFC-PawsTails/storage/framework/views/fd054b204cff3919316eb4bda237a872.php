<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Editar Producto</title>
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
                <img src="<?php echo e(asset("imagenesTienda/imagen sin fondo.png")); ?>" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <section class="container d-flex justify-content-center align-items-center contenedor-formulario">
        <section class="container">
            <h1 class="mb-4">Editar Producto "<?php echo e($producto->nombre); ?>"</h1>
            <h5>Rellene todos los campos</h5>

            <form action="/pawsTails/editarProducto/<?php echo e($producto->id); ?>" method="post" enctype="multipart/form-data">
                <!--Se mostrara el mensaje de que el producto se ha agregado de manera correcta-->
                <?php if(session("info")): ?>
                    <section class="container-fluid d-flex justify-content-center">
                        <section class="alert alert-success mt-5" role="alert"><?php echo e(session('info')); ?></section>
                    </section>
                <?php endif; ?>
                <?php echo csrf_field(); ?>
                <section class="form-group p-2">
                    <label for="nombre" class="marron-oscuro">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control color-enfoque"
                        value="<?php echo e($producto->nombre); ?>" required>
                    <?php $__errorArgs = ["nombre"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <!--Se coloca cada uno de estos, para en caso de que la funcion validate en el controlador de error, redirige a la pagina anterior,
                                    y mostramos el error por pantalla para informar al usuario-->
                        <section class="text-danger"><?php echo e($message); ?></section>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </section>

                <section class="form-group p-2">
                    <label for="descripcion" class="marron-oscuro">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" class="form-control color-enfoque" maxlength="500" required><?php echo e($producto->descripcion); ?></textarea>
                    <?php $__errorArgs = ["descripcion"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <section class="text-danger"><?php echo e($message); ?></section>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </section>

                <section class="form-group p-2">
                    <label for="categoria" class="marron-oscuro">Categoría del producto:</label>
                    <select id="categoria" name="categoria" class="form-control color-enfoque" required>
                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            {
                            <option value="<?php echo e($categoria->id); ?>" <?php if($categoria->id == $producto->categoria_id): ?> selected <?php endif; ?>><?php echo e($categoria->nombre); ?></option>
                            }
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ["nombreCategoria"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <section class="text-danger"><?php echo e($message); ?></section>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </section>

                <section class="form-group p-2">
                    <label for="imagen" class="marron-oscuro">Imagen (Selecciona una solo si deseas cambiar la imagen actual):</label><br>
                    <img src="<?php echo e(Storage::url("public/imagenesCatalogo/" . $producto->imagen)); ?>" width="150"
                    height="150" class="img-fluid p-2 mt-2" alt="<?php echo e($producto->nombre); ?>">
                    <input type="file" id="imagen" name="imagen" class="form-control color-enfoque">
                    <?php $__errorArgs = ["imagen"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <section class="text-danger"><?php echo e($message); ?></section>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </section>

                <section class="form-group p-2">
                    <label for="precio" class="marron-oscuro">Precio:</label>
                    <input type="text" id="precio" name="precio" class="form-control color-enfoque"
                        value="<?php echo e($producto->precio); ?>" required>
                    <?php $__errorArgs = ['precio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <section class="text-danger"><?php echo e($message); ?></section>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </section>


                <section class="form-group p-2">
                    <a href="/pawsTails/productos"><img src="<?php echo e(asset("imagenesTienda/iconos/arrow-back.png")); ?>" width="50" height="50"  class="img-fluid p-1 aumentoFoto"
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
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/productos/editarProducto.blade.php ENDPATH**/ ?>