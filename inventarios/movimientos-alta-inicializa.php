<?php
	require "conexion.php";
	$conn=abre_conexion();
	session_start();
	$idusuario=(int)$_SESSION['idusuario'];
	$_SESSION['idmovimientotipo']=1;
	$_SESSION['origen']=0;
	$_SESSION['destino']=1;
	$_SESSION['referencia']="";
	$_SESSION['descripcion']="";
	$fecha = date("Y-m-d");
	$_SESSION['fecha']=$fecha;
	$_SESSION['mensaje']="";
	$_SESSION['validacion']="";
	$_SESSION['cantidad']="";
	$_SESSION['codigo']="";
	header ("location:movimientos-alta.php");
?>