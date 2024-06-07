<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareAdmin
{
    //Por defecto la definicion de una funcion para un middleware, lleva el nombre de handle
    public function handle(Request $request, Closure $next): Response
    {
        // Comprobamos que la sesion de rol_usuario, sea igual a administrador
        if (session("rol_usuario") == "administrador") {
            // Si se cumple pasa al controlador
            return $next($request);
        }

        // Si no se cumple, devuelve una vista indicando que se le ha prohibido el acceso a la página, el primer valor es la vista a la cual se le va a redirigir,
        // el segundo valor es un array en caso de que se le tengan que pasar datos a la vista, y el ultimo es para darle informacion al navegador, en este caso
        // 403 indica forbidden, osea que al usuario se le ha denegado al acceso a la página
        return response()->view("denegado.permiso", ["permiso"=>"No tienes permiso para acceder a esta página"], 403);
    }
}

