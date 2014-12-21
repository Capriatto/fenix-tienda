<?php
	error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR CLIENTE</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>
	<a href="buscar_cliente.php?opcion=2" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Crédito</a>
	<a href="buscar_cliente.php?opcion=3" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Abono</a>
	<a href="registrar_cliente.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Cliente</a>
	<form name="buscar-cliente-form" method="post" action="buscar_cliente.php">
	<fieldset>
	<div id="page-container">
		<h2>Buscar Cliente</h2>
		<div class="row">
	  	<div class="col-md-8">
	    <div class="input-group">
	      	<span class="input-group-addon">Nombre del Cliente</span>
	      	<input type="text" id="nombre" name="nombre" class="form-control" pattern="[A-Z a-z ]+" title="Solo puede ingresar letras" placeholder="Ingrese un nombre de cliente para la busqueda"/>
	    </div>
	   	</div>
	  	<div class="row">    
			<button class="btn btn-primary" name="btnfind" value="find" id="find" type="submit"><i class="glyphicon glyphicon-search"></i> Buscar</button>
	  	</div> 	
	  	</div>
	  	<br>
		<?php
			SESSION_START();
			$opcion=$_REQUEST['opcion'];

			if($_POST['btnfind']=='find'){
				$nombre= $_REQUEST['nombre'];
				$_SESSION['nombcli'] = $nombre;
				$opcion=$_REQUEST['opcion'];

				$cliente="select * from cliente where nombre like'%$nombre%' order by nombre";
				$resultado=mysql_query($cliente,$conexion);
				$totalregi = mysql_num_rows($resultado);
				$tamano=10;
				$numpage=ceil($totalregi/$tamano);
				$i=0;
				$j=1; $k=1;
				
				if($totalregi>0){
					//DIV DONDE SE IMPRIMEN LAS PAGINAS
					echo"<div class='row'>";
					echo"<div id='consul' class='col-sm-9'>";				
					echo "<table class='table'>";
					echo "<th class='active'>CÓDIGO</th><th class='active'>NOMBRE</th><th class='active'>TOTAL DEUDA</th><th class='active'></th>";
					
					//Consulta de la primer pagina de los resultados					
					$cliente2="select * from cliente where nombre like'%$nombre%' order by nombre limit $tamano";
					$resultado2=mysql_query($cliente2,$conexion);
					
					while($fila2=mysql_fetch_array($resultado2)){
							echo "<tr class='first-child'>";
							echo "<td>".$fila2['codigo']."</td>";
							echo "<td>".$fila2['nombre']."</td>";
							echo "<td>".$fila2['total_deuda']."</td>";
							if($opcion==1){
								echo "<td><a href='editar_cliente.php?codi=".$fila2['codigo']."'>Editar Cliente</a></td>";
							}
							elseif ($opcion==2) {
								echo "<td><a href='registrar_credito.php?cli=".$fila2['codigo']."'>Registrar Crédito</a></td>";
							}
							elseif ($opcion==3) {
								echo "<td><a href='registrar_abono.php?cli=".$fila2['codigo']."'>Registrar Abono</a></td>";
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
					echo"</div>";
					echo"</div>";
					//CIERRE DIV ROW
					echo"</div>";				
					//DIV NUMEROS DE PAGINA
					echo"<div id='pagi' class='col-sm-7' border='0'>";
					echo "<table class='table-condensed' align='center'>";
					echo "<tr>";	
					while($i<$numpage){
						$num=$i*$tamano;		
						echo "<td><input type='button' class='btn' name='$num' value='$j' onclick='paginas(this.name);' /></td>";
						$i=$i+1;
						$j=$j+1;
					}			
					echo"</tr>";
					echo "</table>";
					echo"</div>";					
				}else{
					echo"<script>alert('No se encontraron resultados');</script>";
				}//Fin if totalregi

			}
		?>
	  	<div id='editar'>

	  	</div>

		<div id='oculto' class="row">
	  	<div class="col-md-6">
	    <div class="input-group">
	      	<span class="input-group-addon">Opción</span>
	      	<input type="text" id="opcion" name="opcion" class="form-control" value="<?php echo $opcion;?>"/>
	    </div>
	   	</div>
	  	</div>	  	
	<!-- cierre div utilidades  -->	
	</div>
	</fieldset>	 
	</form>
</html>

<script type='text/javascript'>
	document.getElementById('oculto').style.display = 'none';

	function paginas(valor){
		var opcion=<?php echo $opcion;?>;
		$('#consul').load('buscar_cliente2.php?num='+valor+'&opc='+opcion);
	}
</script>

