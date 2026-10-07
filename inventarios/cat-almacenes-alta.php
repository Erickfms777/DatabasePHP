<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(almacenesaltas()==0){verificaseguridad();}
else
{	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
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
	<?php require "cat-almacenes-menu.php"; ?>

<div id="informacion">
<form id="AltaAlmacen" name="AltaAlmacen" method="post" enctype="multipart/form-data" action="cat-almacenes-alta-sube.php">
<h1> Almacenes - Nuevo</h1><br />
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="0" >
  <tr class="renglon1">
    <td height="40" align="left" valign="middle" class="texto_formulario">Abreviatura</td>
    <td height="40" align="left" valign="middle"><input name="abreviatura" type="text" class="CapturaProducto" id="abreviatura" maxlength="2" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2">
    <td height="40" align="left" valign="middle" class="texto_formulario">Nombre de Almac&eacute;n</td>
    <td height="40" align="left" valign="middle"><input name="almacen" type="text" class="CapturaProducto" id="almacen" maxlength="100" /></td>
    <td width="10" align="left" valign="middle"></td>
  </tr>
  <tr class="renglon1">
    <td height="40" align="left" valign="middle" class="texto_formulario">Ubicaci&oacute;n</td>
    <td height="40" align="left" valign="middle"><input name="ubicacion" type="text" class="CapturaDireccion" id="ubicacion" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2" >
    <td height="50" align="left" valign="middle" class="texto_formulario">Descripcion</td>
    <td height="50" align="left" valign="middle"><input name="descripcion" type="text" class="CapturaDireccion" id="descripcion" maxlength="200" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2" >
    <td height="50" align="left" valign="middle" class="texto_formulario">&nbsp;</td>
    <td height="50" align="left" valign="middle"><input name="aceptar" type="submit" value="Guardar" class="boton_formulario"/></td>
    <td align="left" valign="middle"></td>
  </tr>
  </table>
</form>
</div>
  	<?php require("pie.php"); ?>
</div>   
</body>
</html>
<?php } ?>
<script language="javascript">
function Filtros(form) { AltaProducto.action="cat-productos-alta-filtros.php"; document.forms["AltaProducto"].submit() }
</script>
