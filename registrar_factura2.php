<?php
	//error_reporting(0);
	SESSION_START();
	include('index.php');
	require("conexion.php");
	require("crud.php");
	
	date_default_timezone_set('America/Bogota');
	$fechaactual=date("Y-m-d");
	
	$codfac= $_REQUEST['codfac'];
	$empre= $_REQUEST['empresa'];

	$conempresa="select nombre from empresa where nit='$empre'";
	$resultado2= mysql_query($conempresa, $conexion);
	$empresa=mysql_result($resultado2, 0);

	if($_POST['btnsave']=='save'){
		$codfac= $_REQUEST['codfac'];
		$empre=$_REQUEST['empresa'];
		//Datos de factura_producto
		$codproducto=$_SESSION['codproducto'];		
		$cantidadproducto=$_SESSION['cantpro'];
		$totalproducto=$_SESSION['totalpro'];
		//echo $codproducto.'-'.$cantidadproducto.'-'.$totalproducto;		
		
		if($codproducto!='' && $cantidadproducto!='' && $cantidadproducto!='0' && $totalproducto!=''){
			guardarFactura2($codfac,$codproducto,$cantidadproducto,$totalproducto);
			$codproducto="";
			$_SESSION['codproducto']="";
			$cantidadproducto="";
			$_SESSION['cantpro']="";
			$totalproducto="";
			$_SESSION['totalpro']="";
			echo"<script>window.location='registrar_factura.php';</script>";
		}else{
			echo"<script>alert('Faltan Datos. Debe completar todos los campos de este formulario');</script>";
		}
	}

	if($_POST['btnadd']=='add'){
		$codfac= $_REQUEST['codfac'];
		$empre=$_REQUEST['empresa'];
		//Datos de factura_producto
		$codproducto=$_SESSION['codproducto'];		
		$cantidadproducto=$_SESSION['cantpro'];
		$totalproducto=$_SESSION['totalpro'];
		//echo $codproducto.'-'.$cantidadproducto.'-'.$totalproducto;		
		
		if($codproducto!='' && $cantidadproducto!='' && $cantidadproducto!='0' && $totalproducto!=''){
			guardarFactura2($codfac,$codproducto,$cantidadproducto,$totalproducto);
			$codproducto="";
			$_SESSION['codproducto']="";
			$cantidadproducto="";
			$_SESSION['cantpro']="";
			$totalproducto="";
			$_SESSION['totalpro']="";
		}else{
			echo"<script>alert('Faltan Datos. Debe completar todos los campos de este formulario');</script>";
		}				
	}else{
		
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<link rel="stylesheet" href="css/chosen.css"> 
</head>

<form name="factura2-form" method="post" action="registrar_factura2.php" onsubmit="return validarcanti(this)">
<fieldset>
<div class="page-container">
	<a href="registrar_factura.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Nueva Factura</a>
  	<h2>Agregar Producto a Factura</h2>
  
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
      <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Seleccione una fecha" value="<?php echo $fechaactual;?>" max='<?php echo $fechaactual;?>' readonly>
    </div>
   	</div>
  	</div>

<br>
	<div id='oculto' class="row">        
        <div class="col-sm-6">
    	<div class="input-group">
      		<span class="input-group-addon">Empresa</span>
      		<input id="empresa" name="empresa" class="form-control" type="text" value='<?php echo $empre;?>' readonly>
        </div>
        </div>
	</div>

	<div class="row">        
        <div class="col-sm-6">
    	<div class="input-group">
      		<span class="input-group-addon">Empresa</span>
      		<input id="nombempre" name="nombempre" class="form-control" type="text" value='<?php echo $empresa;?>' readonly>
        </div>
        </div>
	</div>
	<br>	
	<div class="row">        
    <div class="col-sm-6">
		<div id="productos">
	    	<div class="input-group">
	      		<span class="input-group-addon">Productos</span>
		          <select id="prod" class="form-control" name="productos" required>
		            <option value="">--Productos--</option>
					<?php 				
						$productos="select ep.producto_codigo cod,p.nombre pro,e.nombre emp,ep.valor_compra vc,ep.valor_venta vv from empresa e,producto p,empresa_producto ep where ep.empresa_nit=e.nit and ep.producto_codigo=p.codigo and ep.empresa_nit='$empre' order by p.nombre";
						$resultado= mysql_query($productos, $conexion);
						
						while($result = mysql_fetch_array($resultado)){
							echo "<option value=".$result['cod'].">".$result['pro']."</option>";
						}	
					?>  
		          </select>

	        </div>			
		</div>
	</div>
	</div>
	<br>
<div id='codpro'></div>

	<!--Load precio producto-->
	<div class="row">  
	<div class="col-sm-6">
		<div id='preciouni'>
		   
		</div>
	</div>
	</div>
	<!--Load total del producto-->
	<div class="row">  
	<div class="col-sm-6">
		<div id='total'>

		</div>
	</div>
	</div>	

	<label class="col-md-11" for=""></label>
  <div class="">    
  	<button onclick='return confirmar();' class="btn btn-primary" name="btnsave" title='Use este boton para agregar el último producto a la factura.' value="save" id="save" type="submit" >Agregar Producto y Finalizar Factura</button>
	<button class="btn btn-primary" name="btnadd" title='Use este boton para agregar más productos a la factura.' value="add" id="add" type="submit" >Guardar y Agregar Otro Producto</button>
  </div>
  <br>
 
<?php
//----------------------------------------productos de la factura------------------------------------------------------------------------
echo"<form id='lista-productos-form' name='lista-productos-form' method='post' action=''>";
$productosfac="select * from factura_producto where factura_codigo='$codfac'";
$resultadofac=mysql_query($productosfac,$conexion);
$totalregi = mysql_num_rows($resultadofac);

if($totalregi>0){
	echo "<h2>Productos de esta Factura</h2>";
	echo"<div class='row'>";
	echo"<div id='consul' class='col-sm-8'>";				
	echo "<table class='table'>";
	echo "<th class='active'>CÓDIGO FACTURA</th><th class='active'>PRODUCTO</th><th class='active'>CANTIDAD</th><th class='active'>TOTAL</th><th class='active'>ACCIÓN</th>";
	
	//Consulta de la primer pagina de los resultados					
	$productosfac2="select fp.producto_codigo cod,p.nombre pro,fp.cantidad cant,fp.total_producto total,f.valor_total totalfac from factura f,producto p,factura_producto fp where fp.factura_codigo=f.codigo and fp.producto_codigo=p.codigo and fp.factura_codigo='$codfac' order by p.nombre";
	$resultadofac2=mysql_query($productosfac2,$conexion);	
	
	while($fila2=mysql_fetch_array($resultadofac2)){
			echo "<tr class='first-child'>";
			echo "<td>".$codfac."</td>";

			echo "<td>".$fila2['pro']."</td>";
			echo "<td>".$fila2['cant']."</td>";
			echo "<td>".$fila2['total']."</td>";
			echo "<td><a onclick='return eliminar();' href='eliminar_producto_factura.php?fact=".$codfac."&prod=".$fila2['cod']."&emp=".$empre."'>Eliminar</a></td>";									
			echo "</tr>";
	}
			$resultadofac=mysql_query($productosfac2,$conexion);
			$fila[]=mysql_fetch_array($resultadofac);
			echo "<tr class='active'>";
			echo "<td></td>";
			echo "<td></td>";
			echo "<td><b>TOTAL</b></td>";
			echo "<td><b>".$fila[0]['totalfac']."</b></td>";
			echo "<td></td>";
			echo "</tr>";

	echo "</table>";
	echo"</div>";
	//CIERRE DIV ROW
	echo"</div>";
	}	
//---------------------------------------------------------------------------------------------------------------------------------
  echo"</form>";
?>
</div><!--cierre page-container-->
	
</fieldset>
</form>
</html>

<script type="text/javascript">
	
	document.getElementById('oculto').style.display = 'none';

	$(document).ready(function(){
		$('#prod').change(function(){
			var prod=$('#prod').val();
			var emp=<?php echo $empre;?>;
			if(prod==''){
				alert('Debe seleccionar un producto');
				$('#preciouni').load('subtotal_producto.php?codpro=&emp=');
				//$('#codpro').load('codigo_producto.php?codpro='+prod);
			}else{				
				//$('#codpro').load('codigo_producto.php?codpro='+prod);
				$('#preciouni').load('subtotal_producto.php?codpro='+prod+'&emp='+emp);
			}

		});    
	});

	function validarcanti(){
		var valoruni=document.getElementById("valoruni").value;
		var canti=document.getElementById("cantidad").value;
		var totalpro=document.getElementById("totalpro").value;

		if (canti=='' || canti=='0' || valoruni=='' || totalpro==''){
			alert('Faltan Datos. Debe completar todos los campos de este formulario');
			return false;
		}else{
			return true;
		}
	}
	
	function totalprod(){
		var valoruni=document.getElementById("valoruni").value;
		var cant=document.getElementById("cantidad").value;
		var totalpro=+valoruni*cant;
		//alert('total ' +totalpro);
		document.getElementById("totalpro").value=+totalpro;
		$('#total').load('total_producto.php?totalpro='+totalpro+'&cantpro='+cant);
	}

	function eliminar() {
    	if(confirm("¿Está seguro que desea eliminar el producto de la factura?")){
    		return true;
       	}else{
       		return false;
       	}
	}

	function confirmar() {
    	if(confirm("¿Está seguro que desea finalizar el registro de la factura y no agregar más productos?")){
    		return true;
       	}else{
       		return false;
       	}
	}			
</script>