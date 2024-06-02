<?php session_start();

//Esta línea hay que ponerla para que no de error cuando se suba a internet
header("Content-Type: application/pdf");

include("../recursos/funciones.php");
//fichero que incluye las librerías del pdf.
include('../lib/fpdf/php/php.php');

//Recupero las variables del formulario y las metos en variables de sesión
$_SESSION['desde']=$_POST['fdesde'];
$_SESSION['hasta']=$_POST['fhasta'];

//FUNCIÓN PARA LA CABECERA DEL DOCUMENTO
//******************************************************************************
class NuevoPdf extends FPDF
{
	function Header()
    {
       //$this->image('/imagen/bienestar_social.jpg',10,5,100);
	   $this->setfont('Arial','B',12);
	   $this->Ln(8);
	   $this->Cell(190,8,"SUSTITUCIONES POR CATEGORIA desde: ".MostrarFecha($_SESSION['desde'])." hasta: ".MostrarFecha($_SESSION['hasta']),0,0,'C');	   
	   
	   $this->Ln(20);
	   $this->Cell(100,8,"CATEGORIA",0,0,'L');
	   $this->Cell(30,8,"TOTAL DIAS",0,0,'L');
	   $this->Line(10, 40, 190, 40); //Dibujo una linea después de la cabecera
	}

    function Footer()
    {
       //Situa el cursor a 1,5cm del final de la página.
       $this->SetY(-15);
    }
}

//new fdpf(): creación de un nuevo documento.
$pdf=new NuevoPdf('P');
$pdf->setmargins(10,5,5);
$pdf->AliasNbPages(); 
$pdf->addpage();

$sql="SELECT c.nomCategoria, sum(s.diasSolicitados) AS total".
  " from categoria c, sustituto su, solicitud_has_sustituto h, solicitud s". 
  " WHERE c.idCategoria=su.idCategoria AND s.idSolicitud=h.idSolicitud".
  " and h.idSustituto=su.idSustituto".
  " and fecInicial BETWEEN '".$_SESSION['desde']."' and '".$_SESSION['hasta']."'".
  " GROUP BY nomCategoria ORDER BY nomCategoria";

include("../recursos/con_mysql.php"); //conecto con la base de datos
$tabla=$db->query($sql); //realizo la consulta

while ( $registro=$tabla->fetch_assoc() ) { 							
	$pdf->Ln(8);
	$pdf->Cell(100,8,html_entity_decode($registro["nomCategoria"]),0,0,'L');
	$pdf->Cell(30,8,$registro["total"],0,0,'C');
}

$tabla->free_result(); //Cierro el recordset
$db->close(); //Cierro la base de datos

//$pdf->output('sustituciones.pdf','D');

$pdf->output();

?>
