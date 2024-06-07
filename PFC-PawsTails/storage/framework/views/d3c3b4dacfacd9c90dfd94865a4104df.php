<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Mis Solicitudes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('imagenesTienda/favicon.ico')); ?>" sizes="64x64" type="image/x-icon">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <section class="container-fluid navegacion">
        <nav class="navbar bg-light fixed-top d-flex justify-content-center d-flex">
            <a class="navbar-brand color-nav d-flex" href="/pawsTails">
                <img src="<?php echo e(asset('imagenesTienda/imagen sin fondo.png')); ?>" class="img-fluid logo-inicio"
                    alt="logo empresa Paws and Tails">
                <span class="texto-arriba align-self-center">Paws & Tails</span>
            </a>
        </nav>
    </section>

    <section class="container-fluid separacion">
        <h2 class="text-center mb-4">Solicitudes de Adopción</h2>
        <section class="row justify-content-center">
            <?php if(session('info')): ?>
                <section class="container-fluid d-flex justify-content-center">
                    <section class="alert alert-success" role="alert"><?php echo e(session('info')); ?></section>
                </section>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <section class="container-fluid d-flex justify-content-center">
                    <section class="alert alert-danger" role="alert"><?php echo e(session('error')); ?></section>
                </section>
            <?php endif; ?>
            <?php
                $animalBuscado = session('animalBuscado');
                $contador = 0;
            ?>
            <!--Para el formulario que va a mostrar cada uno de los nombres de los animales que tengan una solicitud respecto al usuario-->
            <section class="container-fluid d-flex mb-2">
                <form action="/pawsTails/mostrarAnimalesFiltro" method="POST" class="d-flex mt-3">
                    <?php echo csrf_field(); ?>
                    <section class="form-group d-flex">
                        <label for="nombre_animal" class="marron-oscuro">Filtrar por nombre:</label>
                        <select id="nombre_animal" name="nombre_animal" class="form-control color-enfoque" required>
                            <option value=" ">Todos los animales</option>
                            <?php $__currentLoopData = $nombresAnimales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($nombre); ?>" <?php if($animalBuscado == $nombre): ?> selected <?php endif; ?>><?php echo e($nombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </section>
                    <button type="submit" class="btn btn-formulario">Aceptar</button>
                </form>
            </section>
            <?php $__currentLoopData = $solicitudes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$animalBuscado || $animalBuscado == $solicitud->animal->nombre): ?>
                    <?php
                        $color = 'warning';
                        if ($solicitud->estado == 'aprobado') {
                            $color = 'success';
                        } elseif ($solicitud->estado == 'rechazado') {
                            $color = 'danger';
                        }
                        $contador++;
                    ?>
                    <section class="col-md-4 mb-4">
                        <section class="card h-100 border-<?php echo e($color); ?> text-dark bordeSolicitud">
                            <section class="card-body">
                                <section class="text-center">
                                    <h5 class="card-title"><?php echo e($solicitud->animal->nombre); ?></h5>
                                    <img src="<?php echo e(Storage::url('public/imagenesAnimales/' . $solicitud->animal->imagen)); ?>"
                                        class="card-img-top img-fluid fotoSolicitudes"
                                        alt="<?php echo e($solicitud->animal->nombre); ?>">
                                </section>
                                <p class="card-text"><b>Refugio:</b> <?php echo e($solicitud->refugio->nombre); ?></p>
                                <p class="card-text"><b>Correo:</b> <?php echo e($solicitud->refugio->correo); ?></p>
                                <p class="card-text"><b>Telefono:</b> <?php echo e($solicitud->refugio->telefono); ?></p>
                                <p class="card-text"><b>Solicitante:</b> <?php echo e($solicitud->usuario->nombre); ?></p>
                                <p class="card-text"><b>Correo del Solicitante:</b> <?php echo e($solicitud->usuario->correo); ?>

                                </p>
                                <p class="card-text"><b>Estado:</b> <button
                                        class="btn btn-<?php echo e($color); ?> btn-solicitud"><?php echo e(ucfirst($solicitud->estado)); ?></button>
                                </p>
                            </section>
                            <section class="card-footer d-flex justify-content-center">
                                <form id="formEliminarSolicitud<?php echo e($solicitud->id); ?>"
                                    action="/pawsTails/borrarSolicitud/<?php echo e($solicitud->id); ?>" method="POST"
                                    class="p-2">
                                    <?php echo csrf_field(); ?>
                                    <button type="button" class="btn btn-dark text-center" data-bs-toggle="modal"
                                        data-bs-target="#modalConfirmacion<?php echo e($solicitud->id); ?>">Eliminar
                                        Solicitud</button>
                                </form>

                                <?php if(session('rol_usuario') == 'refugio' && $solicitud->estado == 'pendiente'): ?>
                                    <a href="#" class="p-2" data-bs-toggle="modal"
                                        data-bs-target="#confirmarAceptarModal<?php echo e($solicitud->id); ?>">
                                        <button type="button" class="btn btn-success">Aceptar solicitud</button>
                                    </a>
                                    <a href="/pawsTails/adopcionesRechazar/<?php echo e($solicitud->id); ?>" class="p-2">
                                        <button type="button" class="btn btn-danger">Rechazar solicitud</button>
                                    </a>
                                <?php endif; ?>
                            </section>
                            <!-- Modal para confirmar la aceptación de la solicitud de adopción -->
                            <section class="modal fade" id="confirmarAceptarModal<?php echo e($solicitud->id); ?>" tabindex="-1"
                                role="dialog" aria-labelledby="confirmarAceptarModalLabel<?php echo e($solicitud->id); ?>"
                                aria-hidden="true">
                                <section class="modal-dialog" role="document">
                                    <section class="modal-content">
                                        <section class="modal-header">
                                            <h5 class="modal-title"
                                                id="confirmarAceptarModalLabel<?php echo e($solicitud->id); ?>">
                                                Confirmar Aceptar solicitud de adopción</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </section>
                                        <section class="modal-body">
                                            ¿Estás seguro de que deseas aceptar esta solicitud? El resto de solicitudes
                                            para
                                            "<b><?php echo e($solicitud->animal->nombre); ?></b>" se rechazarán automáticamente.
                                        </section>
                                        <section class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <a href="/pawsTails/adopcionesAceptar/<?php echo e($solicitud->id); ?>"
                                                class="btn btn-success">Aceptar</a>
                                        </section>
                                    </section>
                                </section>
                            </section>


                            <!--Modal de confirmación para eliminar la solicitud-->
                            <section class="modal" id="modalConfirmacion<?php echo e($solicitud->id); ?>" tabindex="-1">
                                <section class="modal-dialog">
                                    <section class="modal-content">
                                        <section class="modal-header">
                                            <h5 class="modal-title">Confirmar eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </section>
                                        <section class="modal-body">
                                            ¿Estás seguro de que deseas eliminar la solicitud para adoptar a
                                            "<b><?php echo e($solicitud->animal->nombre); ?></b>"<?php if(session('rol_usuario') == 'refugio'): ?>
                                                de <?php echo e($solicitud->usuario->nombre); ?>

                                            <?php endif; ?>?
                                        </section>
                                        <section class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger"
                                                form="formEliminarSolicitud<?php echo e($solicitud->id); ?>">Eliminar</button>
                                        </section>
                                    </section>
                                </section>
                            </section>

                        </section>
                    </section>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($contador == 0): ?>
                <section class="container-fluid text-center">
                    <p class="display-6">Lo sentimos, pero en estos momentos no tienen niguna solicitud pendiente.</p>
                </section>
            <?php endif; ?>
        </section>
        <p><a href="/pawsTails/animales"><img src="<?php echo e(asset('imagenesTienda/iconos/arrow-back.png')); ?>"
                    width="50" height="50" class="img-fluid p-1 aumentoFoto"
                    alt="Icono de una flecha para volver hacia atras"></a></p>
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
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/animales/solicitudUsuario.blade.php ENDPATH**/ ?>