<?php
	ob_start();
	include("seguridad.php");
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$abreviatura=trim(html_base($_POST["abreviatura"]));
	$almacen=trim(html_base($_POST["almacen"]));
	$ubicacion=trim(html_base($_POST["ubicacion"]));
	$descripcion=trim(html_base($_POST["descripcion"]));
	if($almacen==""){}
	else
	{
			$sql="INSERT INTO cat_almacenes (abreviatura,almacen,ubicacion,descripcion) VALUES ('$abreviatura','$almacen','$ubicacion','$descripcion')"; //echo $sql;
			mysqli_query($conn,$sql);

		
	}
	//}
	mysqli_close($conn);
	header("Location:cat-almacenes.php");
	ob_end_flush();
?>