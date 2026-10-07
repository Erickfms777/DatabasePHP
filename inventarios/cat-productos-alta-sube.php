<?php
	ob_start();
	include("seguridad.php");
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$codigocorto=trim(html_base($_POST["codigocorto"]));
	$barcode=trim(html_base($_POST["barcode"]));
	$producto=trim(($_POST["producto"]));
    $_SESSION['codigocorto']=$codigocorto;
    $_SESSION['barcode']=$barcode;
    $_SESSION['producto']=$producto;
	$existencias=0;
 	// validación original, si no tiene nombre de producto o nombre corto, no genera ninguna entrada
	if(($producto=="")or($codigocorto=="")){mysqli_query($conn,$sql); mysqli_close($conn); header("Location:cat-productos.php");}
	else
	{	// Valida si existe el codigo corto
		$sqlValida="SELECT * FROM cat_productos WHERE codigocorto='$codigocorto'";
		$rsValida=mysqli_query($conn,$sqlValida);
		$TotalRegistros=mysqli_num_rows($rsValida);//echo $sqlValida.":".$TotalRegistros;
		if(($TotalRegistros!=0)and($codigocorto!=""))
		{
			$filaValida = mysqli_fetch_object($rsValida);
			$producto=$filaValida->producto;
			$validacion="Ya existe un producto dado de alta, con la siguiente información:<br>";
			$validacion.="Código Corto: ".$filaValida->codigocorto."<br>";
			$validacion.="Código de barras: ".$filaValida->barcode."<br>";
			$validacion.="Descripción: ".base_html($filaValida->producto);
			$_SESSION['validacion']=$validacion;
			header("Location:cat-productos-alta.php");
		}
		else
		{	// Valida si existe el codigo de barras
			$sqlValida="SELECT * FROM cat_productos WHERE barcode='$barcode'";
			$rsValida=mysqli_query($conn,$sqlValida);
			$TotalRegistros=mysqli_num_rows($rsValida);echo $sqlValida.":".$TotalRegistros;
			if(($TotalRegistros!=0)and($barcode!=""))
			{
				$filaValida = mysqli_fetch_object($rsValida);
				$producto=$filaValida->producto;
				$validacion="Ya existe un producto dado de alta, con la siguiente información:<br>";
				$validacion.="Código Corto: ".$filaValida->codigocorto."<br>";
				$validacion.="Código de barras: ".$filaValida->barcode."<br>";
				$validacion.="Descripción: ".base_html($filaValida->producto);
				$_SESSION['validacion']=$validacion;
				header("Location:cat-productos-alta.php");
			}
			else
			{	// Si no existen codigo corto ni codigo de barras, anexa el producto (o sea no es repetido)
				$producto=html_base($producto);
				$sql="INSERT INTO cat_productos (codigocorto,barcode,producto,existencias) VALUES ('$codigocorto','$barcode','$producto',$existencias)";// echo $sql;
				mysqli_query($conn,$sql);
				mysqli_close($conn);
				header("Location:cat-productos.php");
			}
		}
	}
	ob_end_flush();
?>