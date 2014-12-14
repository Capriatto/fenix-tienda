<?php
	//error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");	

  $codigo=$_REQUEST['codi'];
  $nit=$_REQUEST['emp'];

  $emppro="select p.nombre pro,ep.valor_compra vc,ep.valor_venta vv from empresa e,producto p,empresa_producto ep where ep.empresa_nit=e.nit and ep.producto_codigo=p.codigo and (ep.producto_codigo='$codigo' and ep.empresa_nit='$nit')";
  $remppro= mysql_query($emppro, $conexion);
  $result2 = mysql_fetch_array($remppro);

  $descripcion= $result2['pro'];
  $vcompra=$result2['vc'];
  $vventa=$result2['vv'];

	if($_POST['btnsave']=='save'){
		$codigo= $_REQUEST['codigo'];
		$nit= $_REQUEST['empresa'];
    $descripcion=$_REQUEST['descripcion'];
		$vcompra = $_REQUEST['vcompra'];
		$vventa = $_REQUEST['vventa'];
		actualizarPrecios($nit, $codigo, $vcompra, $vventa);
	}else{

	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="editar-precios-form" method="post" action="editar_precios.php">

<fieldset>

<div class="container">
  <a href="buscar_producto.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Buscar Producto</a>
  <a href="registrar_producto.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Producto</a>
  <a href="buscar_producto_3.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Editar Producto</a>
  <a href="buscar_producto_3.php?opcion=2" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Agregar Proveedor de Producto</a>

  <h2>Actualizar Precios de Producto</h2>
  
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Código</span>
      <input id="codigo" name="codigo" class="form-control" placeholder="" type="text" value="<?php echo $codigo;?>" readonly>
    </div>
   </div>
  </div>
<br>	
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Descripción</span>
      <input id="descripcion" name="descripcion" class="form-control" value="<?php echo $descripcion;?>" placeholder="" type="text" value="" onBlur='this.value=this.value.toUpperCase();' title="La descripción no puede estar vacia" readonly>
    </div>
   </div>
  </div>
<br>	
  <div class="row">
    <div class="col-sm-4">
      <div class="input-group">
      <span class="input-group-addon">Proveedor</span>
      <select id="empresa" class="form-control" name="empresa" disabled>
        <option value="">--Empresa--</option>
    		<?php 				
    			$empresa='select * from empresa order by nombre';
    			$resultado= mysql_query($empresa, $conexion);			
    			while($result = mysql_fetch_array($resultado)){
    					if($result['nit']!=$nit){
    						echo "<option value=".$result['nit'].">".$result['nombre']."</option>";
    					}else{
    						echo "<option value=".$result['nit']." selected>".$result['nombre']."</option>";
    					}
    			}
    		?>  
      </select>      
      </div>
    </div>
  </div>
  <br>
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Valor Compra</span>
      <input id="vcompra" name="vcompra" class="form-control" value="<?php echo $vcompra;?>" pattern="[0-9]{1,10}" title="Solo puede ingresar números" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
    </div>
   </div>
  </div>
<br>
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Valor Venta</span>
      <input id="vventa" name="vventa" class="form-control" value="<?php echo $vventa;?>" pattern="[0-9]{1,10}" title="Solo puede ingresar números" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
    </div>
   </div>
  </div>
<br>

  <div class="">    
	<button onclick='' class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" >Actualizar Producto</button>
  </div>	
      
</div>
	
</fieldset>

</form>
</html>

<!--
  <script type="text/javascript">
	document.getElementById("codigo").disabled=true;
  document.getElementById("descripcion").disabled=true;
  document.getElementById("empresa").disabled=true;

	function activartext(){
		document.getElementById("codigo").disabled=false;
    document.getElementById("descripcion").disabled=false;
    document.getElementById("empresa").disabled=false;
	}
</script>
-->