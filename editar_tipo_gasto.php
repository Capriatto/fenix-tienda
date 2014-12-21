<?php
	error_reporting(0);
	include("index.php");
	require("conexion.php");
	require("crud.php");
	
	$codigo=$_REQUEST['codi'];
	$nombre=$_REQUEST['nomb'];

	if(!empty($_POST) and $_POST['btnTipoGasto']=='guardarGasto'){
		$codigoTipoGasto= $_REQUEST['codigoTipoGasto'];
		$nombreTipoGasto= $_REQUEST['nombreTipoGasto'];
		
		actualizarTipoGasto($codigoTipoGasto,$nombreTipoGasto);
	}
?>
<html>
<head>	
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	
</head>

<form name="registrar-tipo-gasto" method="post" action="editar_tipo_gasto.php">
<fieldset>
	
<div class="container">
	<a href="buscar_gasto.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Buscar Tipo Gasto</a>
	<a href="registrar_gasto.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Gasto</a>
	<h2>Editar Tipo de Gasto</h2>

   <div class="row">
	<div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Código</span>
      <input id="codigo" name="codigoTipoGasto" class="form-control" placeholder="" type="text" value="<?php echo $codigo; ?>" readonly>
    </div>
   </div>
	</div>
	<br>
    <div class="row">
    <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Nombre</span>
      <input id="nombre" name="nombreTipoGasto" value="<?php echo $nombre;?>" class="form-control"  pattern="[A-Z a-z ]+" maxlength="30" title='Solo puede ingresar letras' placeholder="" type="text" onBlur='this.value=this.value.toUpperCase();' required>
    </div>
   </div>
	</div>
	<br>
     <div class="">    
	<button class="btn btn-primary" name="btnTipoGasto" value="guardarGasto" id="guardarGasto" type="submit" >Actualizar Tipo Gasto</button>
  </div>
 
 </div><!-- Fin page-container-->
</fieldset>
</form>    
</html>