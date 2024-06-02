<?php session_start();?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>RRHH</title>
	<link rel="stylesheet" href="../recursos/estilos.css">
</head>

<body>  
<div class="container">

<?php
//ini_set('error_reporting', E_ALL);

include('../recursos/con_mysql.php');
//include "../../funciones.php";

$usuario=$_POST['usuario'];
$clave=$_POST['clave'];

//COMPROBACION DE LOS CAMPOS

//include "cabecera.php";
//echo "<P><a href='../index.php'><img src='/imagen/botones/inicio_g.gif' border=0></a></CENTER>";

$sql="SELECT idPersonal, login, acceso FROM usuarios where login='" . $usuario . "' and clave='" . $clave . "'";

$tabla = $db->query($sql);

if ( $rows=$tabla->fetch_assoc() ) { 
	//Si el acceso es correcto, creo variables de sesiones de los campos que me interesan
			  
	$_SESSION['idPersonal']=$rows["idPersonal"];
	$_SESSION['login']=$rows["login"];
	$_SESSION['acceso']=$rows["acceso"];

	//Envio al menú principal
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=../apps/inicio.php\">";
}
else { ?>

	<div class="container">
	<div class="fila">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
		  <h2 style="background-color: #33A8FF; color: white">GESTIÓN DE RECURSOS HUMANOS</h2>
		  <form name="form" onSubmit="return valida_formulario(this)" method="post">	
	  </div>
	</div>
  
    <div class="fila">
      <br><h4>USUARIO NO ENCONTRADO</h4><br>
      <p class="boton" style="width:80px;;text-align: center"><a href="../index.php">VOLVER</a></p>
	    <br><p style="color:blue;font-size:12px"><?=date('Y')?> &copy; anesca</p>
    </div>
<?php 
}
?>

</div>
</body>
</html>

