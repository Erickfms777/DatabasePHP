<?php
//	session_start();
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(usuarioslistado()==0){verificaseguridad();}
else
{
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$nivel=$_SESSION['nivel'];
	$idusuario=$_SESSION['idusuario'];
	$sql="SELECT usuarios.*,cat_tipousuarios.usuario_tipo FROM usuarios,cat_tipousuarios WHERE usuarios.idtipousuario=cat_tipousuarios.idtipousuario  AND (usuarios.idtipousuario>$nivel OR usuarios.idusuario=$idusuario ) ORDER BY usuarios.idtipousuario,usuarios.idusuario";  // echo $sql;
	$rs=mysqli_query($conn,$sql);
	$TotalRegistros=mysqli_num_rows($rs);
	$class = "renglon1";
	
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
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="8" align="center" valign="middle" bgcolor="#FFFFFF" ><span class="Titulo">Cat&aacute;logo de Usuarios</span></td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="8" align="left" valign="middle" bgcolor="#FFFFFF" ><span class="Peticion1"><?php echo "Registros encontrados: ".number_format($TotalRegistros,0,"",","); ?></span></td>
    </tr>
  <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
    <td >Usuario</td>
    <td>Contrase&ntilde;a</td>
    <td>Nombre</td>
    <td>Correo</td>
    <td>Tipo Usuario</td>
    <td width="100">&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td width="100">&nbsp;</td>
  </tr>
  <?php while($fila = mysqli_fetch_object($rs)	){
			if($class == "renglon0" ){$class = "renglon1";} else {$class = "renglon0";}
  ?>
  <tr  class="<?php echo $class; ?>">
    <td height="25"><?php echo base_html($fila->usuario); ?></td>
    <td><?php echo base_html($fila->pasaporte); ?></td>
    <td><?php echo base_html($fila->nombre); ?></td>
    <td><?php echo base_html($fila->correo); ?></td>
    <td><?php echo base_html($fila->usuario_tipo); ?></td>
    <td><a href="cat-usuarios-consultar.php?item=<?php echo $fila->idusuario; ?>"><img src="imagenes/iconoconsultar.png" width="100" height="25" alt="Consultas" /></a></td>
    <td><a href="cat-usuarios-modificar.php?item=<?php echo $fila->idusuario; ?>"><img src="imagenes/iconomodificar.png" width="100" height="25" alt="Modificar" /></a></td>
    <td><?php if($idusuario!=$fila->idusuario){ ?><a href="cat-usuarios-baja.php?item=<?php echo $fila->idusuario; ?>"><img src="imagenes/iconobaja.png" width="100" height="25" alt="Eliminar" /></a><?php } ?></td>
  </tr>
  <?php }  ?>
</table>
<br /><br />

</div>
  	<?php require("pie.php"); ?>
</div>   

</body>
</html>
<?php } ?>