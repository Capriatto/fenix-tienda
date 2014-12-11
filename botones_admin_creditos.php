 <?php
  include('index.php');
 ?>
 <script>
 
  $( document ).ready(function() {
 
    $("#editar-cliente").click(function(){
      window.location='buscar_cliente.php?opcion=1';
    });    

    $("#registrar-credito" ).click(function(){
      window.location='buscar_cliente.php?opcion=2';
	});
		
    $("#registrar-abono" ).click(function(){
      window.location='buscar_cliente.php?opcion=3';
	});
  
	  
  }); 
	 
 </script>
<fieldset>

<button type="button" id="registrar-credito" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-usd">   </span> Registrar Crédito</button>

<button type="button" id="registrar-abono" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-usd">   </span> Registrar Abono</button>

</fieldset>