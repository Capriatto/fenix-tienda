<?php
	error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");

	SESSION_START();
	$nombrecliente=$_REQUEST['cli'];

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
	<a href="buscar_cliente.php?opcion=4" role="button" class="btn btn-config"><i class="glyphicon glyphicon-search"></i> Buscar Cliente</a>
	<form name="lista-creditos-cliente-form" method="post" action="lista_crediabonos_cliente.php">
	<fieldset>
	<div id="page-container">
		<h2>Cliente: <?php echo $nombrecliente?></h2>

		<?php
			$codcliente=$_REQUEST['cod'];
			$opcion=$_REQUEST['opc'];
			$_SESSION['codcli_ca'] = $codcliente;

			if($opcion==1){
				//Listado de creditos---------------------------------------------------------------------------------------------

				$cliente="select * from credito where cliente_cod='$codcliente'";
				$resultado=mysql_query($cliente,$conexion);
				$totalregi = mysql_num_rows($resultado);
				$tamano=10;
				$numpage=ceil($totalregi/$tamano);
				$i=0; $j=1;


				if($totalregi>0){
					echo"<h3>Créditos</h3>";
					echo"<div class='row'>";
					echo"<div id='consul' class='col-sm-9'>";				
					echo "<table class='table'>";
					echo "<th class='active'>CÓD. CRÉDITO</th><th class='active'>FECHA</th><th class='active'>OBSERVACIÓN</th><th class='active'>TOTAL CRÉDITO</th>";

					$creditos="select * from credito where cliente_cod='$codcliente' order by fecha DESC limit $tamano";
					//echo $creditos;
					$resulcred=mysql_query($creditos,$conexion);

					while($fila2=mysql_fetch_array($resulcred)){
						echo "<tr class='first-child'>";
						echo "<td>".$fila2['codigo']."</td>";
						echo "<td>".$fila2['fecha']."</td>";
						echo "<td>".$fila2['observacion']."</td>";
						echo "<td>".$fila2['valor_total']."</td>";											
						echo "</tr>";
					}

					echo "</table>";
					echo"</div>";
					echo"</div>";
					//CIERRE DIV ROW
					echo"</div>";

					echo"<div id='pagi' class='col-sm-9' border='0'>";
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
					echo"<script>alert('No existen créditos registrados para este cliente');</script>";
				}



				//Listado de abonos---------------------------------------------------------------------------------------------------					
				echo "<br><br>";
				$cliente2="select * from abono where cliente_cod='$codcliente'";
				$resultado2=mysql_query($cliente2,$conexion);
				$totalregi = mysql_num_rows($resultado2);
				$tamano=10;
				$numpage=ceil($totalregi/$tamano);
				$i=0; $j=1;				

				if($totalregi>0){
					echo"<h3>Abonos</h3>";
					echo"<div class='row'>";				
					echo"<div id='consul2' class='col-sm-9'>";				
					echo "<table class='table'>";
					echo "<th class='active'>CÓD. ABONO</th><th class='active'>FECHA</th><th class='active'>TOTAL ABONO</th>";

					$abonos="select * from abono where cliente_cod='$codcliente' order by fecha DESC limit $tamano";
					//echo $abonos;
					$resulabn=mysql_query($abonos,$conexion);

					while($fila=mysql_fetch_array($resulabn)){
						echo "<tr class='first-child'>";
						echo "<td>".$fila['codigo']."</td>";
						echo "<td>".$fila['fecha']."</td>";
						echo "<td>".$fila['valor']."</td>";											
						echo "</tr>";
					}

					echo "</table>";
					echo"</div>";
					echo"</div>";
					//CIERRE DIV ROW
					echo"</div>";

					//div paginas abonos
					echo"<div id='pagi2' class='col-sm-9' border='0'>";
					echo "<table class='table-condensed' align='center'>";
					echo "<tr>";	
					while($i<$numpage){
						$num=$i*$tamano;		
						echo "<td><input type='button' class='btn' name='$num' value='$j' onclick='paginas2(this.name);' /></td>";
						$i=$i+1;
						$j=$j+1;
					}			
					echo"</tr>";
					echo "</table>";
					echo"</div>";
				}else{
					echo"<script>alert('No existen abonos registrados para este cliente');</script>";			
				}


			}//cierre if opcion
			
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

	<!-- cierre div page-container  -->	
	</div>
	</fieldset>	 
	</form>
</html>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="js/bootstrap-growl.js"></script>
<script type='text/javascript'>
	document.getElementById('oculto').style.display = 'none';

	function paginas(valor){
		$('#consul').load('lista_crediabonos_cliente2.php?num='+valor);
	}

	function paginas2(valor){
		$('#consul2').load('lista_crediabonos_cliente3.php?num='+valor);
	}
	
</script>