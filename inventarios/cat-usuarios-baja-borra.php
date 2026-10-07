<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(parametrizarpermisos()==0){verificaseguridad();}
else
{	session_start();
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$idusuario=(int)$_POST['idusuario'];	
	$sql="DELETE FROM usuarios WHERE idusuario=$idusuario";
	mysqli_query($conn,$sql);
 	header("Location:cat-usuarios.php");
}
?>
