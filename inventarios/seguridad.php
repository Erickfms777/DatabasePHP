<?php
	ob_start();
	session_start();
	// compruebo que tengo la variable de sesion creada y con el dato correcto 
	if ($_SESSION['autentificado']!='SI'){header("Location:terminar.php"); exit();ob_end_flush();}
	ob_end_flush();
	function verificaseguridad()
	{
		header("Location:terminar.php");
		exit();
		ob_end_flush();
	}
?>