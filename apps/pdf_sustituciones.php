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
	   $this->setfont('Arial','B',12);
	   $this->Ln(8);
	   $this->Cell(280,8,"Sustituciones desde: ".MostrarFecha($_SESSION['desde'])." hasta: ".MostrarFecha($_SESSION['hasta']),0,0,'C');	   
	   
	   $this->Ln(20);
	   $this->Cell(100,8,"TRABAJADOR",0,0,'L');
	   $this->Cell(30,8,"DESDE",0,0,'L');
	   $this->Cell(30,8,"HASTA",0,0,'L');
	   $this->Cell(20,8,"DIAS",0,0,'L');
	   $this->Cell(100,8,"SUSTITUTO",0,0,'L');
	   //Dibujo una linea después de la cabecera
	   $this->Line(10, 40, 280, 40); 
	}

    function Footer()
    {
       //Situa el cursor a 1,5cm del final de la página.
       $this->SetY(-15);
    }
}

//new fdpf(): creación de un nuevo documento.
$pdf=new NuevoPdf('L');
$pdf->setmargins(10,5,5);
$pdf->AliasNbPages(); 
$pdf->addpage();

$sql="select s.idSolicitud, s.idPersonal, p.apellidos AS apeTrab, p.nombre AS nomTrab, su.apellidos as apeSust, su.nombre as nomSust, s.fecInicial, s.fecFinal, s.diasSolicitados from solicitud s, personal p, sustituto su, solicitud_has_sustituto h where s.idPersonal=p.idPersonal and h.idSolicitud=s.idSolicitud and h.idSustituto=su.idSustituto and fecInicial between '".$_SESSION['desde']."' and '".$_SESSION['hasta']."'";

include("../recursos/con_mysql.php"); //conecto con la base de datos
$tabla=$db->query($sql); //realizo la consulta

while ( $registro=$tabla->fetch_assoc() ) { 							
	$pdf->Ln(8);
	$pdf->Cell(100,8,html_entity_decode($registro["apeTrab"].' '.$registro["nomTrab"]),0,0,'L');
	$pdf->Cell(30,8,MostrarFecha($registro["fecInicial"]),0,0,'L');
	$pdf->Cell(30,8,MostrarFecha($registro["fecFinal"]),0,0,'L');
	$pdf->Cell(20,8,$registro["diasSolicitados"],0,0,'C');
	$pdf->Cell(100,8,$registro["apeSust"].' '.$registro["nomSust"],0,0,'L');
}

$tabla->free_result(); //Cierro el recordset
$db->close(); //Cierro la base de datos

//$pdf->output('sustituciones.pdf','D');

$pdf->output();

?>
