<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include("permisos.php");}
if(usuariosaltas()==0){verificaseguridad();}
else
{	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$nivel=$_SESSION['nivel'];	
	$sql="SELECT * FROM cat_tipousuarios WHERE idtipousuario>$nivel ORDER BY idtipousuario";
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
<form id="AltaUsuario" name="AltaUusario" method="post" action="cat-usuarios-alta-sube.php">
<h1> Usuarios - Altas</h1><br />
<table width="50%" border="0" align="center" cellpadding="1" cellspacing="0" >
  <tr class="renglon1">
    <td height="40" align="left" valign="middle" class="texto_formulario">Usuario:</td>
    <td height="40" align="left" valign="middle"><input name="usuario" type="text" class="CapturaUsuario" id="usuario" maxlength="20" /></td>
    <td width="10" align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2">
    <td height="40" align="left" valign="middle" class="texto_formulario">Contrase&ntilde;a:</td>
    <td height="40" align="left" valign="middle"><input name="pasaporte" type="text" class="CapturaPassword" id="pasaporte" maxlength="20" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon1">
    <td height="40" align="left" valign="middle" class="texto_formulario">Nombre:</td>
    <td height="40" align="left" valign="middle"><input name="nombre" type="text" class="CapturaNombre" id="nombre" maxlength="100" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2" >
    <td height="50" align="left" valign="middle" class="texto_formulario">Correo:</td>
    <td height="50" align="left" valign="middle"><input name="correo" type="text" class="CapturaCorreo" id="correo" maxlength="100" /></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon1" >
    <td height="50" align="left" valign="middle" class="texto_formulario">Tipo:</td>
    <td height="50" align="left" valign="middle"><span class="Folio">
      <select name="idtipousuario" id="idtipousuario" class="CapturaTipoUsuario">
        <?php
					   while($filaUsuario = mysqli_fetch_object($rsUsuario)){ ?>
        <option value="<?php echo $filaUsuario->idtipousuario; ?>"><?php echo base_html($filaUsuario->usuario_tipo); ?></option>
        <?php } ?>
      </select>
    </span></td>
    <td align="left" valign="middle"></td>
  </tr>
  <tr class="renglon2" >
    <td height="50" align="left" valign="middle" class="texto_formulario">&nbsp;</td>
    <td height="50" align="left" valign="middle"><input name="aceptar" type="submit" value="Guardar" class="boton_formulario" /></td>
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
