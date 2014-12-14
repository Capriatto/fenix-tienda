<?php
  error_reporting(0);
  include('index.php');
	require("conexion.php");
	require("crud.php");
	
  date_default_timezone_set('America/Bogota');
  $fechaactual=date("Y-m-d");

  if($_POST['btnsave']=='save'){
    $codigo= $_REQUEST['codigo'];
    $fecha= $_REQUEST['fecha'];
    $total= $_REQUEST['total'];
    $cliente = $_REQUEST['codcliente'];        

    guardarAbono($codigo,$fecha,$total,$cliente);
  }else{
    $cod= $_REQUEST['cli'];
    $consulcliente="select * from cliente where codigo='$cod'";
    $resultado=mysql_query($consulcliente,$conexion);
    $fila=mysql_fetch_array($resultado);
  }
?>
<html>
<head>	
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="abono-form" method="post" action="registrar_abono.php">
<fieldset>
<div class="page-container">
  <a href="buscar_cliente.php?opcion=3" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Buscar Cliente</a>
  <a href="registrar_cliente.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Registrar Cliente</a>
  <h2>Registrar Abono</h2> 
    
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Código</span>
      <input id="codigo" name="codigo" class="form-control" placeholder="" type="text" value="<?php echo generarCodigo('ABN-','abono'); ?>" readonly>
    </div>
   </div>
  </div>
<br>
  <div id='oculto' class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Código Cliente</span>
      <input id="codcliente" name="codcliente" class="form-control" placeholder="" type="text" value="<?php echo $cod;?>">
    </div>
   </div>
  </div>
  
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Cliente</span>
      <input id="cliente" name="cliente" class="form-control" placeholder="" type="text" value="<?php echo $fila['nombre'];?>" readonly>
    </div>
   </div>
  </div>
<br>
  <div class="row">
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">Fecha</span>
      <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo $fechaactual;?>" max='<?php echo $fechaactual;?>' required>
    </div>
   </div>
  </div>
<br>
 <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Total Abono</span>
      <input type="text" id="total" name="total" class="form-control" pattern="[0-9]{1,7}" title="Solo puede ingresar números" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
    </div>
   </div>
  </div>
<br>

	<label class="col-md-11" for=""></label>
  <div class="">    
	<button onclick='' class="btn btn-primary" name="btnsave" value="save" id="save" type="submit">Guardar Abono</button>
  </div>
	    

</div>	
</fieldset>
</form>
</html>

<script type="text/javascript">
  //document.getElementById("codigo").disabled=true;
  //document.getElementById("cliente").disabled=true;
  document.getElementById('oculto').style.display = 'none';
  
  function activartext(){
    document.getElementById("codigo").disabled=false;
    document.getElementById("cliente").disabled=false;
  }
</script>