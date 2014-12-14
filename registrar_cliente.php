<?php
  error_reporting(0);
  include('index.php');
	require("conexion.php");
	require("crud.php");	

	if($_POST['btnsave']=='save'){
		$codigo= $_REQUEST['codigo'];
		$nombre= $_REQUEST['nombre'];
		$total= $_REQUEST['total'];
		
		guardarCliente($codigo,$nombre,$total);	
  }
?>
<html>
<head>	
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="cliente-form" method="post" action="registrar_cliente.php">
<fieldset> 
<div class="page-container">
  <a href="buscar_cliente.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-pencil"></i> Editar Cliente</a>
  <a href="buscar_cliente.php?opcion=2" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Crédito</a>
  <a href="buscar_cliente.php?opcion=3" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Abono</a>
  <h2>Registrar Cliente</h2>
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Código</span>
      <input id="codigo" name="codigo" class="form-control" placeholder="" type="text" value="<?php echo generarCodigo('CLI-','cliente'); ?>" readonly>
    </div>
   </div>
  </div>
<br>	
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Nombre</span>
      <input id="nombre" name="nombre" class="form-control" pattern="[A-Z a-z]{1,100}" maxlength="100" placeholder="Ingrese el nombre del cliente" title="Solo puede ingresar letras" onBlur='this.value=this.value.toUpperCase();' type="text" required>
    </div>
   </div>
  </div>
<br>
 <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Total Crédito</span>
      <input type="text" id="total" name="total" class="form-control" pattern="[0-9]{1,7}" maxlength="10" title="Solo puede ingresar números" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
    </div>
   </div>
  </div>
<br>

	<label class="col-md-11" for=""></label>
  <div class="">    
    <button onclick='' class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" >Guardar Cliente</button>
  </div>
	
<!--Fin div page-container -->      
</div>
	
</fieldset>
</form>
</html>

<script type="text/javascript">
	//document.getElementById("codigo").disabled=true;
	
	function activartext(){
		document.getElementById("codigo").disabled=false;
	}

</script>
