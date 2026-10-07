<?php
	require "conexion.php";
	$conn=abre_conexion();
	session_start();
	$idusuario=(int)$_SESSION['idusuario'];
    $_SESSION['validacion']="";
    $_SESSION['codigocorto']="";
    $_SESSION['barcode']="";
    $_SESSION['producto']="";
	$_SESSION['mensaje']="";
	header ("location:cat-productos-alta.php");
?>