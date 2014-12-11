<?php
	//error_reporting(0);
	SESSION_START();
	
	$codproducto=$_REQUEST['codpro'];
	$_SESSION['codproducto']=$codproducto;
	//echo $_SESSION['codproducto'];
?>