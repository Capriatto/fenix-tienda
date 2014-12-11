<?php
	error_reporting(0);
	include("index.php");
	require("crud.php");

	$factura=$_REQUEST['fact'];
	$producto=$_REQUEST['prod'];
	$empresa=$_REQUEST['emp'];

	eliminarProductoFactura($factura,$producto,$empresa);
?>