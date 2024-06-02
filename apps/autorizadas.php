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
  <p>Solicitudes autorizadas</p>

  <table style="width: 100%;">
	<!-- FILA PARA LA CABECERA DE LOS REGISTROS -->
	<thead>
		<tr>
			<td>Trabajador</td><td>Fecha Inicio</td><td>Fecha Fin</td><td>Dias</td><td>Editar</td>
		</tr>
	</thead>

	<?php
		include("../recursos/con_mysql.php"); //conecto con la base de datos
		$sql="select s.idSolicitud, s.idPersonal, p.apellidos, p.nombre, s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s, personal p where s.idPersonal=p.idPersonal and s.idSolicitud IN (SELECT idSolicitud FROM solicitud WHERE autorizado=1 and idSolicitud not IN(SELECT idSolicitud FROM solicitud_has_sustituto))";

		$tabla=$db->query($sql); //realizo la consulta

		//Recorremos la tabla y muestro los registrtos
		echo "<tbody>";
		while ( $registro=$tabla->fetch_assoc() ) { 							
			echo "<tr><td>".$registro["apellidos"].', '.$registro["nombre"]."</td>";
			echo "<td>".MostrarFecha($registro["fecInicial"])."</td><td>".MostrarFecha($registro["fecFinal"])."</td><td>".$registro["diasSolicitados"]."</td>";				
			echo "<td><a href='sustituto.php?id=".$registro["idSolicitud"]."'><img src='../img/iconos/persona.png' width=24px></a></td>";
        } //FIN while articulos 
		echo "</tbody>";

		$tabla->free_result(); //Cierro el recordset

		$db->close(); //Cierro la base de datos
	?>
  </table>
		  
</div>

</body>
</html>