<php session_destroy();?>

<!DOCTYPE html>
<HTML lang="es">

<HEAD>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

  <TITLE>GESTIÓN DE RRHH</TITLE>
  <link rel="stylesheet" href ="recursos/estilos.css" type="text/css">
</HEAD>

<body>
  <div class="container">
    <div class="fila">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
	    	<h2 style="background-color: #33A8FF; color: white">GESTIÓN DE RECURSOS HUMANOS</h2>
      </div>
    </div>

    <div class="fila">
      <br><h4>Se ha cerrado la sesión</h4><br>
      <p class="boton" style="width:80px;;text-align: center"><a href="index.php">INICIO</a></p>
	    <br><p style="color:blue;font-size:12px"><?=date('Y')?> &copy; anesca</p>
    </div>

  </div>
</body>

</html>
