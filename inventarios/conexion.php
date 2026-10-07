<?php 
	function abre_conexion(){
//	$conn = mysqli_connect("localhost","octubred_user_monograf","Cataleya2018OD"); 
	$conn = mysqli_connect("localhost","gerardo","lalito888"); 
	if (!$conn){
		exit("Error de Conexión con el Servidor Local...: " . $conn);
	}
//	mysqli_select_db($conn,"octubred_monograf_inventario");
	mysqli_select_db($conn,"monograf_inventario");
	return $conn;
}
?>