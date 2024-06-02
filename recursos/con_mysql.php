<?php

  $NomBase="qymfjiir_rrhh";
  $NomServidor="localhost";
  $Usuario="root";
  $Clave="";

  //WayDami
  /*$NomBase="qymfjiir_rrhh";
  $NomServidor="waydami.es";
  $Usuario="qymfjiir_rrhh";
  $Clave="Melilla20$";
  */
  
  $db = new mysqli($NomServidor, $Usuario, $Clave, $NomBase);

  //$db->set_charset("UTF8");
?>
