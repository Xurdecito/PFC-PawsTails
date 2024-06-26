<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\usuario;
use App\Models\producto;
use App\Models\comentario;
use App\Models\respuestaComentarios;

class usuarioController extends Controller
{

    //Esta funcion devuelve el array con el contenido del dropdown que se va a mostrar en las vistas, se hace asi para no tener que poner todas las condiciones en cada 
    //una de las vistas de la aplicacion
    public function datosMenu(){
        //Definimos un array bidimensional en el que se va a almacenar el contenido del dropdown dentro del nav
        $array= [];
        if(session("rol_usuario")=="usuario"){
            $array = ["menu"=>"Mi perfil", 
            "enlaces"=>[
                ["texto" => "Mis datos", "url" => "/pawsTails/perfil"],
                ["texto" => "Mi carrito", "url" => "/pawsTails/carrito"],
                ["texto" => "Mis pedidos", "url"=> "/pawsTails/misPedidos"],
                ["texto" => "Solicitudes de adopción" , "url" => "/pawsTails/misAdopciones"],
                ["texto" => "Cerrar Sesión", "url" => "/pawsTails/cerrarSesion"]
            ]
        ];
        }else if(session("rol_usuario")=="administrador"){
            $array = ["menu"=>"Administración", 
            "enlaces"=>[
                ["texto" => "Ver usuarios", "url" => "/pawsTails/listarUsuarios"],
                ["texto" => "Registrar producto", "url" => "/pawsTails/agregarProducto"],
                ["texto" => "Ver pedidos Tienda", "url" => "/pawsTails/pedidosTienda"],
                ["texto" => "Agregar refugio", "url" => "/pawsTails/agregarRefugio"],
                ["texto" => "Buscarles un nuevo hogar", "url" => "/pawsTails/buscarNuevoHogar"],
                ["texto" => "Ver adopciones", "url" => "/pawsTails/adopcionesAdmin"],
                ["texto" => "Cerrar sesion", "url" => "/pawsTails/cerrarSesion"],
            ]
        ];
        }else if(session("rol_usuario")=="refugio"){
            $array = ["menu"=>"Refugio", 
            "enlaces"=>[
                ["texto" => "Buscarles un nuevo hogar", "url" => "/pawsTails/buscarNuevoHogar"],
                ["texto" => "Solicitudes de adopción", "url" => "/pawsTails/adopcionesRefugio"],
                ["texto" => "Cerrar sesion", "url" => "/pawsTails/cerrarSesion"],
            ]
        ];
        }else{
            $array = ["menu"=>"Acceder", 
            "enlaces"=>[
                ["texto" => "Crear una cuenta", "url" => "/pawsTails/crearCuenta"],
                ["texto" => "Ya tengo una cuenta", "url" => "/pawsTails/login"]
            ]
        ]; 
        }
        return $array;
    }

    public function cargarMenu(){
        //Redirigimos a la vista principal con el array para mostrar un menu diferente en funcion de la sesion de cada usuario, llamamos con la ayuda de $this a la funcion
        $array = $this->datosMenu();
        return view("index")->with("datosMenu",$array);
    }

    /**
     * Funcion que va a llamar a la vista que contiene el formulario para iniciar sesion
     */
    public function iniciarSesion(){
        return response()->view("identificacion.inicioSesion");
    }

    /**
     * Funcion que comprueba si esxiste una cuenta con los datos especificados en el formulario
     */
    public function comprobarLogin(Request $request){
        /*Recogemos los datos que se reciben desde el formulario*/
        $correo = $request->input("correo");
        $contrasenia = $request->input("contrasenia");
        /*Buscamos al usuario a traves del correo recibido en el formulario, se utiliza first ya que where espera obtener un solo resultado y si no se pone 
        first no funciona*/
        $usuario = usuario::where("correo",$correo)->first();
        /*Si la contraseña recibida en el formulario es la misma que se encuentra en la base de datos para el correo del formulario, inicia sesion,
        se usa el metodo hash, ya que la contraseña se va a guardar de manera segura en la base de datos*/
        if ($usuario && Hash::check($contrasenia, $usuario->contrasenia)) {
            session(["id_usuario"=>$usuario->id]);   
            session(["rol_usuario"=>$usuario->rol]);    
            return redirect("/pawsTails")->with("sesionIniciada","Bienvenido/a ". $usuario->nombre."");
        } else {
            /*With crea una sesion temporal para error, con el mensaje del segundo parametro, se crea para todos los campos del formulario excepto para la contraseña*/
            return redirect("/pawsTails/login")->with("error", "Correo o contraseña incorrectos.")->withInput($request->except("contrasenia"));
        }

    }

    /**
     * Funcion que muestra la vista para que el usuario pueda crear una cuenta
     */
    public function mostrarFormularioCuenta(){
        return response()->view("identificacion.crearCuenta");
    }

    /**
     * Funcion que comprueba si los datos del usuario para crear una cuenta son correctos
     */
    public function crearCuenta(Request $request){
         // Validar los datos del formulario, si no son correctos laravel devuelve al usuario a la ultima pagina en la que se haya situado, que en este caso será 
         // la pagina para crear una cuenta, para acceder a los datos que el usuario habia metido en los input, se usa a traves del html old(), y para los errores que 
         // surgan en la validacion se utiliza @error() y se accede a su valor mediante la variable predefinida $message
         $request->validate([
            "nombre" => "required|string|max:255",
            "correo" => "required|email|unique:usuarios,correo",
            "contrasenia" => "required|string|min:8",
            "direccion" => "nullable|string|max:255",
            "telefono" => "nullable|string|min:9|max:9",
        ], [
            "nombre.required" => "El nombre es obligatorio.",
            "nombre.max" => "El nombre no puede tener más de :max caracteres.",
            "correo.required" => "El correo electrónico es obligatorio.",
            "correo.email" => "El correo electrónico debe ser una dirección de correo válida.",
            "correo.unique" => "Este correo electrónico ya está en uso.",
            "contrasenia.required" => "La contraseña es obligatoria.",
            "contrasenia.min" => "La contraseña debe tener al menos :min caracteres.",
            "direccion.max" => "La dirección no puede tener más de :max caracteres.",
            "telefono.max" => "El teléfono no puede tener más de :max caracteres.",
            "telefono.min" => "EL telefono debe tener 9 dígitos.",
            "telefono.max" => "El telefono debe tener 9 dígitos."
        ]);

        //Crear un nuevo usuario en la base de datos
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->contrasenia = bcrypt($request->contrasenia); //Usamos bcrypt para guardar la contraseña en la base de datos de manera segura
        $usuario->direccion = $request->direccion;
        $usuario->telefono = $request->telefono;
        $usuario->save();
        return redirect("/pawsTails/login")->with("exito", "¡Cuenta creada exitosamente! Por favor, inicia sesión.");
    }

    public function verPerfil(Request $request){
        $idUsuario = session("id_usuario");
        $usuario = usuario::find($idUsuario);
        //dd($usuario);//Para comprobar que la sesion se haya creado de manera correcta
        if($usuario){
            return view("identificacion.datosPersonales",["usuario"=>$usuario]);
        }else{
            //Aqui se aplica 401, porque indica sin autorizacion, ya que el usuario aun no ha iniciado sesion
            return response()->view("denegado.permiso", ["permiso"=>"Debes haber iniciado sesion para poder acceder a tus datos"], 401);
        }
       
    }

    public function actualizarDatos(Request $request){
        $request -> validate([
            "nombre" => "required|string|max:255",
            "correo" => "required|email",
            "direccion" => "nullable|string|max:255",
            "telefono" => "nullable|string|min:9|max:9",
        ], [
            "nombre.required" => "El nombre es obligatorio.",
            "nombre.max" => "El nombre no puede tener más de :max caracteres.",
            "correo.required" => "El correo electrónico es obligatorio.",
            "correo.email" => "El correo electrónico debe ser una dirección de correo válida.",
            "direccion.max" => "La dirección no puede tener más de :max caracteres.",
            "telefono.max" => "El teléfono no puede tener más de :max caracteres.",
        ]);
        $actUsuario = Usuario::find(session("id_usuario"));
        $actUsuario->nombre = $request->nombre;
        $actUsuario->direccion = $request->direccion;
        $actUsuario->telefono = $request->telefono;

        if($actUsuario->correo != $request->correo){
            $request -> validate(
                [
                    "correo" => "unique:usuarios,correo",
                ],
                [
                    "correo.unique" => "El correo que has introducido ya está en uso",
                ]
            );
            $actUsuario->correo = $request->correo;
        }

        if(isset($request->contrasenia)){
            if(Hash::check($request->contrasenia, $actUsuario->contrasenia)){
                $request -> validate([
                    "contrasenia_nueva" => "string|min:8",
                ], [
                    "contrasenia_nueva.min" => "La nueva contraseña debe tener una longitud de al menos 8 caracteres.",
                ]);
    
                $actUsuario->contrasenia = bcrypt($request->contrasenia_nueva);
            }else{
                // Si la contraseña proporcionada no es igual a la de la base de datos, devuelve un mensaje de error
                return redirect("/actualizar-perfil")->with("contrasenia", "La contraseña introducida no es correcta.");
            }
           
        }
        
        $actUsuario->save();
        return redirect("/actualizar-perfil")->with("info", "Datos actualizados correctamente");

    }
    //Funcion que recogera todos los usuarios que se encuentren en la base de datos, y los devuelve a la vista de "listarUsuarios"
    public function listarUsuarios(){
        //Obetenemos todos los usuarios a traves de su rol
        $usuarios = usuario::orderBy("rol","desc")->get();
        return response()->view("identificacion.listarUsuarios",["usuarios"=>$usuarios]);
    }
    //Funcion que llama a la vista que muestra los usuarios, pero esta vez solo mostrara el que coincida con el correo que reciba
    public function buscarUsuario(Request $request){
        $usuarioBuscado = $request->usuarioBuscado;
        $usuarios = Usuario::where("correo", "like", "%" . $usuarioBuscado . "%")->get();
        return response()->view("identificacion.listarUsuarios",["usuarios"=>$usuarios]);
    }

    //Funcion que a partir de un id de un usuario, se le elimina de la base de datos, solo puede acceder a ella el admin a traves de la vista
    //que muestra a todos los usarios
    public function borrarUsuario($id){
        $usuario = usuario::find($id);
        $usuario->delete();
        return redirect("/pawsTails/listarUsuarios")->with("info", "Usuario eliminado correctamente.");
    }

    //Funcion que devuelve la vista del formulario con los datos del usuario que el administrador haya seleccionado
    public function mostrarActualizarUsuario($id){
        $usuario = usuario::find($id);
        return view("identificacion.actualizarAdmin",["usuario"=>$usuario]);     
    }

    //Funcion que va a comprobar que los datos introducidos a la hora de realizar el cambio en los datos de un usuario sean validos
    public function actualizarUsuarioAdmin(Request $request,$id){
        $request -> validate([
            "nombre" => "required|string|max:255",
            "correo" => "required|email",
            "direccion" => "nullable|string|max:255",
            "telefono" => "nullable|string|max:20",
        ], [
            "nombre.required" => "El nombre es obligatorio.",
            "nombre.max" => "El nombre no puede tener más de :max caracteres.",
            "correo.required" => "El correo electrónico es obligatorio.",
            "correo.email" => "El correo electrónico debe ser una dirección de correo válida.",
            "direccion.max" => "La dirección no puede tener más de :max caracteres.",
            "telefono.max" => "El teléfono no puede tener más de :max caracteres.",
        ]);

        $actUsuario = Usuario::find($id);
        $actUsuario->nombre = $request->nombre;
        $actUsuario->direccion = $request->direccion;
        $actUsuario->telefono = $request->telefono;
        $actUsuario->rol = $request->rol;

        if($actUsuario->correo != $request->correo){
            $request -> validate(
                [
                    "correo" => "unique:usuarios,correo",
                ],
                [
                    "correo.unique" => "El correo que has introducido ya está en uso",
                ]
            );
            $actUsuario->correo = $request->correo;
        }
        $actUsuario->save();
        return redirect("/pawsTails/editarUsuario/".$id)->with("info", "Datos actualizados correctamente");
    }
    //Funcion qudevuelve la vista para registrar a un nuevo usuario en la tienda con el perfil de refugio
    public function mostrarAgregarRefugio(){
        return response()->view("identificacion.agregarRefugio");
    }
    //Funcion que se encargara de registrar al usuario con el rol de refugio en la base de datos
    public function agregarRefugio(Request $request){
        // Validar los datos del formulario, si no son correctos laravel devuelve al usuario a la ultima pagina en la que se haya situado, que en este caso será 
         // la pagina para crear una cuenta, para acceder a los datos que el usuario habia metido en los input, se usa a traves del html old(), y para los errores que 
         // surgan en la validacion se utiliza @error() y se accede a su valor mediante la variable predefinida $message
         $request->validate([
            "nombre" => "required|string|max:255",
            "correo" => "required|email|unique:usuarios,correo",
            "contrasenia" => "required|string|min:8",
            "direccion" => "required|string|max:255",
            "telefono" => "required|string|min:9|max:9",
        ], [
            "nombre.required" => "El nombre es obligatorio.",
            "nombre.max" => "El nombre no puede tener más de :max caracteres.",
            "correo.required" => "El correo electrónico es obligatorio.",
            "correo.email" => "El correo electrónico debe ser una dirección de correo válida.",
            "correo.unique" => "Este correo electrónico ya está en uso.",
            "contrasenia.required" => "La contraseña es obligatoria.",
            "contrasenia.min" => "La contraseña debe tener al menos :min caracteres.",
            "direccion.required" => "La direccion es un campo obligatorio",
            "direccion.max" => "La dirección no puede tener más de :max caracteres.",
            "telefono.required" => "El telefono es un campo obligatorio",
            "telefono.max" => "El teléfono no puede tener más de :max caracteres.",
            "telefono.min" => "EL telefono debe tener 9 dígitos.",
            "telefono.max" => "El telefono debe tener 9 dígitos."
        ]);

        // Crear un nuevo usuario en la base de datos
        $usuario = new usuario();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->contrasenia = bcrypt($request->contrasenia); // Usamos bcrypt para guardar la contraseña en la base de datos de manera segura
        $usuario->rol = "refugio";
        $usuario->direccion = $request->direccion;
        $usuario->telefono = $request->telefono;
        $usuario->save();
        return redirect("/pawsTails/agregarRefugio")->with("exito", "¡Cuenta del refugio creada exitosamente, facilite los datos al refugio!.");
    }
    
    // Funcion que cierra la sesion del usuario registrado
    public function cerrarSesion(Request $request){
        $request->session()->forget("id_usuario");
        $request->session()->forget("rol_usuario");
        return redirect("/pawsTails")->with("sesionCerrada","¡Sesión cerrada exitosamente!");
    }
    //Funcion que devuelve la vista para ver la pagina de contacto
    public function mostrarContacto(){
        $array = $this->datosMenu();
        return view("contacto.contacto")->with("datosMenu",$array);
    }

    //Funcion que recibe el id del producto y los datos de un textarea, que es el contenido del comentario, y junto con la sesion que contiene el id del
    //usuario, se crea un nuevo comentario
    public function comentarProducto(Request $request, $id){
        if(session("rol_usuario")!=null&&  session("id_usuario")!=null){
            $producto = producto::find($id);
            $validatedData = $request->validate([
                "mensaje" => "required|string|min:10|max:255",
            ], [
                "mensaje.required" => "El comentario no puede estar vacío.",
                "mensaje.string" => "El comentario debe ser texto válido.",
                "mensaje.min" => "El comentario debe tener al menos 10 caracteres.",
                "mensaje.max" => "El comentario no puede tener más de 255 caracteres."
            ]);
            $comentario = new comentario();
            $comentario->mensaje = $request->mensaje;
            $comentario->usuario_id = session("id_usuario");
            $comentario->producto_id = $id;
    
            $comentario->save();
            return redirect("/pawsTails/productos/$id")->with("infoComentario","Tu comentario se ha registrado de manera exitosa.");
        }else{
            return redirect("/pawsTails/productos/$id")->with("errorComentario","Debe iniciar sesión para poder realizar comentarios");
        }

    }
    //Funcion que recibe el id de un comentario y se borra
    public function borrarComentario($id){
        $comentario = comentario::find($id);
        $comentario->delete();
        return redirect()->back()->with("infoComentario","El comentario ha sido eliminado");
    }

    public function borrarRespuesta($id){
        $respuesta = respuestaComentarios::find($id);
        $respuesta->delete();
        return redirect()->back()->with("infoComentario","La respuesta ha sido eliminada");
    }
    //Funcion que recibe el id de un comentario, y los datos de un formulario, y a partir de eso, crea una repsuesta para un comentario en concreto
    public function responderComentario(Request $request, $id){
        if(session("id_usuario") && session("rol_usuario")){
            $respuesta = new respuestaComentarios();
            $respuesta->comentario_id = $id;
            $respuesta->usuario_id = session("id_usuario");
            $respuesta->producto_id = $request->producto_id;
            $respuesta->mensaje = $request->respuesta;
            $respuesta->save();
            return redirect()->back()->with("infoComentario","Se ha publicado tu respuesta");
        }
    }

}
