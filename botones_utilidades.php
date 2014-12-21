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
 
    $("#registrar-cliente").click(function(){
      window.location='registrar_cliente.php';
    });

    $("#editar-cliente").click(function(){
      window.location='buscar_cliente.php?opcion=1';
    });

    $("#ver-clientes").click(function(){
      window.location='buscar_cliente.php?opcion=0';
    });
        

    $("#registrar-credito" ).click(function(){
      window.location='buscar_cliente.php?opcion=2';
	});
		
    $("#registrar-abono" ).click(function(){
      window.location='buscar_cliente.php?opcion=3';
	});

  $("#ver-creditos-abonos" ).click(function(){
      window.location='buscar_cliente.php?opcion=4';
  });  

	 
	$("#registrar-gasto" ).click(function(){
      window.location='registrar_gasto.php';
	});
  
  $("#registrar-tipo-gasto" ).click(function(){
      window.location='registrar_tipo_gasto.php';
  });
  
  $("#eliminar-gasto" ).click(function(){
      window.location='buscar_gasto.php?opcion=1';
  });

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

  $("#listado-productos").click(function(){
      window.location='buscar_producto.php?opcion=0';
  });  

	$("#registrar-factura").click(function(){
        window.location='registrar_factura.php';
  });

  $("#buscar-factura").click(function(){
        window.location='buscar_factura.php';
  });


  }); 
	 
 </script>
<fieldset>
  
<button type="button" id="registrar-empresa" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-briefcase">   </span> Registrar Empresa</button>

<button type="button" id="editar-empresa" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-pencil">   </span> Editar Empresa</button>

<button type="button" id="registrar-producto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-tag">   </span> Registrar Producto</button>

<button type="button" id="editar-producto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-pencil">   </span> Editar Producto</button>

<button type="button" id="editar-precios" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-tag">   </span> Editar Precios</button>

<button type="button" id="agregar-proveedor" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-plus">   </span> Agregar Proveedor</button>

<button type="button" id="listado-productos" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-list-alt">   </span> Listado Productos</button>

<button type="button" id="registrar-factura" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-briefcase">   </span> Registrar Factura</button>

<button type="button" id="buscar-factura" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-search">   </span> Buscar Factura</button>

<button type="button" id="registrar-gasto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-usd">   </span> Registrar Gasto</button>

<button type="button" id="eliminar-gasto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-trash">   </span> Eliminar Gasto</button>

<button type="button" id="registrar-tipo-gasto" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-usd">   </span> Registrar Tipo de Gasto</button>

<button type="button" id="registrar-cliente" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-user">   </span> Registrar Cliente</button>

<button type="button" id="editar-cliente" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-pencil">   </span> Editar Cliente</button>

<button type="button" id="ver-clientes" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-search">   </span> Consultar Cliente</button>

<button type="button" id="registrar-credito" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-usd">   </span> Registrar Crédito</button>

<button type="button" id="registrar-abono" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-thumbs-up">   </span> Registrar Abono</button>

<button type="button" id="ver-creditos-abonos" href="#" class="btn-metro btn-primary  " data-toggle="modal"><span class="glyphicon glyphicon-search">   </span> Ver Créditos y Abonos</button>

</fieldset>

<div id="contenedor-utilidades">

</div>