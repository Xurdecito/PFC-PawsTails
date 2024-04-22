<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\usuario;

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
                ["texto" => "Mi carrito", "url" => "/pawsTails/carrito"],//cambiar
                ["texto" => "Mis adopciones" , "url" => "/paesTails/misAdopciones"],//cambiar
                ["texto" => "Cerrar Sesión", "url" => "/pawsTails/cerrarSesion"]
            ]
        ];
        }else if(session("rol_usuario")=="administrador"){
            $array = ["menu"=>"Gestionar tienda", 
            "enlaces"=>[
                ["texto" => "Ver usuarios", "url" => "/pawsTails/perfil"],//cambiar
                ["texto" => "Registrar producto", "url" => "/pawsTails/perfil"],//cambiar
                ["texto" => "Agregar refugio", "url" => "#"],//cambiar
                ["texto" => "Ver adopciones", "url" => "#"],//cambiar
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
    public function iniciarSesion()
    {
        return response()->view("identificacion.inicioSesion");
    }

    /**
     * Funcion que comprueba si esxiste una cuenta con los datos especificados en el formulario
     */
    public function comprobarLogin(Request $request)
    {
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
    public function mostrarFormularioCuenta()
    {
        return response()->view("identificacion.crearCuenta");
    }

    /**
     * Funcion que comprueba si los datos del usuario para crear una cuenta son correctos
     */
    public function crearCuenta(Request $request)
    {
         // Validar los datos del formulario, si no son correctos laravel devuelve al usuario a la ultima pagina en la que se haya situado, que en este caso será 
         // la pagina para crear una cuenta, para acceder a los datos que el usuario habia metido en los input, se usa a traves del html old(), y para los errores que 
         // surgan en la validacion se utiliza @error() y se accede a su valor mediante la variable predefinida $message
         $request->validate([
            "nombre" => "required|string|max:255",
            "correo" => "required|email|unique:usuarios,correo",
            "contrasenia" => "required|string|min:8",
            "direccion" => "nullable|string|max:255",
            "telefono" => "nullable|string|max:20",
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
        ]);

        // Crear un nuevo usuario en la base de datos
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->correo = $request->correo;
        $usuario->contrasenia = bcrypt($request->contrasenia); // Usamos bcrypt para guardar la contraseña en la base de datos de manera segura
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
            // Aqui se aplica 401, porque indica sin autorizacion
            return response()->view("denegado.permiso", ["permiso"=>"Debes haber iniciado sesion para poder acceder a tus datos"], 401);
        }
       
    }

    public function actualizarDatos(Request $request){
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

        if(isset($request->contrasenia) && Hash::check($request->contrasenia, $actUsuario->contrasenia)){
            $request -> validate([
                "contrasenia_nueva" => "string|min:8",
            ], [
                "contrasenia_nueva.min" => "La nueva contraseña debe tener una longitud de al menos 8 caracteres.",
            ]);

            $actUsuario->contrasenia = bcrypt($request->contrasenia_nueva);
        } else {
            // Si la contraseña proporcionada no es igual a la de la base de datos, devuelve un mensaje de error
            return redirect('/actualizar-perfil')->with("contrasenia", "La contraseña introducida no es correcta.");
        }
        
        $actUsuario->save();
        return redirect('/actualizar-perfil')->with("info", "Datos actualizados correctamente");

    }
    
    // Funcion que cierra la sesion del usuario registrado
    public function cerrarSesion(Request $request){
        $request->session()->forget("id_usuario");
        $request->session()->forget("rol_usuario");
        return redirect("/pawsTails")->with("sesionCerrada","¡Sesión cerrada exitosamente!");
    }
}
