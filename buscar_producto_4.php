<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR PRODUCTO</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="buscar-producto2-form" method="post" action="buscar_producto_4.php">

		<?php
			error_reporting(0);
			SESSION_START();	
			require_once('conexion.php');
			
			$k=1;			
			$pag=$_REQUEST['num'];
			$opcion=$_REQUEST['opc'];
			$nomb=$_SESSION['nombpro'];			

			$consulta="select * from producto where nombre like'%$nomb%' order by nombre limit $pag,10";
			$resultado=mysql_query($consulta,$conexion);
			
			//DIV DONDE SE IMPRIMEN LAS PAGINAS
			echo "<table class='table'>";
			echo "<th class='active'>CÓDIGO</th><th class='active'>PRODUCTO</th><th class='active'></th>";
			while($fila=mysql_fetch_array($resultado)){
					echo "<tr>";
					echo "<td>".$fila['codigo']."</td>";
					echo "<td>".$fila['nombre']."</td>";
					if($opcion==1){
						echo "<td><a href='editar_producto.php?codpro=".$fila['codigo']."&nompro=".$fila['nombre']."'>Editar Producto</a></td>";
					}
					else if($opcion==2){
						echo "<td><a href='agregar_proveedor.php?codpro=".$fila['codigo']."&nompro=".$fila['nombre']."'>Agregar Proveedor</a></td>";
					}									
					echo "</tr>";
			}
			echo "</table>";	
		?>	
	</form>
</html>