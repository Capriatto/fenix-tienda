<?php
	//error_reporting(0);
	SESSION_START();
	include('index.php');
	require("conexion.php");
	require("crud.php");
	
	date_default_timezone_set('America/Bogota');
	$fechaactual=date("Y-m-d");

	$diario="select * from diario where fecha='$fechaactual'";
	$resultado= mysql_query($diario,$conexion);
	$result=mysql_fetch_array($resultado);

    $base=$result['base'];

    if($base==''){
    	header("Location: index.php");
    }


	if($_POST['btnsave']=='save'){
		//Datos de la tabla factura
		$codfac= $_REQUEST['codfac'];
		$fecha= $_REQUEST['fecha'];
		$empresa=$_REQUEST['empresa'];
		$vtotal=0;


		//Datos de factura_producto
		$codproducto=$_SESSION['codproducto'];		
		$cantidadproducto=$_SESSION['cantpro'];
		$totalproducto=$_SESSION['totalpro'];
		//echo $codproducto.'-'.$cantidadproducto.'-'.$totalproducto;		
		
		if($codproducto!='' && $cantidadproducto!='' && $cantidadproducto!='0' && $totalproducto!=''){
			guardarFactura1($codfac,$vtotal,$empresa,$fecha,$codproducto,$cantidadproducto,$totalproducto);
			$codfac= "";
			$fecha= "";
			$empresa= "";
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

	if($_POST['btnadd']=='add'){
		$codfac= $_REQUEST['codfac'];
		$fecha= $_REQUEST['fecha'];
		$empresa=$_REQUEST['empresa'];		
		$vtotal=0;


		//Datos de factura_producto
		$codproducto=$_SESSION['codproducto'];		
		$cantidadproducto=$_SESSION['cantpro'];
		$totalproducto=$_SESSION['totalpro'];
		//echo $codproducto.'-'.$cantidadproducto.'-'.$totalproducto;
		
		if($codproducto!='' && $cantidadproducto!='' && $cantidadproducto!='0' && $totalproducto!=''){
			guardarFactura1($codfac,$vtotal,$empresa,$fecha,$codproducto,$cantidadproducto,$totalproducto);
			echo"<script>window.location='registrar_factura2.php?codfac=".$codfac."&empresa=".$empresa."';</script>";
			$codfac= "";
			$fecha= "";
			$empresa= "";
			$codproducto="";
			$_SESSION['codproducto']="";
			$cantidadproducto="";
			$_SESSION['cantpro']="";
			$totalproducto="";
			$_SESSION['totalpro']="";

		}else{
			echo"<script>alert('Faltan Datos. Debe completar todos los campos de este formulario.');</script>";
		}
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<link rel="stylesheet" href="css/chosen.css"> 
</head>

<form name="empresa-form" method="post" action="registrar_factura.php" onsubmit="return validarcanti(this)">
<fieldset>
<div class="page-container">
	<a href="buscar_factura.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Buscar Factura</a>
	<!--<a href="buscar_empresa.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-pencil"></i> Editar Empresa</a>-->
  	<h2>Registrar Factura</h2>
  
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Código Factura</span>
      <input id="codfac" name="codfac" class="form-control" type="text" value='<?php echo generarCodigo("FAC-","factura");?>' readonly>
    </div>
   </div>
  </div>
<br>	
	<div class="row">
  	<div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Fecha</span>
      <input type="date" id="fecha" name="fecha" class="form-control" placeholder="Seleccione una fecha" value="<?php echo $fechaactual;?>" max='<?php echo $fechaactual;?>' required>
    </div>
   	</div>
  	</div>

<br>

	<div class="row">        
        <div class="col-sm-6">
    	<div class="input-group">
      		<span class="input-group-addon">Empresa</span>        	
          <select id="empresa" class="form-control" name="empresa" required>
            <option value="">--Empresa--</option>
			<?php 				
				$empresa='select * from empresa order by nombre';
				$resultado= mysql_query($empresa, $conexion);
				
				while($result = mysql_fetch_array($resultado)){
					echo "<option value=".$result['nit'].">".$result['nombre']."</option>";
				}	
			?>  
          </select>
        </div>
        </div>
	</div>
	<br>
	<div class="row">        
    <div class="col-sm-6">
		<div id="productos">
			<div class="input-group">
	      	<span class="input-group-addon">Producto</span>			
		      <select class="form-control" name="productos" id="prod" required>
		        <option value="">--Productos--</option>
		      </select>
		    </div>
		</div>
	</div>
	</div>
	<br>
	<label class="col-md-11" for=""></label>
  <div class="">    
  	<button onclick='return confirmar();' class="btn btn-primary" title='Use este boton para agregar el último producto a la factura.' name="btnsave" value="save" id="save" type="submit" >Agregar Producto y Finalizar Factura</button>
	<button class="btn btn-primary" title='Use este boton para agregar más productos a la factura.' name="btnadd" value="add" id="add" type="submit" >Guardar y Agregar Otro Producto</button>
  </div>

</div><!--cierre page-container-->
	
</fieldset>
</form>

</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#empresa').change(function(){
			var emp=$('#empresa').val();
			$('#productos').load('cargar_productos.php?emp='+emp);
		});		
	});

	function validarcanti(){
		var produ=$('#prod').val();
		var valoruni=document.getElementById("valoruni").value;
		var canti=document.getElementById("cantidad").value;
		var totalpro=document.getElementById("totalpro").value;

		if (canti=='' || canti=='0' || valoruni=='' || totalpro=='' || produ==''){
			alert('Faltan Datos. Debe completar todos los campos de este formulario.');
			return false;
		}else{
			return true;
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