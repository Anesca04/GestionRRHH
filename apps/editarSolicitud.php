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

        form.action="editarSolicitud.php";
		form.submit();
		return (true);
	  } //Fin función valida_formulario
    </script>

</head>

<body>  

<div class="container">
    <?php include("menu.php");?>
    <p>Editar Solicitud</p>

    <?php 
    if (!isset($_POST['fdesde'])) { //Si el formulario no se ha enviado, lo muestra
        //Recupero el registro a modificar
        include("../recursos/con_mysql.php"); //conecto con la base de datos
        $sql="select s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s where s.idSolicitud=".$_GET['id'];
        $tabla=$db->query($sql); //realizo la consulta

        $registro=$tabla->fetch_assoc();
    ?>

    <table width=80% cellspacing=0 cellpadding=0 border=0 style="border:2px outset #E1E1E1">
    <FORM NAME="form" onSubmit="return valida_formulario(this)" method="post">

    <tr> <td colspan=2 style="font-weight:bold">SOLICITUD VACACIONES</td> </tr>

    <tr>
        <td>Desde: </td>
        <td><INPUT TYPE="date" NAME="fdesde" size="10" value=<?=$registro["fecInicial"]?>></td>   
    </tr>    

    <tr>
        <td>Hasta: </td>
        <td><INPUT TYPE="date" NAME="fhasta" size="10" value=<?=$registro["fecFinal"]?>></td>   
    </tr>    

    <tr>
        <td>Dias: </td>
        <td><INPUT TYPE="text" NAME="fdias" value=<?=$registro["diasSolicitados"]?> size=2></td>   
    </tr>    

    <tr>
        <td colspan="2" align=center>
            <INPUT TYPE="hidden" NAME="id" value=<?=$_GET["id"]?>>
            <button type="submit" class="boton">Guardar</button>    
        </td>
    </tr>   
    
    </form> 
    </table>

<?php
} else { //Cuando el formulario ha sido enviado, inserto el registro
    //Recupero los datos del formulario
    $fdesde=$_POST['fdesde'];
    $fhasta=$_POST['fhasta'];
    $fdias=$_POST['fdias'];
    $id=$_POST['id'];

    include("../recursos/con_mysql.php"); //conecto con la base de datos

    //Realizo la consulta
    //El campo codart no lo pongo, porque lo he puesto autoincremental en la base de datos.
    $sql=sprintf("update solicitud set fecInicial='%s', fecFinal='%s', diasSolicitados=%s where idSolicitud=%s", $fdesde,$fhasta,$fdias,$id);

    //echo $sql;
    echo "<h2 style='text-align:center'>SOLICITUD MODIFICADA</h2>";
    echo "<p style='text-align:center'><a href='inicio.php'><button class='boton'> Volver </button></a></p>";

    $db->query($sql); //Inserto el registro  
} 
?>

</div>

</BODY>
</HTML>

