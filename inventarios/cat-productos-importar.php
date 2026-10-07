<?php
	require_once 'vendor/autoload.php';
	use PhpOffice\PhpSpreadsheet\IOFactory;
	$error=0;
//	session_start();
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(productoslistado()==0){verificaseguridad();}
else
{
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$nivel=$_SESSION['nivel'];
	$archivo=trim( $_FILES['productos']['name']);
	$extension = explode(".",(string)$archivo);
	if($archivo==""){$mensaje="Favor de subir archivo de datos"; $error=1;} 
	elseif($extension[1]!="xlsx")
	{
		$mensaje="Archivo en formato inv&aacute;lido, tiene que ser de excel .xlsx";
		$error=1;
	}
	else
	{
		move_uploaded_file($_FILES["productos"] ["tmp_name"],$archivo);
		$spreadsheet= IOFactory::load($archivo);
        $worksheet = $spreadsheet->getActiveSheet();
        $TotalProductos = $worksheet->getHighestRow()-1;
        $highestColumn = $worksheet->getHighestColumn();// echo ":".$highestColumn.":";
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); 
		// verificamos ahora que la estructura de la hoja de cálculo esté correcta
		$hojaActual = $spreadsheet->getSheet(0);
		$encabezado1 = $hojaActual->getCell("A1"); echo $encabezado1;
		$encabezado2 = $hojaActual->getCell("B1"); echo $encabezado2;
		$encabezado3 = $hojaActual->getCell("C1"); echo $encabezado3;
		$mensaje="";
		if($encabezado1!="CODIGOCORTO"){$mensaje="Error de datos, la primera columna debe ser CODIGOCORTO<br>"; $error=1;}
		if($encabezado2!="CODIGODEBARRAS"){$mensaje.="Error de datos, la segunda columna debe ser CODIGODEBARRAS<br>" ;$error=1;}
		if($encabezado3!="PRODUCTO"){$mensaje.="Error de datos, la tercera columna debe ser PRODUCTO<br>"; $error=1;}
		if($error==0){$mensaje="Procesando cat&aacute;logo de productos : ".$archivo." <br> Total de productos a procesar: ".$TotalProductos ;}

	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Monograf- Sistema de Inventarios</title>
<link rel="stylesheet" href="estilos/estilos.css">
<link rel="stylesheet" href="estilos/menu.css">
<style type="text/css">
#contenedor #informacion table tr .Titulo p {
	text-align: center;
}
</style>
</head>
<body>
<div id="contenedor">
	<?php require("encabezado-logotipo.php"); ?>
	<?php require("encabezado-usuario.php"); ?>
  <?php require "encabezado-menusuperior.php"; ?>
  <?php require "cat-productos-menu.php"; ?>

<div id="informacion">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="center" valign="middle"  class="Titulo"><p>Importaci&oacute;n del cat&aacute;logo de productos</p></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="middle" class="TextoEncabezadoTablas">
	<?php 
		echo $mensaje;		

	?></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="middle" class="TextoEncabezadoTablas">
    <?php if($error==0) { ?>
    <table width="98%" border="1" cellspacing="1" cellpadding="0">
      <tr>
        <td width="25%">C&oacute;digo Corto</td>
        <td width="25%">C&oacute;digo de Barras</td>
        <td width="50%">Producto</td>
        <td width="23%">Estatus</td>
      </tr>
      <?php
	  	  $registros=0;
		  $erroneos=0;
		  $duplicados=0;
	  	  for ($indice = 2; $indice <= $TotalProductos+1; $indice++)
		  {
			  $codigocorto=trim($hojaActual->getCell("A".$indice));
			  $codigodebarras=trim((string)$hojaActual->getCell("B".$indice));
	 		  $producto=trim($hojaActual->getCell("C".$indice));
			  $estatus="ok";
			  if($codigocorto==""){$estatus="erroneo"; $erroneos+=1;}
			  else
			  {
				  $sql="SELECT * FROM cat_productos WHERE codigocorto='$codigocorto'";// echo $sql;
				  $rs=mysqli_query($conn,$sql);
				  $cuantos=mysqli_num_rows($rs);
				  if($cuantos!=0){$estatus="duplicado"; $duplicados+=1;}
			  }
			  if($producto==""){$estatus="erroneo"; $erroneos+=1;}
			  if($codigodebarras!="")
			  {
				  $sql="SELECT * FROM cat_productos WHERE barcode='$codigodebarras'";// echo $sql;
				  $rs=mysqli_query($conn,$sql);
				  $cuantos=mysqli_num_rows($rs);
				  if($cuantos!=0){$estatus="duplicado"; $duplicados+=1;}
			  }
	  		  if($estatus=="ok")
			  {
					$sql="INSERT INTO cat_productos(codigocorto,barcode,producto,existencias) VALUES ('$codigocorto','$codigodebarras','$producto',0)";
					mysqli_query($conn,$sql);
				    $registros+=1;
			  }
			  
	  ?>
      <tr>
        <td><?php echo $codigocorto; ?></td>
        <td><?php echo $codigodebarras; ?></td>
        <td><?php echo $producto; ?></td>
        <td><?php echo $estatus; ?></td>
      </tr>
      <?php } ?>      
         <tr>
        	<td colspan="4"><p>Total de Productos A&ntilde;adidos:  <?php echo $registros; ?><br />            	  
        	  Total de Productos Erroneos: <?php echo $erroneos; ?></p>
        	  <p>Total de Productos Duplicados: <?php echo $duplicados; ?><br />
      	    </p></td>
	        </tr>
    </table>
    <?php } ?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
  	<?php require("pie.php"); ?>
</div>   

</body>
</html>
<?php } ?>

<script language="javascript">
function Filtros(form) { NuevoGrupo.action="cat-grupos-alta-filtros.php"; document.forms["NuevoGrupo"].submit() }
function AltaGrupo(form) { NuevoGrupo.action="cat-grupos-alta-sube.php"; document.forms["NuevoGrupo"].submit() }
</script>