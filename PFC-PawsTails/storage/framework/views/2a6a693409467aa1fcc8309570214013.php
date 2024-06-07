<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - <?php echo e($producto->nombre); ?></title>
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

    <section class="container-fluid separacion justify-content-center text-center">
        <!--Se mostrara el mensaje de que el producto se ha añadido de manera correcta-->
        <?php if(session('info')): ?>
            <section class="container-fluid d-flex justify-content-center">
                <section class="alert alert-success" role="alert"><?php echo e(session('info')); ?><a
                        class="nav-link text-primary herramientas" href="/pawsTails/carrito">Ver carrito.</a></section>
            </section>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <section class="container-fluid d-flex justify-content-center">
                <section class="alert alert-danger" role="alert"><?php echo e(session('error')); ?></section>
            </section>
        <?php endif; ?>
        <section class="row">
            <section class="col-1 d-flex align-items-center justify-content-center">
                <?php if(isset($anteriorProducto->id)): ?>
                    <a href=<?php echo e('/pawsTails/productos/' . $anteriorProducto->id); ?>><img
                            src="<?php echo e(asset('imagenesTienda/iconos/chevron-left.png')); ?>" width="50" height="50"
                            class="img-fluid p-1 aumentoFoto" alt="Icono de una flecha para volver hacia atras"
                            title="Producto anterior"></a>
                <?php endif; ?>
            </section>
            <section class="col-5">
                <img src="<?php echo e(Storage::url('public/imagenesCatalogo/' . $producto->imagen)); ?>"
                    class="img-fluid p-1 producto-informacion" alt="<?php echo e($producto->nombre); ?>">
            </section>
            <section class="col-5 text-start">
                <h2 class="display-5 marron"><?php echo e($producto->nombre); ?></h2>
                <p class="fs-5">Categoría: <?php echo e($categoria->nombre); ?></p>
                <p class="fw-bold fs-5"><?php echo e($producto->precio); ?>€</p>
                <p class="fs-5"><?php echo e($producto->descripcion); ?></p>
                <button class="btn btn-formulario btn-marron"><a
                        href=<?php echo e('/pawsTails/productos/agregarCarrito/' . $producto->id); ?>

                        class="text-decoration-none text-white">Agregar al carrito</a></button>
                <p><a href="/pawsTails/productos"><img src="<?php echo e(asset('imagenesTienda/iconos/arrow-back.png')); ?>"
                            width="50" height="50" class="img-fluid p-1 aumentoFoto"
                            alt="Icono de una flecha para volver hacia atras"></a></p>
            </section>
            <section class="col-1 d-flex align-items-center justify-content-center">
                <?php if(isset($siguienteProducto->id)): ?>
                    <a href=<?php echo e('/pawsTails/productos/' . $siguienteProducto->id); ?>><img
                            src="<?php echo e(asset('imagenesTienda/iconos/chevron-right.png')); ?>" width="50" height="50"
                            class="img-fluid p-1 aumentoFoto" alt="Icono de una flecha para volver hacia atras"
                            title="Producto posterior"></a>
                <?php endif; ?>
            </section>
        </section>
    </section>

    <!--Para el formulario y mostrar lo relacionado con los comentarios-->
    <section class="container-fluid separacion justify-content-center mt-5">
        <?php if(session('infoComentario')): ?>
            <section class="container-fluid d-flex justify-content-center">
                <section class="alert alert-success" role="alert"><?php echo e(session('infoComentario')); ?></section>
            </section>
        <?php endif; ?>
        <?php if(session('rol_usuario') != null && session('id_usuario') != null): ?>
            <section class="justify-content-center">
                <section class="col-8 mx-auto text-start">
                    <p class="marron">Agregar un comentario</p>
                    <form action="/pawsTails/comentarios/<?php echo e($producto->id); ?>" method="POST"
                        class="form-inline comentario-form">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="producto_id" value="<?php echo e($producto->id); ?>">
                        <section class="form-group mb-3 w-100">
                            <textarea id="mensaje" name="mensaje" class="form-control color-enfoque w-100" placeholder="Escribe un comentario..." maxlength="254" minlength="10"
                                required><?php echo e(old('comentario')); ?></textarea>
                        </section>
                        <button type="submit" class="btn btn-formulario mt-3">Comentar</button>
                    </form>
                </section>
            </section>
        <?php endif; ?>
        <section class="mt-3 mx-auto" style="width: 90%;">
            <h3 class="display-6 marron">Comentarios</h3>
            <?php
                $contador = 0;
            ?>
            <?php $__currentLoopData = $comentarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $contador++;
                ?>
                <section class="card mt-3 justify-content-center">
                    <section class="card-body d-flex justify-content-between">
                        <section>
                            <h5 class="card-title"><?php echo e($comentario->usuario->nombre); ?> |
                                <?php echo e(ucfirst($comentario->usuario->rol)); ?></h5>
                                <?php
                                    $mensaje = wordwrap($comentario->mensaje, 133, "<br>", true);
                                    echo "<p class='card-text'>$mensaje</p>";
                                ?>
                        </section>
                        <?php if(session('rol_usuario') == 'administrador'): ?>
                            <a href="" class="text-danger p-2 herramientas" data-bs-toggle="modal"
                                data-bs-target="#confirmarModalComentario<?php echo e($comentario->id); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-x" id="iconoBorrar">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M18 6l-12 12" />
                                    <path d="M6 6l12 12" />
                                </svg>
                            </a>
                        <?php endif; ?>
                    </section>
                    <?php $__currentLoopData = $respuestas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $respuesta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($respuesta->comentario_id == $comentario->id): ?>
                            <section class="card-body d-flex justify-content-between ms-5">
                                <section>
                                    <h5 class="card-title"><?php echo e($respuesta->usuario->nombre); ?> |
                                        <?php echo e(ucfirst($respuesta->usuario->rol)); ?></h5>
                                        <?php
                                        $respuestaMensaje = wordwrap($respuesta->mensaje, 133, "<br>", true);
                                        echo "<p class='card-text'>$respuestaMensaje</p>";
                                    ?>
                                </section>
                                <?php if(session('rol_usuario') == 'administrador'): ?>
                                    <a href="" class="text-danger p-2 herramientas" data-bs-toggle="modal"
                                        data-bs-target="#confirmarModalRespuesta<?php echo e($respuesta->id); ?>">
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
                                <?php endif; ?>
                            </section>
                        <?php endif; ?>
                        <!--Modal para preguntar al administrador si de verdad quiere borrar la respuesta del usuario-->
                        <section class="modal" tabindex="-1" id="confirmarModalRespuesta<?php echo e($respuesta->id); ?>">
                            <section class="modal-dialog">
                                <section class="modal-content">
                                    <section class="modal-header">
                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </section>
                                    <section class="modal-body">
                                        ¿Estás seguro de que deseas eliminar el comentario de
                                        "<?php echo e($respuesta->usuario->nombre); ?>" cuyo contenido es
                                        "<?php echo e($respuesta->mensaje); ?>"?.
                                    </section>
                                    <section class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <a href="/pawsTails/borrarRespuesta/<?php echo e($respuesta->id); ?>"
                                            class="btn btn-danger">Eliminar</a>
                                    </section>
                                </section>
                            </section>
                        </section>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!--Para crear el formulario para que un usuario pueda contestar al comentario de otro-->
                    <?php if(session('id_usuario') && session('rol_usuario')): ?>
                        <section class="card-footer">
                            <a href="#" class="text-primary p-2 mostrarFormulario">Responder</a>
                            <section id="formularioRespuesta<?php echo e($comentario->id); ?>" class="formulario-respuesta mt-2"
                                style="display: none;">
                                <form action="/pawsTails/responderComentario/<?php echo e($comentario->id); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="producto_id"
                                        value="<?php echo e($producto->id); ?>"><!--Para pasarle el id del producto-->
                                    <section class="mb-3">
                                        <label for="respuesta<?php echo e($comentario->id); ?>" class="form-label">Tu
                                            respuesta</label>
                                        <textarea class="form-control color-enfoque" id="respuesta<?php echo e($comentario->id); ?>" name="respuesta" rows="3" maxlength="254" minlength="10"></textarea>
                                    </section>
                                    <button type="submit" class="btn btn-formulario">Enviar Respuesta</button>
                                </form>
                            </section>
                        </section>
                    <?php endif; ?>
                </section>
                <!--Modal para preguntar al administrador si de verdad quiere borrar el comentario del usuario -->
                <section class="modal" tabindex="-1" id="confirmarModalComentario<?php echo e($comentario->id); ?>">
                    <section class="modal-dialog">
                        <section class="modal-content">
                            <section class="modal-header">
                                <h5 class="modal-title">Confirmar Eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </section>
                            <section class="modal-body">
                                ¿Estás seguro de que deseas eliminar el comentario de
                                "<?php echo e($comentario->usuario->nombre); ?>" cuyo contenido es "<?php echo e($comentario->mensaje); ?>"?.
                            </section>
                            <section class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <a href="/pawsTails/borrarComentario/<?php echo e($comentario->id); ?>"
                                    class="btn btn-danger">Eliminar</a>
                            </section>
                        </section>
                    </section>
                </section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($contador == 0): ?>
                <section class="card mt-3 justify-content-center">
                    <section class="card-body">
                        <p class="card-text">Aun no se han realizado comentarios sobre este producto</p>
                    </section>
                </section>
            <?php endif; ?>
        </section>
    </section>

    <!--Footer de la página-->
    <footer class="footer mt-auto p-3 bg-light text-center">
        <section class="container">
            <section class="text-muted">© 2024 Paws & Tails. Todos los derechos reservados.</section>
        </section>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?php echo e(asset('js/js.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/productos/informacionProducto.blade.php ENDPATH**/ ?>