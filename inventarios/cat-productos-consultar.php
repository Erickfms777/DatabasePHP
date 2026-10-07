<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(productosconsultas()==0){verificaseguridad();}
else
{	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$idproducto=(int)$_GET["item"];
	$sql="SELECT cat_productos.* FROM cat_productos WHERE cat_productos.idproducto=$idproducto";
	$rs = mysqli_query($conn,$sql);
	$fila = mysqli_fetch_object($rs);
	$nivel=$_SESSION['nivel'];	
	$ruta="";
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
<form id="AltaUsuario" name="AltaUusario" method="post" enctype="multipart/form-data" action="cat-productos-alta-sube.php">
<h1> Productos - Informaci&oacute;n</h1><br />
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="0" >
  <tr class="renglon1">
    <td width="20%" height="40" align="left" valign="middle" class="texto_formulario">C&oacute;digo Corto:</td>
    <td height="40" align="left" valign="middle" class="texto_formulario"><?php echo base_html($fila->codigocorto); ?></td>
    <td width="10" rowspan="5" align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr class="renglon2">
    <td height="40" align="left" valign="middle" class="texto_formulario">C&oacute;digo de Barras:</td>
    <td height="40" align="left" valign="middle" class="texto_formulario"><?php echo base_html($fila->barcode); ?></td>
  </tr>
  <tr class="renglon1" >
    <td height="40" align="left" valign="middle" class="texto_formulario">Descripci&oacute;n</td>
    <td align="left" valign="middle" class="texto_formulario"><?php echo base_html($fila->producto); ?></td>
  </tr>
  <tr class="renglon2" >
    <td height="40" align="left" valign="middle" class="texto_formulario">Existencias</td>
    <td align="left" valign="middle" class="texto_formulario"><?php echo base_html($fila->existencias); ?></td>
  </tr>
  <tr class="renglon2" >
    <td align="left" valign="middle" class="texto_formulario">&nbsp;</td>
    <td align="left" valign="middle" class="texto_formulario">&nbsp;</td>
  </tr>
  </table>
</form>
</div>
  	<?php require("pie.php"); ?>
</div>   
</body>
</html>
<?php } ?>
