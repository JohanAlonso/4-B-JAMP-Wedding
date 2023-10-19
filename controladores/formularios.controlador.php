<?php
class ControladorFormularios
{



/**
 * 
 */


    /*
    REGISTRO
    */
    static public function crtRegistro()
    {
        // Comprueba si se ha enviado el formulario de registro
        if (isset($_POST["registerName"])) {
        // Comenta el contenido de depuración
        /*return $_POST["registerName"] . "<br>" . $_POST["registerEmail"] . "<br>" .$_POST["registerPassword"] . "<br>";*/
        
        // Nombre de la tabla en la base de datos
        $tabla = "registros";

        // Arreglo con los datos del registro
        $datos = array(
            "nombre" => $_POST["registerName"],
            "email" => $_POST["registerEmail"],
            "password" => $_POST["registerPassword"]
        );

        // Llama al método "mdlRegistro" del modelo para insertar los datos en la base de datos
        $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);

        // Retorna la respuesta del modelo (puede ser "ok" u otro mensaje)
        return $respuesta;
    }
    
    
}






    /**
 * Selección de registros de la tabla
 */
static public function ctrSeleccionarRegistros($item, $valor)
{
    // Verificar si no se proporciona un criterio y un valor de búsqueda
    if ($item == null && $valor == null) {
        // Nombre de la tabla en la base de datos
        $tabla = "registros";

        // Llama al método "mdlSeleccionarRegistros" del modelo para obtener todos los registros
        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, null, null);

        // Retorna la respuesta del modelo (puede ser un arreglo de registros)
        return $respuesta;
    } else {
        // Si se proporciona un criterio y un valor de búsqueda

        // Nombre de la tabla en la base de datos
        $tabla = "registros";

        // Llama al método "mdlSeleccionarRegistros" del modelo con el criterio y el valor proporcionados
        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

        // Retorna la respuesta del modelo (puede ser un registro específico)
        return $respuesta;
    }
}








    /**
     * Ingreso
     */
    public function ctrIngreso()
    {
        if (isset($_POST["ingresoEmail"])) {
            $tabla = "registros";
            $item = "email";
            $valor = $_POST["ingresoEmail"];

            $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla, $item, $valor);

            if (is_array($respuesta)) {
                if ($respuesta["email"] == $_POST["ingresoEmail"] && $respuesta["password"] == $_POST["ingresoPassword"]) {

                    $_SESSION["validarIngreso"] = "ok";

                    echo "Ingreso Exitoso";

                    echo '<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                        setTimeout(function(){
                            window.location.href = "index.php?pagina=inicio";
                        }, 2000); // Redirecciona después de 2 segundos (ajusta el tiempo según tus preferencias)
                    </script>';
                } else {
                    echo '<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null, null, window.location.href);
                        }
                    </script>';
                    echo '<div class="alert alert-danger">Error al ingresar al sistema</div>';
                }
            } else {
                echo '<script>
                    if (window.history.replaceState){
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>';
                echo '<div class="alert alert-danger">Error en el sistema ';
            }
        }

    }

    static public function ctrActualizarRegistro()
    {


        if (isset($_POST["updateName"])) {
            if ($_POST["updatePassword"] != "") {
                $password = $_POST["updatePassword"];
            } else {
                $password = $_POST["passwordActual"];
            }
            $tabla = "registros_mac_wedding";

            $datos = array(
                "id" => $_POST["id"],
                "nombre" => $_POST["updateName"],
                "email" => $_POST["updateEmail"],
                "password" => $password
            );

            $actualizar = ModeloFormularios::mdlActualizarRegistros($tabla, $datos);

            return $actualizar;
        }


    }

    public function ctrEliminarRegistro()
    {
        if (isset($_POST["deleteRegistro"])) {

            $tabla = "registros";
            $valor = $_POST["deleteRegistro"];


            $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor);
////
//////
////////////////////////////////escrip malo///////////////////////
/////
////
////

            if ($respuesta == "ok") {
                echo '<script>
                if (window.history.replaceState){
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>    ';
                echo '<div class="alert-success"> El usuario ha sido Eliminado</div>
                    <script>
                    setTimeout(function(){
                    window.location = "index.php?pagina=inicio";
                    },3000);
                    </script>
                    ';
            }
        }
    }

}
