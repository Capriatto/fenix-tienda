<?php
	//error_reporting(0);
	SESSION_START();
	include('index.php');
	require("conexion.php");
	require("crud.php");
	
	$codfac= $_REQUEST['codfac'];

	$factura="select f.codigo cod,e.nombre emp,f.fecha fecha,f.valor_total total from factura f,empresa e where f.empresa=e.nit and f.codigo='$codfac'";
	$resultadofac=mysql_query($factura,$conexion);
	$result=mysql_fetch_array($resultadofac);

	$empresa=$result['emp'];
	$fecha=$result['fecha'];
	$total=$result['total'];

?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<link rel="stylesheet" href="css/chosen.css"> 
</head>

<form name="detalle-factura-form" method="post" action="detalle_factura.php">
<fieldset>
<div class="page-container">
	<a href="registrar_factura.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Nueva Factura</a>
	<a href="buscar_factura.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-search"></i> Buscar Factura</a>
  	<h2>Detalle de Factura</h2>
  
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Código Factura</span>
      <input id="codfac" name="codfac" class="form-control" type="text" value='<?php echo $codfac;?>' readonly>
    </div>
   </div>
  </div>
<br>	
	<div class="row">
  	<div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Fecha</span>
      <input id="fecha" name="fecha" class="form-control" type="text" value='<?php echo $fecha;?>' readonly> 
    </div>
   	</div>
  	</div>

<br>

	<div class="row">        
        <div class="col-sm-6">
    	<div class="input-group">
      		<span class="input-group-addon">Empresa</span>
      		<input id="nombempre" name="nombempre" class="form-control" type="text" value='<?php echo $empresa;?>' readonly>
        </div>
        </div>
	</div>
<br>
 
<?php
//----------------------------------------productos de la factura------------------------------------------------------------------------
$productosfac="select * from factura_producto where factura_codigo='$codfac'";
$resultadofac=mysql_query($productosfac,$conexion);
$totalregi = mysql_num_rows($resultadofac);

if($totalregi>0){
	echo "<h2>Productos</h2>";
	echo"<div class='row'>";
	echo"<div id='consul' class='col-sm-8'>";				
	echo "<table class='table'>";
	echo "<th class='active'>PRODUCTO</th><th class='active'>VALOR UNIDAD</th><th class='active'>CANTIDAD</th><th class='active'>SUBTOTAL</th>";
	
	//Consulta de la primer pagina de los resultados					
	$productosfac2="select p.nombre pro,ep.valor_compra vc,fp.cantidad cant,fp.total_producto total,f.valor_total totalfac FROM factura f,producto p,factura_producto fp,empresa e,empresa_producto ep where ep.empresa_nit=e.nit and ep.producto_codigo=p.codigo and f.empresa=e.nit and fp.factura_codigo=f.codigo and fp.producto_codigo=p.codigo and fp.factura_codigo='$codfac' order by p.nombre";
	$resultadofac2=mysql_query($productosfac2,$conexion);	
	
	while($fila2=mysql_fetch_array($resultadofac2)){
			echo "<tr class='first-child'>";
			echo "<td>".$fila2['pro']."</td>";
			echo "<td>".$fila2['vc']."</td>";
			echo "<td>".$fila2['cant']."</td>";
			echo "<td>".$fila2['total']."</td>";
									
			echo "</tr>";
	}
			echo "<tr class='active'>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td><b>TOTAL</b></td>";
			echo "<td><b>".$total."</b></td>";
			echo "</tr>";

	echo "</table>";
	echo"</div>";
	//CIERRE DIV ROW
	echo"</div>";
	}else{
		echo"<script>alert('Esta factura no contiene productos');</script>";
	}	
//---------------------------------------------------------------------------------------------------------------------------------
?>
</div><!--cierre page-container-->
	
</fieldset>
</form>
</html>