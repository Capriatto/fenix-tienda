<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">
	<link rel="stylesheet" href="css/font-awesome-animation.min.css">
    <title>SteWapp</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--WebFont-->
	<script src="http://use.edgefonts.net/medula-one:n4:all.js"></script><!--fin webFont-->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="js/bootstrap-growl.js"></script>
	<script type="text/javascript">$( "#abrirCaja" ).prop( "disabled", false );</script>

  </head>


  <body>
    <?php
      require('seguridad.php');      
    ?>
  <form name="index-form" method="post" action="index.php">


    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"><?php echo $_SESSION['userapp'];?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
             <li><a href="#acercade" data-toggle="modal">Acerca De</a></li>
            <li><a onclick='return confirmarsalir();' href="salir.php">Salir</a></li>
          </ul>
        </div>
      </div>
    </div>
	  
	<div class="jumbotron">
  <h1 class="font-title">Bienvenido a SteWapp  <span class="glyphicon glyphicon-shopping-cart faa-horizontal animated"></span></h1><br/>
  <a href="abrir_caja.php" id='admincaja' class="btn btn-primary btn-lg "><span class="glyphicon glyphicon-asterisk"></span> Abrir Caja</a>
  <a href="cerrar_caja.php" id='admincaja' class="btn btn-primary btn-lg "><span class="glyphicon glyphicon-asterisk"></span> Cerrar Caja</a>
  
	</div>
	 

  <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
	  <div class="list-group">
		  <p href="#" class="list-group-item active">Administración</p>
          <a href="botones_admin_empresa.php" id='adminempresa' class="list-group-item">Registrar Empresa</a>
          <a href="botones_admin_productos.php" id='adminempresa' class="list-group-item">Administrar Productos</a>
          <a href="consolidado_ventas1.php" class="list-group-item ">Consolidado Ventas</a>
          <a href="botones_admin_factura.php"  id="adminfactura" class="list-group-item">Registrar Factura</a>
          <a href="botones_admin_gasto.php" class="list-group-item">Registrar Gasto</a>
          <a href="botones_admin_clientes.php" class="list-group-item">Administrar Clientes</a>
          <a href="botones_admin_creditos.php" class="list-group-item">Administrar Créditos</a>

          <a href="reportes.php" class="list-group-item">Reportes</a>
		      <a href="botones_utilidades.php" id="utilidades" class="list-group-item actived">█ Utilidades</a>
	  </div>
  </div>

  <div id="page-container">

	 
  </div>
	  
<!-- Modal -->
<div class="modal fade centro" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Abrir Caja</h4>
      </div>
      <div class="modal-body" >
		¿Realmente desea abrir la caja?
      </div>
		<div class="input-group col-lg-6 " style="margin-left: 15px;">
  <span class="input-group-addon">Base</span>
  <input type="text" name="txtBase" id="txtBase" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Dinero base para abrir caja...">
</div>
	<br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <!--boton abrir caja-->
        <button type="submit" name="btnabrircaja" value="abrircaja" id="abrircaja" class="btn btn-primary">Si, por favor</button>
      </div>

    </div>
  </div>
</div>
	  
	  
<!-- Modal  cerrar caja-->
<div class="modal fade centro" id="modalCerrarCaja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<!--<form method="post" action="cerrar_caja.php">-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title" id="myModalLabel">Cerrar Caja</h4>
      </div>
      <div class="modal-body" >
        Ingrese el total del día para cerrar la caja:
      </div>
		<div class="input-group col-lg-6 " style="margin-left: 15px;">
  <span class="input-group-addon">Total Día</span>
  <input type="text" name="txtTotalDia" id="txtTotalDia" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
</div>
	<br>		
      <div class="modal-footer">
        <button type="submit" name="SumbitCerrarCaja" class="btn btn-primary">Cerrar Caja</button>
      </div>
	  <!--</form>-->
    </div>
  </div>
</div>

<!-- Modal acerca de-->
<div class="modal fade centro" id="acercade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h2 class="modal-title" id="myModalLabel">Desarrollado por:</h2>
      </div>
      <div class="modal-body" >
        <h3>Jhonny Sierra Parra</h3>
        <h3>Juan Sebastian Ocampo Ospina</h3>
      </div>
      <div class="modal-footer">
        <h4>©2014 | SteWapp v 1.0</h4>
      </div>
    </div>
  </div>
</div>

	   </form><!--cierre body general-->  
	</body>
</html>

<?php

//error 1 = caja ya está abierta, no se puede volver a abrir.
//error 2 = No se puede registrar factura, no se ha abierto la caja.
//error 3 = No se puede registrar factura, ya cerró la caja de hoy.

if(isset($_GET['err']) && $_GET['err']==1) {
		echo '<script>$( "#abrirCaja" ).prop( "disabled", true );</script>';
}

if(isset($_GET['err']) && $_GET['err']=='2') {
	 echo "<script>avisoError('¡Error! No se puede registrar factura. Abra la caja primero.');</script>";
}

if(isset($_GET['err']) && $_GET['err']==3) {
	 echo "<script>avisoError('¡Error! No se puede registrar factura. Ya cerró caja hoy.');</script>";
}


?>

<script>
  function confirmarsalir() {
      if(confirm("¿Está seguro que desea salir de la aplicación?")){
        return true;
        }else{
          return false;
        }
  	}
	
  function bloquearbotones(){
    javascript:window.history.forward(1);
    javascript:window.history.back(1); 
  }
</script>
