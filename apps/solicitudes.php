<?php session_start();
  include("../recursos/funciones.php");
?>

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
  <?php include("menu.php");?>
  <p>Solicitudes</p>

  <table>
	<!-- FILA PARA LA CABECERA DE LOS REGISTROS -->
	<thead>
		<tr>
			<td>Sustituído</td><td>Fecha Inicio</td><td>Fecha Fin</td><td>Dias</td><td>Editar</td><td>Eliminar</td>
		</tr>
	</thead>

	<?php
		include("../recursos/con_mysql.php"); //conecto con la base de datos

		if ($_SESSION['acceso']==2) //Acceso Jefe Personal
			$sql="select s.idSolicitud, s.idPersonal, p.apellidos, p.nombre, s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s, personal p where s.idPersonal=p.idPersonal and s.autorizado=1";
		else { //Acceso Director
			if ($_GET['op']=='A') {
				$sql="select s.idSolicitud, s.idPersonal, p.apellidos, p.nombre, s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s, personal p where s.idPersonal=p.idPersonal and s.autorizado=1";
			}
			else {
				$sql="select s.idSolicitud, s.idPersonal, p.apellidos, p.nombre, s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s, personal p where s.idPersonal=p.idPersonal and s.autorizado=0";
			}

		}

		//echo $sql;

		$tabla=$db->query($sql); //realizo la consulta

		//Recorremos la tabla y muestro los registrtos
		echo "<tbody id='registros'>";
		while ( $registro=$tabla->fetch_assoc() ) { 							
			echo "<tr><td>".$registro["nombre"].' '.$registro["apellidos"]."</td>";
			echo "<td>".MostrarFecha($registro["fecInicial"])."</td>";
			echo "<td>".MostrarFecha($registro["fecFinal"])."</td>";
			echo "<td>".$registro["diasSolicitados"]."</td></tr>";				
		}
		echo "</tbody>";

		$tabla->free_result(); //Cierro el recordset

		$db->close(); //Cierro la base de datos
	?>
  </table>
		  
</div>

</body>
</html>