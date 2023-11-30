<?php

    $servidor = "localhost";
    $usuario = "usuarioempresa";
    $contrasena = "contraempresa";
    $basededatos = "empresa";    
    $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basededatos);
    // Mostrar tablas
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
    
        // Mostrar columnas
        $peticion = "SHOW COLUMNS FROM ".$_GET['tabla'].";";
        $resultado = mysqli_query($conexion,$peticion);
        echo "<table border=1>";
        echo "<tr>";
        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<th>".$fila['Field']."</th>";
        }
        echo "<th>Acciones</th>";
        echo "</tr>";
        echo "</table>";
    }
    
?>