<?php

    $servidor = "localhost";
    $usuario = "usuarioempresa";
    $contrasena = "contraempresa";
    $basededatos = "empresa";
    
    $conexion = new mysqli(
        $servidor,
        $usuario,
        $contrasena,
        $basededatos
    );

?>