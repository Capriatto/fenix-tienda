<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR FACTURA</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="buscar-factura2-form" method="post" action="buscar_factura2.php">
		<?php
			//error_reporting(0);
			SESSION_START();	
			require_once('conexion.php');
					
			$pag=$_REQUEST['num'];
			$fecha=$_SESSION['fechafac'];
			
			$facturas2="select f.codigo cod,e.nombre emp,f.fecha fecha,f.valor_total total from factura f,empresa e where f.empresa=e.nit and fecha='$fecha' limit $pag,10";
			$resultadofac2=mysql_query($facturas2,$conexion);

			echo "<table class='table'>";
			echo "<th class='active'>CÓDIGO FACTURA</th><th class='active'>EMPRESA</th><th class='active'>FECHA</th><th class='active'>TOTAL</th><th class='active'>ACCIÓN</th>";
		
			while($fila2=mysql_fetch_array($resultadofac2)){
					echo "<tr class='first-child'>";
					echo "<td>".$fila2['cod']."</td>";
					echo "<td>".$fila2['emp']."</td>";
					echo "<td>".$fila2['fecha']."</td>";
					echo "<td>".$fila2['total']."</td>";
					echo "<td><a href='detalle_factura.php?codfac=".$fila2['cod']."'>Ver Factura</a></td>";										
					echo "</tr>";
			}
			echo "</table>";	
		?>
	</form>
</html>