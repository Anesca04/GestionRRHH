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
		function autorizarSolicitud() {
			if (confirm("¿Autorizar vacaciones?"))
				return true;
			else 
				return false;
		}
		function denegarSolicitud() {
			if (confirm("¿Denegar vacaciones?"))
				return true;
			else 
				return false;
		}
	</script>
</head>

<?php 
		
    if (isset($_GET['idAutoriza'])) {
        //Realizo la consulta
		$sql=sprintf("update solicitud set autorizado=1 where idSolicitud=".$_GET['idAutoriza']);
        include("../recursos/con_mysql.php"); //conecto con la base de datos
		$db->query($sql); //actualizo el registro
		$db->close(); //Cierro la base de datos
    }

    if (isset($_GET['idDeniega'])) {
		//Realizo la consulta
		$sql=sprintf("update solicitud set autorizado=2 where idSolicitud=".$_GET['idDeniega']);	
        include("../recursos/con_mysql.php"); //conecto con la base de datos
		$db->query($sql); //actualizo el registro
		$db->close(); //Cierro la base de datos
    }
?>

<body>  
<div class="container">
<div class="fila">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
        <?php include("menu.php");?>
		<p>Solicitudes pendientes</p>
      </div>
  </div>

  <div class="fila">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<table style="display: block; overflow: auto;">
			<!-- FILA PARA LA CABECERA DE LOS REGISTROS -->
			<thead>
				<tr>
					<td>Trabajador</td></td><td>Fecha Inicio</td><td>Fecha Fin</td><td>Dias</td><td>Autorizar</td><td>NO Autorizar</td>
				</tr>
			</thead>

			<?php
				$sql="select s.idSolicitud, s.idPersonal, p.apellidos, p.nombre, s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s, personal p where s.idPersonal=p.idPersonal and s.autorizado=0";
				//echo $sql;

				include("../recursos/con_mysql.php"); //conecto con la base de datos
				$tabla=$db->query($sql); //realizo la consulta

				//Recorremos la tabla y muestro los registrtos
				echo "<tbody>";
				while ( $registro=$tabla->fetch_assoc() ) { 							
					echo "<tr><td>".$registro["apellidos"].' '.$registro["nombre"]."</td>";
					echo "<td>".MostrarFecha($registro["fecInicial"])."</td><td>".MostrarFecha($registro["fecFinal"])."</td><td>".$registro["diasSolicitados"]."</td>";				
					echo "<td><a href='pendientes.php?idAutoriza=".$registro["idSolicitud"]."' onclick='return autorizarSolicitud()'><img src='../img/iconos/ok.png' width=24px></a></td>";
					echo "<td><a href='pendientes.php?idDeniega=".$registro["idSolicitud"]."' onclick='return denegarSolicitud()'><img src='../img/iconos/borrar.png' width=24px></a></td></tr>";
				} //FIN while articulos 
				echo "</tbody>";

				$tabla->free_result(); //Cierro el recordset

				$db->close(); //Cierro la base de datos
			?>
		</table>
	</div>
  </div>
</div>

</body>
</html>