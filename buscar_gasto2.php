<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR GASTO</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="buscar-gasto2-form" method="post" action="buscar_gasto2.php">
		<?php
			error_reporting(0);
			SESSION_START();	
			require_once('conexion.php');
			date_default_timezone_set('America/Bogota');
			$fechaactual=date("Y-m-d");
			
			$k=1;			
			$pag=$_REQUEST['num'];
			$opcion=$_REQUEST['opc'];		

			$consulta="select g.codigo cod,tg.nombre tipogst,g.valor valor,g.fecha fecha from gasto g,tipo_gasto tg where g.tipo_gasto_codigo=tg.codigo and fecha='$fechaactual' order by fecha DESC limit $pag,10";
			$resultado=mysql_query($consulta,$conexion);
			
			echo "<table class='table'>";
			echo "<th class='active'>CÓDIGO</th><th class='active'>TIPO GASTO</th><th class='active'>FECHA</th><th class='active'>TOTAL</th><th class='active'></th>";
			while($fila=mysql_fetch_array($resultado)){
					echo "<tr class='first-child'>";
					echo "<td>".$fila['cod']."</td>";							
					echo "<td>".$fila['tipogst']."</td>";
					echo "<td>".$fila['fecha']."</td>";
					echo "<td>".$fila['valor']."</td>";
					if($opcion==1){
						echo "<td><a onclick='return eliminar();' href='eliminar_gasto.php?codi=".$fila['cod']."'>Eliminar Gasto</a></td>";
					}
					echo "</tr>";
			}
			echo "</table>";
		?>
	</form>
</html>