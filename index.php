<?php
  # index:
    # En el mostraremos la salida de las vistas al usuario y tambien a traves de él le 
    # enviaremos las distintas acciones que el usuario envie al controlador.
    #
    #requiere(). Establece que el codigo del arcivo invocado es requerido 
    #es decir, obligatorio para el funcionameinto dekl programa 
    #por ello si archivo 
    #require_once, funciona de la misma qe su respectico salvo que al 
    #utilizar la version ONCE SE impide la carga de un mismo archivo
    #mas de una vez

    require_once ("controladores/plantilla.controlador.php");
    require_once ("controladores/formularios.controlador.php");
    require_once ("modelos/formularios.modelos.php");

    $plantilla = new ControladorPLantilla();
    $plantilla -> ctrTraerPlantilla();

    ?>