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
</head>

<body>  
<div class="container">
  <div class="fila">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
        <?php include("menu.php");?>
		<p>Solicitudes</p>
      </div>
  </div>

  <div class="fila">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<table style="display: block; overflow: auto">
			<!-- FILA PARA LA CABECERA DE LOS REGISTROS -->
			<thead>
				<tr>
					<td>Trabajador</td></td><td>Fecha Inicio</td><td>Fecha Fin</td><td>Dias</td><td>Sustituto</td>
				</tr>
			</thead>

			<?php
				$sql="select s.idSolicitud, s.idPersonal, p.apellidos AS apeTrab, p.nombre AS nomTrab, su.apellidos as apeSust, su.nombre as nomSust, s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s, personal p, sustituto su, solicitud_has_sustituto h where s.idPersonal=p.idPersonal and h.idSolicitud=s.idSolicitud and h.idSustituto=su.idSustituto";

				include("../recursos/con_mysql.php"); //conecto con la base de datos
				$tabla=$db->query($sql); //realizo la consulta

				//Recorremos la tabla y muestro los registrtos
				echo "<tbody>";
				while ( $registro=$tabla->fetch_assoc() ) { 							
					echo "<tr><td>".$registro["apeTrab"].' '.$registro["nomTrab"]."</td>";
					echo "<td>".MostrarFecha($registro["fecInicial"])."</td><td>".MostrarFecha($registro["fecFinal"])."</td><td>".$registro["diasSolicitados"]."</td>";				
					echo "<td>".$registro["apeSust"].' '.$registro["nomSust"]."</td>";
				} //FIN while
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