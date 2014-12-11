<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR EMPRESA</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="buscar-empresa2-form" method="post" action="buscar_empresa2.php">
		<?php
			error_reporting(0);
			SESSION_START();	
			require_once('conexion.php');
			
			$k=1;			
			$pag=$_REQUEST['num'];
			$opcion=$_REQUEST['opc'];
			$nomb=$_SESSION['nombcli'];
			echo $nomb;		

			$empresa2="select e.nit nit,e.nombre nombre,e.direccion dir,c.nombre ciud from empresa e,ciudad c where e.ciudad=c.id and e.nombre like'%$nomb%' order by e.nombre limit $pag,10";
			$resultado2=mysql_query($empresa2,$conexion);

			echo "<table class='table'>";
			echo "
			<th class='active'>NIT</th>
			<th class='active''>NOMBRE</th>
			<th class='active'>DIRECCIÓN</th>
			<th class='active'>CIUDAD</th>
			<th class='active'>ACCIÓN</th>
			";
			while($fila2=mysql_fetch_array($resultado2)){
					echo "<tr>";
					echo "<td>".$fila2['nit']."</td>";
					echo "<td>".$fila2['nombre']."</td>";
					echo "<td>".$fila2['dir']."</td>";
					echo "<td>".$fila2['ciud']."</td>";
					if($opcion==1){
						echo "<td><a href='editar_empresa.php?nit=".$fila2['nit']."'>Editar Empresa</a></td>";
					}
					echo "</tr>";
			}
			echo "</table>";		
		?>
	</form>
</html>