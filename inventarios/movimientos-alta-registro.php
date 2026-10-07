<?php
	include("seguridad.php");
	include("utilerias.php");
	require("conexion.php");
	$conn=abre_conexion();
	$idusuario=$_SESSION['idusuario'];
	$idmovimientotipo=$_POST['idmovimientotipo'];
	$_SESSION['idmovimientotipo']=$idmovimientotipo;
	$origen=$_POST['idalmacenorigen'];
	$_SESSION['origen']=$origen;
	$destino=$_POST['idalmacendestino'];
	$_SESSION['destino']=$destino;
	$_SESSION['referencia']=html_base($_POST['referencia']);
	$_SESSION['descripcion']=html_base($_POST['descripcion']);
	$_SESSION['fecha']=$_POST['fecha'];
	$cantidad=(int)$_POST["cantidad"];
	$codigo=$_POST["codigo"];
	$_SESSION['cantidad']=$cantidad;
	$_SESSION['codigo']=$codigo;
	// verifica si el producto está en el catálogo 
	$sql="SELECT * FROM cat_productos WHERE codigocorto='$codigo' OR barcode='$codigo'"; //echo $sql;
	$rs=mysqli_query($conn,$sql);
	$totalReg = mysqli_num_rows($rs);
	if($totalReg==0)
	{
		$validacion="Producto inexistente en el catálogo de productos";
		$_SESSION['validacion']=$validacion;
	}
	else
	{
		// Si hay una salida de producto de por medio, verifica 1:si existe en el almacén origen 2: si hay existencias suficientes
		$fila = mysqli_fetch_object($rs); 
		$codigocorto=$fila->codigocorto; 
		$barcode=$fila->barcode;
		$idproducto=$fila->idproducto;
		$producto=$fila->producto;
		$existencias=$fila->existencias;
		if($origen!=0)
		{
			$sqlOrigen="SELECT * FROM inventario WHERE idproducto=$idproducto AND idalmacen=$origen";
			$rsOrigen=mysqli_query($conn,$sqlOrigen);
			$totalOrigen = mysqli_num_rows($rsOrigen);
			if($totalOrigen==0)
			{
				$validacion="Producto inexistente en el almacen de origen";
				$_SESSION['validacion']=$validacion;
			}
			else
			{
				$sqlRepetido="SELECT * FROM movimientos_desglose_aux WHERE idproducto=$idproducto";
				$rsRepetido=mysqli_query($conn,$sqlRepetido);
				$totalRepetido = mysqli_num_rows($rsRepetido);
				if($totalRepetido!=0)
				{
					$filaRepetido=mysqli_fetch_object($rsRepetido);
					$cantidadRepetido=$filaRepetido->cantidad;
					$validacion="Ya se han capturado ".$cantidadRepetido. " piezas de este producto, de ser necesario borre el registro capturado y vuelva a ingresar la cantidad total";
					$_SESSION['validacion']=$validacion;
				}
				else
				{
					$filaOrigen=mysqli_fetch_object($rsOrigen);
					$cantidadOrigen=$filaOrigen->existencias;
					if($cantidadOrigen<$cantidad)
					{
						$validacion="Existencias insuficientes de producto en el almacen de origen. Solo existen ".$cantidadOrigen;
						$_SESSION['validacion']=$validacion;
					}
					else
					{
						$sql="INSERT INTO movimientos_desglose_aux (idusuario,cantidad,idproducto,codigocorto,barcode,producto) VALUES ($idusuario,$cantidad,$idproducto,'$codigocorto','$barcode','$producto')"; //echo $sql;
						mysqli_query($conn,$sql);
						$_SESSION['validacion']="";
					}
				}
			}
		}
		else
		{
			$sql="INSERT INTO movimientos_desglose_aux (idusuario,cantidad,idproducto,codigocorto,barcode,producto) VALUES ($idusuario,$cantidad,$idproducto,'$codigocorto','$barcode','$producto')"; //echo $sql;
			mysqli_query($conn,$sql);
			$_SESSION['validacion']="";
		}
	}
?>
<form name="MovsAlta" method="post" enctype="multipart/form-data" action="movimientos-alta.php"></form>
<script language="javascript">
document.forms["MovsAlta"].submit();
</script>