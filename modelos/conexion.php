<?php 
    // Definición de una clase llamada "Conexion"
    class Conexion{
        // Definición de un método estático llamado "conectar"
        static public function conectar(){
            // Creación de una instancia de la clase PDO para conectarse a la base de datos MySQL
            $link = new PDO("mysql:host=localhost;port=3307;dbname=web-4b", "soporte3b", "soporte3b");
            
            // Establecimiento de la codificación de caracteres a UTF-8 para asegurar la compatibilidad con caracteres especiales
            $link->exec("set names utf8");
            

            // Devuelve la instancia de PDO, que representa la conexión a la base de datos
            return $link;
        }
    }
    
?>