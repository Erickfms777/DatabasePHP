<?php
	ob_start();
	include("conexion.php");
	include("utilerias.php");
	session_start();
	$_SESSION['autentificado']="No";
	$usuario=html_base($_POST['usuario']);
	$pasaporte=html_base($_POST['pasaporte']);// echo $usuario.":".$pasaporte;
	$conn=abre_conexion();
	$sql="SELECT usuarios.*,cat_tipousuarios.usuario_tipo FROM usuarios,cat_tipousuarios WHERE usuarios.usuario='$usuario' AND usuarios.pasaporte='$pasaporte' AND usuarios.idtipousuario=cat_tipousuarios.idtipousuario";// echo $sql;
	$rs = mysqli_query($conn,$sql); 
	$cuantos=mysqli_num_rows($rs);
	if ($cuantos!=0)
	{
		 $fila = mysqli_fetch_object($rs);
		 $_SESSION['autentificado']="SI";
		 $_SESSION['idusuario']=$fila->idusuario;
		  $_SESSION['usuario']=$fila->usuario;
		 $_SESSION['nombre']=base_html($fila->nombre);
		 $_SESSION['nivel']=$fila->idtipousuario;
		 $_SESSION['nivelusuario']=base_html($fila->usuario_tipo);
		 $sql1="SELECT * FROM parametros";
		 $rs1 = mysqli_query($conn,$sql1); 
		 $fila1 = mysqli_fetch_object($rs1);
		 $_SESSION['sistema']=base_html($fila1->sistema);
		 // Asignación de permisos de usuario 
		 switch($_SESSION['nivel'])
		 {
			 case(1): 	// Superusuario (Gerardo Cuesta Sánchez)
						$_SESSION['parametrizarpermisos']=1;
			 			$_SESSION['usuariosmenuprincipal']=1;
			 			$_SESSION['usuarioslistado']=1;
						$_SESSION['usuariosaltas']=1;
						$_SESSION['usuariosconsultas']=1;
						$_SESSION['usuarioscambios']=1;
						$_SESSION['usuariosbajas']=1;
			 			$_SESSION['almaceneslistado']=1;
						$_SESSION['almacenesaltas']=1;
						$_SESSION['almacenesexistencias']=1;
						$_SESSION['almacenesconsultas']=1;
						$_SESSION['almacenescambios']=1;
						$_SESSION['almacenesbajas']=1;	
						$_SESSION['productosimportar']=1;					
			 			$_SESSION['productoslistado']=1;
						$_SESSION['productosaltas']=1;
						$_SESSION['productosconsultas']=1;
						$_SESSION['productoscambios']=1;
						$_SESSION['productosbajas']=1;
			 			$_SESSION['movimientoslistado']=1;
						$_SESSION['movimientosaltas']=1;
						$_SESSION['movimientosconsultas']=1;
						$_SESSION['movimientosconsultasusuario']=1;						
						break;			 
			 
			 case(2): 	// Administradores
						$_SESSION['parametrizarpermisos']=1;
			 			$_SESSION['usuariosmenuprincipal']=1;
			 			$_SESSION['usuarioslistado']=1;
						$_SESSION['usuariosaltas']=1;
						$_SESSION['usuariosconsultas']=1;
						$_SESSION['usuarioscambios']=1;
						$_SESSION['usuariosbajas']=1;
			 			$_SESSION['almaceneslistado']=1;
						$_SESSION['almacenesaltas']=1;
						$_SESSION['almacenesexistencias']=1;
						$_SESSION['almacenesconsultas']=1;
						$_SESSION['almacenescambios']=1;
						$_SESSION['almacenesbajas']=1;	
						$_SESSION['productosimportar']=1;					
			 			$_SESSION['productoslistado']=1;
						$_SESSION['productosaltas']=1;
						$_SESSION['productosconsultas']=1;
						$_SESSION['productoscambios']=1;
						$_SESSION['productosbajas']=1;
			 			$_SESSION['movimientoslistado']=1;
						$_SESSION['movimientosaltas']=1;
						$_SESSION['movimientosconsultas']=1;
						$_SESSION['movimientosconsultasusuario']=1;		
						break;			 
			 case(3): 	//Operativos
						$_SESSION['parametrizarpermisos']=1;
			 			$_SESSION['usuariosmenuprincipal']=0;
			 			$_SESSION['usuarioslistado']=0;
						$_SESSION['usuariosaltas']=0;
						$_SESSION['usuariosconsultas']=0;
						$_SESSION['usuarioscambios']=0;
						$_SESSION['usuariosbajas']=0;
			 			$_SESSION['almaceneslistado']=1;
						$_SESSION['almacenesaltas']=0;
						$_SESSION['almacenesexistencias']=1;
						$_SESSION['almacenesconsultas']=1;
						$_SESSION['almacenescambios']=0;
						$_SESSION['almacenesbajas']=0;	
						$_SESSION['productosimportar']=0;					
			 			$_SESSION['productoslistado']=1;
						$_SESSION['productosaltas']=0;
						$_SESSION['productosconsultas']=1;
						$_SESSION['productoscambios']=0;
						$_SESSION['productosbajas']=0;
			 			$_SESSION['movimientoslistado']=1;
						$_SESSION['movimientosaltas']=1;
						$_SESSION['movimientosconsultas']=1;
						$_SESSION['movimientosconsultasusuario']=0;
						break;
			default:	// Por default ningún otro tipo de usuario tiene permisos
						$_SESSION['parametrizarpermisos']=0;
				 		$_SESSION['usuariosmenuprincipal']=0;
			 			$_SESSION['usuarioslistado']=0;
						$_SESSION['usuariosaltas']=0;
						$_SESSION['usuariosconsultas']=0;
						$_SESSION['usuarioscambios']=0;
						$_SESSION['usuariosbajas']=0;
			 			$_SESSION['almaceneslistado']=0;
						$_SESSION['almacenesaltas']=0;
						$_SESSION['almacenesexistencias']=0;
						$_SESSION['almacenesconsultas']=0;
						$_SESSION['almacenescambios']=0;
						$_SESSION['almacenesbajas']=0;	
						$_SESSION['productosimportar']=0;					
			 			$_SESSION['productoslistado']=0;
						$_SESSION['productosaltas']=0;
						$_SESSION['productosconsultas']=0;
						$_SESSION['productoscambios']=0;
						$_SESSION['productosbajas']=0;
			 			$_SESSION['movimientoslistado']=0;
						$_SESSION['movimientosaltas']=0;
						$_SESSION['movimientosconsultas']=0;
						$_SESSION['movimientosconsultasusuario']=0;
			 			break;
		 }
		 
	 	header("Location:inventariosmonograf.php"); 
		mysqli_free_result($rs);
		mysqli_close($conn);
		die(); 
		ob_end_flush();
	}
	else
	{ 
		$_SESSION['autentificado']="NO";  
		header("Location:index.php?msj=Usuario y/o Password incorrecto(s)");
		mysqli_free_result($rs);
		mysqli_close($conn);
		die();
		ob_end_flush();
	} 
	mysqli_free_result($rs);
	mysqli_close($conn);
	ob_end_flush();
?>
