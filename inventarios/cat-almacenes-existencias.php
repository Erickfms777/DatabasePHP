<?php
//	session_start();
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(almacenesexistencias()==0){verificaseguridad();}
else
{
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$idalmacen=(int)$_GET["item"];
	$sql="SELECT cat_almacenes.* FROM cat_almacenes WHERE cat_almacenes.idalmacen=$idalmacen";
	$rs = mysqli_query($conn,$sql);
	$fila = mysqli_fetch_object($rs);
	$almacen=base_html($fila->almacen);
	$abreviatura=base_html($fila->abreviatura);
	$nivel=$_SESSION['nivel'];
	$sql="SELECT inventario.*,cat_productos.codigocorto,cat_productos.barcode,cat_productos.producto FROM inventario,cat_productos WHERE inventario.idproducto=cat_productos.idproducto AND inventario.idalmacen=$idalmacen ORDER BY inventario.idproducto"; //  echo $sql;
	$rs=mysqli_query($conn,$sql);
	$TotalRegistros=mysqli_num_rows($rs);
	$class = "renglon1";
	$TotalPiezas=0;
	
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
      <td height="30" colspan="4" align="center" valign="middle" bgcolor="#FFFFFF" ><span class="Titulo">Inventario de Almac&eacute;n <?php echo $almacen; ?> ( <?php echo $abreviatura; ?> )</span></td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="4" align="left" valign="middle" bgcolor="#FFFFFF" >
     
      </td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="4" align="left" valign="middle" bgcolor="#FFFFFF" ><span class="Peticion1"><?php echo "Registros encontrados: ".number_format($TotalRegistros,0,"",","); ?></span></td>
    </tr>
  <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
    <td>C&oacute;digo Corto</td>
    <td>Codigo de Barras</td>
    <td>Producto</td>
    <td width="170">Existencias</td>
    </tr>
  <?php while($fila = mysqli_fetch_object($rs)	){
			if($class == "renglon0" ){$class = "renglon1";} else {$class = "renglon0";}
			$TotalPiezas+=$fila->existencias;
  ?>
  <tr  class="<?php echo $class; ?>">
    <td><?php echo base_html($fila->codigocorto); ?></td>
    <td><?php echo base_html($fila->barcode); ?></td>
    <td height="25"><?php echo base_html($fila->producto); ?></td>
    <td><?php echo $fila->existencias; ?></td>
    </tr>
  <?php }  ?>
  <tr  class="renglon2">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="25">&nbsp;</td>
    <td><?php echo $TotalPiezas; ?></td>
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