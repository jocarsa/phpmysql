<?php

    $servidor = "localhost";
    $usuario = "usuarioempresa";
    $contrasena = "contraempresa";
    $basededatos = "empresa";    
    $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basededatos);

    // Atrapo formulario de inserción
    if(isset($_POST['Identificador'])){
        echo "Insertamos un nuevo registro";
        $cadena = "INSERT INTO ".$_GET['tabla']." VALUES (NULL,";
        foreach($_POST as $clave=>$campo){
            if($clave != "Identificador"){
                $cadena .= '"'.$campo.'",';
            }
        }
        $cadena = substr($cadena,0,-1);
        $cadena .= ");";
        $resultado = mysqli_query($conexion,$cadena);
    }

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
        // Listo los registros
        $peticion = "SELECT * FROM ".$_GET['tabla'].";";
        $resultado = mysqli_query($conexion,$peticion);
        
        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<tr>";
            foreach($fila as $registro){
                echo "<td>".$registro."</td>";
            }
            echo "</tr>";
        }
        // Formulario de inserción
        $peticion = "SHOW COLUMNS FROM ".$_GET['tabla'].";";
        $resultado = mysqli_query($conexion,$peticion);
        echo "<tr>";
        echo "<form action='?tabla=".$_GET['tabla']."' method='POST'> ";
        while($fila = mysqli_fetch_assoc($resultado)){
            echo "<td><input type='text' name='".$fila['Field']."'></td>";
        }
        echo "<td><input type='submit'></td>";
        echo "</form>";
        echo "</tr>";
        echo "</table>";
    }
    
    
?>