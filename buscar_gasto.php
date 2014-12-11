<?php
	error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");

	date_default_timezone_set('America/Bogota');
	$fechaactual=date("Y-m-d");

	if(!empty($_POST) and $_POST['btnsi']=='SI'){
		$codigo= $_REQUEST['codigo'];
		$valor= $_REQUEST['valor'];
		$fecha= $_REQUEST['fecha'];
		$tipogasto= $_REQUEST['tipogasto'];
		
		guardarGasto($codigo,$valor,$fecha, $tipogasto);		
		echo"<script>window.location='registrar_gasto.php';</script>";
	}

	if(!empty($_POST) and $_POST['btnno']=='NO'){
		$codigoTipoGasto= $_REQUEST['codigoTipoGasto'];
		$nombreTipoGasto= $_REQUEST['nombreTipoGasto'];
		
		guardarTipoGasto($codigoTipoGasto,$nombreTipoGasto);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR GASTO</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>
	<a href="registrar_gasto.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Gasto</a>
	<a href="registrar_tipo_gasto.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Tipo Gasto</a>
	
	<form name="buscar-gasto-form" method="post" action="buscar_gasto.php">
	<fieldset>
	<div id="page-container">
		<h2>Buscar Gasto</h2>
<!--		<div class="row">
	  	<div class="col-md-7">
	    <div class="input-group">
	      	<span class="input-group-addon">Nombre del Gasto</span>
	      	<input type="text" id="nombre" name="nombre" class="form-control" pattern="[A-Z a-z]{1,10}" title="Solo puede ingresar letras" placeholder="Ingrese un nombre de gasto para la busqueda"/>
	    </div>
	   	</div>
	  	<div class="row">
			<button class="btn btn-primary" name="btnfind" value="find" id="find" type="submit">Buscar</button>
	  	</div> 	
	  	</div>
	  	<br> -->
		<?php
			SESSION_START();
			$opcion=$_REQUEST['opcion'];

			//if($_POST['btnfind']=='find'){
				$opcion=$_REQUEST['opcion'];

				//Consulta para mostrar los gastos que hay en la fecha actual. No elimina los otros por las FK
				$gasto="select * from gasto where fecha='$fechaactual' order by fecha DESC";
				$resultado=mysql_query($gasto,$conexion);
				$totalregi = mysql_num_rows($resultado);
				$tamano=10;
				$numpage=ceil($totalregi/$tamano);
				$i=0;
				$j=1; $k=1;
				
				if($totalregi>0){
					//DIV DONDE SE IMPRIMEN LAS PAGINAS
					echo"<div class='row'>";
					echo"<div id='consul' class='col-sm-8'>";				
					echo "<table class='table'>";
					echo "<th class='active'>CÓDIGO</th><th class='active'>TIPO GASTO</th><th class='active'>FECHA</th><th class='active'>TOTAL</th><th class='active'></th>";
					
					//Consulta de la primer pagina de los resultados					
					$gasto2="select g.codigo cod,tg.nombre tipogst,g.valor valor,g.fecha fecha from gasto g,tipo_gasto tg where g.tipo_gasto_codigo=tg.codigo and fecha='$fechaactual' order by fecha DESC limit $tamano";
					$resultado2=mysql_query($gasto2,$conexion);
					
					while($fila2=mysql_fetch_array($resultado2)){
							echo "<tr class='first-child'>";
							echo "<td>".$fila2['cod']."</td>";							
							echo "<td>".$fila2['tipogst']."</td>";
							echo "<td>".$fila2['fecha']."</td>";
							echo "<td>".$fila2['valor']."</td>";
							if($opcion==1){
								echo "<td><a onclick='return eliminar();' href='eliminar_gasto.php?codi=".$fila2['cod']."'>Eliminar Gasto</a></td>";
							}											
							echo "</tr>";
					}
					echo "</table>";
					echo"</div>";
					echo"</div>";
					//CIERRE DIV ROW
					echo"</div>";				
					//DIV NUMEROS DE PAGINA
					echo"<div id='pagi' class='col-sm-8' border='0'>";
					echo "<table class='table-condensed' align='center'>";
					echo "<tr>";	
					while($i<$numpage){
						$num=$i*$tamano;		
						echo "<td><input type='button' class='btn' name='$num' value='$j' onclick='paginas(this.name);' /></td>";
						$i=$i+1;
						$j=$j+1;
					}			
					echo"</tr>";
					echo "</table>";
					echo"</div>";					
				}else{
					echo"<script>alert('No se encontraron resultados');</script>";
					echo"<script>window.location='registrar_gasto.php';</script>";
				}//Fin if totalregi
			//fin btn}
		?>
	  	<div id='editar'>

	  	</div>

		<div id='oculto' class="row">
	  	<div class="col-md-6">
	    <div class="input-group">
	      	<span class="input-group-addon">Opción</span>
	      	<input type="text" id="opcion" name="opcion" class="form-control" value="<?php echo $opcion;?>"/>
	    </div>
	   	</div>
	  	</div>	  	
	<!-- cierre div utilidades  -->	
	</div>
	</fieldset>	 
	</form>
</html>



<script type='text/javascript'>
	document.getElementById('oculto').style.display = 'none';

	function paginas(valor){
		var opcion=<?php echo $opcion;?>;
		$('#consul').load('buscar_gasto2.php?num='+valor+'&opc='+opcion);
	}

	function eliminar() {
    	if(confirm("¿Está seguro que desea eliminar el gasto?")){
    		return true;	
       	}else{
       		return false;
       	}
	}	
</script>

<script language="javascript" type="text/javascript">
<!--

//-->
</script