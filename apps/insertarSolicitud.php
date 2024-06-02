<?php session_start();
  include("../recursos/funciones.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
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
		else if (form.fdias.value==""){ 
	       alert("Debes introducir el número de días") 
	       form.fhasta.focus();
	       return (false);
	    }

        form.action="insertarSolicitud.php";
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
		<p>Insertar Solicitud</p>
      </div>
  </div>

  <div class="fila">
    <?php 
    if (!isset($_POST['fdesde'])) { //Si el formulario no se ha enviado, lo muestra
    ?>

    <table width=80% cellspacing=0 cellpadding=0 border=0 style="border:2px outset #E1E1E1">
    <FORM NAME="form" onSubmit="return valida_formulario(this)" method="post">

    <tr> <td colspan=2 style="font-weight:bold">SOLICITUD VACACIONES</td> </tr>

    <tr>
        <td>Desde: </td>
        <td><INPUT TYPE="date" NAME="fdesde" size="10"></td>   
    </tr>    

    <tr>
        <td>Hasta: </td>
        <td><INPUT TYPE="date" NAME="fhasta" size="10" value="30-04-2024"></td>   
    </tr>    

    <tr>
        <td>Dias: </td>
        <td><INPUT TYPE="text" NAME="fdias" size=2></td>   
    </tr>    

    <tr>
        <td colspan="2" align=center>
        <button type="submit" class="boton">Guardar</button>    
    </tr>   
    
    </form> 
    </table>
  </div>
<?php
} else { //Cuando el formulario ha sido enviado, inserto el registro
    //Recupero los datos del formulario
    $fdesde=$_POST['fdesde'];
    $fhasta=$_POST['fhasta'];
    $fdias=$_POST['fdias'];

    include("../recursos/con_mysql.php"); //conecto con la base de datos

    //Realizo la consulta
    //El campo codart no lo pongo, porque lo he puesto autoincremental en la base de datos.
    $sql=sprintf("insert into solicitud(idSolicitud, fecSolicitud, fecInicial, fecFinal, diasSolicitados, idPersonal) values('default','%s', '%s', '%s', %s, %s)", date('Y-m-d'),$fdesde,$fhasta,$fdias,$_SESSION['idPersonal']);

    //echo $sql;
    echo "<h2 style='text-align:center'>SOLICITUD INSERTADA</h2>";
    echo "<p style='text-align:center'><a href='inicio.php'><button class='boton'> Volver </button></a></p>";

    $db->query($sql); //Inserto el registro  

    $db->close(); //Cierro la base de datos
} 
?>

</div>

</BODY>
</HTML>

