<?php 
error_reporting(1);
include( 'index.php');
require( "conexion.php");
require( "crud.php");

if($_POST[ 'btnsave']=='save' )
{
	$totaldia=$_REQUEST[ 'txtTotalDia'];
 	CerrarCaja($totaldia); 
} 
?>

<html>

<head>
	<meta http-equiv="Content-Type" charset="utf-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

<form name="cerrar-form" method="post" action="cerrar_caja.php">
	<fieldset>
		<div class="page-container">
			<h2>Cerrar Caja</h2>

			<div class="row">
				<div class="input-group col-lg-6 " style="margin-left: 15px;">
					<span class="input-group-addon">Total Día</span>
					<input type="text" placeholder="Dinero en caja actualmente..." name="txtTotalDia" id="txtTotalDia" class="form-control" 									onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
				</div>
			</div>
			<br>
			<label class="col-md-11" for=""></label>
			<div class="">
				<button onclick='return confirmar();' class="btn btn-primary" name="btnsave" value="save" id="save" type="submit">Cerrar Caja</button>
			</div>

		</div>
		<!--cierre page-container-->

	</fieldset>
</form>

</html>


<script type="text/javascript">
	function confirmar() {
		if (confirm("¿Está seguro que desea cerrar la caja?")) {
			return true;
		} else {
			return false;
		}
	}
</script>


