<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(parametrizarpermisos()==0){verificaseguridad();}
else
{	session_start();
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$usuario=html_base(trim($_POST['usuario']));
	$pasaporte=html_base(trim($_POST['pasaporte']));
	$nombre=html_base(trim($_POST['nombre']));
	$correo=html_base(trim($_POST['correo']));
	$idtipousuario=(int)$_POST['idtipousuario'];
	$sql="INSERT INTO usuarios (usuario,pasaporte,nombre,correo,idtipousuario) 
	      VALUES ('$usuario','$pasaporte','$nombre','$correo',$idtipousuario)";
	mysqli_query($conn,$sql);
 	header("Location:cat-usuarios.php");
}
?>
