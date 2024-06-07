<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Mis pedidos</title>
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

    <section class="container-fluid">
        <h6 class="display-6 separacion">Mis pedidos</h6>
        <!--Formulario que permite buscar un pedido a traves de su id-->
        <section class="container-fluid">
            <form action="/pawsTails/buscarPedido" method="GET" class="d-flex justify-content-center mt-3 mb-3">
                <input type="number" name="pedidoBuscado" placeholder="Buscar por #id de pedido"
                    class="form-control color-enfoque me-2 w-25" min="0">
                <button type="submit" class="btn btn-formulario">Buscar</button>
            </form>
        </section>
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
        <section class="row d-flex justify-content-center">
            <?php
                $totalProducto = 0;
                $totalPedido = 0;
                $pedidoBuscado = session('pedidoBuscado');
            ?>
            <?php $__currentLoopData = $datosPedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$pedidoBuscado || $pedidoBuscado->id == $pedido['pedido']->id): ?>
                <?php $totalPedido = 0;?>
                <section class="col-md-4">
                    <section class="card">
                        <section class="card-body">
                            <h5 class="card-title">Id del pedido #<?php echo e($pedido['pedido']->id); ?></h5>
                            <p class="card-text">Fecha: <?php echo e($pedido['pedido']->created_at); ?></p>
                            <ul class="list-group list-group-flush">
                                <p><b>Productos:</b></p>
                                <?php $__currentLoopData = $pedido['productos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $totalProducto = $producto->precio * $producto->cantidad_producto;
                                        $totalPedido += $totalProducto;
                                    ?>
                                    <li class="list-group-item"><?php echo e($producto->nombre); ?>

                                        (<?php echo e($producto->cantidad_producto); ?> unidades)
                                        - <?php echo e($totalProducto); ?> €.</li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <p class="card-text"><strong>Total: </strong><?php echo e($totalPedido); ?> €.</p>
                        </section>
                    </section>
                </section>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($totalProducto == 0): ?>
                <p class="display-5 separacion">Aun no has realizado ningun pedido.</p>
            <?php endif; ?>
        </section>
        <p><a href="/pawsTails/productos"><img src="<?php echo e(asset('imagenesTienda/iconos/arrow-back.png')); ?>"
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
<?php /**PATH C:\xampp\htdocs\pawsTails\resources\views/pedidos/misPedidos.blade.php ENDPATH**/ ?>