<?php
	error_reporting(0);
	include("index.php");
	require("crud.php");

	$codigo=$_REQUEST['codi'];
	eliminarGasto($codigo);
?>