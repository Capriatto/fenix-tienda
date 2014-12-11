<?php
	error_reporting(0);
	SESSION_START();
	require("conexion.php");
	
	$codproducto=$_REQUEST['codpro'];
	$empresa=$_REQUEST['emp'];

	$producto="select ep.valor_compra vc from empresa e,producto p,empresa_producto ep where ep.empresa_nit=e.nit and ep.producto_codigo=p.codigo and ep.producto_codigo='$codproducto' and ep.empresa_nit='$empresa'";
	$resultado=mysql_query($producto,$conexion);
	$precio=mysql_result($resultado, 0);

	$_SESSION['totalpro']=$precio;
	$_SESSION['codproducto']=$codproducto;

  if($codproducto=='' && $empresa==''){
    $_SESSION['cantpro']='';
    $cantidad='';

  }else{
    $cantidad=1;
    $_SESSION['cantpro']=1;
  }
	//echo $_SESSION['codproducto'].'-'.$_SESSION['cantpro'].'-'.$_SESSION['totalpro'];

	//$_SESSION['subproducto']=$precio;
	//echo $_SESSION['subproducto'];
?>


<div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Precio Unidad</span>
      <input id="valoruni" name="valoruni" class="form-control" pattern="[0-9]{1,20}" maxlength="20" placeholder="" title="Solo puede ingresar números" type="text" value='<?php echo $precio;?>' readonly>
    </div>
   </div>
 </div>
<br>
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Cantidad</span>
      <input onkeyup='totalprod();' onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="cantidad" name="cantidad" class="form-control" pattern="[0-9]{1,3}" maxlength="3" placeholder="" title="Solo puede ingresar números" type="text" value='<?php echo $cantidad;?>' required>
    </div>
   </div>
  </div>
<br>
  <div class="row">
  <div class="col-md-7">
    <div class="input-group">
      <span class="input-group-addon">Total Producto</span>
      <input id="totalpro" name="totalpro" class="form-control" pattern="[0-9]{1,20}" maxlength="20" placeholder="" title="Solo puede ingresar números" type="text" value='<?php echo $_SESSION['totalpro'];?>' readonly required>
    </div>
   </div>
  </div>
<br> 