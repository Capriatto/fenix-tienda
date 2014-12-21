<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR PRODUCTO</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="buscar-producto2-form" method="post" action="buscar_producto2.php">
		<?php
			error_reporting(0);
			SESSION_START();	
			require_once('conexion.php');
			
			$k=1;			
			$pag=$_REQUEST['num'];
			$opcion=$_REQUEST['opc'];
			$nomb=$_SESSION['nombpro'];			

			$consulta="select ep.producto_codigo cod,p.nombre pro,e.nombre emp,ep.valor_compra vc,ep.valor_venta vv,e.nit codemp from empresa e,producto p,empresa_producto ep where ep.empresa_nit=e.nit and ep.producto_codigo=p.codigo and p.nombre like'%$nomb%' order by p.nombre limit $pag,10";
			$resultado=mysql_query($consulta,$conexion);
			
			echo "<table class='table' border='0'>";
				echo "<th class='active'>CÓDIGO</th><th class='active'>PRODUCTO</th><th class='active'>PROVEEDOR</th><th class='active'>VALOR COMPRA</th><th class='active'>VALOR VENTA</th><th class='active'></th>";
			while($fila=mysql_fetch_array($resultado)){
					echo "<tr>";
					echo "<td>".$fila['cod']."</td>";
					echo "<td>".$fila['pro']."</td>";
					echo "<td>".$fila['emp']."</td>";
					echo "<td>".$fila['vc']."</td>";
					echo "<td>".$fila['vv']."</td>";
					if($opcion==1){
						echo "<td><a href='editar_precios.php?codi=".$fila['cod']."&emp=".$fila['codemp']."'>Actualizar Precios</a></td>";
					}
					else if($opcion==0){
						echo "<td></td>";
					}
										
					else if($opcion==2){
						echo "<td><a href='agregar_proveedor.php?codpro=".$fila2['cod']."'>Agregar Proveedor a Producto</a></td>";
					}
					else if($opcion==3){
						echo "<td><a href='editar_producto.php?codpro=".$fila2['cod']."&nompro=".$fila2['pro']."'>Editar Producto</a></td>";
					}									
					echo "</tr>";
			}
			echo "</table>";
		?>	
	</form>
</html>