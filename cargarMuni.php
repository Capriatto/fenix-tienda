<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<form name="empresa-form" method="post" action="cargarMuni.php">
<?php

	error_reporting(0);	
	require_once('conexion.php');
	
	$cod=$_REQUEST['dpto'];
	
	echo"<select class='form-control' name='ciudad' id='ciud' required>";
		$ciudades="select * from ciudad where departamento='$cod' order by nombre";
		$resultado=mysql_query($ciudades,$conexion);
		echo"<option value=''>--Municipio--</option>";
		while($resul=mysql_fetch_array($resultado))
		{
			echo"<option value=".$resul['id'].">".$resul['nombre']."</option>";
		}						  
	echo "</select>";
?>

<div id='codciu'></div>
</form>
</html>

<script type='text/javascript'>
	$(document).ready(function(){
		$('#ciud').change(function(){
			var ciud=$('#ciud').val();
			if(ciud==''){
				alert('Debe seleccionar una ciudad');
			}				
			$('#codciu').load('codigoCiudad.php?codciu='+ciud);
		});    
	});	
</script>


