<?php
	require "conexion.php";
	$conn=abre_conexion();
	session_start();
	$idmovimientotipo=$_POST['idmovimientotipo'];
	$sqlNuevoTipo="SELECT * FROM cat_movimientos WHERE idmovimientotipo=$idmovimientotipo";
	$rsNuevoTipo= mysqli_query($conn,$sqlNuevoTipo);
	$filaNuevoTipo = mysqli_fetch_object($rsNuevoTipo);
	$origen=$filaNuevoTipo->origen;
	$destino=$filaNuevoTipo->destino;
	$_SESSION['idmovimientotipo']=$idmovimientotipo;
	$_SESSION['origen']=$origen;
	$_SESSION['destino']=$destino;
	$_SESSION['referencia']=$_POST['referencia'];
	$_SESSION['descripcion']=$_POST['descripcion'];
	$_SESSION['fecha']=$_POST['fecha'];
	header ("location:movimientos-alta.php");
?>
