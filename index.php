<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">

  <TITLE>GESTIÓN DE RRHH</TITLE>

  <link rel="stylesheet" href="recursos/estilos.css">

  <script language="Javascript">
	  // COMPROBAR LOS CAMPOS DEL FORMULARIO                                    *
	  function valida_formulario(form){ 	 
		//valida los campos del formulario

		if (form.usuario.value.length==0){ 
	       alert("Introduzca el LOGIN") 
	       form.usuario.focus();
	       return (false);
	    }

		else if (form.clave.value.length==0){ 
	       alert("Introduzca la CLAVE") 
	       form.clave.focus();
	       return (false);
	    }

	    form.action="apps/valida.php";
		form.submit();
		return (true);
		
	  } //Fin función valida_formulario
   </script>
</head>

<body>

<div class="container">
  <div class="fila">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="font-weight:bold">
		<h2 style="background-color: #33A8FF; color: white">GESTIÓN DE RECURSOS HUMANOS</h2>
		<form name="form" onSubmit="return valida_formulario(this)" method="post">	
	</div>
  </div>

  <div class="fila">
	<label style="width:100px;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;">Usuario: </label>
	<input style="width:50%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;" type="text" name="usuario" size="15" maxlength="15" placeholder="Introduzca el usuario">
  </div>

  <div class="fila">
	<label style="width:100px;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;">Clave:    </label>
	<input style="width:50%;padding: 12px 20px;margin: 8px 0;box-sizing: border-box;" type="password" name="clave" size="15" maxlength="15" placeholder="Introduzca la clave">
  </div>

  <div class="fila" style="text-align: center;">
	<button type="submit" class="boton">ENTRAR</button>
	</form>		
  </div>

  <p style="color:blue;font-size:12px;"><?=date('Y')?> &copy; anesca</p>

</div>

</body>

</html>
