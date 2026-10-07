<?php
//	session_start();
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(productoslistado()==0){verificaseguridad();}
else
{
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$nivel=$_SESSION['nivel'];
	$sql="SELECT cat_productos.* FROM cat_productos ORDER BY cat_productos.idproducto"; //  echo $sql;
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
  <?php require "cat-productos-menu.php"; ?>

<div id="informacion">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="8" align="center" valign="middle" bgcolor="#FFFFFF" ><span class="Titulo">Cat&aacute;logo de productos</span></td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="8" align="center" valign="middle" bgcolor="#FFFFFF" >
      <?php if(productosimportar()==0){verificaseguridad();}
		else
		{ ?>
		<form action="cat-productos-importar.php" method="post" enctype="multipart/form-data" name="ProductosImportar" id="ProductosImportar">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="30%" height="30">
          <input name="productos" type="file" id="productos" size="30" maxlength="100" accept=".xlsx" class="CapturaArchivo" /></td>
          <td><input name="aceptar" type="submit" value="Importar Productos" class="boton_formulario" /></td>
        </tr>
      </table>
     </form> 
      <?php } ?>
      
      </td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="7" align="left" valign="middle" bgcolor="#FFFFFF" >
      </td>
      <td height="30" align="left" valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="8" align="left" valign="middle" bgcolor="#FFFFFF" ><span class="Peticion1"><?php echo "Registros encontrados: ".number_format($TotalRegistros,0,"",","); ?></span></td>
    </tr>
  <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
    <td height="30">C&oacute;digo Corto</td>
    <td>Codigo de Barras</td>
    <td>Producto</td>
    <td width="250">Existencias <br />
      Almacenes</td>
    <td width="50">Exis<br />
      Total</td>
    <td width="80">&nbsp;</td>
    <td width="80">&nbsp;</td>
    <td width="80">&nbsp;</td>
  </tr>
  <?php while($fila = mysqli_fetch_object($rs)	){
			if($class == "renglon0" ){$class = "renglon1";} else {$class = "renglon0";}
			$TotalPiezas+=$fila->existencias;
  ?>
  <tr  class="<?php echo $class; ?>">
    <td><?php echo base_html($fila->codigocorto); ?></td>
    <td><?php echo base_html($fila->barcode); ?></td>
    <td height="25"><?php echo base_html($fila->producto); ?></td>
    <td>
    	<?php
			$sqlAlmacenes="SELECT * FROM cat_almacenes ORDER BY idalmacen";
			$rsAlmacenes=mysqli_query($conn,$sqlAlmacenes);
			while($filaAlmacenes = mysqli_fetch_object($rsAlmacenes))
			{
				$idAlmacen=$filaAlmacenes->idalmacen;
				$sqlInventarios="SELECT * FROM inventario WHERE idalmacen=$idAlmacen AND idproducto=$fila->idproducto";// echo $sqlInventarios;
				$rsInventarios=mysqli_query($conn,$sqlInventarios);
				$totalInventarios = mysqli_num_rows($rsInventarios);
				if($totalInventarios==0)
				{
					$cadExistencias="000";
				}
				else
				{
					$filaInventarios=mysqli_fetch_object($rsInventarios);
					$cadExistencias=str_pad($filaInventarios->existencias,3,"0",STR_PAD_LEFT);
				}
				 echo $filaAlmacenes->abreviatura.":".$cadExistencias." ";?>&brvbar;&nbsp;<?php 
			}
		?>
    </td>
    <td><?php echo $fila->existencias; ?></td>
    <td><a href="cat-productos-consultar.php?item=<?php echo $fila->idproducto; ?>"><img src="imagenes/iconoconsultar.png" width="100" height="25" alt="Consultas" /></a></td>
    <td><a href="cat-productos-modificar-inicializa.php?item=<?php echo $fila->idproducto; ?>"><img src="imagenes/iconomodificar.png" width="100" height="25" alt="Modificar" /></a></td>
    <td><a href="cat-productos-baja.php?item=<?php echo $fila->idproducto; ?>"><img src="imagenes/iconobaja.png" width="100" height="25" alt="Eliminar" /></a></td>
  </tr>
  <?php }  ?>
  <tr  class="renglon2">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
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