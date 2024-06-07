<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\animal;
use App\Models\adopcion;
use App\Models\usuario;
class animalesController extends Controller
{
    //Funcion que muestra el formulario para poder agrgar un nuevo animal para ponerlo en adoppcion
    public function mostrarAgregarAnimal(){
        return response()->view("animales.agregarAnimal");
    }
    //Funcion que recibe los datos del formulario, y agrega a la base de datos dichos datos
    public function agregarAnimal(Request $request){
        $request -> validate([
            "nombre" => "required|string",
            "especie" => "required",
            "descripcion" => "required|string|max:255",
            "imagen" => "required|image|mimes:jpeg,png,jpg|max:2048",//El ultimo valor es para el tamaño maximo de la imagen
          ], [
            "nombre.required" => "El nombre es obligatorio.",
            "especie.required" => "Debes indicar la especie del animal.",
            "descripcion.required" => "La descripción del animal es obligatoria.",
            "descripcion.max" => "La descripción del animal no debe exceder los 500 caracteres.",
            "imagen.required" => "Debes añadir una imagen al animal.",
            "imagen.image" => "La imagen seleccionada no es válida.",
            "imagen.max" => "El tamaño maximo de la imagen es de 2MB.",
            "imagen.mimes" => "La imagen debe tener una de las siguientes extensiones: jpeg,png,jpg.", 
        ]);

        $animal = new animal();
        $animal->nombre = $request->nombre;
        $animal->especie = $request->especie;
        $animal->descripcion = $request->descripcion;
        if(isset($request->id_refugio)){
            $request->validate([
                "id_refugio" => "required|exists:usuarios,id,rol,refugio",
            ],
            ["id_refugio.exists" => "El id del refugio que has indicado no existe en la base de datos, o no es un refugio."]);
            $animal->usuario_id = $request->id_refugio;            
        }else{
            $animal->usuario_id = session("id_usuario");
        }
    
        $imagen = $request->file("imagen"); //Seleccionamos la imagen que el usuario ha añadido
        //Creamos una variable en la que vamos a guardar el nombre de la foto, para evitar duplicados, le agregamos el tiempo y una barra baja al inicio del nombre
        $nombreImagen = time() . "_" .  $imagen->getClientOriginalName(); 
    
        $imagen->storeAs("public/imagenesAnimales/",$nombreImagen); //Usando el metodo proporcionado por Laravel, guardamos la imagen, lo primero es el directorio, y lo segundo el nombre
     
        $animal->imagen = $nombreImagen;
    
        $animal->save();
        return redirect("/pawsTails/buscarNuevoHogar")->with("exito","¡El animal está listo para encontrar su nuevo hogar!");
    }
    //Funcion que devuelve la vista donde se muestran a todos los animales para su adopcion
    public function mostrarAnimales(){
        $controladorUsuario = new usuarioController();
        $aux = $controladorUsuario->datosMenu();
        $animales = animal::where("Adoptado", 0)->get();//Para mostrar solo aquellos animales que no se hayan adoptado
        $nombreRefugios = usuario::where("rol", "refugio")->get();
        return view("animales.mostrarAnimales")->with("datosMenu",$aux)->with("animales",$animales)->with("datosRefugios",$nombreRefugios);
    }
    //Funcion que devuelve al formulario para que pueda editar al animal
    public function editarAnimal($id){
        $animal = animal::find($id);
        if(session("rol_usuario")=="administrador" || ($animal->usuario->id == session("id_usuario"))){
            return view("animales.mostrarEditarAnimales")->with("datosAnimal",$animal);
        }else{
             //Aqui se aplica 401, porque indica sin autorizacion
             return response()->view("animae.permiso", ["permiso"=>"Este animal no pertenece su refugio."], 401);
        }
    }

    public function actualizarAnimal(Request $request,$id){
        $animal = animal::find($id);
        if(session("rol_usuario")=="administrador" || ($animal->usuario->id == session("id_usuario"))){
            $request -> validate([
                "nombre" => "required|string",
                "especie" => "required",
                "descripcion" => "required|string|max:255",
              ], [
                "nombre.required" => "El nombre es obligatorio.",
                "especie.required" => "Debes indicar la especie del animal.",
                "descripcion.required" => "La descripción del animal es obligatoria.",
                "descripcion.max" => "La descripción del animal no debe exceder los 500 caracteres.",
            ]);

            $animal->nombre = $request->nombre;
            $animal->descripcion = $request->descripcion;
            $animal->especie = $request->especie;
    
            if(isset($request->imagen)){
              $request -> validate([
                "imagen" => "required|image|mimes:jpeg,png,jpg|max:2048"//El ultimo valor es para el tamaño maximo de la imagen
              ], [
                "imagen.required" => "Debes añadir una imagen al animal.",
                "imagen.image" => "La imagen seleccionada no es válida.",
                "imagen.max" => "El tamaño maximo de la imagen es de 2MB.",
                "imagen.mimes" => "La imagen debe tener una de las siguientes extensiones: jpeg,png,jpg."
            ]);
            //Eliminar la imagen almacenada en storage/app/public
            Storage::delete("public/imagenesAnimales/" . $animal->imagen);
            //Eliminar la imagen almacenada en public/storage
            Storage::delete("imagenesAnimales/" . $animal->imagen);
    
            $imagen = $request->file("imagen"); //Seleccionamos la imagen que el usuario ha añadido
            //Creamos una variable en la que vamos a guardar el nombre de la foto, para evitar duplicados, le agregamos el tiempo y una barra baja al inicio del nombre
            $nombreImagen = time() . "_" .  $imagen->getClientOriginalName(); 
            $imagen->storeAs("public/imagenesAnimales/",$nombreImagen); //Usando el metodo proporcionado por Laravel, guardamos la imagen, lo primero es el directorio, y lo segundo el nombre
            $animal->imagen = $nombreImagen;
            }
            $animal->save();

            return redirect("/pawsTails/animales")->with("info","Datos de " . $animal->nombre . " actualizados correctamente.");
        }else{
             //Aqui se aplica 401, porque indica sin autorizacion
             return response()->view("denegado.permiso", ["permiso"=>"Este animal no pertenece a su refugio."], 401);
        } 
    }
    //Funcion que elimina de la base de datos al animal que se pase como id
    public function borrarAnimal($id){
        $animal = animal::find($id);
        if(session("rol_usuario") || ($animal->usuario->id == session("id_usuario"))){
            Storage::delete("public/imagenesAnimales/" . $animal->imagen);
            Storage::delete("imagenesAnimales/" . $animal->imagen);
            $animal ->delete();
            return redirect("/pawsTails/animales")->with("info","Animal eliminado correctamente.");
        }else{
            //Aqui se aplica 401, porque indica sin autorizacion
             return response()->view("denegado.permiso", ["permiso"=>"Este animal no pertenece a su refugio."], 401);
        }
    }
    //Funcion que permite crear las solicitudes de los usuarios para crear una solicitud de adopcion, si el usuario que intenta hacer la adopcion, no es 
    //un usuario da error, y si el usuario que intenta hacerlo, ya ha intentado una solicitud para ese animal en concreto, tambien dara error
    public function adoptarAnimal($id){
        if (session("rol_usuario") == "usuario") {
        $usuarioId = session("id_usuario");

        $adopcionExistente = adopcion::where("usuario_id", $usuarioId)
                                     ->where("animale_id", $id)
                                     ->first();
        if (!$adopcionExistente) {
            $animal = animal::find($id);
            $adopcion = new Adopcion();
            $adopcion->usuario_id = $usuarioId;
            $adopcion->animale_id = $id;
            $adopcion->refugio_id = $animal->usuario_id;
            $adopcion->estado = "pendiente";
            $adopcion->save();
    
            return redirect("/pawsTails/animales")->with("info", "Solicitud de adopción realizada con éxito.");
        }else{
            return redirect("/pawsTails/animales")->with("error", "Ya tienes una solicitud de adopcion para este animal.");
        }

        
        }else{
            return redirect("/pawsTails/animales")->with("error", "Solo los usuarios pueden adoptar animales.");
        }

        
    }
    //Funcion que recoge el id del usuario de las sesiones del navegador, muestra en la vista todas las solicitudes que dicho usuario tiene pendiente
    public function adopcionesUsuario(){
        $usuarioId = session("id_usuario");
        $solicitudes = adopcion::where("usuario_id", $usuarioId)
            ->with(["animal", "refugio"])
            ->get();
            //Añadimos a un array cada uno de los nombres de los animales para poder filtrar por ellos
            $nombresAnimales = [];
            foreach ($solicitudes as $solicitud) {
                if ($solicitud->animal) {
                    array_push($nombresAnimales,$solicitud->animal->nombre);
                }
            }
              //Eliminamos los duplicados, ya que se almacenan los nombres del animal de cada solicitud, por lo que el nombre del animal si tiene mas de 
           //una solicitud para adoptar, se va a repetir
           $nombresAnimales = array_unique($nombresAnimales);
        return view("animales.solicitudUsuario")->with("solicitudes", $solicitudes)->with("nombresAnimales",$nombresAnimales);
        //return view("animales.solicitudUsuario")->with("solicitudes", $solicitudes);
    }
    //Funcion que recibe el id de una solicitud y la borra
    public function borrarSolicitud($id){
        if(session("rol_usuario")!=null && session("id_usuario")!=null){
            $solicitud = adopcion::find($id);
            $solicitud->delete();
            //En el caso en el que se quiera borrar una solicitud de un usuario cuya solictud haya sido aprobada, el estado del animal se vuelve a poner
            //como que no ha sido adoptado, y se vuelve a ver en el apartado de adopciones
            if($solicitud->estado == "aprobado"){
                $animal = animal::find($solicitud->animale_id);
                $animal->adoptado = false;
                $animal->save();
            }
            if(session("rol_usuario")=="administrador"){
                return redirect("/pawsTails/adopcionesAdmin")->with("info", "La solicitud se ha borrado con éxito.");
            }else if(session("rol_usuario")=="usuario"){
                return redirect("/pawsTails/misAdopciones")->with("info", "Tu solicitud se ha borrado con éxito.");
            }else if(session("rol_usuario")=="refugio"){
                return redirect("/pawsTails/adopcionesRefugio")->with("info", "La solicitud se ha borrado con éxito.");
            }
        }else{
                return redirect("/pawsTails/misAdopciones")->with("error", "No puedes borrar la solicitud en estos momentos, intentalo mas tarde.");            
        }
    }
    //Funcion que muestra todas las adopciones
    public function adopcionesAdmin(){
        $solicitudes = adopcion::all();
           //Añadimos a un array cada uno de los nombres de los animales para poder filtrar por ellos
           $nombresAnimales = [];
           foreach ($solicitudes as $solicitud) {
               if ($solicitud->animal) {
                   array_push($nombresAnimales,$solicitud->animal->nombre);
               }
           }
            //Eliminamos los duplicados, ya que se almacenan los nombres del animal de cada solicitud, por lo que el nombre del animal si tiene mas de 
           //una solicitud para adoptar, se va a repetir
           $nombresAnimales = array_unique($nombresAnimales);
        return view("animales.solicitudUsuario")->with("solicitudes", $solicitudes)->with("nombresAnimales",$nombresAnimales);
    }
    //Funcion que muestra las adopciones que correspondan a cada refugio
    public function adopcionesRefugio(){
        $refugio_id = session("id_usuario");
        $solicitudes = adopcion::where("refugio_id",$refugio_id)->get();
           //Añadimos a un array cada uno de los nombres de los animales para poder filtrar por ellos
           $nombresAnimales = [];
           foreach ($solicitudes as $solicitud) {
               if ($solicitud->animal) {
                   array_push($nombresAnimales,$solicitud->animal->nombre);
               }
           }
           //Eliminamos los duplicados, ya que se almacenan los nombres del animal de cada solicitud, por lo que el nombre del animal si tiene mas de 
           //una solicitud para adoptar, se va a repetir
           $nombresAnimales = array_unique($nombresAnimales);
        return view("animales.solicitudUsuario")->with("solicitudes", $solicitudes)->with("nombresAnimales",$nombresAnimales);
    }
    //Funcion que permite rechazar la solicitud de un usuario
    public function rechazarAdopcion($id){
        $solicitud = adopcion::find($id);
        if($solicitud->refugio_id == session("id_usuario")){
            $solicitud->estado = "rechazado";
            $solicitud->save();
            return redirect("/pawsTails/adopcionesRefugio")->with("info", "Solicitud del usuario rechazada correctamente.");
        }else{
            return redirect("/pawsTails/adopcionesRefugio")->with("error", "No tienes los permisos para rechazar la adopción.");
        }
    }
    //Funcion que permite aceptar la solicitud de un usuario, si lo hace todas las demas solicitudes para el mismo animal, se rechazaran automaticamente
    public function aceptarAdopcion($id){
        $solicitud = adopcion::find($id);
        if($solicitud->refugio_id == session("id_usuario")){
            $solicitud->estado = "aprobado";
            $solicitud->save();
            //Indicamos que el animal ya ha sido adoptado para no mostrarlo en la lista de animales
            $animal = $solicitud->animal;
            $animal->adoptado = true;
            $animal->save();
            //Rechazamos todas las adopciones de este id, excepto la aque se ha aceptado
            adopcion::where("animale_id", $solicitud->animale_id)
            ->where("id", "!=", $id)
            ->update(["estado" => "rechazado"]);
            return redirect("/pawsTails/adopcionesRefugio")->with("info", "Solicitud del usuario aceptada correctamente.");
        }else{
            return redirect("/pawsTails/adopcionesRefugio")->with("error", "No tienes los permisos para aceptar la solictud.");
        }
    }
    //Funcion que se ejecuta cuando se aplica un flitro para filtrar alguno de los animales en la pestaña de ver adopciones, en funcion del rol
    //que tenga el usuario redigira a una ruta u otro para ver los animales que cumplan con el filtro
    public function aplicarFiltro(Request $request){
        $animalBuscado = $request->nombre_animal;
        if(session("rol_usuario")=="usuario"){
            return redirect("/pawsTails/misAdopciones")->with("animalBuscado",$animalBuscado);
        }else if(session("rol_usuario")=="administrador"){
            return redirect("/pawsTails/adopcionesAdmin")->with("animalBuscado",$animalBuscado);
        }else if(session("rol_usuario")=="refugio"){
            return redirect("/pawsTails/adopcionesRefugio")->with("animalBuscado",$animalBuscado);
        }
    }
    //Funcion que ejecuta el filtro de los animales en funcion del refugio seleccionado
    public function filtrarAnimales(Request $request){
        $refugioBuscado = $request->refugio;
        return redirect("/pawsTails/animales")->with("refugioBuscado",$refugioBuscado);
    }
    }

