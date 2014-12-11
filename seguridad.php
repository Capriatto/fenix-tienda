<?php
error_reporting(0);
SESSION_START();

$usu=$_SESSION['ingreso'];
echo $usu;

if($usu != "YES"){ 
    header("Location: login.php");
  } 
?>
