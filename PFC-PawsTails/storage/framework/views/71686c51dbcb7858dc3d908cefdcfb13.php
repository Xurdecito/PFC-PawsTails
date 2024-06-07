<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Animales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="icon" href="<?php echo e(asset('imagenesTienda/favicon.ico')); ?>" sizes="64x64" type="image/x-icon">
    <link rel="prefetch" href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="prefetch" href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <!--Menú de navegacion-->
    <section class="container-fluid navegacion">
        <nav class="navbar navbar-expand-sm bg-light container-fluid text-center fixed-top">
            <a class="navbar-brand" href="/pawsTails">
                <img src="<?php echo e(asset('imagenesTienda/imagen sin fondo.png')); ?>" class="img-fluid logo"
                    alt="logo empresa Paws and Tails">
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#menu"><!--navbar-toggler indica que va a ser el boton que va a colapsar data-bs-toggle indica como lo va a hacer y target a quien va dirgido-->
                <span class="navbar-toggler-icon"></span><!--Simbolo para el boton de mostrar/ocultar nav-->
            </button>

            <section class="collapse navbar-collapse" id="menu">
                <!--Collapse indica que como se deben colapsar los elementos al visualizarlos en dispositivos pequeños-->
                <nav class="navbar-nav d-flex justify-content-start flex-grow-1">
                    <!--flex-grow-1 para que se comporte como se espera, ya que si no los cambios al usar justify-content no se aprecian-->
                    <a href="/pawsTails"
                        class="nav-link text-dark color-nav">Inicio</a><!--nav-link para el estilo de los enlaces sin subrayado... y text-dark para el color del texto-->
                    <?php if(session('rol_usuario') != 'refugio'): ?>
                        <a href="/pawsTails/productos" class="nav-link text-dark color-nav">Productos</a>
                    <?php endif; ?>
                    <a href="/pawsTails/animales" class="nav-link marron">Adopción</a>
                    <a href="/pawsTails/contacto" class="nav-link text-dark color-nav">Contacto</a>

                    <!--Se mostrara Mi perfil solo si el usuario ha iniciado sesion, si no le dara la opcion para que cree una cuenta o inicie sesion-->
                    <section class="dropdown ms-auto">
                        <a class="nav-link text-dark ms-auto dropdown-toggle color-nav" role="button"
                            data-bs-toggle="dropdown">
                            <?php echo e($datosMenu['menu']); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php $__currentLoopData = $datosMenu['enlaces']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a class="dropdown-item color-nav contenedor-dropdown <?php if($loop->last): ?> ultimo <?php endif; ?>"
                                        href="<?php echo e($datos['url']); ?>"><?php echo e($datos['texto']); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </section>

                    <svg class="me-3 icon icon-tabler icons-tabler-outline icon-tabler-user-circle"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" stroke="#8b5025" />
                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" stroke="#8b5025" />
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" stroke="#8b5025" />
                    </svg>
                </nav>
            </section>
        </nav>
    </section>

    <section class="container-fluid">
        <section class="row justify-content-center mb-4 separacion">
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
            <section class="col-10">
                <section class="card p-4 shadow rounded bg-light">
                    <h2 class="text-center marron">La Responsabilidad de Adoptar</h2>
                    <p>
                        Adoptar una mascota es un acto de amor y responsabilidad. Antes de decidir adoptar, es
                        importante considerar los siguientes puntos:
                    </p>
                    <section class="row">
                        <section class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3"><b>Tiempo y Compromiso:</b> Una mascota requiere atención diaria,
                                    ejercicio y cuidados médicos.</li>
                                <li class="mb-3"><b>Gastos:</b> Los costos de alimentación, salud y otros cuidados
                                    pueden sumar.</li>
                                <li class="mb-3"><b>Espacio:</b> Asegúrate de tener el espacio adecuado para la
                                    mascota que deseas adoptar.</li>
                            </ul>
                        </section>
                        <section class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3"><b>Compatibilidad:</b> Considera si la mascota es adecuada para
                                    tu estilo de vida y entorno familiar.</li>
                                <li class="mb-3"><b>Longevidad:</b> Las mascotas pueden vivir muchos años, así que
                                    prepárate para un compromiso a largo plazo.</li>
                            </ul>
                        </section>
                    </section>
                    <p class="text-center mt-4">
                        <b>Si estás listo para asumir esta hermosa responsabilidad, ¡explora los animales que buscan
                            un hogar!</b>
                    </p>
                    <p class="text-center mt-4 text-primary">
                        <b>Recuerde que una vez realizada la solicitud, el refugio correspondiente se pondrá en contacto
                            con usted.</b>
                    </p>
                    <section class="text-center">
                        <img src="<?php echo e(asset('imagenesTienda/iconos/logoAdopcion.jpg')); ?>" alt="Adopción Responsable"
                            class="img-fluid rounded" width="300" height="300">
                    </section>
                </section>
            </section>
        </section>

        <section class="row justify-content-center">
            <section class="col-10">
                <section class="card p-4 shadow rounded">
                    <h2 class="text-center">Animales Disponibles para Adoptar</h2>
                    <!--Formulario de selección de refugios-->
                    <form action="<?php echo e(url('pawsTails/animales')); ?>" method="POST" class="d-flex p-3">
                        <?php echo csrf_field(); ?>
                        <section class="form-group d-flex">
                            <label for="refugio" class="marron-oscuro p-2">Filtrar:</label>
                            <select id="refugio" name="refugio" class="form-control color-enfoque" required>
                                <option value = " ">Todos los refugios</option>
                                <?php $__currentLoopData = $datosRefugios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refugio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($refugio->id); ?>"
                                        <?php if(session('refugioBuscado') == $refugio->id): ?> selected <?php endif; ?>>
                                        <?php echo e($refugio->nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </section>
                        <button type="submit" class="btn btn-formulario">Aceptar</button>
                    </form>
                    <section class="row">
                        <?php
                            $contador = 0;
                            $refugioBuscado = session('refugioBuscado');
                        ?>
                        <?php $__currentLoopData = $animales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$refugioBuscado || $refugioBuscado == $animal->usuario->id): ?>
                                <section class="col-md-4 mb-4">
                                    <section class="card h-100">
                                        <section class="card-info">
                                            <section class="card-contenido">
                                                <h5 class="card-title"><?php echo e($animal->nombre); ?></h5>
                                                <p class="card-text"><b><?php echo e(strtoupper($animal->especie)); ?></b></p>
                                                <p class="card-text"><b>Refugio: </b><?php echo e($animal->usuario->nombre); ?>

                                                </p>
                                                <p class="card-text"><b>Contacto: </b><?php echo e($animal->usuario->correo); ?>

                                                </p>
                                                <p class="card-text"><?php echo e($animal->descripcion); ?></p>
                                                <a href="/pawsTails/adoptar/<?php echo e($animal->id); ?>"
                                                    class="btn btn-formulario">Adoptar<img
                                                        src="<?php echo e(asset('imagenesTienda/iconos/heart-handshake.png')); ?>"
                                                        width="35" height="35" class="img-fluid p-1" alt="Icono de dos manos haciendo un corazon"></a>
                                                <?php if(session('rol_usuario') == 'administrador' ||
                                                        (session('rol_usuario') == 'refugio' && $animal->usuario_id == session('id_usuario'))): ?>
                                                    <a href="/pawsTails/editarAnimal/<?php echo e($animal->id); ?>"
                                                        class="btn btn-primary">Editar<img
                                                            src="<?php echo e(asset('imagenesTienda/iconos/edit.png')); ?>"
                                                            width="35" height="35" class="img-fluid p-1" alt="Icono de un lápiz"></a>
                                                    <a href="/pawsTails/borrarAnimal/<?php echo e($animal->id); ?>"
                                                        class="btn btn-danger m-2"><img
                                                            src="<?php echo e(asset('imagenesTienda/iconos/trash.png')); ?>"
                                                            width="35" height="35" class="img-fluid p-1"
                                                            title="Eliminar animal" alt="Icono de una papelera"></a>
                                                <?php endif; ?>
                                            </section>
                                            <section class="card-imagen"
                                                style="background-image: url('<?php echo e(Storage::url('public/imagenesAnimales/' . $animal->imagen)); ?>');">
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <?php
                                    $contador++;
                                ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </section>
                    <?php if($contador == 0): ?>
                        <section class="contaiiner-fluid text-center">
                            <p class="display-6">Este refugio actualmente no está mostrando ningun animal.</p>
                        </section>
                    <?php endif; ?>
                </section>
            </section>
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
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/animales/mostrarAnimales.blade.php ENDPATH**/ ?>