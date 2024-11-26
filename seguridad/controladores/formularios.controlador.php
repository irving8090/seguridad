<?php

class ControladorFormularios{

    /*****************************
     * Registro usuario estáctico
     ******************************/
    static public function ctrRegistro(){
        #verificar si viene del formulario
        if(isset($_POST["registroNombre"])){
            //Filtrar la información que no tengo inyección de código
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["registroNombre"]) &&
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["registroEmail"]) ){

                $tabla1 = "alumnos";
                
                $token1 = md5($_POST["registroNombre"] . "+" . $_POST["registroApellido"] ."+".$_POST["registroMatricula"]
                 ."+". $_POST["registroEmail"] . "+" . $_POST["registroDivision"] . "+" . $_POST["registroNumero"]);

                #la información del formulario
                $datos1 = array("id" => $token1,
                            "nombre" => $_POST["registroNombre"],
                            "apellido"=> $_POST["registroApellido"],
                            "matricula"=> $_POST["registroMatricula"],
                            "email" => $_POST["registroEmail"],
                            "division" => $_POST["registroDivision"],
                            "numero"=> $_POST["registroNumero"]);
                            
                
                $respuesta1 = ModeloFormularios::mdlRegistro($tabla1, $datos1);
                
                return $respuesta1;
            }  else {
                $respuesta1 = "error";
                return $respuesta1;
            }
        }
        
    }

    /*****************************
     * Seleccionar usuarios
     ******************************/
    static public function ctrSeleccionarRegistros($item1,$valor1){
        $tabla1 = "alumnos";
        
        $respuesta1 = ModeloFormularios::mdlSeleccionarRegistros1($tabla1,$item1,$valor1);

        return $respuesta1;
    }
    /*********************************
     * Ingreso
     *********************************/
    public function ctrIngreso(){
        if(isset($_POST["ingresoEmail"])){
            //Filtrar la información que no tengo inyección de código
            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["ingresoEmail"])&&
               preg_match('/^[0-9a-zA-Z]+$/',$_POST["ingresoPassword"]) ){
                $tabla = "users";
                $item = "email";
                $valor = $_POST["ingresoEmail"];
                //LLamar la consulta
                $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla,$item,$valor);

                #encriptar el password
                
                
                if ($respuesta != null){
                    //echo "Existe";
                    //Validar si esta registrado y son correctas las crendenciales
                    if ($respuesta["email"] == $_POST["ingresoEmail"] &&
                        $respuesta["password"] == $_POST["ingresoPassword"]){
                            $_SESSION["validaringreso"] = "ok";
                            echo '<script>
                                if(window.history.replaceState){
                                    window.history.replaceState(null,null,window.location.href);
                                }

                                window.location = "index.php?pagina=inicio";
                            </script>';
                        echo "Correcto";
                    } else {
                        echo '<script>
                            if(window.history.replaceState){
                                window.history.replaceState(null,null,window.location.href);
                            }
                        </script>';
                        echo '<div class="alert alert-danger">
                            Error al ingresar al sistema, email o contraseña incorrecta
                            </div>';
                    }
                    
                } else {
                    echo '<script>
                        if(window.history.replaceState){
                            window.history.replaceState(null,null,window.location.href);
                        }
                    </script>';
                    echo '<div class="alert alert-danger">
                        Error al ingresar al sistema, email o contraseña incorrecta
                        </div>';
                }
            } else {
                echo '<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
                </script>';
                echo '<div class="alert alert-danger">
                    No se permiten caracteres especiales
                    </div>';
            } 

        }
    }

    /*********************************
 * Actualizar registro
 *********************************/
        static public function ctrActualizarRegistro(){
            if(isset($_POST["actualizarNombre"]) && 
            isset($_POST["actualizarApellido"]) && 
            isset($_POST["actualizarMatricula"]) && 
            isset($_POST["actualizarEmail"]) && 
            isset($_POST["actualizarDivision"]) && 
            isset($_POST["actualizarNumero"])){

        // Validar el token
        $tabla1 = "alumnos";
        $item1 = "id";
        $valor1 = $_POST["id"];
        $alumnos = ModeloFormularios::mdlSeleccionarRegistros1($tabla1, $item1, $valor1);
        if (is_array($alumnos)) {
        $compararToken = md5($alumnos["nombre"] . "+" . $alumnos["apellido"] . "+" . $alumnos["matricula"]
                    . "+" . $alumnos["email"] . "+" . $alumnos["division"] . "+" . $alumnos["numero"]);
                if ($compararToken == $_POST["id"] && 
                    $_POST["idUsuario"] == $alumnos["id"]) {

                    // Datos para el modelo
                    $actualizarToken = md5($_POST["actualizarNombre"] . "+" . $_POST["actualizarApellido"]
                        . "+" . $_POST["actualizarMatricula"] . "+" . $_POST["actualizarEmail"] . "+" . $_POST["actualizarDivision"]
                        . "+" . $_POST["actualizarNumero"]);
                        $tabla1 = "alumnos";
                        $datos1 = array("id" => $_POST["idUsuario"],
                        
                        "nombre" => $_POST["actualizarNombre"],
                        "apellido" => $_POST["actualizarApellido"],
                        "matricula" => $_POST["actualizarMatricula"],
                        "email" => $_POST["actualizarEmail"],
                        "division" => $_POST["actualizarDivision"],
                        "numero" => $_POST["actualizarNumero"]);

                    $respuesta1 = ModeloFormularios::mdlActualizarRegistro($tabla1, $datos1);
                    return $respuesta1;
                } else {
                    return "error"; // Token no coincide
                }
            } else {
                return "error"; // La clave 'id' no existe en el registro
            }
        } 
    
}

    /*********************************
 * Eliminar registro
 *********************************/
public function ctrEliminarRegistro(){
    // Verificar el parámetro
    if(isset($_POST["eliminarRegistro"])){
        // Los datos para el modelo
        $tabla1 = "alumnos";
        $item1 = "id";
        $valor1 = $_POST["eliminarRegistro"];

        // Validar el token
        $alumnos = ModeloFormularios::mdlSeleccionarRegistros1($tabla1, $item1, $valor1);

        // Verificar si se encontró el registro
        if ($alumnos) {
            $compararToken = md5($alumnos["nombre"] . "+" . $alumnos["apellido"] . 
            "+" . $alumnos["matricula"] . "+" . $alumnos["email"] . "+" . 
            $alumnos["division"] . "+" . $alumnos["numero"]);

            if ($compararToken == $valor1) {
                $respuesta1 = ModeloFormularios::mdlEliminarRegistro($tabla1, $valor1); 
                // Verificar si fue exitoso
                if ($respuesta1 == "ok") {
                    // Limpiar el cache
                    echo '<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null,null,window.location.href);
                        }
                        
                        window.location = "index.php?pagina=inicio";
                    </script>';
                }
            } 
        } else {
            echo '<div class="alert alert-danger">Error: Registro no encontrado.</div>';
        }
    }
}

}

