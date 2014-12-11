<?php
	//error_reporting(0);
	SESSION_START();
	include('index.php');
	require("conexion.php");
	require("crud.php");
	
	date_default_timezone_set('America/Bogota');
	$fechaactual=date("Y-m-d");

?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8" />
	<title>BUSCAR FACTURA</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<link rel="stylesheet" href="css/chosen.css"> 
</head>

<form name="buscar-factura-form" method="post" action="buscar_factura.php">
<fieldset>
<div class="page-container">
	<a href="registrar_factura.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Nueva Factura</a>
  	<h2>Buscar Factura</h2>
  
	<div class="row">
  	<div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Fecha</span>
      <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Seleccione una fecha" value="<?php echo $fechaactual;?>" max='<?php echo $fechaactual;?>' required>
    </div>
   	</div>
   		<div class="">    
  			<button class="btn btn-primary" name="btnfind" value="find" id="find" type="submit"><i class="glyphicon glyphicon-search"></i> Buscar</button>
  		</div>
  	</div>
<br>
 
<?php

	if($_POST['btnfind']=='find'){
		$fecha= $_REQUEST['fecha'];
		$_SESSION['fechafac'] = $fecha;

		$facturas="select * from factura where fecha='$fecha'";
		$resultadofac=mysql_query($facturas,$conexion);
		$totalregi = mysql_num_rows($resultadofac);
		$tamano=10;
		$numpage=ceil($totalregi/$tamano);
		$i=0;
		$j=1; $k=1;

		if($totalregi>0){
			echo"<div class='row'>";
			echo"<div id='consul' class='col-sm-8'>";				
			echo "<table class='table'>";
			echo "<th class='active'>CÓDIGO FACTURA</th><th class='active'>EMPRESA</th><th class='active'>FECHA</th><th class='active'>TOTAL</th><th class='active'>ACCIÓN</th>";
			
			//Consulta de la primer pagina de los resultados					
			$facturas2="select f.codigo cod,e.nombre emp,f.fecha fecha,f.valor_total total from factura f,empresa e where f.empresa=e.nit and fecha='$fecha' limit $tamano";
			$resultadofac2=mysql_query($facturas2,$conexion);
			
			while($fila2=mysql_fetch_array($resultadofac2)){
					echo "<tr class='first-child'>";
					echo "<td>".$fila2['cod']."</td>";
					echo "<td>".$fila2['emp']."</td>";
					echo "<td>".$fila2['fecha']."</td>";
					echo "<td>".$fila2['total']."</td>";
					echo "<td><a href='detalle_factura.php?codfac=".$fila2['cod']."'>Ver Factura</a></td>";										
					echo "</tr>";
			}
					echo "</table>";
					echo"</div>";
					//Fin div row
					echo"</div>";				
					//DIV NUMEROS DE PAGINA
					echo"<div id='pagi' class='col-sm-8' border='1'>";
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
		}

	}
?>
</div><!--cierre page-container-->
	
</fieldset>
</form>
</html>

<script type="text/javascript">
	
	function paginas(valor){
		$('#consul').load('buscar_factura2.php?num='+valor);
	}
			
</script>