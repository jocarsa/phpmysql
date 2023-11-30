<?php

    $servidor = "localhost";
    $usuario = "usuarioempresa";
    $contrasena = "contraempresa";
    $basededatos = "empresa2";
    
    $conexion = new mysqli(
        $servidor,
        $usuario,
        $contrasena,
        $basededatos
    );
    if($conexion->connect_error){
        die("Error en la conexión");
    }
    
    $peticion = "
        CREATE TABLE clientes ( 
            Identificador INT(255) NOT NULL AUTO_INCREMENT ,
            nombre VARCHAR(255) NOT NULL , 
            apellidos VARCHAR(255) NOT NULL , 
            email VARCHAR(255) NOT NULL , 
            PRIMARY KEY (Identificador)
        ) ENGINE = InnoDB;
    ";
    $resultado = $conexion->query($peticion);
    $conexion->close();
?>