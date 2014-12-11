<?php
	error_reporting(0);
	include("index.php");
	require("conexion.php");
	require("crud.php");
	

	if(!empty($_POST) and $_POST['btnTipoGasto']=='guardarGasto'){
		$codigoTipoGasto= $_REQUEST['codigoTipoGasto'];
		$nombreTipoGasto= $_REQUEST['nombreTipoGasto'];
		
		guardarTipoGasto($codigoTipoGasto,$nombreTipoGasto);
	}
?>
<html>
<head>	
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	
</head>

<form name="registrar-tipo-gasto" method="post" action="registrar_tipo_gasto.php">
<fieldset>	
<div class="page-container">
	<a href="registrar_gasto.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Gasto</a>
	<a href="buscar_tipo_gasto.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-pencil"></i> Editar Tipo Gasto</a>
	<h2>Registrar Tipo de Gasto</h2>

   <div class="row">
	<div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Código</span>
      <input id="codigo" name="codigoTipoGasto" class="form-control" placeholder="" type="text" value="<?php echo generarCodigo('TST-','tipo_gasto'); ?>" readonly>
    </div>
   </div>
	</div>
	<br>
    <div class="row">
    <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Nombre</span>
      <input id="nombre" name="nombreTipoGasto" class="form-control" pattern="[A-Z a-z]{1,30}" maxlength="30" title='Solo puede ingresar letras' placeholder="" type="text" onBlur='this.value=this.value.toUpperCase();' required>
    </div>
   </div>
	</div>
	<br>
     <div class="">    
	<button class="btn btn-primary" name="btnTipoGasto" value="guardarGasto" id="guardarGasto" type="submit" >Guardar Tipo Gasto</button>
  </div>
 
 </div><!-- Fin page-container-->
</fieldset>
</form>    
</html>