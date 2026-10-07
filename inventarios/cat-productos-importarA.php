<?php 
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(productosimportar()==0){verificaseguridad();}
else
{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<br>
<br>
<?php
	session_start();
	include("conexion.php");
	include("utilerias.php");
	$archivo="productos.xlsx";
	// PROCESAMOS LAS LINEAS
	echo "Procesando catálogo de productos : ".$archivo." <br>";
	require_once 'Classes/PHPExcel/IOFactory.php';
	$objPHPExcel = PHPExcel_IOFactory::load($archivo);
	$worksheet=$objPHPExcel->getActiveSheet();
	$worksheetTitle     = $worksheet->getTitle();
	$highestRow         = $worksheet->getHighestRow();
	ini_set('memory_limit', '1600M');
	echo "Registros en hoja de excel: ".$highestRow."<br>";
	$error="";
	$total=0;

	// validaci�n de estructura
//	if(strtoupper ( $_DATOS_EXCEL[1]['A'])!="NO"){$error.="Se requiere campo No<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['B'])!="EMPRESA"){$error.="Se requiere campo RazonSocial<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['C'])!="RFC"){$error.="Se requiere campo RFC<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['D'])!="DIRECCION"){$error.="Se requiere campo Direccion<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['E'])!="TELEFONOS"){$error.="Se requiere campo Telefonos<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['F'])!="CORREO"){$error.="Se requiere campo Correo<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['G'])!="CONTACTO"){$error.="Se requiere campo Contacto<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['H'])!="MATERIALES"){$error.="Se requiere campo Materiales<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['I'])!="CUENTA"){$error.="Se requiere campo Cuenta<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['J'])!="BANCO"){$error.="Se requiere campo Banco<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['K'])!="CLABE"){$error.="Se requiere campo Clabe<br>";}
//	if(strtoupper ( $_DATOS_EXCEL[1]['L'])!="FORMADEPAGO"){$error.="Se requiere FormaDePago<br>";}
//	echo $error;
//	if($error!=""){echo "No se puede procesar archivo, no corresponde a la estructura necesaria";}
//	else  //la estructura est� correcta, se procede a procesar el archivo de proveedores
	{
		$registros_correctos=0;
		$registros_erroneos=0;
		$clientes_anexados=0;
	for ($i=2;$i<=$highestRow ;$i++)  //ciclo desde la segunda fila (primera de datos), hasta la �ltima
		{
			// se obtiene una fila de informaci�n, toda est� en formato texto
			$_DATOS_EXCEL[2]['A'] = utf8_decode($objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue());
			$_DATOS_EXCEL[2]['B'] = utf8_decode($objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue());
			$_DATOS_EXCEL[2]['C'] = utf8_decode($objPHPExcel->getActiveSheet()->getCell("C".$i)->getCalculatedValue());
			$_DATOS_EXCEL[2]['D'] = utf8_decode($objPHPExcel->getActiveSheet()->getCell("D".$i)->getCalculatedValue());
			$_DATOS_EXCEL[2]['E'] = utf8_decode($objPHPExcel->getActiveSheet()->getCell("E".$i)->getCalculatedValue());
			// Se calculan los datos que requieran calcularse
			$clave=trim($_DATOS_EXCEL[2]['A']);
			$descripcion=trim($_DATOS_EXCEL[2]['B']);
			$alterna=(int)trim($_DATOS_EXCEL[2]['C']);
			$categoria=(int)trim($_DATOS_EXCEL[2]['D']);
			$estatus="procesado";			
			if($estatus=="procesado") //todo bien, ahora si, se inserta
			{
				$sql="INSERT INTO articulos (clave,descripcion,alterna,categoria) VALUES ('$clave','$descripcion',$alterna,$categoria)  "; //echo $sql;
				mysqli_query($conn,$sql);
				$registros_correctos+=1;
			}
		}
	echo ($highestRow-1)." registros procesados<br>".$registros_correctos." registros correctos<br>".$clientes_anexados." productos anexados<br>".($highestRow-1-$registros_correctos)." registros erroneos";  

	}
}
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
