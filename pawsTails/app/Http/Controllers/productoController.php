<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\categoria;

class productoController extends Controller
{
    //Funcion que va a devolver la vista de los productos de la tienda, hace una instancia del controlador de usuario, ya que alli se encuentra la funcion la cual va
    //a devolver un array con los datos del dropdown
    public function mostrar(){
        $controladorUsuario = new usuarioController();
        $aux = $controladorUsuario->datosMenu();
        $catalogo = producto::all();
        return view("productos.catalogo")->with("datosMenu",$aux)->with("catalogo",$catalogo);
    }

    //Funcion que se encarga de recoger en una variable todos los datos de la tabla de productos, y los devuelve junto con la vista de agregar un nuevo producto
    public function mostrarFormularioProducto(){
      $categorias = categoria::all();
      return view("productos.añadir")->with("categorias",$categorias);
    }

    public function agregarProducto(Request $request){

      $request -> validate([
        "nombre" => "required|string",
        "descripcion" => "required|string|max:500",
        "categoria" => "required",
        "imagen" => "required|image|mimes:jpeg,png,jpg|max:2048",//El ultimo valor es para el tamaño maximo de la imagen
        "precio" => "required|numeric"
      ], [
        "nombre.required" => "El nombre es obligatorio.",
        "descripcion.required" => "La descripción del producto es obligatoria.",
        "descripcion.max" => "La descripción del producto no debe exceder los 500 caracteres.",
        "categoria.required" => "La categoria del producto es obligatoria.",
        "imagen.required" => "Debes añadir una imagen al producto.",
        "imagen.image" => "La imagen seleccionada no es válida.",
        "imagen.max" => "El tamaño maximo de la imagen es de 2MB.",
        "imagen.mimes" => "La imagen debe tener una de las siguientes extensiones: jpeg,png,jpg.",
        "precio.required" => "El precio para el producto es obligatorio.",
        "precio.numeric" => "El precio debe ser un número." 
    ]);

    $producto = new Producto();
    $producto->nombre = $request->nombre;
    $producto->descripcion = $request->descripcion;
    $producto->categoria_id = $request->categoria;

    $imagen = $request->file("imagen"); //Seleccionamos la imagen que el usuario ha añadido
    //Creamos una variable en la que vamos a guardar el nombre de la foto, para evitar duplicados, le agregamos el tiempo y una barra baja al inicio del nombre
    $nombreImagen = time() . "_" .  $imagen->getClientOriginalName(); 

    $imagen->storeAs("public/imagenesCatalogo/",$nombreImagen); //Usando el metodo proporcionado por Laravel, guardamos la imagen, lo primero es el directorio, y lo segundo el nombre
 
    $producto->imagen = $nombreImagen;
    $producto->precio = $request->precio;

    $producto->save();
    return redirect("/pawsTails/agregarProducto")->with("info","¡Tu producto se ha agregado de manera exitosa!");
    }
}
