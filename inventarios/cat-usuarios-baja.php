<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(inscripcionespermisoconsultas()==0){verificaseguridad();}
else
{	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$item=$_GET["item"];
	$sql="SELECT usuarios.*,cat_tipousuarios.usuario_tipo FROM usuarios,cat_tipousuarios WHERE usuarios.idtipousuario=cat_tipousuarios.idtipousuario AND usuarios.idusuario=$item"; //echo $sql;
	$rsActual=mysqli_query($conn,$sql);
	$filaActual=mysqli_fetch_object($rsActual);
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
	<?php require "cat-usuarios-menu.php"; ?>

<div id="informacion">
<form id="ModificaUsuario" name="ModificaUsario" method="post" action="cat-usuarios-baja-borra.php">
<h1> Usuarios - Baja</h1><br />
<table width="50%" border="0" align="center" cellpadding="1" cellspacing="0" class="texto_formulario">
  <tr class="renglon3">
    <td height="40" align="left" valign="middle" class="texto_formulario">Usuario:</td>
    <td height="40" align="left" valign="middle"><?php echo base_html($filaActual->usuario); ?></td>
    <td width="10" align="left" valign="middle"></td>
  </tr>
  <tr class="renglon4">
    <td height="40" align="left" valign="middle" class="texto_formulario">Contrase&ntilde;a:</td>
    <td height="40" align="left" valign="middle"><?php echo base_html($filaActual->pasaporte); ?></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon3">
    <td height="40" align="left" valign="middle" class="texto_formulario">Nombre:</td>
    <td height="40" align="left" valign="middle"><?php echo base_html($filaActual->nombre); ?></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon4" >
    <td height="50" align="left" valign="middle" class="texto_formulario">Correo:</td>
    <td height="50" align="left" valign="middle"><?php echo base_html($filaActual->correo); ?></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon3" >
    <td height="50" align="left" valign="middle" class="texto_formulario">Tipo:</td>
    <td height="50" align="left" valign="middle"><?php echo base_html($filaActual->usuario_tipo); ?>
      <input name="idusuario" type="hidden" id="idusuario" value="<?php echo $item; ?>" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon4" >
    <td height="50" align="left" valign="middle" class="texto_formulario">&nbsp;</td>
    <td height="50" align="left" valign="middle"><input name="aceptar" type="submit" value="Confirmar Baja" class="boton_formulario" /></td>
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
