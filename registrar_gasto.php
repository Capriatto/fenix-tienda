<?php
	error_reporting(0);
	include("index.php");
	require("conexion.php");
	require("crud.php");
	
	date_default_timezone_set('America/Bogota');
	$fechaactual=date("Y-m-d");

	if(!empty($_POST) and $_POST['btnsave']=='save'){
		$codigo= $_REQUEST['codigo'];
		$observacion= $_REQUEST['observacion'];
		$valor= $_REQUEST['valor'];
		$fecha= $_REQUEST['fecha'];
		$tipogasto= $_REQUEST['tipogasto'];
		
		guardarGasto($codigo, $observacion, $valor,$fecha, $tipogasto);		
		echo"<script>window.location='registrar_gasto.php';</script>";
	}

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

<form name="cliente-form" method="post" action="registrar_gasto.php">
<fieldset>
<div class="page-container">
	<a href="registrar_tipo_gasto.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Nuevo Tipo Gasto</a>
	<a href="buscar_tipo_gasto.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-pencil"></i> Editar Tipo Gasto</a>
	<a href="buscar_gasto.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-trash"></i> Eliminar Gasto</a>
	<h2>Registrar Gasto</h2>
  
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Código</span>
      <input id="codigo" name="codigo" class="form-control" placeholder="" type="text" value="<?php echo generarCodigo('GST-','gasto'); ?>" require readonly>
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
        <form class="form-inline">  
		<div class="input-group"> <span class="input-group-addon">Tipo Gasto</span>
		<select id="dpto" class="form-control" name="tipogasto" title='Debe seleccionar un tipo de gasto' required>
            <option value="">--Tipo de Gasto--</option>
			<?php 				
				$dpto='select * from tipo_gasto order by nombre';
				$resultado= mysql_query($dpto, $conexion);
				
				while($result = mysql_fetch_array($resultado)){
					echo "<option value=".$result['id'].">".$result['nombre']."</option>";
				}	
			?>  
          </select>
		</div>
		</form>
    </div>
	</div>
<br>
	 <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Observación</span>
      <input id="observacion" name="observacion" class="form-control" placeholder="" type="text" 			require onblur="this.value = this.value.toUpperCase();" >
    </div>
   </div>
  </div>
<br>
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Valor</span>
      <input id="valor" name="valor" min="1" max="9999999" class="form-control" placeholder="valor del gasto sin puntos ni comas..." type="number" required>
    </div>
   </div>
  </div>
<br>
	
	<label class="col-md-11" for=""></label>
  <div class="">    
	<button onclick='' class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" >Guardar Gasto</button>
  </div>
	
      
</div>
	
</fieldset>
</form>
	
<!--Aqui empieza el modal de TIPO GASTO-->	

	
	
	
</html>