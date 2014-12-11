<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR GASTO</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
</head>

	<form name="buscar-gasto2-form" method="post" action="buscar_tipo_gasto2.php">

		<?php
			error_reporting(0);
			SESSION_START();	
			require_once('conexion.php');
			
			$k=1;			
			$pag=$_REQUEST['num'];
			$opcion=$_REQUEST['opc'];
			$nomb=$_SESSION['nombgasto'];			

			$consulta="select * from tipo_gasto where nombre like'%$nomb%' order by nombre limit $pag,10";
			$resultado=mysql_query($consulta,$conexion);
			
			echo "<table class='table'>";
			echo "<th class='active'>CÓDIGO</th><th class='active'>NOMBRE</th><th class='active'>ACCIÓN</th>";
			while($fila=mysql_fetch_array($resultado)){
					echo "<tr class='first-child'>";
					echo "<td>".$fila['codigo']."</td>";
					echo "<td>".$fila['nombre']."</td>";
					if($opcion==1){
						echo "<td><a href='editar_tipo_gasto.php?codi=".$fila['codigo']."&nomb=".$fila['nombre']."'>Editar Tipo Gasto</a></td>";
					}											
					echo "</tr>";
			}
			echo "</table>";
		?>
	</form>
</html>