<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use App\Models\pedido;
use App\Models\pedido_producto;
use Illuminate\Support\Facades\DB;

class pedidoController extends Controller{
    
    //Funcion para recuperar los datos de los pedidos pertenecientes a un usuario
    public function mostrarPedidosUsuarios(){
        $usuario = usuario::find(session("id_usuario"));//Buscamos al usuario a partir del id que se almacena en la sesion
        $pedidos = pedido::where("usuario_id",$usuario->id)->get();//recuperamos todos los pedidos que el usuario haya solicitado
        $datosPedidos = [];
        //Hacemos una consulta para almacenar la informacion de cada producto
        foreach ($pedidos as $pedido) {
            $productos = DB::table("pedido_producto")
                            ->join("productos", "pedido_producto.producto_id", "=", "productos.id")
                            ->where("pedido_producto.pedido_id", "=", $pedido->id)
                            ->select("productos.*","pedido_producto.cantidad as cantidad_producto")
                            ->orderBy("productos.created_at","desc")
                            ->get();
    
            $datosPedidos[] = [
                "pedido" => $pedido,
                "productos" => $productos
            ];
            //dd($datosPedidos);
        }
    
        return view("pedidos.misPedidos")->with("datosPedidos", $datosPedidos);
    }

    //Funcion que va a devolver todos los pedidos realizados por todos los usuarios
    public function mostrarPedidosAdmin(){
        $pedidos = pedido::all();

        $datosPedidos = [];


        foreach ($pedidos as $pedido) {
            $productos = DB::table("pedido_producto")
                            ->join("productos", "pedido_producto.producto_id", "=", "productos.id")
                            ->where("pedido_producto.pedido_id", "=", $pedido->id)
                            ->select("productos.*","pedido_producto.cantidad as cantidad_producto")
                            ->orderBy("productos.created_at","desc")
                            ->get();

            $datosPedidos[] = [
                "pedido" => $pedido,
                "productos" => $productos
            ];
        }

        return view("pedidos.pedidosTienda")->with("datosPedidos", $datosPedidos);
        }

        public function eliminarPedido ($id){
            $pedido = pedido::find($id);

            if (!$pedido) {
                return redirect()->back()->with("error", "El pedido que se intenta eliminar no se ha encontrado.");
            }

            pedido_producto::where("pedido_id", $pedido->id)->delete();//Borramos todos los productos asociados al pedido

 
            $pedido->delete();//Borramos el pedido


            return redirect()->back()->with("info", "El pedido se ha eliminado correctamente.");
        }
    

}
