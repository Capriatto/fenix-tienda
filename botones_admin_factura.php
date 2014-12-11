 <?php
  include('index.php');
 ?>

 <script>

  $( document ).ready(function() {
    $("#registrar-factura").click(function(){
      	window.location='registrar_factura.php';
    });

    $("#buscar-factura").click(function(){
      	window.location='buscar_factura.php';
    });

  }); 
   
 </script>

<fieldset>
  
<button type="button" id="registrar-factura" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-briefcase">   </span> Registrar Factura</button>

<button type="button" id="buscar-factura" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-search">   </span> Buscar Factura</button>

</fieldset>