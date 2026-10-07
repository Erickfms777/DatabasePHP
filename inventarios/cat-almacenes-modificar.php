<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(almacenescambios()==0){verificaseguridad();}
else
{	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$idalmacen=(int)$_GET["item"];
	$sql="SELECT cat_almacenes.* FROM cat_almacenes WHERE cat_almacenes.idalmacen=$idalmacen";
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
	<?php require "cat-almacenes-menu.php"; ?>

<div id="informacion">
<form id="ModificarAlmacen" name="ModificarAlmacen" method="post" enctype="multipart/form-data" action="cat-almacenes-modificar-cambia.php">
<h1> Almacenes - Modificar</h1><br />
<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1" >
  <tr class="renglon1">
    <td height="40" align="left" valign="middle" class="texto_formulario">Abreviatura :</td>
    <td height="40" align="left" valign="middle"><input name="abreviatura" type="text" class="CapturaProducto" id="abreviatura" value="<?php echo base_html($fila->abreviatura); ?>" maxlength="2" /></td>
  </tr>
  <tr class="renglon0">
    <td height="40" align="left" valign="middle" class="texto_formulario">Almac&eacute;n :</td>
    <td height="40" align="left" valign="middle"><input name="almacen" type="text" class="CapturaProducto" id="almacen" value="<?php echo base_html($fila->almacen); ?>" maxlength="200" /></td>
    </tr>
  <tr class="renglon1">
    <td height="40" align="left" valign="middle" class="texto_formulario">Ubicaci&oacute;n:</td>
    <td height="40" align="left" valign="middle"><input name="ubicacion" type="text" class="CapturaProducto" id="ubicacion" value="<?php echo base_html($fila->ubicacion); ?>" maxlength="200" /></td>
    </tr>
  <tr class="renglon2" >
    <td height="40" align="left" valign="middle" class="texto_formulario">Descripci&oacute;n</td>
    <td height="40" align="left" valign="middle"><input name="descripcion" type="text" class="CapturaProducto" id="descripcion" value="<?php echo base_html($fila->descripcion); ?>" maxlength="200" /></td>
  </tr>
  <tr class="renglon2" >
    <td align="left" valign="middle" class="texto_formulario"><input name="idalmacen" type="hidden" id="idalmacen" value="<?php echo $idalmacen; ?>" /></td>
    <td align="left" valign="top" class="texto_formulario"><input name="aceptar" type="submit" value="Guardar" class="boton_formulario"/></td>
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
function Filtros(form) { ModificarProducto.action="cat-productos-modificar-filtros.php"; document.forms["ModificarProducto"].submit() }
</script>
