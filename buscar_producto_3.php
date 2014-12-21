<?php
	//error_reporting(0);
	include('index.php');
	require("conexion.php");
	require("crud.php");
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>BUSCAR PRODUCTO</title>
	<meta http-equiv="Content-Type" charset="UTF-8" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
</head>

	<form name="buscar-producto-form" method="post" action="buscar_producto_3.php">
	<fieldset>
	<div id="page-container">
		<a href="registrar_producto.php" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Registrar Producto</a>
		<a href="buscar_producto_3.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-pencil"></i> Editar Producto</a>
		<a href="buscar_producto.php?opcion=1" role="button" class="btn btn-config"><i class="glyphicon glyphicon-refresh"></i> Actualizar Precios Producto</a>
  		<a href="buscar_producto_3.php?opcion=2" role="button" class="btn btn-config"><i class="glyphicon glyphicon-plus"></i> Agregar Proveedor de Producto</a>		

		<h2>Buscar Producto</h2>
		<div class="row">
	  	<div class="col-md-7">
	    <div class="input-group">
	      	<span class="input-group-addon">Nombre del Producto</span>
	      	<input type="text" id="nombre" name="nombre" class="form-control"  pattern="[A-Z a-z ]+" title="Solo puede ingresar letras" placeholder="Ingrese un nombre de producto para la busqueda" onBlur='this.value=this.value.toUpperCase();'>
	    </div>
	   	</div>
	  	<div class="">    
			<button class="btn btn-primary" name="btnfind" value="find" id="find" type="submit"><i class="glyphicon glyphicon-search"></i> Buscar</button>
	  	</div> 	
	  	</div>
      <br>  	

		<?php
			SESSION_START();			
			$opcion=$_REQUEST['opcion'];

			if($_POST['btnfind']=='find'){
				$nombre= $_REQUEST['nombre'];
				$_SESSION['nombpro'] = $nombre;

				$producto="select * from producto where nombre like'%$nombre%' order by nombre";
				$resultado=mysql_query($producto,$conexion);
				$totalregi = mysql_num_rows($resultado);
				$tamano=10;
				$numpage=ceil($totalregi/$tamano);
				$i=0;
				$j=1; $k=1;
				
				if($totalregi>0){
					//DIV DONDE SE IMPRIMEN LAS PAGINAS
					echo"<div class='row'>";
					echo"<div id='consul' class='col-md-8'>";
					echo "<table class='table' border='0'>";
					echo "<th class='active'>CÓDIGO</th><th class='active'>PRODUCTO</th><th class='active'></th>";
					
					$producto2="select * from producto where nombre like'%$nombre%' order by nombre limit $tamano";
					$resultado2=mysql_query($producto2,$conexion);
					while($fila2=mysql_fetch_array($resultado2)){
							echo "<tr>";
							echo "<td>".$fila2['codigo']."</td>";
							echo "<td>".$fila2['nombre']."</td>";
							if($opcion==1){
								echo "<td><a href='editar_producto.php?codpro=".$fila2['codigo']."&nompro=".$fila2['nombre']."'>Editar Producto</a></td>";
							}
							else if($opcion==2){
								echo "<td><a href='agregar_proveedor.php?codpro=".$fila2['codigo']."&nompro=".$fila2['nombre']."'>Agregar Proveedor</a></td>";
							}													
							echo "</tr>";
					}
					echo "</table>";
					echo"</div>";
					//CIERRE DIV ROW
					echo"</div>";
					//DIV NUMEROS DE PAGINA
					echo"<div id='pagi' class='col-md-8' border='0'>";
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
				}

			}
		?>

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

	$(document).ready(function() {
	    $("#find").click(function(){
	    	$('#condefault').empty();
    	});
	});
	    
	function paginas(valor){
		var opcion=<?php echo $opcion;?>;
		$('#consul').load('buscar_producto_4.php?num='+valor+'&opc='+opcion);
	}	
</script>