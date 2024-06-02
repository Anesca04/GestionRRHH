<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RRHH</title>
	<link rel="stylesheet" href="../recursos/estilos.css">
</head>

<body>  
  <div class="container">
    <header>
        <h2>RECURSOS HUMANOS</h2>
        
        <?php include('../recursos/con_mysql.php');
            //Muestro el nombre de la persona que se ha validado
            $sql="SELECT nombre, apellidos FROM personal where idPersonal=".$_SESSION['idPersonal'];
            $tabla= $db->query($sql);

            $rows=$tabla->fetch_assoc();  
            echo "<p>".$rows["nombre"].' '.$rows["apellidos"];
            $tabla->free_result(); //Cierro el recordset
            $db->close(); //Cierro la base de datos
        ?>

        <nav>
            <?php 
                if ($_SESSION['acceso']==1) { //Menú usuarios
                 echo "<ul>";
                   echo "<li><a href='misSolicitudes.php'>Mis Solicitudes</a></li>";
                   echo "<li><a href='insertarSolicitud.php'>Insertar</a></li>";
                }
                elseif ($_SESSION['acceso']==2) { //Menú Jefe Personal
                    echo "<ul>";
                        echo "<li><a href='misSolicitudes.php'>Mis Solicitudes</a></li>";
                        echo "<li><a href='insertarSolicitud.php'>Insertar</a></li>";
                        echo "<li><a href='autorizadas.php'>Solicitudes Autorizadas</a></li>";
                }
                elseif ($_SESSION['acceso']==3) { //Menú Director
                    echo "<ul>";
                        echo "<li><a href='pendientes.php'>Solicitudes Pendientes</a></li>";
                        echo "<li><a href='sustituciones.php'>Sustituciones</a></li>";
                        echo "<li><a href='explotacion.php'>Informes</a></li>";
                }
                echo "<li><a href='../cerrarSesion.php'>Cerrar Sessión</a></li>";
                echo "</ul>";
            ?>
        </nav>
    </header>

  </div>
</body>

</html>
