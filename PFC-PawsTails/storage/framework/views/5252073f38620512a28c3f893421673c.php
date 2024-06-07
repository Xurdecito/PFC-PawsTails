<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Editar Animal</title>
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

    <section class="container-fluid contenedor-formulario">
        <form action="/pawsTails/editarAnimal/<?php echo e($datosAnimal->id); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <h2 class="text-center">Animal: "<?php echo e($datosAnimal->nombre); ?>"</h2>
            <?php if(session("exito")): ?>
            <section class="d-flex justify-content-center text-center">
                <section class="alert alert-success w-50" role="alert"><?php echo e(session("exito")); ?></section>
            </section>
            <?php endif; ?>
            <section class="row justify-content-center">
                <section class="col-10">
                    <section class="card p-4 shadow rounded">
                        <section class="form-floating mb-3">
                            <input type="text" class="form-control color-enfoque" id="nombre" placeholder="Nombre del animal" name="nombre" value="<?php echo e($datosAnimal->nombre); ?>" required>
                            <label for="nombre">Nombre del animal</label>
                            <?php $__errorArgs = ["nombre"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </section>
                        <section class="form-floating mb-3">
                            <select class="form-select color-enfoque" id="especie" name="especie" required>
                                <option value="" disabled selected>Seleccione una especie</option>
                                <option value="perro" <?php if($datosAnimal->especie == "perro"): ?> selected <?php endif; ?>>Perro</option>
                                <option value="gato" <?php if($datosAnimal->especie == "gato"): ?> selected <?php endif; ?>>Gato</option>
                            </select>
                            <label for="especie">Especie</label>
                            <?php $__errorArgs = ["especie"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </section>
                        <section class="form-floating mb-3">
                            <textarea class="form-control color-enfoque" id="descripcion" placeholder="Descripción" name="descripcion" required><?php echo e($datosAnimal->nombre); ?></textarea>
                            <label for="descripcion">Descripción</label>
                            <?php $__errorArgs = ["descripcion"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-danger"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </section>
                        <section class="form-group p-2">
                            <label for="imagen">Imagen: (Solo seleccione una si desea cambiarla)</label><br>
                            <img src="<?php echo e(Storage::url("public/imagenesAnimales/" . $datosAnimal->imagen)); ?>" width="150"
                            height="150" class="img-fluid p-2 mt-2" alt="<?php echo e($datosAnimal->nombre); ?>">
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
                        <?php if(session("rol_usuario")=="administrador"): ?>
                        <section class="form-group p-2">
                            <label for="id_refugio">Indique el id del refugio al que le deseas añadir este animal:</label>
                            <input type="number" id="id_refugio" name="id_refugio" class="form-control color-enfoque" value="<?php echo e(old("id_refugio")); ?>" required>
                            <?php $__errorArgs = ["id_refugio"];
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
                        <?php endif; ?>
                        <button type="submit" class="btn btn-formulario">Actualizar los datos de "<?php echo e($datosAnimal->nombre); ?>"</button>
                        <p><a href="/pawsTails/animales"><img src="<?php echo e(asset("imagenesTienda/iconos/arrow-back.png")); ?>" width="50" height="50" class="img-fluid p-1 aumentoFoto" alt="Icono de una flecha para volver hacia atrás"></a></p>
                    </section>
                </section>
            </section>
        </form>
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
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/animales/mostrarEditarAnimales.blade.php ENDPATH**/ ?>