<?php
	//error_reporting(0);
	SESSION_START();
	
	$totalproducto=$_REQUEST['totalpro'];
	$cantidadproducto=$_REQUEST['cantpro'];

	$_SESSION['totalpro']=$totalproducto;
	$_SESSION['cantpro']=$cantidadproducto;
	//echo $_SESSION['totalpro'];
	//echo"<br>";
	//echo $_SESSION['cantpro'];
?>