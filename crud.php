<?php

	//error_reporting(0);
	
	function guardarEmpresa($nit, $nombre, $direccion, $ciudad){
		require("conexion.php");
		$existe="select nit from empresa where nit='$nit'";
		$resexiste=mysql_query($existe,$conexion);
		$totalexiste=mysql_num_rows($resexiste);
		if($totalexiste==0){
			//Gerenera el id de la empresa
			$id= generarId("empresa");
			//Registra la empresa
			$consulta="insert into empresa values('$id','$nit','$nombre','$direccion','$ciudad')";
			$resul=mysql_query($consulta,$conexion);
			
			if($resul){
				$_SESSION['ciudad']="";
				echo '<script>avisoExitoso(" Empresa registrada satisfactoriamente.");</script>';
			}else{
				echo '<script>avisoError(" ¡Error! No se pudo registrar la empresa");</script>';
				
				$_SESSION['ciudad']="";
				echo"<script>alert('Ocurrió un error y no se pudo registrar la empresa');</script>";					}			
			
		}else{

			$_SESSION['ciudad']="";
			echo '<script>avisoError("¡Error! La empresa ya está registrada")</script>';
		}
	}

	function actualizarEmpresa($nit, $nombre, $direccion, $ciudad){
		require("conexion.php");
		$consulta="update empresa set nombre='$nombre',direccion='$direccion',ciudad='$ciudad' where nit='$nit'";
		$resul=mysql_query($consulta,$conexion);
		if($resul){
			$_SESSION['ciudad']="";
			echo"<script>alert('Se actualizaron los datos de la empresa');</script>";
			echo"<script>window.location='buscar_empresa.php?opcion=1';</script>";
		}else{
			echo '<script>avisoError("¡Error! La empresa ya está registrada")</script>';
		}
	}

	function guardarCliente($codigo,$nombre,$totaldeuda){
		require("conexion.php");
		$id= generarId("cliente");
		$consulta="insert into cliente values('$id','$codigo','$nombre','$totaldeuda')";
		$resul= mysql_query($consulta,$conexion);
		if($resul){
			echo '<script>avisoExitoso("Cliente registrado satisfactoriamente.");</script>';
		}else{
			echo '<script>avisoError(" ¡Error! No se pudo registrar el cliente");</script>';
		}
	}
	
	function actualizarCliente($codigo,$nombre,$totaldeuda){
		require("conexion.php");
		$consulta="update cliente set nombre='$nombre',total_deuda='$totaldeuda' where codigo='$codigo'";
		$resul=mysql_query($consulta,$conexion);
		if($resul){
			echo '<script>avisoExitoso("Datos de cliente actualizados satisfactoriamente.");</script>';
			echo"<script>window.location='buscar_cliente.php?opcion=1';</script>";
		}else{
			echo '<script>avisoError(" ¡Error! No se pudo actualizar el cliente.");</script>';
		}		
	}	

	function guardarGasto($codigo, $observacion, $valor,$fecha, $tipogasto){
		require("conexion.php");
		
		$id= generarId("gasto");
		$result = mysql_query("SELECT codigo FROM tipo_gasto WHERE id=$tipogasto limit 1",$conexion);
	
		$tipoGasto = mysql_fetch_row($result);
		$consulta="INSERT INTO gasto VALUES($id,'$codigo', '$observacion', $valor, '$fecha', '$tipoGasto[0]')";
		
		$resul= mysql_query($consulta,$conexion);
		if($resul){
			echo '<script>avisoExitoso("Se registró el gasto satisfactoriamente.");</script>';
		}else{
			echo '<script>avisoError(" ¡Error! No se pudo registrar el gasto.");</script>';
		}
	}

	function guardarBase($base){
		require("conexion.php");
		$id= generarId("diario");
		$codigo= generarCodigo("CJA-","diario");
		date_default_timezone_set('America/Bogota');
		$fecha=  date('Y-m-d');
		$consulta= "INSERT INTO diario (id, codigo, base, fecha) VALUES ($id, '$codigo','$base', '$fecha')";
		$resul= mysql_query($consulta,$conexion);
		if($resul){
			echo '<script>avisoExitoso("Se abrió la caja.");</script>';
		}else{
			echo '<script>avisoError(" ¡Error! No se pudo abrir la caja.");</script>';
		}
	}

	function eliminarGasto($codigo){
		require("conexion.php");
		$result = mysql_query("SELECT codigo FROM tipo_gasto WHERE id=$tipogasto limit 1", $conexion);
	
		$tipoGasto = mysql_fetch_row($result);
		$consulta="DELETE from gasto where codigo='$codigo'";		
		$resul= mysql_query($consulta,$conexion);
		if($resul){
			echo"<script>alert('Se eliminó el gasto');</script>";
			echo"<script>window.location='buscar_gasto.php?opcion=1';</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se eliminó el gasto');</script>";
		}
	}

	function guardarTipoGasto( $codigoTipoGasto, $nombreTipoGasto){
		require("conexion.php");
		$id= generarId("tipo_gasto");
		$consulta= "INSERT INTO tipo_gasto VALUES ($id, '$codigoTipoGasto', '$nombreTipoGasto')";
		
		$resul= mysql_query($consulta,$conexion);

		if($resul){
			echo"<script>alert('Se registró el tipo gasto');</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se registró el tipo gasto');</script>";
		}		
	}

	function actualizarTipoGasto($codigo, $nombre){
		require("conexion.php");
		$consulta="update tipo_gasto set nombre='$nombre' where codigo='$codigo'";
		$resul=mysql_query($consulta,$conexion);
		if($resul){
			echo"<script>alert('Se actualizó el tipo de gasto');</script>";
			echo"<script>window.location='buscar_tipo_gasto.php?opcion=1';</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se actualizó el tipo de gasto');</script>";
		}		
	}	

	function guardarCredito($codigo,$fecha,$observacion,$total,$cliente){
		require("conexion.php");
		$id= generarId("credito");
		$consulta="insert into credito values('$id','$codigo','$fecha','$observacion','$total','$cliente')";
		$resul= mysql_query($consulta,$conexion);
		if($resul){
			echo"<script>alert('Se registró el crédito');</script>";
			echo"<script>window.location='registrar_cliente.php';</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se registró el crédito');</script>";
		}		
	}

	function guardarAbono($codigo,$fecha,$total,$cliente){
		require("conexion.php");
		$id= generarId("abono");
		$consulta="insert into abono values('$id','$codigo','$fecha','$total','$cliente')";
		$resul=mysql_query($consulta,$conexion);
		if($resul){
			echo"<script>alert('Se registró el abono');</script>";
			echo"<script>window.location='registrar_cliente.php';</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se registró el abono');</script>";
		}			
	}	

	function guardarProducto($codigo,$descripcion,$nit,$vcompra,$vventa){
		require("conexion.php");
		$id= generarId("producto");
		$consulta="insert into producto values('$id','$codigo','$descripcion')";
		$resul=mysql_query($consulta,$conexion);
		if($resul){
			$consulta2="insert into empresa_producto values('$nit','$codigo','$vcompra','$vventa')";
			$resul2=mysql_query($consulta2,$conexion);
			echo"<script>alert('Se registró el producto');</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se pudo registrar el producto');</script>";
		}
	}

	function actualizarProducto($codigo, $descripcion){
		require("conexion.php");
		$consulta="update producto set nombre='$descripcion' where codigo='$codigo'";
		$resul=mysql_query($consulta,$conexion);
		if($resul){
			echo"<script>alert('Se actualizó la descripción del producto');</script>";
			echo"<script>window.location='buscar_producto_3.php?opcion=1';</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se actualizó la descripción del producto');</script>";
		}		
	}

	function actualizarPrecios($nit, $producto, $vcompra, $vventa){
		require("conexion.php");
		$consulta="update empresa_producto set valor_compra='$vcompra',valor_venta='$vventa' where empresa_nit='$nit' and producto_codigo='$producto'";
		$resul=mysql_query($consulta,$conexion);
		if($resul){
			echo"<script>alert('Se actualizaron los precios del producto');</script>";
			echo"<script>window.location='buscar_producto.php?opcion=1';</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se actualizaron los precios del producto');</script>";
		}		
	}

	function guardarEmpresaProducto($nit,$producto,$vcompra,$vventa){
		require("conexion.php");
		$consulta="insert into empresa_producto values('$nit','$producto','$vcompra','$vventa')";
		$resul=mysql_query($consulta,$conexion);
		if($resul){
			echo"<script>alert('Se agregó el proveedor');</script>";
			echo"<script>window.location='buscar_producto_3.php?opcion=2';</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se agregó el proveedor al producto');</script>";
		}			
	}	

	function guardarFactura1($codfac,$vtotal,$empresa,$fecha,$codproducto,$cantidadproducto,$totalproducto){
		require("conexion.php");
		$id= generarId("factura");




		//Inicio de la transaccion
		$consulta="START TRANSACTION";
		mysql_query($consulta,$conexion);

			$consulta="insert into factura values('$id','$codfac','$vtotal','$empresa','$fecha')";
			$resul= mysql_query($consulta,$conexion);

			$consulta="insert into factura_producto values('$codfac','$codproducto','$cantidadproducto','$totalproducto')";
			$resul= mysql_query($consulta,$conexion);

		//Fin de la transaccion	
		$consulta="COMMIT";
		$resul=mysql_query($consulta,$conexion);

		if($resul){
			echo"<script>alert('Se registró la factura y se agregó un producto.');</script>";			
		}else{
			echo"<script>alert('Ocurrió un error y no se registró la factura.');</script>";
		}			
	}
	function guardarFactura2($codfac,$codproducto,$cantidadproducto,$totalproducto){
		require("conexion.php");
		//Inicio de la transaccion
		$consulta="START TRANSACTION";
		mysql_query($consulta,$conexion);

			$consulta="insert into factura_producto values('$codfac','$codproducto','$cantidadproducto','$totalproducto')";
			$resul= mysql_query($consulta,$conexion);

		//Fin de la transaccion	
		$consulta="COMMIT";
		$resul=mysql_query($consulta,$conexion);

		if($resul){
			echo"<script>alert('Se agregó el producto a la factura');</script>";			
		}else{
			echo"<script>alert('Ocurrió un error y no se agregó el producto a la factura');</script>";
		}			
	}

	function eliminarProductoFactura($factura,$producto,$empresa){
		require("conexion.php");

		$consulta="DELETE from factura_producto where factura_codigo='$factura' and producto_codigo='$producto'";		
		$resul= mysql_query($consulta,$conexion);
		if($resul){
			echo"<script>alert('Se eliminó el producto de la factura');</script>";
			echo"<script>window.location='registrar_factura2.php?codfac=".$factura."&empresa=".$empresa."';</script>";
		}else{
			echo"<script>alert('Ocurrió un error y no se eliminó el producto');</script>";
		}
	}

	function generarId($tabla){
		require("conexion.php");
		$id = mysql_result(mysql_query("select max(id) from $tabla", $conexion), 0);
		$idGuardar=$id+1;		
		return $idGuardar;
	}

	function generarCodigo($ref,$tabla){
		$cont = generarId($tabla);
		$conse = str_pad($cont, 6, "0", STR_PAD_LEFT);
		$codigo = $ref.$conse;
		return $codigo;
	}

	function errorAbriendoCaja(){
		echo '<script>aviso("¡Error! La caja ya está abierta");</script>';
	}
?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="js/bootstrap-growl.js"></script>
<script type="text/javascript">
	function avisoExitoso(texto){
		$.growl(texto, {
			animate: {
				enter: 'animated zoomInDown',
				exit: 'animated zoomOutUp'
			},
			type: "growl",
		
		offset: {
			x: 20,
			y: 340
		}
		});
	
	}
	
	function avisoError(texto){
		$.growl(texto, {
			animate: {
				enter: 'animated zoomInDown',
				exit: 'animated zoomOutUp'
			},
			type: "error",
		
		offset: {
			x: 20,
			y: 340
		}
		});
	
	}

</script>
