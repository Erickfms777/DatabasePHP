<?php
	require "conexion.php";
	$conn=abre_conexion();
	session_start();
	$idproducto=(int)$_GET["item"];
	$sql="SELECT cat_productos.* FROM cat_productos WHERE cat_productos.idproducto=$idproducto";
	$rs = mysqli_query($conn,$sql);
	$fila = mysqli_fetch_object($rs);
	$idusuario=(int)$_SESSION['idusuario'];
	$_SESSION['idproducto']=$idproducto;
	$_SESSION['validacion']="";
    $_SESSION['codigocorto']=$fila->codigocorto;;
    $_SESSION['barcode']=$fila->barcode;
    $_SESSION['producto']=$fila->producto;
	$_SESSION['mensaje']="";
	header ("location:cat-productos-modificar.php");
?>