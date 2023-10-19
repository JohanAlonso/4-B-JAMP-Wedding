<?php

require_once "conexion.php";

class ModeloFormularios
{   
    // Método para realizar un registro en una tabla de la base de datos
    static public function mdlRegistro($tabla, $datos)
    {   
        // Paso 1: Preparar la consulta SQL de inserción usando los datos proporcionados
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, email, password) 
        VALUES (:nombre, :email, :password)");
         // Paso 2: Vincular los valores de los parámetros de la consulta a los datos proporcionados
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        
        // Paso 3: Ejecutar la consulta SQL
        if ($stmt->execute()) {
            // Si la consulta se ejecuta con éxito, retornar "ok" para indicar un registro exitoso
            return "ok";
        } else {
             // Si la consulta falla, imprimir información de error (esto es solo para fines de depuración)
            print_r($stmt->errorInfo());
        }
        // Paso 4: Liberar los recursos relacionados con la consulta y cerrarla
        //$stmt->close();
        $stmt = null;

    }


/////////////////////////////////////////////////////////////////////////////////



    /**
     * selecionar registros
     */
    // Método para seleccionar registros de una tabla de la base de datos
    static public function mdlSeleccionarRegistros($tabla, $item, $valor)
    {   
        // Verificar si se proporcionaron valores para la selección
        if ($item == null && $valor == null) {
            // Paso 1: Preparar una consulta SQL para seleccionar todos los registros en la tabla
            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha, '%d/%m/%y') as f FROM 
        $tabla ORDER BY id DESC");
         // Paso 2: Ejecutar la consulta
            $stmt->execute();

            // Paso 3: Retornar todos los resultados en un arreglo (fetchAll)
            return $stmt->fetchAll();
        } else {
            // Si se proporciona un criterio de selección y un valor

            $stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha, '%d/%m/%y') as f FROM 
        $tabla WHERE $item = :$item ORDER BY id DESC");
        // Paso 2: Vincular el valor del criterio proporcionado
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            // Paso 3: Ejecutar la consulta

            $stmt->execute();
            // Paso 4: Retornar el primer resultado encontrado (fetch)
            return $stmt->fetch();
        }

            // Paso 5: Liberar los recursos relacionados con la consulta (no se llega a ejecutar debido a las devoluciones anteriores)
        $stmt = null;
    }
    
    
    
    
    
   /**
 * Actualiza registros en una tabla de la base de datos
 */
static public function mdlActualizarRegistros($tabla, $datos)
{
    // Paso 1: Preparar una consulta SQL de actualización
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre=:nombre, email=:email, password=:password 
    WHERE id=:id");

    // Paso 2: Vincular los valores de los parámetros de la consulta a los datos proporcionados
    $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

    // Paso 3: Ejecutar la consulta SQL
    if ($stmt->execute()) {
        // Si la consulta se ejecuta con éxito, retornar "ok" para indicar una actualización exitosa
        return "ok";
    } else {
        // Si la consulta falla, imprimir información de error (esto es solo para fines de depuración)
        print_r($stmt->errorInfo());
    }
    
    // Paso 4: Liberar los recursos relacionados con la consulta y cerrarla
    //$stmt->close();
    $stmt = null;
}


   
   
   
   
   
   
    /**
 * Elimina un registro de una tabla de la base de datos
 */
static public function mdlEliminarRegistro($tabla, $valor)
{
    // Paso 1: Preparar una consulta SQL de eliminación
    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=:id");

    // Paso 2: Vincular el valor del parámetro de la consulta al valor proporcionado
    $stmt->bindParam(":id", $valor, PDO::PARAM_INT);

    // Paso 3: Ejecutar la consulta SQL
    if ($stmt->execute()) {
        // Si la consulta se ejecuta con éxito, retornar "ok" para indicar una eliminación exitosa
        return "ok";
    } else {
        // Si la consulta falla, imprimir información de error (esto es solo para fines de depuración)
        print_r($stmt->errorInfo());
    }
    
    // Paso 4: Liberar los recursos relacionados con la consulta y cerrarla
    //$stmt->close();
    $stmt = null;
}

}
?>