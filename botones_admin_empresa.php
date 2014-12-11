 <?php
  include('index.php');
 ?>
 
 <script>
 
  $( document ).ready(function() {
    $("#registrar-empresa").click(function(){
		  window.location='registrar_empresa.php';
    });

    $("#editar-empresa").click(function(){
      window.location='buscar_empresa.php?opcion=1';
    });
  
  }); 
	 
 </script>
 
<fieldset>
  
<button type="button" id="registrar-empresa" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-briefcase">   </span> Registrar Empresa</button>

<button type="button" id="editar-empresa" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-pencil">   </span> Editar Empresa</button>

</fieldset>
