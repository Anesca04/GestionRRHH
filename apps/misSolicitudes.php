<?php session_start();
  include("../recursos/funciones.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
	<title>RRHH</title>
	<link rel="stylesheet" href="../recursos/estilos.css">

	<script language="Javascript">
		//función para confirmar la eliminación del registro
		function confirmar() {
			if (confirm("¿Quieres eliminar el registro?"))
				return true;
			else 
				return false;
		}
	</script>
</head>

<?php 
	if (isset($_GET['id'])) {
		//Elimino el registro
		include("../recursos/con_mysql.php"); //conecto con la base de datos

		//Realizo la consulta
		$sql=sprintf("delete from solicitud where idSolicitud=".$_GET['id']);
	
		$db->query($sql); //Elimino el registro	
		$db->close(); //Cierro la base de datos
	}
?>

<body>  
<div class="container">
  <div class="fila">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
        <?php include("menu.php");?>
		<p>Mis solicitudes</p>
      </div>
  </div>

  <div class="rwd">		
	<table class="rwd_auto">
		<!-- FILA PARA LA CABECERA DE LOS REGISTROS -->
		<thead>
			<tr>
				<td>Fecha Inicio</td><td>Fecha Fin</td><td>Dias</td><td>Editar</td><td>Eliminar</td>
			</tr>
		</thead>

		<?php
			include("../recursos/con_mysql.php"); //conecto con la base de datos

			$sql="select s.idSolicitud, s.idPersonal, s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s where s.idPersonal=".$_SESSION['idPersonal'];
			//echo $sql;

			$tabla=$db->query($sql); //realizo la consulta

			//Recorremos la tabla y muestro los registrtos
			echo "<tbody>";
			while ( $registro=$tabla->fetch_assoc() ) { 							

				//Compruebo si la petición ya tiene sustituto
				$sql="select * from solicitud_has_sustituto where idSolicitud=".$registro["idSolicitud"];
				$tsustituto=$db->query($sql); //realizo la consulta
				if (!$tsustituto->fetch_assoc()) {
					//La petición NO tiene sustituto
					echo "<tr><td>".MostrarFecha($registro["fecInicial"])."</td><td>".MostrarFecha($registro["fecFinal"])."</td><td>".$registro["diasSolicitados"]."</td>";				
					echo "<td><a href='editarSolicitud.php?id=".$registro["idSolicitud"]."'><img src='../img/iconos/editar.png' width=24px></a></td>";
					echo "<td><a href='misSolicitudes.php?id=".$registro["idSolicitud"]."' onclick='return confirmar()'><img src='../img/iconos/eliminar.png' width=24px></a></td></tr>";
				}
				else {
					//La petición tiene sustituto
					echo "<tr style='color:green'><td>".MostrarFecha($registro["fecInicial"])."</td><td>".MostrarFecha($registro["fecFinal"])."</td><td>".$registro["diasSolicitados"]."</td>";				
					echo "<td> </td><td> </td></tr>";					
				}
			} //FIN while articulos 
			echo "</tbody>";

			$tabla->free_result(); //Cierro el recordset

			$db->close(); //Cierro la base de datos
		?>
	</table>		  
  </div>
</div>

</body>
</html>
