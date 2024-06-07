<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\producto;
use App\Models\categoria;
use App\Models\comentario;
use App\Models\respuestaComentarios;

class productoController extends Controller
{
    //Funcion que va a devolver la vista de los productos de la tienda, hace una instancia del controlador de usuario, ya que alli se encuentra la funcion la cual va
    //a devolver un array con los datos del dropdown
    public function mostrar(){
        $controladorUsuario = new usuarioController();
        $aux = $controladorUsuario->datosMenu();
        $catalogo = producto::all();
        $categorias = categoria::all();
        return view("productos.catalogo")->with("datosMenu",$aux)->with("catalogo",$catalogo)->with("categorias",$categorias);
    }

    //Funcion que se encarga de recoger en una variable todos los datos de la tabla de productos, y los devuelve junto con la vista de agregar un nuevo producto
    public function mostrarFormularioProducto(){
      $categorias = categoria::all();
      return view("productos.añadir")->with("categorias",$categorias);
    }

    //Funcion que valida el formulario para agregar un nuevo producto
    public function agregarProducto(Request $request){

      $request -> validate([
        "nombre" => "required|string",
        "descripcion" => "required|string|max:255",
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

    public function agregarCategoria(Request $request){
      // Validar los datos del formulario
      $request->validate([
        "nombreCategoria" => "required|string|max:255|unique:categorias,nombre",
      ]);

      //Crear una nueva instancia de la categoría
      $categoria = new Categoria();
      $categoria->nombre = $request->nombreCategoria;
  
      // Guardar la categoría en la base de datos
      $categoria->save();

      //Redireccionar a la página anterior con un mensaje de éxito
      return redirect("/pawsTails/agregarProducto")->with("info","¡La categoría se ha creado de manera correcta!");
      }

      //Funcion que se ejecuta cuando se haga clic en el boton de mas informacion en la vista del catalogo
      public function mostrarProducto($id){
        $productoAEnseñar = producto::find($id);
        $categoria = categoria::find($productoAEnseñar->categoria_id);
        $anteriorProducto = producto::where("id","<",$id)->orderBy("id")->first();
        $siguienteProducto = producto::where("id",">",$id)->orderBy("id")->first();
        $comentarios = comentario::where("producto_id", $id)->get();
        $respuestas = respuestaComentarios::where("producto_id", $id)->get();
        return view("productos.informacionProducto")->with("producto",$productoAEnseñar)->with("categoria",$categoria)
        ->with("siguienteProducto",$siguienteProducto)->with("anteriorProducto",$anteriorProducto)->with("comentarios",$comentarios)->with("respuestas",$respuestas);
      }

      //Funcion que se ejeucta cuando el usuario le de a la opción de filtrar los productos en la vista del catálogo
      public function filtrar(Request $request){
        $categoriaBuscada = $request->categoria;
        return redirect("/pawsTails/productos")->with("categoriaBuscada",$categoriaBuscada);
      }
      //Funcion que se ejecuta cuando se apreta el boton de la vista de catalogo "borrar", y se encarga de eliminar de la base de datos el producto
      //indicado, y devolver a la vistra de catalogo donde se muestran el resto de productos
      public function borrarProducto($id){
        $productoABorrar = producto::find($id);
        //Eliminar la imagen almacenada en storage/app/public
        Storage::delete("public/imagenesCatalogo/" . $productoABorrar->imagen);
        //Eliminar la imagen almacenada en public/storage (enlace simbólico)
        Storage::delete("imagenesCatalogo/" . $productoABorrar->imagen);
        $productoABorrar->delete();
        return redirect("/pawsTails/productos")->with("infoAdmin","¡El producto se ha borrado de manera correcta!");
      }

      public function mostrarEditarProducto($id){
        $producto = producto::find($id);
        $categorias = categoria::all();
        return view("productos.editarProducto")->with("producto",$producto)->with("categorias",$categorias);
      }

      public function editarProducto(Request $request, $id){
        $request -> validate([
          "nombre" => "required|string",
          "descripcion" => "required|string|max:255",
          "categoria" => "required",
          "precio" => "required|numeric"
        ], [
          "nombre.required" => "El nombre es obligatorio.",
          "descripcion.required" => "La descripción del producto es obligatoria.",
          "descripcion.max" => "La descripción del producto no debe exceder los 500 caracteres.",
          "categoria.required" => "La categoria del producto es obligatoria.",
          "precio.required" => "El precio para el producto es obligatorio.",
          "precio.numeric" => "El precio debe ser un número." 
      ]);

        $actProducto = producto::find($id);
        $actProducto->nombre = $request->nombre;
        $actProducto->descripcion = $request->descripcion;
        $actProducto->categoria_id = $request->categoria;
        $actProducto->precio = $request->precio;

        if(isset($request->imagen)){
          $request -> validate([
            "imagen" => "required|image|mimes:jpeg,png,jpg|max:2048"//El ultimo valor es para el tamaño maximo de la imagen
          ], [
            "imagen.required" => "Debes añadir una imagen al producto.",
            "imagen.image" => "La imagen seleccionada no es válida.",
            "imagen.max" => "El tamaño maximo de la imagen es de 2MB.",
            "imagen.mimes" => "La imagen debe tener una de las siguientes extensiones: jpeg,png,jpg."
        ]);
        //Eliminar la imagen almacenada en storage/app/public
        Storage::delete("public/imagenesCatalogo/" . $actProducto->imagen);
        //Eliminar la imagen almacenada en public/storage
        Storage::delete("imagenesCatalogo/" . $actProducto->imagen);

        $imagen = $request->file("imagen"); //Seleccionamos la imagen que el usuario ha añadido
        //Creamos una variable en la que vamos a guardar el nombre de la foto, para evitar duplicados, le agregamos el tiempo y una barra baja al inicio del nombre
        $nombreImagen = time() . "_" .  $imagen->getClientOriginalName(); 
        $imagen->storeAs("public/imagenesCatalogo/",$nombreImagen); //Usando el metodo proporcionado por Laravel, guardamos la imagen, lo primero es el directorio, y lo segundo el nombre
        $actProducto->imagen = $nombreImagen;
        }
        $actProducto->save();
        return redirect("/pawsTails/editarProducto/".$actProducto->id."\"")->with("info","¡El producto se ha actualizado de manera correcta!");
      }
}
