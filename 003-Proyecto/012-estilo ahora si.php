<!doctype html>
<html>
    <head>
        <title>Panel de control</title>
        <style>
            body,html{background:rgb(220,220,220);font-family:sans-serif;}
            header,main,footer{background:white;margin:auto;padding:20px;width:800px;}
            table{width:100%;}
            table tr:first-child{background:black !important;color:white;}
            table tr:nth-child(odd){background:rgb(240,240,240);}
            header,footer{position:relative;z-index:1000;text-align:center;}
            main{box-shadow:0px 0px 20px rgba(0,0,0,0.4);}
        </style>
    </head>
    <body>
        <header>
            <h1>Panel de control</h1>
        </header>
        <main>
        <?php

            $servidor = "localhost";
            $usuario = "usuarioempresa";
            $contrasena = "contraempresa";
            $basededatos = "empresa";    
            $conexion = mysqli_connect($servidor,$usuario,$contrasena,$basededatos);
            // Atrapamos la operación de borrado
            if(isset($_GET['operacion'])){
                if($_GET['operacion'] == "borrar"){
                    $peticion = "DELETE FROM ".$_GET['tabla']." WHERE Identificador = ".$_GET['id'].";";
                    $resultado = mysqli_query($conexion,$peticion);
                }
            }
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
                echo "<table>";
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
                    $contador = 0;
                    $id = 0;
                    foreach($fila as $registro){
                        echo "<td>".$registro."</td>";
                        if($contador == 0){
                            $id = $registro;
                        }
                        $contador++;
                    }
                    echo "<td><a href='?tabla=".$_GET['tabla']."&operacion=borrar&id=".$id."'><button>Borrar</button></a></td>";
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
            
                    </main>
        <footer>
            <h6>(c) 2023 Jose Vicente Carratala</h6>
        </footer>
    </body>
</html>