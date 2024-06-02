<?php
//setlocale(LC_ALL,"spanish");
   //FUNCI�N PARA DEVOLVER LA FECHA EN FORMATO DIA, MES EN LETRA Y A�O.
   function fechalarga()
   {
	  switch (date('n'))
	   {
		  case 1:
			  $mes='Enero';
			  break;
		  case 2:
			  $mes='Febrero';
			  break;
		  case 3:
			  $mes='Marzo';
			  break;
		  case 4:
			  $mes='Abril';
			  break;
		  case 5:
			  $mes='Mayo';
			  break;
		  case 6:
			  $mes='Junio';
			  break;
		  case 7:
			  $mes='Julio';
			  break;
		  case 8:
			  $mes='Agosto';
			  break;
		  case 9:
			  $mes='Septiembre';
			  break;
		  case 10:
			  $mes='Octubre';
			  break;
		  case 11:
			  $mes='Noviembre';
			  break;
		  case 12:
			  $mes='Diciembre';
		      break;
		}

      $fecha=date('j').' de '.$mes.' de '.date('Y');
	  return $fecha;
   }

   function nombre_mes($numero_mes)
   {
	  $mes="";
	  switch ($numero_mes)
	   {
		  case 1:
			  $mes='Enero';
			  break;
		  case 2:
			  $mes='Febrero';
			  break;
		  case 3:
			  $mes='Marzo';
			  break;
		  case 4:
			  $mes='Abril';
			  break;
		  case 5:
			  $mes='Mayo';
			  break;
		  case 6:
			  $mes='Junio';
			  break;
		  case 7:
			  $mes='Julio';
			  break;
		  case 8:
			  $mes='Agosto';
			  break;
		  case 9:
			  $mes='Septiembre';
			  break;
		  case 10:
			  $mes='Octubre';
			  break;
		  case 11:
			  $mes='Noviembre';
			  break;
		  case 12:
			  $mes='Diciembre';
		      break;
		}

	  return $mes;
   }

   //********************************************************************************
   //-------------------------- FUNCIONES PARA FECHA --------------------------------
   //********************************************************************************
   function GuardarFecha ($Fecha)
   {
	   $dia=substr($Fecha, 0, 2);
	   $mes=substr($Fecha, 3, 2);
	   $ano=substr($Fecha, 6, 4);
	   $Fecha=$ano."-".$mes."-".$dia;

	   /*$dia=substr($Fecha, 1, 2);
	   $mes=substr($Fecha, 4, 2);
	   $ano=substr($Fecha, 7, 4);
	   $Fecha=$ano."/".$mes."/".$dia;
	   */
	   return $Fecha;
   }

   function MostrarFecha ($Fecha)
   {
	   $dia=substr($Fecha, 8, 2);
	   $mes=substr($Fecha, 5, 2);
	   $ano=substr($Fecha, 0, 4);
	   $Fecha=$dia."/".$mes."/".$ano;
	   if ($Fecha=="//") $Fecha="";
	   return $Fecha;
   }

function dateAdd_Original($dias) {
	$mes = date("m");
	$anio = date("Y"); 
	$dia = date("d");
	$ultimo_dia = date( "d", mktime(0, 0, 0, $mes + 1, 0, $anio) ) ;
	$dias_adelanto = $dias;
	$siguiente = $dia + $dias_adelanto;
	if ($ultimo_dia < $siguiente) {
		$dia_final = $siguiente - $ultimo_dia;
	    $mes++;
		if ($mes == '13'){
		  $anio++;
		  $mes = '01';
		}
		$fecha_final = $dia_final.'/'.$mes.'/'.$anio;
	}
	else {
		$fecha_final = $siguiente .'/'.$mes.'/'.$anio;
	}
	return $fecha_final;
}

?>