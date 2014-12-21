<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR CLIENTE</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="lista-creditos-cliente2-form" method="post" action="lista_creditos_cliente2.php">
		<?php

			require("conexion.php");
			SESSION_START();
			$codcliente2=$_SESSION['codcli_ca'];
			$pag=$_REQUEST['num'];
		
			echo "<table class='table'>";
			echo "<th class='active'>CÓD. CRÉDITO</th><th class='active'>FECHA</th><th class='active'>OBSERVACIÓN</th><th class='active'>TOTAL CRÉDITO</th>";

			$creditos="select * from credito where cliente_cod='$codcliente2' order by fecha DESC limit $pag,10";
			$resulcred=mysql_query($creditos,$conexion);

			while($fila=mysql_fetch_array($resulcred)){
				echo "<tr class='first-child'>";
				echo "<td>".$fila['codigo']."</td>";
				echo "<td>".$fila['fecha']."</td>";
				echo "<td>".$fila['observacion']."</td>";
				echo "<td>".$fila['valor_total']."</td>";											
				echo "</tr>";
			}

			echo "</table>";					
		?>
	<!-- cierre div page-container  -->	
	</form>
</html>

