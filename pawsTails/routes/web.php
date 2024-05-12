<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\carritoController;
use App\Http\Controllers\pedidoController;
use App\Http\Middleware\MiddlewareAdmin;



//Pagina de la aplicacion de Paws and Tails

//Para redirigir al iniciar la busqueda de la aplicación
Route::get("/pawsTails",[usuarioController::class,"cargarMenu"]);

//Para redirigir al formulario de inicio de sesion y el segundo al de crear una cuenta
Route::get("/pawsTails/login",[usuarioController::class,"iniciarSesion"]);
Route::get("/pawsTails/crearCuenta",[usuarioController::class,"mostrarFormularioCuenta"]);

//Para comprobar que los datos del formulario sean correctos para los usuarios
Route::post("/pawsTails/comprobarLogin",[usuarioController::class,"comprobarLogin"]);
Route::post("/pawsTails/crearCuenta",[usuarioController::class,"crearCuenta"]);
Route::post("/actualizar-perfil",[usuarioController::class,"actualizarDatos"]);
Route::get("/actualizar-perfil", [usuarioController::class,"verPerfil"]);

//Para que se muestren todos los usuarios registrados en la página
Route::get("/pawsTails/listarUsuarios",[usuarioController::class,"listarUsuarios"])->middleware(MiddlewareAdmin::class);
Route::get("/pawsTails/editarUsuario/{id}",[usuarioController::class,"mostrarActualizarUsuario"])->middleware(MiddlewareAdmin::class);
Route::post("/pawsTails/editarUsuario/{id}",[usuarioController::class,"actualizarUsuarioAdmin"])->middleware(MiddlewareAdmin::class);
Route::get("/pawsTails/borrarUsuario/{id}",[usuarioController::class,"borrarUsuario"])->middleware(MiddlewareAdmin::class);


//Para mostrar el perfil del usuario y sus datos
Route::get("/pawsTails/perfil",[usuarioController::class,"verPerfil"]);
//Para cerrar la sesion del usuario
Route::get("/pawsTails/cerrarSesion",[usuarioController::class,"cerrarSesion"]);
//Para mostrar el formulario para que el administrador pueda registrar un refugio en la página
Route::get("/pawsTails/agregarRefugio",[usuarioController::class,"mostrarAgregarRefugio"])->middleware(MiddlewareAdmin::class);
Route::post("/pawsTails/agregarRefugio",[usuarioController::class,"agregarRefugio"])->middleware(MiddlewareAdmin::class);

//Para lo relacionado con los productos
Route::get("/pawsTails/productos",[productoController::class,"mostrar"]);
Route::post("/pawsTails/productos",[productoController::class,"filtrar"]);
Route::post("/pawsTails/añadirCategoria",[productoController::class,"agregarCategoria"])->middleware(MiddlewareAdmin::class);
Route::get("/pawsTails/productos/{id}",[productoController::class,"mostrarProducto"]);
Route::get("/pawsTails/editarProducto/{id}",[productoController::class,"mostrarEditarProducto"]);//Muestra el formulario para editar
Route::post("/pawsTails/editarProducto/{id}",[productoController::class,"editarProducto"]);//Actualiza los campos de la base de datos
Route::get("/pawsTails/borrarProducto/{id}",[productoController::class,"borrarProducto"]);
//Rutas relacionadas con los pedidos
Route::get("/pawsTails/misPedidos",[pedidoController::class,"mostrarPedidosUsuarios"]);//Para mostrar los pedidos de un usuario
Route::get("/pawsTails/pedidosTienda",[pedidoController::class,"mostrarPedidosAdmin"])->middleware(MiddlewareAdmin::class);//Para mostrar los pedidos de la tienda
Route::get("/pawsTails/borrarPedido/{id}",[pedidoController::class,"eliminarPedido"])->middleware(MiddlewareAdmin::class);;
//Para que un administrador sea capaz de agregar un nuevo producto
Route::get("/pawsTails/agregarProducto",[productoController::class,"mostrarFormularioProducto"])->middleware(MiddlewareAdmin::class);
Route::post("/agregarProducto",[productoController::class,"agregarProducto"])->middleware(MiddlewareAdmin::class);
//Para las rutas relacionadas con el carrito
Route::get("/pawsTails/carrito",[carritoController::class,"mostrarCarrito"]);//Muestra los productos que tiene el usuario en el  carrito
Route::get("/pawsTails/carrito/realizarPedido",[carritoController::class,"realizarPedido"]);//Para mostrar el formulario para que el usuario realice el pedido
Route::post("/pawsTails/carrito/realizarPedido/{id}",[carritoController::class,"crearPedido"]);//Para que el usuario termine de pagar el pedido
Route::get("/pawsTails/productos/agregarCarrito/{id}",[carritoController::class,"agregarProductoCarrito"]);//Agrega un producto al carrito
Route::get("/pawsTails/retroceder",[carritoController::class,"retroceder"]);//Para volver hacia atras, ya que no se sabe desde que enlace se ha accedido al carrito
Route::get("/pawsTails/eliminaruno/{id}",[carritoController::class,"borrarUnArticulo"]);