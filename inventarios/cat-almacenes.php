<?php
//	session_start();
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(almaceneslistado()==0){verificaseguridad();}
else
{
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$nivel=$_SESSION['nivel'];
	$sql="SELECT cat_almacenes.* FROM cat_almacenes ORDER BY cat_almacenes.idalmacen"; //  echo $sql;
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
  <?php require "cat-almacenes-menu.php"; ?>

<div id="informacion">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="8" align="center" valign="middle" bgcolor="#FFFFFF" ><span class="Titulo">Cat&aacute;logo de almacenes</span></td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="8" align="left" valign="middle" bgcolor="#FFFFFF" >
     
      </td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="8" align="left" valign="middle" bgcolor="#FFFFFF" ><span class="Peticion1"><?php echo "Registros encontrados: ".number_format($TotalRegistros,0,"",","); ?></span></td>
    </tr>
  <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
    <td width="50">Abrev.</td>
    <td>Almac&eacute;n</td>
    <td>Ubicacion</td>
    <td>Descripci&oacute;n</td>
    <td width="100">&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td width="100">&nbsp;</td>
  </tr>
  <?php while($fila = mysqli_fetch_object($rs)	){
			if($class == "renglon0" ){$class = "renglon1";} else {$class = "renglon0";}
  ?>
  <tr  class="<?php echo $class; ?>">
    <td><?php echo base_html($fila->abreviatura); ?></td>
    <td><?php echo base_html($fila->almacen); ?></td>
    <td><?php echo base_html($fila->ubicacion); ?></td>
    <td height="25"><?php echo base_html($fila->descripcion); ?></td>
    <td><a href="cat-almacenes-existencias.php?item=<?php echo $fila->idalmacen; ?>"><img src="imagenes/iconoexistencias.png" width="100" height="25" alt="Consultas" /></a></td>
    <td><a href="cat-almacenes-consultar.php?item=<?php echo $fila->idalmacen; ?>"><img src="imagenes/iconoconsultar.png" width="100" height="25" alt="Consultas" /></a></td>
    <td><a href="cat-almacenes-modificar.php?item=<?php echo $fila->idalmacen; ?>"><img src="imagenes/iconomodificar.png" width="100" height="25" alt="Modificar" /></a></td>
    <td><a href="cat-almacenes-baja.php?item=<?php echo $fila->idalmacen; ?>"><img src="imagenes/iconobaja.png" width="100" height="25" alt="Eliminar" /></a></td>
  </tr>
  <?php }  ?>
  <tr  class="renglon2">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>  
</table>
<br /><br />

</div>
  	<?php require("pie.php"); ?>
</div>   

</body>
</html>
<?php } ?>

<script language="javascript">
function Filtros(form) { NuevoGrupo.action="cat-grupos-alta-filtros.php"; document.forms["NuevoGrupo"].submit() }
function AltaGrupo(form) { NuevoGrupo.action="cat-grupos-alta-sube.php"; document.forms["NuevoGrupo"].submit() }
</script>