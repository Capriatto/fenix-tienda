 <?php
  include('index.php');
 ?>
 <script>
	$(document).ready(function () {

		$("#registrar-cliente").click(function () {
			window.location = 'registrar_cliente.php';
		});
		$("#editar-cliente").click(function () {
			window.location = 'buscar_cliente.php?opcion=1';
		});


	});
</script>
<fieldset>
	<button type="button" id="registrar-cliente" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-user">   </span> Registrar Cliente</button>

	<button type="button" id="editar-cliente" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-pencil">   </span> Editar Cliente</button>

</fieldset>

<div id="contenedor-utilidades">

</div>