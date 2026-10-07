<?php
	session_start();
	include("conexion.php");
	include("utilerias.php");	
	$conn=abre_conexion();
	$sql="SELECT * FROM parametros";
	$rs = mysqli_query($conn,$sql);
	$fila = mysqli_fetch_object($rs);
	$sistema=base_html($fila->sistema);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Monograf- Sistema de Inventarios</title>
<link rel="stylesheet" href="estilos/estilos.css">
</head>
<body>
<div id="contenedor">
	<?php require("encabezado-logotipo.php"); ?>
	<div id="header_texto"><?php echo $sistema; ?></div>
    
<section class="centro">
<br /><br /><br /><br />

<form id="form" name="form" method="post" action="validar.php">
<p>&nbsp;&nbsp;</p>
<table width="600" border="0" align="center" cellpadding="1" cellspacing="0" style="border:0px;">
  <tr>
    <td width="130" height="50" align="left" valign="middle" class="texto_formulario">Usuario:&nbsp;</td>
    <td align="left" valign="middle"><input name="usuario" type="text" id="usuario" size="25" maxlength="25" / class="CapturaNombre"></td>
  </tr>
  <tr>
    <td height="50" align="left" valign="middle" class="texto_formulario">Contrase&ntilde;a:&nbsp;</td>
    <td align="left" valign="middle"><input name="pasaporte" type="password"  id="pasaporte" size="25" maxlength="25" / class="CapturaNombre"></td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input name="Ingresar" type="submit" value="Ingresar" class="boton_formulario" /></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</form>
</section>    
  	<?php require("pie.php"); ?>
</div> 
<?php if(isset($_GET["msj"])) { ?>
	<script language="javascript">
		alert('<?php echo $_GET["msj"]; ?>');
	</script>
<?php } ?>
</body>
</html>