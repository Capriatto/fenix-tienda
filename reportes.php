<?php
include("index.php");

?>

<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		<fieldset>
		<div class="page-container">
		<h2 style="text-align:center;">GRÁFICA Y REPORTES</h2>
		<br>
		<?php
		
		require("razorflow_php/razorflow.php");
		require("conexion.php");
		
		
		class SampleDashboard extends StandaloneDashboard {
		  
			
		  public function buildDashboard(){
			
			require("conexion.php");
			$sinDatos= false;  
			 
			$con= mysql_query("
			SELECT IFNULL(t1.totalMes,0) AS bedrag 
			from
			(
			select
			SUM(ifnull(vn.ventas,0)) as totalMes,
			cast(DATE_FORMAT(fecha, '%M') as char) as mdate
			FROM diario vn 
			WHERE vn.fecha BETWEEN '2014-01-01' AND '2014-12-31' 
			GROUP BY DATE_FORMAT(fecha, '%M')
			) t1 RIGHT OUTER JOIN all_months am on t1.mdate = am.a_month
			group by am.a_month
			order by a_month_id asc;", $conexion) or $sinDatos=true;
				
			$chart = new ChartComponent('chart');
			$chart->setCaption("Ventas Por Mes");
			$chart->setDimensions (8, 6);
			$chart->setLabels (array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", 				"Sep", "Oct", "Nov", "Dic"));
		

			/*echo"<a href='reporte_creditos.php' class='btn btn-config' target='blank'><i 							class='glyphicon glyphicon-list-alt'></i> Creditos</a>";


	  	 	echo"<a href='reporte_gastos.php' role='button' class='btn btn-config' target='blank'><i 					class='glyphicon glyphicon-list-alt'></i> Gastos Este Mes</a>";
		

			echo"<a href='reporte_diario.php' role='button' class='btn btn-config' target='blank'><i 					class='glyphicon glyphicon-list-alt'></i> Reporte Diario</a>"; */ 
			
			echo '<button type="button" href="#modalCredito" class="btn btn-config" data-toggle="modal"><i 				class="glyphicon glyphicon-list-alt"></i> Reporte 						Creditos</button>';
			  
			echo '   
			<button type="button" href="#modalGastos" class="btn btn-config" data-toggle="modal"><i 					class="glyphicon glyphicon-list-alt"></i> Reporte Gastos</button>
	  	 	';
			echo '   
			<button type="button" href="#modalDiario" class="btn btn-config" data-toggle="modal"><i 					class="glyphicon glyphicon-list-alt"></i>  Reporte 								Diario</button>
	  	 	';

			$r_idarray = array();
			  
			if ($sinDatos==false){
				while ($rcontain = mysql_fetch_array($con))
				{
					$r_idarray[] = $rcontain['bedrag'];
				}
				$chart->addSeries ("sales_2014", "Año Actual", array($r_idarray[0], $r_idarray[1], 				   $r_idarray[2], $r_idarray[3], $r_idarray[4], $r_idarray[5], $r_idarray[6], 						$r_idarray[7],  $r_idarray[8],  $r_idarray[9],  $r_idarray[10],  								$r_idarray[11]),array(
					"seriesDisplayType"=> "area"
				));
				
				$chart->setYAxis('Valores en Miles(K) de Pesos', array("numberPrefix"=> '$', 					"numberHumanize"=> true));
				$this->addComponent ($chart);
				
			}else{
				
			
				$chart->addSeries ("sales_2014", "Año Actual", 													array(0,0,0,0,0,0,0,0,0,0,0,0,),array(
					"seriesDisplayType"=> "area"
				));
				
				$chart->setYAxis('Valores en Miles(K) de Pesos', array("numberPrefix"=> '$', 					"numberHumanize"=> true));
				$this->addComponent ($chart);
				
			}
			 
			
		  }
		}

		$db = new SampleDashboard();
		$db->renderStandalone();

		//pie
		

		?>

		</div><!--fin page container-->
	</fieldset>

		<!-- Modal de Creditos -->
<div class="modal fade centro" id="modalCredito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Reporte de Créditos</h4>
      </div>
      <form class="form-inline" action="reporte_creditos.php?m=" target="_blank">  
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
<!-- Modal de Gastos -->		
<div class="modal fade centro" id="modalGastos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Reporte de Gastos</h4>
      </div>
      <form class="form-inline" action="reporte_gastos.php?m=" target="_blank">  
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
<!-- Modal de Balance Diario -->		
<div class="modal fade centro" id="modalDiario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Reporte Diario</h4>
      </div>
      <form class="form-inline" action="reporte_diario.php?m=" target="_blank">  
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



	</body>
	
</html>
