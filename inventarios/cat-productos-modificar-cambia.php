<?php
	ob_start();
	include("seguridad.php");
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$idproducto=(int)$_POST["idproducto"];	
	$codigocorto=trim(html_base($_POST["codigocorto"]));
	$barcode=trim(html_base($_POST["barcode"]));
	$producto=trim(html_base($_POST["producto"]));
	if(($producto=="")or($codigocorto=="")){mysqli_query($conn,$sql); mysqli_close($conn); header("Location:cat-productos.php");}
	else
	{
		// Valida si existe el codigo corto
		$sqlValida="SELECT * FROM cat_productos WHERE codigocorto='$codigocorto' AND idproducto NOT IN ($idproducto)";// echo $sqlValida;
		$rsValida=mysqli_query($conn,$sqlValida);
		$TotalRegistros=mysqli_num_rows($rsValida);//echo $sqlValida.":".$TotalRegistros;
		if(($TotalRegistros!=0)and($codigocorto!="")) // Se encontró código corto en otro producto
		{
			$filaValida = mysqli_fetch_object($rsValida);
			$producto=$filaValida->producto;
			$validacion="Ya existe un producto duplicado, con la siguiente información:<br>";
			$validacion.="Código Corto: ".$filaValida->codigocorto."<br>";
			$validacion.="Código de barras: ".$filaValida->barcode."<br>";
			$validacion.="Descripción: ".base_html($filaValida->producto);
			$_SESSION['validacion']=$validacion;
			header("Location:cat-productos-modificar.php");

		}
		else
		{	// Valida si existe el codigo de barras
			$sqlValida="SELECT * FROM cat_productos WHERE barcode='$barcode'  AND idproducto NOT IN ($idproducto)";
			$rsValida=mysqli_query($conn,$sqlValida);
			$TotalRegistros=mysqli_num_rows($rsValida);echo $sqlValida.":".$TotalRegistros;
			if(($TotalRegistros!=0)and($barcode!=""))
			{
				$filaValida = mysqli_fetch_object($rsValida);
				$producto=$filaValida->producto;
				$validacion="Ya existe un producto duplicado, con la siguiente información:<br>";
				$validacion.="Código Corto: ".$filaValida->codigocorto."<br>";
				$validacion.="Código de barras: ".$filaValida->barcode."<br>";
				$validacion.="Descripción: ".base_html($filaValida->producto);
				$_SESSION['validacion']=$validacion;
				header("Location:cat-productos-modificar.php");
			}
			else
			{	// Si no existen codigo corto ni codigo de barras, anexa el producto (o sea no es repetido)
				$sql="UPDATE cat_productos SET codigocorto='$codigocorto',barcode='$barcode',producto='$producto' WHERE idproducto=$idproducto";// echo $sql;
				mysqli_query($conn,$sql);
				mysqli_close($conn);
				header("Location:cat-productos.php");
				ob_end_flush();
			}
		}
	}
	ob_end_flush();
?>