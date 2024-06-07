<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Productos</title>
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
                        <a href="/pawsTails/productos" class="nav-link marron">Productos</a>
                    <?php endif; ?>
                    <a href="/pawsTails/animales" class="nav-link text-dark color-nav">Adopción</a>
                    <a href="/pawsTails/contacto" class="nav-link text-dark color-nav">Contacto</a>

                    <!--Se mostrara  solo si el usuario ha iniciado sesion, si no le dara la opcion para que cree una cuenta o inicie sesion-->
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
    </section>


    <section class="container-fluid d-flex">
        <!-- Formulario de selección de categorías -->
        <form action="/pawsTails/productos" method="POST" class="d-flex mt-3">
            <?php echo csrf_field(); ?>
            <section class="form-group d-flex">
                <label for="categoria" class="marron-oscuro p-2">Filtrar:</label>
                <select id="categoria" name="categoria" class="form-control color-enfoque" required>
                    <option value = " ">Todas las categorías</option>
                    <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($categoria->id); ?>" <?php if(session('categoriaBuscada') == $categoria->id): ?> selected <?php endif; ?>>
                            <?php echo e($categoria->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </section>
            <button type="submit" class="btn btn-formulario">Aceptar</button>
        </form>


        <?php if(session('rol_usuario') == 'administrador'): ?>
            <button class="btn btn-formulario btn-catalogo ms-auto"><a href="<?php echo e(url('pawsTails/agregarProducto')); ?>"
                    class="nav-link">Agregar un producto</a></button>
        <?php endif; ?>
    </section>


    <!--Contenido de la página, donde se muestran todos los productos-->
    <?php if(session('info')): ?>
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-success" role="alert"><?php echo e(session('info')); ?><a
                    class="nav-link text-primary herramientas" href="/pawsTails/carrito">Ver carrito.</a></section>
        </section>
    <?php endif; ?>
    <?php if(session('infoAdmin')): ?>
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-success" role="alert"><?php echo e(session('infoAdmin')); ?></section>
        </section>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-danger" role="alert"><?php echo e(session('error')); ?></section>
        </section>
    <?php endif; ?>
    <section class="container-fluid p-2">
        <?php
            $categoriaBuscada = session('categoriaBuscada');
            $contador = 0;
        ?>
        <?php $__currentLoopData = $catalogo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$categoriaBuscada || $categoriaBuscada == $producto->categoria_id): ?>
                <?php if($contador % 3 == 0): ?>
                    <section class="container-fluid row p-2">
                <?php endif; ?>
                <section class="col-4 p-0 d-flex justify-content-center align-items-center flex-column">
                    <img src="<?php echo e(Storage::url('public/imagenesCatalogo/' . $producto->imagen)); ?>" width="350"
                        height="350" class="img-fluid p-2 mt-2" alt="<?php echo e($producto->nombre); ?>">
                    <p><?php echo e($producto->nombre); ?></p>
                    <section>
                        <a href=<?php echo e('/pawsTails/productos/' . $producto->id); ?>

                            class="text-decoration-none text-white btn btn-formulario btn-marron p-2">Mas información</a>
                        <a href=<?php echo e('/pawsTails/productos/agregarCarrito/' . $producto->id); ?>><img
                                src="<?php echo e(asset('imagenesTienda/iconos/shopping-bag.png')); ?>" width="50"
                                height="50" class="img-fluid p-1 aumentoFoto"
                                alt="Icono de un carrito de la compra"></a>
                    </section>
                    <?php if(session('rol_usuario') == 'administrador'): ?>
                        <section>
                            <a href="/pawsTails/editarProducto/<?php echo e($producto->id); ?>"
                                class="text-primary text-decoration-none btn btn-primary text-white">Editar<img
                                    src="<?php echo e(asset('imagenesTienda/iconos/edit.png')); ?>" width="35"
                                    height="35" class="img-fluid p-1" alt="Icono de un lápiz"></a>
                            <a href="#" class="text-danger text-decoration-none btn btn-danger text-white" data-bs-toggle="modal"
                                data-bs-target="#confirmarBorrar<?php echo e($producto->id); ?>">
                                Borrar
                                <img src="<?php echo e(asset('imagenesTienda/iconos/trash.png')); ?>" width="35"
                                    height="35" class="img-fluid p-1" alt="Icono de una papelera">
                            </a>

                            <!--Modal para confirmar la eliminacion del producto-->
                            <section class="modal fade" id="confirmarBorrar<?php echo e($producto->id); ?>" tabindex="-1"
                                aria-labelledby="confirmarBorrarLabel<?php echo e($producto->id); ?>" aria-hidden="true">
                                <section class="modal-dialog">
                                    <section class="modal-content">
                                        <section class="modal-header">
                                            <h5 class="modal-title" id="confirmarBorrarLabel<?php echo e($producto->id); ?>">
                                                Confirmar eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </section>
                                        <section class="modal-body">
                                            ¿Estás seguro que deseas eliminar "<?php echo e($producto->nombre); ?>"?.
                                        </section>
                                        <section class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <a href="/pawsTails/borrarProducto/<?php echo e($producto->id); ?>"
                                                class="btn btn-danger">Eliminar</a>
                                        </section>
                                    </section>
                                </section>
                            </section>

                        </section>
                    <?php endif; ?>
                </section>
                <?php //Mirar a ver si esto lo hay que eliminar o no cuando agregue mas de 3 productos
                    $contador++;
                ?>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($contador == 0): ?>
        <section class="container-fluid text-center productoNoEncontrado">
            <p class="display-6 text-center">¡Lo sentimos, pero no hemos encontrado ningun producto que enseñarte!.</p>
        </section>
    <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/productos/catalogo.blade.php ENDPATH**/ ?>