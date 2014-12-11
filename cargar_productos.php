<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
</head>
<form name="productos-form" method="post" action="cargar_productos.php">
<?php

	error_reporting(0);	
	SESSION_START();
	require_once('conexion.php');
	
	$empresa=$_REQUEST['emp'];
	
	echo"<div class='input-group'>";
	echo"<span class='input-group-addon'>Producto</span>";
	echo"<select class='form-control' name='productos' id='prod' required>";
		$productos="select ep.producto_codigo cod,p.nombre pro,e.nombre emp,ep.valor_compra vc,ep.valor_venta vv from empresa e,producto p,empresa_producto ep where ep.empresa_nit=e.nit and ep.producto_codigo=p.codigo and ep.empresa_nit='$empresa' order by p.nombre";
		$resultado=mysql_query($productos,$conexion);
		echo"<option value=''>--Productos--</option>";
		while($resul=mysql_fetch_array($resultado))
		{
			echo"<option value=".$resul['cod'].">".$resul['pro']."</option>";
		}						  
	echo "</select>";
	echo "</div>";
?>
<!--Load codigo producto seleccionado-->
<div id='codpro'></div>

<br>
<!--Load precio producto-->
<div id='preciouni'>

</div>
<!--Load total producto-->
<div id='total'>

</div>

</form>
</html>

<script type='text/javascript'>
	$(document).ready(function(){
		$('#prod').change(function(){
			var prod=$('#prod').val();
			var emp=<?php echo $empresa;?>;
			if(prod==''){
				alert('Debe seleccionar un producto');
				$('#preciouni').load('subtotal_producto.php?codpro=&emp=');
			}else{				
				//$('#codpro').load('codigo_producto.php?codpro='+prod);
				$('#preciouni').load('subtotal_producto.php?codpro='+prod+'&emp='+emp);
			}

		});    
	});

	function totalprod(){
		var valoruni=document.getElementById("valoruni").value;
		var cant=document.getElementById("cantidad").value;
		var totalpro=+valoruni*cant;
		//alert('total ' +totalpro);
		document.getElementById("totalpro").value=+totalpro;
		$('#total').load('total_producto.php?totalpro='+totalpro+'&cantpro='+cant);
	}
	
</script>