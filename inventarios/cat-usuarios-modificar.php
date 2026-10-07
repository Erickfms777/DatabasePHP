<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(usuarioscambios()==0){verificaseguridad();}
else
{	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$item=$_GET["item"];
	$nivel=$_SESSION['nivel'];//	echo "Nivel: ".$nivel;
	$sql="SELECT * FROM usuarios WHERE idusuario=$item";
	$rsActual=mysqli_query($conn,$sql);
	$filaActual=mysqli_fetch_object($rsActual);
	if($nivel==$filaActual->idtipousuario)
	{$sql="SELECT * FROM cat_tipousuarios WHERE idtipousuario=$nivel ORDER BY idtipousuario";}
	else {$sql="SELECT * FROM cat_tipousuarios WHERE idtipousuario>$nivel ORDER BY idtipousuario";}
	$rsUsuario= mysqli_query($conn,$sql);
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
<form id="ModificaUsuario" name="ModificaUsario" method="post" action="cat-usuarios-modificar-cambia.php">
<h1> Usuarios - Cambios</h1><br />
<table width="50%" border="0" align="center" cellpadding="1" cellspacing="0" >
  <tr class="renglon3">
    <td height="40" align="left" valign="middle" class="texto_formulario">Usuario:</td>
    <td height="40" align="left" valign="middle"><?php echo base_html($filaActual->usuario); ?></td>
    <td width="10" align="left" valign="middle"></td>
  </tr>
  <tr class="renglon4">
    <td height="40" align="left" valign="middle" class="texto_formulario">Contrase&ntilde;a:</td>
    <td height="40" align="left" valign="middle"><input name="pasaporte" type="text" class="CapturaPassword" id="pasaporte" value="<?php echo base_html($filaActual->pasaporte); ?>" maxlength="20" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon3">
    <td height="40" align="left" valign="middle" class="texto_formulario">Nombre:</td>
    <td height="40" align="left" valign="middle"><input name="nombre" type="text" class="CapturaNombre" id="nombre" value="<?php echo base_html($filaActual->nombre); ?>" maxlength="100" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon4" >
    <td height="50" align="left" valign="middle" class="texto_formulario">Correo:</td>
    <td height="50" align="left" valign="middle"><input name="correo" type="text" class="CapturaCorreo" id="correo" value="<?php echo base_html($filaActual->correo); ?>" maxlength="200" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon3" >
    <td height="50" align="left" valign="middle" class="texto_formulario">Tipo:</td>
    <td height="50" align="left" valign="middle"><span class="Folio">
      <select name="idtipousuario" id="idtipousuario" class="CapturaTipoUsuario">
        <?php
					   while($filaUsuario = mysqli_fetch_object($rsUsuario)){ ?>
        <option value="<?php echo $filaUsuario->idtipousuario; ?>" <?php if($filaActual->idtipousuario==$filaUsuario->idtipousuario){echo "selected";} ?>><?php echo base_html($filaUsuario->usuario_tipo); ?></option>
        <?php } ?>
      </select>
      <input name="idusuario" type="hidden" id="idusuario" value="<?php echo $item; ?>" />
    </span></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon4" >
    <td height="50" align="left" valign="middle" class="texto_formulario">&nbsp;</td>
    <td height="50" align="left" valign="middle"><input name="aceptar" type="submit" value="Cambios" class="boton_formulario" /></td>
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
