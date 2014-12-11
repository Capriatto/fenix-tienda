<?php
	error_reporting(0);
	SESSION_START();

	$_SESSION['ingreso']='';
	$_SESSION['userapp']='';
	header("Location: login.php");
?>
