<?php
	error_reporting(0);
	SESSION_START();
	include('index.php');
	require("conexion.php");
	require("crud.php");
	

	if($_POST['btnsave']=='save'){
		$nit= $_REQUEST['nit'];
		$nombre= $_REQUEST['nombre'];
		$direccion= $_REQUEST['direccion'];
		$ciudad=$_SESSION['ciudad'];
		
		if($_SESSION['ciudad']!=''){
			guardarEmpresa($nit,$nombre,$direccion,$ciudad);
			$nit= "";
			$nombre= "";
			$direccion= "";
			$ciudad= "";
		}else{
			echo"<script>avisoError('Debe seleccionar una ciudad');</script>";
			
			//echo"<script>alert('Debe seleccionar una ciudad');</script>";
		}		
		
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="empresa-form" method="post" action="registrar_empresa.php" onsubmit="return validarciudad(this)">
<fieldset>
<div class="page-container">
	<a href="buscar_empresa.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-pencil"></i> Editar Empresa</a>
  	<h2>Registrar Empresa</h2>
  
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Nit</span>
      <input id="nit" name="nit" class="form-control" pattern="[0-9]{1,20}" maxlength="20" placeholder="" title="Solo puede ingresar números" type="text" value='<?php echo $nit;?>' required>
    </div>
   </div>
  </div>
<br>	
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Nombre</span>
      <input id="nombre" name="nombre" class="form-control" pattern="[A-Z a-z]{1,50}" maxlength="50" placeholder="" title="Solo puede ingresar letras" onBlur='this.value=this.value.toUpperCase();' type="text" value='<?php echo $nombre;?>' required>
    </div>
   </div>
  </div>
<br>
 <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Dirección</span>
      <input id="direccion" name="direccion" class="form-control" pattern="[A-Z a-z 0-9 # -]{1,50}" title='Solo puede ingresar letras,números o los caracteres numeral(#) y guion(-)' maxlength="50" placeholder="" onBlur='this.value=this.value.toUpperCase();' type="text" value='<?php echo $direccion;?>' required>
    </div>
   </div>
  </div>
<br>
	<div class="row">        
        <div class="col-sm-3">
          <select id="dpto" class="form-control" name="dpto" required>
            <option value="">--Departamento--</option>
			<?php 				
				$dpto='select * from departamento order by nombre';
				mysql_query("SET NAMES utf8");
				$resultado= mysql_query($dpto, $conexion);				
				
				while($result = mysql_fetch_array($resultado)){
					echo "<option value=".$result['id'].">".$result['nombre']."</option>";
				}	
			?>  
          </select>
        </div>
		
		<div id="municipio" class="col-sm-4">
          <select class="form-control" name="ciudad" id="ciud" required>
            <option value="">--Municipio--</option>
          </select>
        </div>
		
      </div>
	<br>
	<label class="col-md-11" for=""></label>
  <div class="">    
	<button class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" >Guardar Empresa</button>
  </div>

</div>
	
</fieldset>
</form>

</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#dpto').change(function(){
			var dpto=$('#dpto').val();		
			$('#municipio').load('cargarMuni.php?dpto='+dpto);
		});		
	});

	function validarciudad(){
		var ciud=$('#ciud').val();

		if (ciud==''){
			alert('Debe seleccionar una ciudad');
			return false;
		}else{
			return true;
		}
	}	
</script>