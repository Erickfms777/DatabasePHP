<?php
//	include("seguridad.php");
	function parametrizarpermisos(){return($_SESSION['parametrizarpermisos']);}	
	function usuariosmenuprincipal(){return($_SESSION['usuariosmenuprincipal']);}
	function usuarioslistado(){return($_SESSION['usuarioslistado']);}
	function usuariosaltas(){return($_SESSION['usuariosaltas']);}
	function usuariosconsultas(){return($_SESSION['usuariosconsultas']);}
	function usuarioscambios(){return($_SESSION['usuarioscambios']);}
	function usuariosbajas(){return($_SESSION['usuariosbajas']);}
	
	function almaceneslistado(){return($_SESSION['almaceneslistado']);}
	function almacenesexistencias(){return($_SESSION['almacenesexistencias']);}
	function almacenesaltas(){return($_SESSION['almacenesaltas']);}
	function almacenesconsultas(){return($_SESSION['almacenesconsultas']);}
	function almacenescambios(){return($_SESSION['almacenescambios']);}
	function almacenesbajas(){return($_SESSION['almacenesbajas']);}

	function productosimportar(){return($_SESSION['productosimportar']);}
	function productoslistado(){return($_SESSION['productoslistado']);}
	function productosaltas(){return($_SESSION['productosaltas']);}
	function productosconsultas(){return($_SESSION['productosconsultas']);}
	function productoscambios(){return($_SESSION['productoscambios']);}
	function productosbajas(){return($_SESSION['productosbajas']);}
	
	function movimientoslistado(){return($_SESSION['movimientoslistado']);}
	function movimientosaltas(){return($_SESSION['movimientosaltas']);}
	function movimientosconsultas(){return($_SESSION['movimientosconsultas']);}
	function movimientosconsultasusuario(){return($_SESSION['movimientosconsultasusuario']);}

?>
