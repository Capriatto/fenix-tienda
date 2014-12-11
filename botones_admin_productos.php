 <?php
  include('index.php');
 ?>
 <script>
 
  $( document ).ready(function() {

  $("#registrar-producto" ).click(function(){
      window.location='registrar_producto.php';
  });

  $("#editar-producto").click(function(){
      window.location='buscar_producto_3.php?opcion=1';
  });  

  $("#editar-precios").click(function(){
      window.location='buscar_producto.php?opcion=1';
  });

  $("#agregar-proveedor").click(function(){
      window.location='buscar_producto_3.php?opcion=2';
  });

	  
  }); 
	 
 </script>
<fieldset>
  
<button type="button" id="registrar-producto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-tag">   </span> Registrar Producto</button>

<button type="button" id="editar-producto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-pencil">   </span> Editar Producto</button>

<button type="button" id="editar-precios" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-pencil">   </span> Editar Precios</button>

<button type="button" id="agregar-proveedor" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-plus">   </span> Agregar Proveedor</button>

</fieldset>