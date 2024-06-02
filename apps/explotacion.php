<?php session_start();?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

	<title>TIENDA</title>
	<link rel="stylesheet" href="../recursos/estilos.css">

  <script language="Javascript">
	  // COMPROBAR LOS CAMPOS DEL FORMULARIO                                    *
	  function valida_formulario(form){ 	 
      //valida los campos del formulario
      if (form.fdesde.value==""){ 
          alert("Fecha desde incorrecta") 
          form.fdesde.focus();
          return (false);
        }
      else if (form.fhasta.value==""){ 
          alert("Fecha hasta incorrecta") 
          form.fhasta.focus();
          return (false);
        }
      form.action=form.informe.value;
      form.submit();
      return (true);
	  } //Fin función valida_formulario
  </script>

</head>

<body>  


<div class="container">
  <div class="fila">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
        <?php include("menu.php");?>
      </div>
  </div>

  <FORM NAME="form" onSubmit="return valida_formulario(this)" method="post" target="_blank">
    <div class="fila">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">EXPLOTACIÓN DE DATOS</div>
    </div>

    <div class="fila">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">Desde: </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><INPUT TYPE="date" NAME="fdesde" size="10"></div>   
    </div>

    <div class="fila">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">Hasta: </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><INPUT TYPE="date" NAME="fhasta" size="10"></div>   
    </div>

    <div class="fila">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">Informe: </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <select name="informe">
          <option value="pdf_sustituciones.php">Listado sustituciones</option>
          <option value="pdf_categorias.php">Sustituciones por categorías</option>
        </select>
      </div>   
    </div>

    <div class="fila">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center">
        <button type="submit" class="boton">Solicitar informe</button>
      </div>
    </div>
  </form> 

</div>

<?php
  /*
    //Recupero los datos del formulario
    $fdesde=$_POST['fdesde'];
    $fhasta=$_POST['fhasta'];
    $fdias=$_POST['fdias'];

    include("../recursos/con_mysql.php"); //conecto con la base de datos

    //Realizo la consulta
    //El campo codart no lo pongo, porque lo he puesto autoincremental en la base de datos.
    $sql=sprintf("insert into solicitud(idSolicitud, fecSolicitud, fecInicial, fecFinal, diasSolicitados, idPersonal) values('default','%s', '%s', '%s', %s, %s)", date('Y-m-d'),$fdesde,$fhasta,$fdias,$_SESSION['idPersonal']);

    echo $sql;
    echo "<h2 style='text-align:center'>SOLICITUD INSERTADA</h2>";
    echo "<p style='text-align:center'><a href='inicio.php'><button class='boton'> Volver </button></a></p>";

    $db->query($sql); //Inserto el registro  

    $db->close(); //Cierro la base de datos
  */
?>

</BODY>
</HTML>

