<?php
include_once("index.php");
include_once("conexion.php");
date_default_timezone_set('America/Bogota');
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="buscar-producto-form" method="post" action="consolidado_ventas.php">
	<fieldset>
	<div id="page-container">
	<div class="alert alert-info alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span 		   class="sr-only">Close</span></button>
  		<strong>Atención!</strong> Algunos datos se mostrarán en 0 porque se calculan al cerrar caja.
		</div>
		
	<a role="button" href="#modalVentas" data-toggle="modal" class="btn btn-config"><i class="glyphicon glyphicon-list-alt"></i> Reporte ventas</a>
	
		
		
		<h2>Consolidado de Ventas</h2>
		
		
		<br>
		<div class="row">
	  		<div class="container">
			<div class="col-md-5">
  
 
    <div class="input-group add-on">
      <span class="input-group-addon">Fecha</span>
      <input type="date" class="form-control" placeholder="Search" name="fecha" id="srch-term" 				  value="<?php date_default_timezone_set('America/Bogota'); echo date('Y-m-d');?>" required>
      <div class="input-group-btn">
        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i> 					Buscar</button>
      </div>
    </div>
 </div>
</div>
	  	</div>
	  	<br>
	
	</div>
	
	</fieldset>	 
	
	</form>
	
	
	<!-- Modal de Balance Diario -->		
<div class="modal fade centro" id="modalVentas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Reporte Diario</h4>
      </div>
      <form class="form-inline" action="reporte_ventas.php?m=" target="_blank">  
		<div class="modal-body" >
        Elija Un Mes Para Generar Su Reporte
		  <div class="row">
	 
		<div class="col-sm-6">
       <br>
		<div class="input-group" > <span class="input-group-addon">Mes del Año</span>
		<select id="mes" class="form-control"  name="m" required>
            <option value="">--Seleccione--</option>
			<option value="01">Enero</option>
			<option value="02">Febrero</option>
			<option value="03">Marzo</option>
			<option value="04">Abril</option>
			<option value="05">Mayo</option>
			<option value="06">Junio</option>
			<option value="07">Julio</option>
			<option value="08">Agosto</option>
			<option value="09">Septiembre</option>
			<option value="10">Octubre</option>
			<option value="11">Noviembre</option>
			<option value="12">Diciembre</option>
          </select>
		</div>
		</div>
		
	</div>
      </div>
		  <div class="modal-footer">
				<button type="submit" class="btn btn-primary pull-right" 											style="margin-right:10px;">Generar Reporte</button>
      	</div>
	</form>
      
		
    </div>
  </div>
</div>

</html>