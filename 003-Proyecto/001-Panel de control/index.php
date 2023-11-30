<?php

    $servidor = "localhost";
    $usuario = "usuarioempresa";
    $contrasena = "contraempresa";
    $basededatos = "empresa";    
    $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basededatos);
    $peticion = "SHOW TABLES FROM empresa;";
    $resultado = mysqli_query($conexion,$peticion);
    while($fila = mysqli_fetch_assoc($resultado)){
        echo $fila["Tables_in_empresa"];
    }
    
?>