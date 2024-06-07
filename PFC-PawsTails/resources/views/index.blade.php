<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paws & Tails - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('imagenesTienda/favicon.ico') }}" sizes="64x64" type="image/x-icon">
    <link rel="prefecth" href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="prefetch" href="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</head>

<body>
    <!--Menú de navegacion-->
    <section class="container-fluid navegacion">
        <nav class="navbar navbar-expand-sm bg-light container-fluid text-center fixed-top">
            <a class="navbar-brand" href="/pawsTails">
                <img src="{{ asset('imagenesTienda/imagen sin fondo.png') }}" class="img-fluid logo"
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
                        class="nav-link marron">Inicio</a><!--nav-link para el estilo de los enlaces sin subrayado... y text-dark para el color del texto-->
                    @if (session('rol_usuario') != 'refugio')
                        <a href="/pawsTails/productos" class="nav-link text-dark color-nav">Productos</a>
                    @endif
                    <a href="/pawsTails/animales" class="nav-link text-dark color-nav">Adopción</a>
                    <a href="/pawsTails/contacto" class="nav-link text-dark color-nav">Contacto</a>

                    <!--Se mostrara Mi perfil solo si el usuario ha iniciado sesion, si no le dara la opcion para que cree una cuenta o inicie sesion-->
                    <section class="dropdown ms-auto">
                        <a class="nav-link text-dark ms-auto dropdown-toggle color-nav" role="button"
                            data-bs-toggle="dropdown">
                            {{ $datosMenu['menu'] }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" id="contenedor-menu">
                            @foreach ($datosMenu['enlaces'] as $datos)
                                <li><a class="dropdown-item contenedor-dropdown color-nav @if ($loop->last) ultimo @endif"
                                        href="{{ $datos['url'] }}">{{ $datos['texto'] }}</a></li>
                            @endforeach
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
    <!--Se mostrara el mensaje de que la sesion del usuario se ha iniciado de manera exitosa-->
    @if (session('sesionIniciada'))
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-success mt-5" role="alert">{{ session('sesionIniciada') }}</section>
        </section>
    @endif
    <!--Se mostrara el mensaje de que la sesion del usuario se ha cerrado de manera exitosa-->
    @if (session('sesionCerrada'))
        <section class="container-fluid d-flex justify-content-center">
            <section class="alert alert-success mt-5" role="alert">{{ session('sesionCerrada') }}<br>¡Esperamos verte pronto por aquí!</section>
        </section>
    @endif

    <!--Carrusel-->
    <section class="carousel slide bg-light text-center" data-bs-ride="carousel" data-bs-interval="5000">
        <section class="carousel-inner">
            <section class="carousel-item active">
                <section class="row">
                    <section class="col-4 bg-primary p-0 d-flex justify-content-center align-items-center flex-column">
                        <h5 class="display-5 text-white">Paws and Tails</h5>
                        <p class="text-warning lead">Porque las mejores historias se escriben con huellas</p>
                    </section>
                    <section class="col-8 p-0">
                        <img src="{{ asset('imagenesTienda/carrusel/perroygato.jpg') }}" alt="Foto de un gato y un perro"
                            class="img-fluid carrusel">
                    </section>
                </section>
            </section>

            <section class="carousel-item">
                <section class="row">
                    <section class="col-4 bg-primary p-0 d-flex justify-content-center align-items-center flex-column">
                        <h5 class="display-5 text-white">Paws and Tails</h5>
                        <p class="text-warning lead">Accesorios y juguetes para mantener a tu mascota feliz y saludable
                        </p>
                    </section>
                    <section class="col-8 p-0">
                        <img src="{{ asset('imagenesTienda/carrusel/gatoCarrusel.jpg') }}" alt="Foto de un gato echado en el césped"
                            class="img-fluid carrusel">
                    </section>
                </section>
            </section>
        </section>
    </section>

    <!--Información sobre la tienda-->
    <section class="container-fluid">
        <h6 class="display-6 text-center">Sobre nosotros</h6>
        <section class="row mb-4">
            <section class="col-6 infoPrincipal">
                <h2 class="mb-4">Paws and Tails</h2>
                <p class="lead">Paws and Tails es tu destino definitivo para el cuidado y el bienestar de tus queridas
                    mascotas. Como una tienda dedicada con pasión al mundo animal, nos enorgullece ofrecerte una amplia
                    gama de productos de la más alta calidad para perros, gatos y otras mascotas. Desde alimentos
                    nutritivos hasta juguetes interactivos y accesorios elegantes, tenemos todo lo que necesitas para
                    mantener a tus amigos peludos felices y saludables. Nuestro compromiso es brindarte no solo
                    productos excepcionales, sino también orientación experta y un servicio personalizado para
                    satisfacer las necesidades únicas de cada mascota.</p>
            </section>
            <section class="col-6 infoPrincipal">
                <img src="{{ asset('imagenesTienda/imagen sin fondo.png') }}" class="img-fluid fotoInfo"
                    alt="logo empresa Paws and Tails">
            </section>
        </section>

        <section class="row mb-4">
            <section class="col-6 infoPrincipal">
                <img src="{{ asset('imagenesTienda/carrusel/cuidador.png') }}" class="img-fluid p-1 fotoInfo"
                    alt="Dibujo de un cuidador en una tienda de animales">
            </section>
            <section class="col-6 infoPrincipal">
                <h2 class="mb-4">Confia en nosotros</h2>
                <p class="lead">En Paws and Tails, tu confianza es nuestra prioridad número uno. Nos esforzamos por
                    ganar y mantener tu confianza en cada interacción que tengas con nosotros. Con años de experiencia
                    en el cuidado de mascotas y un equipo dedicado de amantes de los animales, puedes confiar en que
                    estamos aquí para brindarte productos de la más alta calidad, consejos expertos y un servicio
                    excepcional. Desde la selección cuidadosa de nuestros proveedores hasta la atención personalizada
                    que ofrecemos a cada cliente, estamos comprometidos a superar tus expectativas y ser tu destino
                    confiable para todas las necesidades de tus mascotas. Cuando confías en Paws and Tails, puedes estar
                    seguro de que estás haciendo lo mejor para tus amigos peludos.</p>
            </section>
        </section>
    </section>


    <section class="container-fluid mt-4">
        <h6 class="display-6 text-center">Quizá te pueda interesar</h6>
        <section class="row d-flex justify-content-around mt-4">
            <section class="col-md-4">
                <section class="card">
                    <img src="{{ asset('imagenesTienda/carrusel/estandaresAlimentarios.jpg') }}"
                        alt="logo de estandares alimenticios">
                    <section class="card-body">
                        <h5 class="card-title lead">¿Con qué están hechos nuestros productos?</h5>
                        <p class="card-text">Todos nuestros productos están realizados con materiales respetuosos con
                            el medio ambiente, cumpliendo todos los estándares de calidad.</p>
                    </section>
                </section>
            </section>
            <section class="col-md-4">
                <section class="card">
                    <img src="{{ asset('imagenesTienda/carrusel/refugio.png') }}"
                        alt="imagen de un dibujo de un refugio">
                    <section class="card-body">
                        <h5 class="card-title lead">¿De dónde provienen los animales?</h5>
                        <p class="card-text">Los animales que ofrecemos en nuestra tienda provienen de refugios
                            responsables y certificados que se preocupan por el bienestar y la salud de los animales.
                            Los animales que se ofrecen en adopción, no dependen de la marca Paws and Tails, sino que
                            esta se utiliza como medio para poner en contacto a refugios que esten acreditados con
                            personas interesadsa en asdoptar</p>
                    </section>
                </section>
            </section>
            <section class="col-md-4">
                <section class="card">
                    <img src="{{ asset('imagenesTienda/carrusel/veterinaria.jpg') }}"
                        alt="imagen de un dibujo de un veterinario cuidando a una mascota">
                    <section class="card-body">
                        <h5 class="card-title lead">Siempre al lado de vuestras mascotas</h5>
                        <p class="card-text">Nuestra mayor preocupacion es el bienestar de las mascotas que se
                            encuentren a nuestro cargo, es por ello que les daremos el mejor trato y cuidado posible, y
                            estaremos a su disposicion para cualquier duda que le surga.</p>
                    </section>
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
