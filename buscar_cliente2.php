<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR CLIENTES</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="buscar-cliente2-form" method="post" action="buscar_cliente2.php">
		<?php
			error_reporting(0);
			SESSION_START();	
			require_once('conexion.php');
			
			$k=1;			
			$pag=$_REQUEST['num'];
			$opcion=$_REQUEST['opc'];
			$nomb=$_SESSION['nombcli'];			

			$consulta="select * from cliente where nombre like'%$nomb%' order by nombre limit $pag,10";
			$resultado=mysql_query($consulta,$conexion);
			
			echo "<table class='table'>";
			echo "<th class='active'>CÓDIGO</th><th class='active'>NOMBRE</th><th class='active'>TOTAL DEUDA</th><th class='active'></th>";
			while($fila=mysql_fetch_array($resultado)){
					echo "<tr>";
					echo "<td>".$fila['codigo']."</td>";
					echo "<td >".$fila['nombre']."</td>";
					echo "<td>".$fila['total_deuda']."</td>";
					if($opcion==1){
						echo "<td><a href='editar_cliente.php?codi=".$fila['codigo']."'>Editar Cliente</a></td>";
					}
					elseif ($opcion==2) {
						echo "<td><a href='registrar_credito.php?cli=".$fila['codigo']."'>Registrar Crédito</a></td>";
					}
					elseif ($opcion==3) {
						echo "<td><a href='registrar_abono.php?cli=".$fila['codigo']."'>Registrar Abono</a></td>";
					}
					elseif ($opcion==4) {
						echo "<td><a href='lista_crediabonos_cliente.php?cod=".$fila2['codigo']."&cli=".$fila2['nombre']."&opc=1'>Ver Créditos y Abonos</a></td>";
					}
					else if($opcion==0){
						echo "<td></td>";
					}					
					echo "</tr>";
			}
			echo "</table>";
		?>
	</form>
</html>