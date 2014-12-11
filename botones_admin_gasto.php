 <?php
  include('index.php');
 ?>

 <script>
 
  $( document ).ready(function() {
	 
	$("#registrar-gasto" ).click(function(){
      window.location='registrar_gasto.php';
	});

  $("#registrar-tipo-gasto" ).click(function(){
      window.location='registrar_tipo_gasto.php';
  });

  $("#editar-tipo-gasto" ).click(function(){
      window.location='buscar_tipo_gasto.php?opcion=1';
  });

  $("#eliminar-gasto" ).click(function(){
      window.location='buscar_gasto.php?opcion=1';
  });


  }); 
	 
 </script>
<fieldset>
  
<button type="button" id="registrar-gasto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-usd">   </span> Registrar Gasto</button>

<button type="button" id="eliminar-gasto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-trash">   </span> Eliminar Gasto</button>

<button type="button" id="registrar-tipo-gasto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-usd">   </span> Registrar Tipo de Gasto</button>

<button type="button" id="editar-tipo-gasto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-pencil">   </span> Editar Tipo de Gasto</button>

</fieldset>