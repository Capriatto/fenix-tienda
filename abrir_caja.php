<?php
	error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");

	if($_POST['btnsave']=='save'){
		$base=$_REQUEST['txtBase'];
		guardarBase($base);			
	}

?>
<html>
<head>
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="abrir-form" method="post" action="abrir_caja.php">
<fieldset>
<div class="page-container">
  	<h2>Abrir Caja</h2>
  
  <div class="row">
	<div class="input-group col-lg-6 " style="margin-left: 15px;">
  		<span class="input-group-addon">Base</span>
  		<input type="text" name="txtBase" id="txtBase" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Dinero base para abrir caja..." required>
	</div>
 </div>
	<br>
	<label class="col-md-11" for=""></label>
  <div class="">    
	<button onclick='return confirmar();' class="btn btn-primary" name="btnsave" value="save" id="save" type="submit" >Abrir Caja</button>
  </div>

</div><!--cierre page-container-->
	
</fieldset>
</form>

</html>

<script type="text/javascript">
  function confirmar() {
      if(confirm("¿Está seguro que desea cerrar la caja?")){
        return true;
        }else{
          return false;
        }
  	}
</script>