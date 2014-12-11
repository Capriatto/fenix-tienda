<?php
	error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");	

  $codigo=$_REQUEST['codpro'];
  $descripcion=$_REQUEST['nompro'];
  

	if($_POST['btnsave']=='save'){
		$codigo= $_REQUEST['codigo'];
		$descripcion= $_REQUEST['descripcion'];
		actualizarProducto($codigo,$descripcion);
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="editar-producto-form" method="post" action="editar_producto.php">

<fieldset>

<div class="container">
  <a href="registrar_producto.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Producto</a>
  <a href="buscar_producto.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Actualizar Precios Producto</a>
  <a href="buscar_producto_3.php?opcion=2" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Agregar Proveedor de Producto</a>
  <h2>Editar Producto</h2>
  
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
      <input id="descripcion" name="descripcion" class="form-control" value="<?php echo $descripcion;?>" placeholder="" type="text" onBlur='this.value=this.value.toUpperCase();' title="La descripción no puede estar vacia" required>
    </div>
   </div>
  </div>
<br>	

  <div class="">    
	<button onclick='' class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" >Editar Producto</button>
  </div>	
      
</div>
	
</fieldset>

</form>
</html>