<?php
	require "conexion.php";
	$conn=abre_conexion();
	session_start();
	$origen=$_POST['idalmacenorigen'];
	$_SESSION['origen']=$origen;
	header ("location:movimientos-alta.php");
?>
