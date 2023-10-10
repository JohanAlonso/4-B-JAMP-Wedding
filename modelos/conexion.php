<?php 
    class Conexion{
        static public function conectar(){
            $link = new PDO("mysql:host=localhost;port=3307;dbname=web-4b", "soporte3b", "soporte3b");
    
            $link->exec("set names utf8");
    
            return $link;
        }
    }
    
?>