<?php

    $servidor = "localhost";
    $usuario = "usuarioempresa";
    $contrasena = "contraempresa";
    $basededatos = "empresa";
    
    $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basededatos);

    $peticion = "
        CREATE TABLE productos ( 
            Identificador INT(255) NOT NULL AUTO_INCREMENT ,
            nombre VARCHAR(255) NOT NULL , 
            precio DOUBLE(255,2) NOT NULL , 
            descripcion VARCHAR(255) NOT NULL , 
            PRIMARY KEY (Identificador)
        ) ENGINE = InnoDB;
    ";

    $resultado = mysqli_query($conexion,$peticion);
    
?>