<?php

    $servidor = "localhost";
    $usuario = "usuarioempresa";
    $contrasena = "contraempresa";
    $basededatos = "empresa";    
    $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basededatos);
    $peticion = "SHOW TABLES FROM empresa;";
    $resultado = mysqli_query($conexion,$peticion);
    while($fila = mysqli_fetch_assoc($resultado)){
        echo "<a href='?tabla="
            .$fila["Tables_in_empresa"]
            ."'><button>"
            .$fila["Tables_in_empresa"]
            ."</button></a>";
    }
    if(isset($_GET['tabla'])){
        echo "<h3>Mostrando el contenido de la tabla: ".$_GET['tabla']."</h3>";
    }
    
?>