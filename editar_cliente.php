<?php
	error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");
	
	$cod=$_REQUEST['codi'];

	if($_POST['btnsave']=='save'){
		$codigo= $_REQUEST['codigo'];
		$nombre= $_REQUEST['nombre'];
		$total= $_REQUEST['total'];		
		actualizarCliente($codigo,$nombre,$total);
	}else{
		$cliente="select * from cliente where codigo='$cod'";
		$resultado=mysql_query($cliente,$conexion);
		$fila=mysql_fetch_array($resultado);
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="editar-cliente-form" method="post" action="editar_cliente.php">
<fieldset>
<div class="page-container">
  <a href="buscar_cliente.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Buscar Cliente</a>
  <a href="registrar_cliente.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Registrar Cliente</a>
  <h2>Editar Cliente</h2>
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Código</span>
      <input id="codigo" name="codigo" class="form-control" placeholder="" type="text" value="<?php echo $cod; ?>" readonly>
    </div>
   </div>
  </div>
<br>	
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Nombre</span>
      <input id="nombre" name="nombre" class="form-control" placeholder="" type="text" value="<?php echo $fila['nombre']; ?>" maxlength="100" onBlur='this.value=this.value.toUpperCase();' required>
    </div>
   </div>
  </div>
<br>
 <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Total Crédito</span>
      <input type="text" id="total" name="total" class="form-control" pattern="[0-9]{1,7}" value="<?php echo $fila['total_deuda']; ?>" title="Solo puede ingresar números" placeholder="Ingrese el valor en n?meros, sin usar puntos, comas o espacios." required />
    </div>
   </div>
  </div>
<br>
	
	<label class="col-md-11" for=""></label>
	<div class="">    
	<button class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" >Actualizar Cliente</button>
	</div>
	
      
</div>
	
</fieldset>
</form>
</html>

