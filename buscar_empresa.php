<?php
	error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR EMPRESA</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>
	
	<form name="buscar-empresa-form" method="post" action="buscar_empresa.php">
	<fieldset>	
	<div id="page-container">
		<a href="registrar_empresa.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Empresa</a>
		<h2>Buscar Empresa </h2>
		<div class="row">
	  	<div class="col-md-8">
	    <div class="input-group">
	      	<span class="input-group-addon">Nombre de la Empresa</span>
	      	<input type="text" id="nombre" name="nombre" class="form-control" pattern="[A-Z a-z]{1,50}" title="Solo puede ingresar letras" placeholder="Ingrese el nombre de la empresa para la busqueda"/>
	    </div>
	   	</div>
	  	<div class="row">    
			<button class="btn btn-primary" name="btnfind" value="find" id="find" type="submit"> <i class="glyphicon glyphicon-search"></i> Buscar </button>
	  	</div>
		</div>
		<br>
	
 		<?php
			SESSION_START();
			$opcion=$_REQUEST['opcion'];
			//$opcion=3;

			if($_POST['btnfind']=='find'){
				$nombre= $_REQUEST['nombre'];
				$_SESSION['nombcli'] = $nombre;
				$opcion=$_REQUEST['opcion'];

				$empresa="select * from empresa where nombre like'%$nombre%' order by nombre";
				$resultado=mysql_query($empresa,$conexion);
				$totalregi = mysql_num_rows($resultado);
				$tamano=10;
				$numpage=ceil($totalregi/$tamano);
				$i=0;
				$j=1; $k=1;				

				if($totalregi>0){
					//Consulta de la primer pagina de los resultados					
					$empresa2="select e.nit nit,e.nombre nombre,e.direccion dir,c.nombre ciud from empresa e,ciudad c where e.ciudad=c.id and e.nombre like'%$nombre%' order by e.nombre limit $tamano";
					$resultado2=mysql_query($empresa2,$conexion);

					//DIV DONDE SE IMPRIMEN LAS PAGINAS
					echo"<div class='row'>";
					echo"<div id='consul' class='col-sm-9'>";
					echo "<table class='table'>";
					echo "
					<th class='active'>NIT</th>
					<th class='active'>NOMBRE</th>
					<th class='active'>DIRECCIÓN</th>
					<th class='active'>CIUDAD</th>
					<th class='active'>ACCIÓN</th>
					";					
					while($fila2=mysql_fetch_array($resultado2)){
							echo "<tr class='first-child'>";
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
					echo"</div>";
					//Fin div row
					echo"</div>";				
					//DIV NUMEROS DE PAGINA
					echo"<div id='pagi' class='col-sm-9' border='1'>";
					echo "<table class='table-condensed' align='center'>";
					echo "<tr>";	
					while($i<$numpage){
						$num=$i*$tamano;		
						echo "<td><input type='button' class='btn' name='$num' value='$j' onclick='paginas(this.name);'/></td>";
						$i=$i+1;
						$j=$j+1;
					}			
					echo"</tr>";
					echo "</table>";
					echo"</div>";					
				}else{
					echo"<script>alert('No se encontraron resultados');</script>";
				}//Fin if resultado2

			}
		?> 


		<div id='oculto' class="row">
	  	<div class="col-md-3">
	    <div class="input-group">
	      	<span class="input-group-addon">Opción</span>
	      	<input type="text" id="opcion" name="opcion" class="form-control" value="<?php echo $opcion;?>"/>
	    </div>
	   	</div>
	  	</div>
	<!-- cierre div page-container  -->	
	</div>
	</fieldset> 
	</form>
</html>

<script type='text/javascript'>
	document.getElementById('oculto').style.display = 'none';

	function paginas(valor){
		var opcion=<?php echo $opcion;?>;
		$('#consul').load('buscar_empresa2.php?num='+valor+'&opc='+opcion);
	}
</script>

