<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(productoscambios()==0){verificaseguridad();}
else
{	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$mensaje=$_SESSION['mensaje']; 
	$idproducto=$_SESSION['idproducto'];
	$validacion=$_SESSION['validacion']; 
	$codigocorto=$_SESSION['codigocorto'];
    $barcode=$_SESSION['barcode'];
    $producto=$_SESSION['producto'];
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
<script type="text/javascript" language="javascript" src="scripts/cat-productos-modificar.js"></script>
<form id="ModificarProducto" name="ModificarProducto" method="post" enctype="multipart/form-data" action="cat-productos-modificar-cambia.php">
<h1> Productos - Modificar</h1><br />
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="0" >
  <tr class="renglon1">
    <td height="40" align="left" valign="middle" class="texto_formulario">Codigo Corto:</td>
    <td height="40" align="left" valign="middle"><input name="codigocorto" type="text" class="CapturaProducto" id="codigocorto" value="<?php echo base_html($codigocorto); ?>" maxlength="200" /></td>
    </tr>
  <tr class="renglon0">
    <td height="40" align="left" valign="middle" class="texto_formulario">Descripci&oacute;n</td>
    <td height="40" align="left" valign="middle"><input name="producto" type="text" class="CapturaProducto" id="producto" value="<?php echo base_html($producto); ?>" maxlength="200" /></td>
    </tr>
  <tr class="renglon1" >
    <td height="40" align="left" valign="middle" class="texto_formulario">C&oacute;digo de Barras:</td>
    <td height="40" align="left" valign="middle"><input name="barcode" type="text" class="CapturaProducto" id="barcode" value="<?php echo base_html($barcode); ?>" maxlength="200" /></td>
  </tr>
  <tr class="renglon2" >
    <td align="left" valign="middle" class="texto_formulario"><input name="idproducto" type="hidden" id="idproducto" value="<?php echo $idproducto; ?>" /></td>
    <td align="left" valign="top" class="texto_formulario"><input name="aceptar" type="button" value="Guardar" class="boton_formulario"  onclick="validar();"/></td>
  </tr>
  <tr class="renglon2" >
    <td colspan="2" align="left" valign="middle" class="texto_formulario"><?php echo $validacion; ?></td>
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
function Filtros(form) { ModificarProducto.action="cat-productos-modificar-filtros.php"; document.forms["ModificarProducto"].submit() }
</script>
