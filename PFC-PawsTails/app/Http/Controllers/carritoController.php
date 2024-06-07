<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\carrito;
use App\Models\usuario;
use App\Models\producto;
use App\Models\pedido;
use App\Models\pedido_producto;

class carritoController extends Controller
{
    public function mostrarCarrito(){
        if(session()->has("id_usuario")){
            $usuario = usuario::find(session("id_usuario"));
            $carrito = carrito::where("usuario_id", $usuario->id)->with("producto","usuario")->get();
            //dd($carrito);
            return view("carrito.mostrarCarrito")->with("carrito",$carrito);
        }else{
            return response()->view("denegado.permiso", ["permiso"=>"Debes iniciar sesion para poder ver tu carrito."], 404);
        }
        
    }

    //Funcion que agrega un nuevo producto al carrito
    public function agregarProductoCarrito($id){
       // Obtener el ID del usuario de la sesión
    $idUsuario = session("id_usuario");

    //Buscar si el usuario ya tiene el producto agregado al carrito, en ese caso la cantidad aumentará en 1
    $carritoExistente = carrito::where("usuario_id", $idUsuario)->where("producto_id", $id)->first();

    if ($carritoExistente) {
        $carritoExistente->cantidad++;
        $carritoExistente->save();

        //Se usa back en vez del nombre de la vista, ya que se puede añadir un producto desde dos vistas distintas y no se sabe desde cual la va a agregar
        return redirect()->back()->with("info", "Se ha agregado el producto al carrito.");
    }

    //Si no existe una entrada, crear una nueva
    $usuario = usuario::find($idUsuario);
    $producto = producto::find($id);

    //Verificar si el usuario y el producto existen y para agreagar el producto, el rol debe ser de usuario
    if ($usuario && $producto && (session("rol_usuario"))=="usuario") {
        $carrito = new Carrito();
        $carrito->usuario_id = $idUsuario;
        $carrito->producto_id = $id;
        $carrito->cantidad = 1;

        $carrito->save();

        return redirect()->back()->with("info", "Producto agregado al carrito correctamente.");
    } else {
        return redirect()->back()->with("error", "Debe tener una cuenta de usuario para poder agregar productos.");
    }
    }

    //Para volver hacia la pestaña anterior a acceder al carrito, ya que no se sabe cual va a ser pues se redirije directamente a la anterior
    public function retroceder(){
        return redirect()->back();
    }

    //Para eliminar un articulo del carrito
    public function borrarUnArticulo($id){
        $carrito = carrito::where("id", $id)->first();
        $carrito->delete();
        return redirect("/pawsTails/carrito")->with("info", "Producto(s) eliminado(s) del carrito");
    } 

    //Para mostrar la vista para que el usuario introduzca sus datos para realziar el pedido
    public function realizarPedido(){
        if(session()->has("id_usuario")){
            $usuario = usuario::find(session("id_usuario"));
            $carrito = carrito::where("usuario_id", $usuario->id)->with("producto","usuario")->get();
            if($carrito->isEmpty()){
            return redirect("/pawsTails/carrito")->with("info", "Debes agregar algun producto al carrito para poder realizar el pedido.");
            }else{
            return view("carrito.realizarPedido")->with("carrito",$carrito)->with("usuario",$usuario);
            }
        }else{
            return response()->view("denegado.permiso", ["permiso"=>"Debes iniciar sesion para poder ver tu carrito."], 404);
        }
    }

    public function crearPedido($idUsuario, Request $request){

        $request->validate([
            "nombre" => "required|string|max:255",
            "direccion" => "required|string|max:255",
            "email" => "required|email",
            "telefono" => "required|string|size:9",
            "tarjeta" => "required|string|max:20|regex:/^[0-9]{16}$/",
            "vencimiento" => "required|string|max:5|date_format:m/y",
            "cvv" => "required|string|max:4|regex:/^[0-9]{3,4}$/",
        ], [
            "nombre.required" => "El nombre es obligatorio.",
            "direccion.required" => "La dirección es obligatoria.",
            "email.required" => "El correo electrónico es obligatorio.",
            "email.email" => "El correo electrónico debe ser válido.",
            "telefono.required" => "El teléfono es obligatorio.",
            "tarjeta.required" => "El número de tarjeta es obligatorio.",
            "tarjeta.regex" => "El número de tarjeta debe tener 16 dígitos numéricos.",
            "vencimiento.required" => "La fecha de vencimiento es obligatoria.",
            "vencimiento.date_format" => "El formato de la fecha de vencimiento debe ser MM/AA.",
            "cvv.required_with" => "El CVV es obligatorio si se proporciona una tarjeta.",
            "cvv.regex" => "El CVV debe tener 3 o 4 dígitos numéricos."
        ]);        
        //Obtener los productos del carrito del usuario
        $productosCarrito = carrito::where("usuario_id", $idUsuario)->get();
        $usuario = usuario::find(session("id_usuario"));
        $usuario->direccion = $request->direccion;
        $usuario->telefono = $request->telefono;
        $usuario->save();
        //Crear un nuevo pedido
        $pedido = new pedido();
        $pedido->usuario_id = $idUsuario;
    
        //Obtener el último número de pedido y agregar 1 para obtener uno nuevo
        $ultimoNumeroPedido = pedido::max("num_pedido");
        $nuevoNumeroPedido = $ultimoNumeroPedido + 1;
        $pedido->num_pedido = $nuevoNumeroPedido;
        $pedido->save();
    
        foreach ($productosCarrito as $productoCarrito) {
            $pedidoProducto = new pedido_producto();
            $pedidoProducto->pedido_id = $pedido->id;
            $pedidoProducto->producto_id = $productoCarrito->producto_id;
            $pedidoProducto->cantidad = $productoCarrito->cantidad;
            $pedidoProducto->save();
        }
    
        //Eliminar los registros del carrito asociados al usuario
        Carrito::where("usuario_id", $idUsuario)->delete();
    
        return redirect("/pawsTails/carrito")->with("info", "¡Tu pedido se ha registrado con éxito!");
    }
    
    
}
