<?php
error_reporting(1);

if(isset($_POST['SumbitCerrarCaja'])){
	require("conexion.php");
	date_default_timezone_set('America/Bogota');
	$fechaHoy= date("Y-m-d");
	$consultaBaseHoy= "SELECT IF(base IS NULL,0, base) FROM diario WHERE fecha='$fechaHoy;'";
	$consultaInversionesHoy = "SELECT IF(sum(valor_total) IS NULL,0, sum(valor_total)) AS sumGastosFROM 	from factura WHERE fecha='$fechaHoy'";
	$consultaGastosHoy ="SELECT IF(sum(valor) IS NULL,0, sum(valor)) AS sumGastos FROM gasto WHERE 	   		fecha='$fechaHoy'";
		
	$baseHoy = mysql_result(mysql_query($consultaBaseHoy, $conexion), 0);
	$inversionesHoy = mysql_result(mysql_query($consultaInversionesHoy, $conexion), 0);
	$gastosHoy= mysql_result(mysql_query($consultaGastosHoy, $conexion), 0);
	$totalHoy= $_REQUEST['txtTotalDia'];
	 
	 
	$ventasHoy= $totalHoy - ( $baseHoy - ($inversionesHoy + $gastosHoy ));
	
	
	
	
	$consulta= "UPDATE diario SET total_dia=$totalHoy, gastos=$gastosHoy, inversiones=$inversionesHoy, 		ventas=$ventasHoy WHERE fecha='$fechaHoy';";
	require("conexion.php");
	mysql_query($consulta, $conexion);
	header("Location: index.php");
}else{
	header("Location: index.php");
}








