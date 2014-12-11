<?php
	error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");	

	if($_POST['btnsave']=='save'){
		$codigo= $_REQUEST['codigo'];
		$descripcion= $_REQUEST['descripcion'];
		$nit= $_REQUEST['empresa'];
		$vcompra = $_REQUEST['vcompra'];
		$vventa = $_REQUEST['vventa'];
		guardarProducto($codigo,$descripcion,$nit,$vcompra,$vventa);
	}else{

	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="producto-form" method="post" action="registrar_producto.php">
<fieldset>
<div class="nav">
  <a href="buscar_producto_3.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-pencil"></i> Editar Producto</a>
  <a href="buscar_producto.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-refresh"></i> Actualizar Precios Producto</a>
  <a href="buscar_producto_3.php?opcion=2" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Agregar Proveedor de Producto</a>
  <h2>Registrar Producto</h2>
  
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Código</span>
      <input id="codigo" name="codigo" class="form-control" placeholder="" type="text" value="<?php echo generarCodigo('PRO-','producto'); ?>" readonly>
    </div>
   </div>
  </div>
<br>	
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Descripción</span>
      <input id="descripcion" name="descripcion" class="form-control" placeholder="" type="text" value="" onBlur='this.value=this.value.toUpperCase();' title="La descripción no puede estar vacia" required>
    </div>
   </div>
  </div>
<br>	
  <div class="row">
    <div class="col-sm-5">
      <div class="input-group">
        <span class="input-group-addon">Proveedor</span>
        <select id="empresa" class="form-control" name="empresa" required>
          <option value="">--Proveedor--</option>
        		<?php 				
        			$empresa='select * from empresa order by nombre';
        			$resultado= mysql_query($empresa, $conexion);			
        			while($result = mysql_fetch_array($resultado)){
        						echo "<option value=".$result['nit'].">".$result['nombre']."</option>";
        			}
        		?>  
        </select>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Valor Compra</span>
      <input id="vcompra" name="vcompra" class="form-control" pattern="[0-9]{1,10}" title="Solo puede ingresar números" placeholder="Ingrese el valor en números, sin usar puntos, comas o espacios." required>
    </div>
   </div>
  </div>
<br>
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Valor Venta</span>
      <input id="vventa" name="vventa" class="form-control" pattern="[0-9]{1,10}" title="Solo puede ingresar números" placeholder="Ingrese el valor en números, sin usar puntos, comas o espacios." required>
    </div>
   </div>
  </div>
<br>

  <div class="">    
	<button onclick='' class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" >Guardar Producto</button>
  </div>	
      
</div>
	
</fieldset>

</form>
</html>

<!--
  <script type="text/javascript">
	document.getElementById("codigo").disabled=true;
	
	function activartext(){
		document.getElementById("codigo").disabled=false;
	}
</script>
-->