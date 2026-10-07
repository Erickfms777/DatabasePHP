<?php
ob_start();
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(parametrizarpermisos()==0){verificaseguridad();}
else
{	session_start();
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$idusuario=(int)$_POST['idusuario'];	
	$pasaporte=html_base(trim($_POST['pasaporte']));
	$nombre=html_base(trim($_POST['nombre']));
	$correo=html_base(trim($_POST['correo']));
	$idtipousuario=(int)$_POST['idtipousuario'];
	$sql="UPDATE usuarios SET pasaporte='$pasaporte',nombre='$nombre',correo='$correo',idtipousuario=$idtipousuario WHERE idusuario=$idusuario";
	mysqli_query($conn,$sql);
 	header("Location:cat-usuarios.php");
}
ob_end_flush();
?>
