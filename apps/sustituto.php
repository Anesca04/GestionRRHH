<?php session_start();
  include("../recursos/funciones.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
	<title>TIENDA</title>
	<link rel="stylesheet" href="../recursos/estilos.css">
</head>

<body>  

<div class="container">
    <?php include("menu.php");?>
    <p>Editar Solicitud</p>

    <?php 
    if (!isset($_POST['idSolicitud'])) { //Si el formulario no se ha enviado, lo muestra
        //Recupero el registro a modificar
        include("../recursos/con_mysql.php"); //conecto con la base de datos
        $sql="select s.fecInicial, p.nombre, p.apellidos, c.idCategoria, c.nomCategoria, s.fecFinal, s.diasSolicitados from solicitud s, personal p, categoria c where s.idPersonal=p.idPersonal and p.idCategoria=c.idCategoria and s.idSolicitud=".$_GET['id'];
        
        $tabla=$db->query($sql); //realizo la consulta
        $registro=$tabla->fetch_assoc();
    ?>

    <table width=80% cellspacing=0 cellpadding=0 border=0 style="border:2px outset #E1E1E1">
    <FORM NAME="form" onSubmit="sustituto.php" method="post">

    <tr> <td colspan=6 style="font-weight:bold">SOLICITUD VACACIONES</td> </tr>

    <tr>
        <td>Sustituído: </td>
        <td colspan="3"> <?=$registro["nombre"].' '.$registro["apellidos"]?> </td>   
        <td>Categoría: </td>
        <td> <?=$registro["nomCategoria"]?> </td>   
    </tr>   

    <tr>
        <td>Desde: </td><td> <?=$registro["fecInicial"]?> </td>   
        <td>Hasta: </td><td> <?=$registro["fecFinal"]?> </td>   
        <td>Días: </td><td> <?=$registro["diasSolicitados"]?> </td>   
    </tr>    

    <tr>
        <td>Sustituto: </td>
        <td>
        <select name="idSustituto">
            <!-- RELLENAMOS EL COMBO CON UN WHILE -->
            <?php	   
                $sql="select s.idSustituto, s.nombre, s.apellidos from sustituto s where s.idCategoria=".$registro["idCategoria"]." order by s.apellidos, s.nombre";
                $tabla2=$db->query($sql); //realizo la consulta 

                while ($sustituto=$tabla2->fetch_assoc())
                {
                    echo "<option value=".$sustituto["idSustituto"].">" .$sustituto["apellidos"].', ',$sustituto["nombre"]."</option>";
                }
            ?> 
        </select>
        </td>
    </tr>
            
    <tr>
        <td colspan="6" align=center>
            <INPUT TYPE="hidden" NAME="idSolicitud" value=<?=$_GET["id"]?>>
            <button type="submit" class="boton">Guardar</button>    
        </td>
    </tr>   
    
    </form> 
    </table>

<?php
} else { //Cuando el formulario ha sido enviado, inserto el registro
    //Recupero los datos del formulario
    $idSolicitud=$_POST['idSolicitud'];
    $idSustituto=$_POST['idSustituto'];

    include("../recursos/con_mysql.php"); //conecto con la base de datos

    //Realizo la consulta
    //El campo codart no lo pongo, porque lo he puesto autoincremental en la base de datos.
    $sql=sprintf("insert into solicitud_has_sustituto (idSolicitud, idSustituto) values(%s, %s)", $idSolicitud, $idSustituto);

    //echo $sql;
    echo "<h2 style='text-align:center'>SUSTITUTO AÑADIDO</h2>";
    echo "<p style='text-align:center'><a href='inicio.php'><button class='boton'> Volver </button></a></p>";

    $db->query($sql); //Inserto el registro  
} 
?>

</div>

</BODY>
</HTML>

