<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

</head>
<form name="editar-empresa-form" method="post" action="cargarMuni2.php">

<?php

	error_reporting(0);	
	require_once('conexion.php');
	
	$cod=$_REQUEST['dpto'];
	$ciud = $_REQUEST['ciud'];
	
	echo"<select class='form-control' name='ciudad' id='ciud' required>";
		$ciudades="select * from ciudad where departamento='$cod' order by nombre";		
		$resultado=mysql_query($ciudades,$conexion);
		echo"<option value=''>--Municipio--</option>";
		while($resul=mysql_fetch_array($resultado)){
			if($resul['id']!=$ciud){
				echo"<option value=".$resul['id'].">".$resul['nombre']."</option>";
			}else{
				echo"<option value=".$resul['id']." selected>".$resul['nombre']."</option>";
			}
			
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

<script type='text/javascript'>
	var ciud=<?php echo $ciud;?>;
	$('#codciu').load('codigoCiudad.php?codciu='+ciud);
</script>

