<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\productoController;
use App\Http\Middleware\MiddlewareAdmin;



//Pagina de la aplicacion de Paws and Tails

//Para redirigir al iniciar la busqueda de la aplicación
Route::get('/pawsTails',[usuarioController::class,"cargarMenu"]);

//Para redirigir al formulario de inicio de sesion y el segundo al de crear una cuenta
Route::get("/pawsTails/login",[usuarioController::class,"iniciarSesion"]);
Route::get("/pawsTails/crearCuenta",[usuarioController::class,"mostrarFormularioCuenta"]);

//Para comprobar que los datos del formulario sean correctos para los usuarios
Route::post("/pawsTails/comprobarLogin",[usuarioController::class,"comprobarLogin"]);
Route::post("/pawsTails/crearCuenta",[usuarioController::class,"crearCuenta"]);
Route::post("/actualizar-perfil",[usuarioController::class,"actualizarDatos"]);
Route::get("/actualizar-perfil", [usuarioController::class,"verPerfil"]);


//Para mostrar el perfil del usuario y sus datos
Route::get("/pawsTails/perfil",[usuarioController::class,"verPerfil"]);
//Para cerrar la sesion del usuario
Route::get("/pawsTails/cerrarSesion",[usuarioController::class,"cerrarSesion"]);

//Para lo relacionado con los productos
Route::get("/pawsTails/productos",[productoController::class,"mostrar"]);
//Para que un administrador sea capaz de agregar un nuevo producto
Route::get("/pawsTails/agregarProducto",[productoController::class,"mostrarFormularioProducto"])->middleware(MiddlewareAdmin::class);
Route::post("/agregarProducto",[productoController::class,"agregarProducto"])->middleware(MiddlewareAdmin::class);