<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(productosaltas()==0){verificaseguridad();}
else
{	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$nivel=$_SESSION['nivel'];	
	$ruta="";
	$mensaje=$_SESSION['mensaje']; 
	$validacion=$_SESSION['validacion']; 
	$codigocorto=$_SESSION['codigocorto'];
    $barcode=$_SESSION['barcode'];
    $producto=$_SESSION['producto'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Monograf- Sistema de Inventarios</title>
<link rel="stylesheet" href="estilos/estilos.css">
<link rel="stylesheet" href="estilos/menu.css">

</head>
<body>
<div id="contenedor">
	<?php require("encabezado-logotipo.php"); ?>
	<?php require("encabezado-usuario.php"); ?>
	<?php require "encabezado-menusuperior.php"; ?>
	<?php require "cat-productos-menu.php"; ?>

<div id="informacion">
<script type="text/javascript" language="javascript" src="scripts/cat-productos-alta.js"></script>
<form id="AltaProducto" name="AltaProducto" method="post" enctype="multipart/form-data" action="cat-productos-alta-sube.php">
<h1> Productos - Nuevo</h1><br />
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="0" >
  <tr class="renglon1">
    <td height="40" align="left" valign="middle" class="texto_formulario">C&oacute;digo Corto</td>
    <td height="40" align="left" valign="middle"><input name="codigocorto" type="text" class="CapturaProducto" id="codigocorto" value="<?php echo $codigocorto; ?>" maxlength="100" /></td>
    <td width="10" align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2">
    <td height="40" align="left" valign="middle" class="texto_formulario">Descripci&oacute;n</td>
    <td height="40" align="left" valign="middle"><input name="producto" type="text" class="CapturaProducto" id="producto" value="<?php echo $producto; ?>" maxlength="200" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon1" >
    <td height="50" align="left" valign="middle" class="texto_formulario">C&oacute;digo de Barras</td>
    <td height="50" align="left" valign="middle"><input name="barcode" type="text" class="CapturaProducto" id="barcode" value="<?php echo $barcode; ?>" maxlength="100" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2" >
    <td height="50" align="left" valign="middle" class="texto_formulario">&nbsp;</td>
    <td height="50" align="left" valign="middle"><input name="aceptar" type="button" value="Guardar" class="boton_formulario"/  onclick="validar();"></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2" >
    <td height="10" colspan="2" align="left" valign="middle" class="texto_formulario"><?php echo $validacion; ?></td>
    <td align="left" valign="middle"></td>
  </tr>
  </table>
</form>
</div>
  	<?php require("pie.php"); ?>
</div>  
<?php if($mensaje!="") { ?>
	<script language="javascript">
		alert('<?php echo $mensaje; ?>');
	</script>
<?php } ?> 
</body>
</html>
<?php } ?>
<script language="javascript">
function Filtros(form) { AltaProducto.action="cat-productos-alta-filtros.php"; document.forms["AltaProducto"].submit() }
</script>
