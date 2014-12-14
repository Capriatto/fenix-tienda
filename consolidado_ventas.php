<?php
include_once("consolidado_ventas1.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<body>
		<div class="container" style="margin-left:327px;">
		<?php
		require("razorflow_php/razorflow.php");
		require("conexion.php");
		class SampleDashboard extends StandaloneDashboard {
		 
			public function buildDashboard(){
			
			  
			if(isset($_POST['fecha'])){
				require("conexion.php");
				$fecha= $_REQUEST['fecha'];
	
					$consulta="SELECT ventas , total_dia, inversiones , base , gastos FROM diario WHERE 					fecha='$fecha'";
					$resul= mysql_query($consulta, $conexion);
	

	
					$result = array();
			  
					while ($filas = mysql_fetch_array($resul,  MYSQL_ASSOC))
					{
						$result[] = $filas;			
					}			
	
					}else{
						header("Location: consolidado_ventas1.php");
					}  
				
			
			if(empty($result)){
				$kpi = new KPIComponent ("sales_kpi");
				$kpi->setDimensions (3, 2);
				$kpi->setCaption ("Ventas Del Día");
				$kpi->setValue (0, array(
				"numberPrefix" => "$"
			));
			}else{
				$kpi = new KPIComponent ("sales_kpi");
				$kpi->setDimensions (3, 2);
				$kpi->setCaption ("Ventas Del Día");
				$kpi->setValue ($result[0]['ventas'], array(
				"numberPrefix" => "$"
			));
			}

			$this->addComponent ($kpi);
			 
			
				$kpi1 = new KPIGroupComponent ('kpi');
				$kpi1->setDimensions (10, 2);
				$kpi1->setCaption('Otros Datos');

			if(empty($result)){
				$kpi1->addKPI('beverages', array(
			  	'caption' => 'Total En Caja',
			  	'value' => 0 ,
			  	'numberPrefix' => ' $'
				));
			}else{
				$kpi1->addKPI('beverages', array(
			  	'caption' => 'Total En Caja',
			  	'value' => $result[0]['total_dia'] ,
			  	'numberPrefix' => ' $'
				));
			}
			
			if(empty($result)){	
				$kpi1->addKPI('condiments', array(
				'caption' => 'Inversiones',
				'value' => 0,
				'numberPrefix' => ' $'
			));
			}else{
				$kpi1->addKPI('condiments', array(
				'caption' => 'Inversiones',
				'value' => $result[0]['inversiones'],
				'numberPrefix' => ' $'
				));
		  	}
				
			if(empty($result)){	
				$kpi1->addKPI('confections', array(
			  	'caption' => 'Base',
			  	'value' => 0,
			  	'numberPrefix' => ' $'
			));
			}else{
				$kpi1->addKPI('confections', array(
			  	'caption' => 'Base',
			  	'value' => $result[0]['base'],
			  	'numberPrefix' => ' $'
				));
			}
			
			if(empty($result)){		
				$kpi1->addKPI('daily_products', array(
				  'caption' => 'Gastos',
				  'value' => 0,
				  'numberPrefix' => ' $'
				));
			}else{
				$kpi1->addKPI('daily_products', array(
				  'caption' => 'Gastos',
				  'value' => $result[0]['gastos'],
				  'numberPrefix' => ' $'
				));
			
			}
				
    		$this->addComponent ($kpi1);  
			  
		  }
		}

		$db = new SampleDashboard();
		$db->renderStandalone();
		?>
		<br><br><br>
	</div>
		</body>
	</head>
</html>
<script type="text/javascript">
	$( document ).ready(function() {
		$('#srch-term').attr('value', '<?php echo $_REQUEST['fecha'] ?>');
	});
</script>

