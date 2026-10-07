<?php
	ob_start();
	include("seguridad.php");
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	setlocale(LC_TIME,"es_MX");
	$idusuario=$_SESSION['idusuario'];
	$idmovimientotipo=$_POST['idmovimientotipo'];
	$origen=$_POST['idalmacenorigen'];
	$destino=$_POST['idalmacendestino'];
	$referencia=html_base($_POST['referencia']);
	$descripcion=html_base($_POST['descripcion']);
	$fecha=$_POST['fecha'];
	$sqlDesglose="SELECT * FROM movimientos_desglose_aux WHERE idusuario=$idusuario";
	$rsDesglose=mysqli_query($conn,$sqlDesglose);
	$TotalRegistros=mysqli_num_rows($rsDesglose);
	if($TotalRegistros==0){header ("location:movimientos-alta.php");} // Si no hay productos en documento, se regresa de donde vino
	else // Si hay datos suficientes para generar remision, así que ya se genera
	{
		// primero generamos el remision como tal
		$sql="INSERT INTO movimientos (idmovimientotipo,origen,destino,referencia,descripcion,fecha,idusuario) VALUES($idmovimientotipo,$origen,$destino,'$referencia','$descripcion','$fecha',$idusuario)";// echo $sql;
		mysqli_query($conn,$sql);
		$sql="SELECT * FROM movimientos ORDER BY idmovimiento DESC";
		$rs=mysqli_query($conn,$sql);
		$fila = mysqli_fetch_object($rs);
		$idmovimiento=$fila->idmovimiento;
		// Ahora vamos a pasar todos los registros de cada remision
		$Totalremision=0;
		while($filaDesglose = mysqli_fetch_object($rsDesglose)	)
		{
			$idproducto=$filaDesglose->idproducto;
			$cantidad=$filaDesglose->cantidad;
			$codigocorto=$filaDesglose->codigocorto;
			$barcode=$filaDesglose->barcode;
			$producto=$filaDesglose->producto;
			// se actualiza el desglose de remision 			
			$sql="INSERT INTO movimientos_desglose (idmovimiento,idproducto,cantidad,codigocorto,barcode,producto) VALUES($idmovimiento,$idproducto,$cantidad,'$codigocorto','$barcode','$producto') "; //echo $sql;
			mysqli_query($conn,$sql);
		}
		// se borra el auxiliar de desglose
		$sql="DELETE FROM movimientos_desglose_aux WHERE idusuario=$idusuario";
		mysqli_query($conn,$sql);
		// se hacen movimientos al inventario 
		$sqlDesglose="SELECT * FROM movimientos_desglose WHERE idmovimiento=$idmovimiento";// echo $sqlDesglose;
		$rsDesglose=mysqli_query($conn,$sqlDesglose);
		while($filaDesglose = mysqli_fetch_object($rsDesglose))
		{
			$cantidad=$filaDesglose->cantidad;
			$barcode=$filaDesglose->barcode;
			$codigocorto=$filaDesglose->codigocorto;
			$idproducto=$filaDesglose->idproducto;
			$producto=$filaDesglose->producto;
			// Va a actualizar existencias del producto
			// Si hay almacen de origen los descuenta
			if($origen==0){}
			else
			{
				$sql1="SELECT * FROM inventario WHERE idproducto=$idproducto AND idalmacen=$origen"; //echo $sql1."<br><br>";
				$rs1=mysqli_query($conn,$sql1);
				$TotalReg=mysqli_num_rows($rs1);
				if($TotalReg==0){header ("location:movimientos.php");ob_end_flush();}
				else
				{
					$fila1 = mysqli_fetch_object($rs1);
					$idinventario=$fila1->idinventario;
					$existencias=$fila1->existencias;
					$existenciasupdate=$existencias-$cantidad;
					$sql1="UPDATE inventario SET existencias=$existenciasupdate WHERE idinventario=$idinventario";// echo $sql1."<br><br>"; //actualiza existencias en 
					mysqli_query($conn,$sql1);
				}
			}
			if($destino==0){}
			else
			{
				$sql1="SELECT * FROM inventario WHERE idproducto=$idproducto AND idalmacen=$destino";// echo $sql1."<br><br>";
				$rs1=mysqli_query($conn,$sql1);
				$TotalReg=mysqli_num_rows($rs1);
				if($TotalReg==0)
				{
					$sql1="INSERT INTO inventario (idalmacen,idproducto,existencias) VALUES ($destino,$idproducto,$cantidad)";
					mysqli_query($conn,$sql1);				
				}
				else
				{
					$fila1 = mysqli_fetch_object($rs1);
					$idinventario=$fila1->idinventario;
					$existencias=$fila1->existencias;
					$existenciasupdate=$existencias+$cantidad;
					$sql1="UPDATE inventario SET existencias=$existenciasupdate WHERE idinventario=$idinventario";// echo $sql1."<br><br>";
					mysqli_query($conn,$sql1);
				}
			}
		}
		// Se actualizan existencias en catálogo de productos
		$sqlDesglose="SELECT * FROM movimientos_desglose WHERE idmovimiento=$idmovimiento"; //echo $sqlDesglose;
		$rsDesglose=mysqli_query($conn,$sqlDesglose);
		while($filaDesglose = mysqli_fetch_object($rsDesglose))
		{
			$idproducto=$filaDesglose->idproducto;
			$cantidad=$filaDesglose->cantidad;
			if($origen!=0)
			{
				$sqlGral="SELECT * FROM cat_productos WHERE idproducto=$idproducto";
				$rsGral=mysqli_query($conn,$sqlGral);
				$filaGral = mysqli_fetch_object($rsGral);
				$existenciasupdate=$filaGral->existencias-$cantidad;
				$sqlGral="UPDATE cat_productos SET existencias=$existenciasupdate WHERE idproducto=$idproducto";// echo $sqlGral.":";
				mysqli_query($conn,$sqlGral);
			}
			if($destino!=0)
			{
				$sqlGral="SELECT * FROM cat_productos WHERE idproducto=$idproducto";
				$rsGral=mysqli_query($conn,$sqlGral);
				$filaGral = mysqli_fetch_object($rsGral);
				$existenciasupdate=$filaGral->existencias+$cantidad;
				$sqlGral="UPDATE cat_productos SET existencias=$existenciasupdate WHERE idproducto=$idproducto"; //echo $sqlGral.":";
				mysqli_query($conn,$sqlGral);
			}
		}
		header ("location:movimientos.php");
		ob_end_flush();
	}
?>