<?php 
     session_destroy();
    echo '<script>window.location="index.php?pagina=ingreso";</script>';
   

    //session_destroy();: Esta función se utiliza para destruir todas las variables de sesión actualmente registradas. 

    //echo '<script>window.location="index.php?pagina=ingreso";</script>';: Esta línea de código emite una etiqueta de 
    //script en la página web que, cuando se ejecuta en el navegador del usuario, redirige la página actual a "index.php" 
    //con el parámetro "pagina" establecido en "ingreso". En otras palabras, esta línea de código redirige al usuario a la página 
    //de inicio de sesión (o cualquier página que maneje el inicio de sesión) después de destruir la sesión actual.