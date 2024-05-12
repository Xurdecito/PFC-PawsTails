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
        return redirect()->back()->with("error", "No se ha podido agregar el producto, intentelo de nuevo mas tarde.");
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
    
        return redirect("/pawsTails/carrito")->with("info", "¡Tu pedido se ha registrado con éxito! Número de pedido: $nuevoNumeroPedido");
    }
    
    
}
