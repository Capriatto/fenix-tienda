<?php
	//error_reporting(0);
	SESSION_START();
	include('index.php');
	require("conexion.php");
	require("crud.php");
	
	$nit=$_REQUEST['nit'];

	$empresa="select * from empresa where nit='$nit'";
	$resultado1=mysql_query($empresa,$conexion);
	$fila=mysql_fetch_array($resultado1);
	//Consulta para que quede por defecto seleccionado donde esta guardado en la bd
	$ciudaddefecto=$fila['ciudad'];

	$ciudadcon="select departamento from ciudad where id='$ciudaddefecto'";
	$resultado2=mysql_query($ciudadcon,$conexion);
	$depar=mysql_result($resultado2, 0);	

	$nit= $_REQUEST['nit'];
	$nombre= $fila['nombre'];
	$direccion= $fila['direccion'];
	//$ciudad=$_SESSION['ciudad'];

	if($_POST['btnsave']=='save'){
		$nit= $_REQUEST['nit'];
		$nombre= $_REQUEST['nombre'];
		$direccion= $_REQUEST['direccion'];
		$ciudad=$_SESSION['ciudad'];

		if($_SESSION['ciudad']!=''){
			actualizarEmpresa($nit,$nombre,$direccion,$ciudad);
		}else{
			echo"<script>alert('No se actualizaron los datos. Debe seleccionar una ciudad');</script>";
			$nit= $_REQUEST['nit'];
			$nombre= $_REQUEST['nombre'];
			$direccion= $_REQUEST['direccion'];
			$_SESSION['ciudad']='';
		}
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>

<form name="editar-empresa-form" method="post" action="editar_empresa.php" onsubmit="return validarciudad(this)">
<fieldset>
<div class="container">
	<a href="buscar_empresa.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-briefcase"></i> Buscar Empresa</a>	
  <h2>Editar Empresa</h2>
  
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Nit</span>
      <input id="nit" name="nit" class="form-control" placeholder="" type="text" value='<?php echo $nit;?>' readonly>
    </div>
   </div>
  </div>
<br>	
  <div class="row">
  <div class="col-md-6">
    <div class="input-group">
      <span class="input-group-addon">Nombre</span>
      <input id="nombre" name="nombre" class="form-control" pattern="[A-Z a-z]{1,50}" maxlength="50" placeholder="" title="Solo puede ingresar letras" onBlur='this.value=this.value.toUpperCase();' type="text" value='<?php echo $nombre;?>' required>
    </div>
   </div>
  </div>
<br>
 <div class="row">
  <div class="col-md-6">
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
            <option value=''>--Departamento--</option>
			<?php 				
				$dpto='select * from departamento order by nombre';
				$resultado= mysql_query($dpto, $conexion);
				
				while($result = mysql_fetch_array($resultado)){
					if($result['id']!=$depar){
						echo "<option value=".$result['id'].">".$result['nombre']."</option>";
					}else{
						echo "<option value=".$result['id']." selected>".$result['nombre']."</option>";
					}
				}	
			?>  
          </select>
        </div>
		
		<div id="municipio" class="col-sm-3">
			<script type="text/javascript">
				var dpto=$('#dpto').val();
				var ciud=<?php echo $ciudaddefecto;?>;
				$('#municipio').load('cargarMuni2.php?dpto='+dpto+'&ciud='+ciud);
			</script>
        </div>
		
      </div>
	<br>
	
  <div class="">
	<button class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" onclick=''>Actualizar Empresa</button>
  </div>
  	
 <!--Fin div page-container-->
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
</script>

<script type="text/javascript">
	//document.getElementById("nit").disabled=true;
	
	function activartext(){
		document.getElementById("nit").disabled=false;
	}
	
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