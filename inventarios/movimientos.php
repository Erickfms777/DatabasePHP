<?php
//	session_start();
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(movimientoslistado()==0){verificaseguridad();}
else
{
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$nivel=$_SESSION['nivel'];
	$sql="SELECT movimientos.*,cat_movimientos.descripcion as descripcionref FROM movimientos,cat_movimientos WHERE movimientos.idmovimientotipo=cat_movimientos.idmovimientotipo ORDER BY movimientos.idmovimiento";//   echo $sql;
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
  <?php require "movimientos-menu.php"; ?>

<div id="informacion">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="7" align="center" valign="middle" bgcolor="#FFFFFF" ><span class="Titulo">Movimientos al Inventario</span></td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="7" align="left" valign="middle" bgcolor="#FFFFFF" >
     
      </td>
    </tr>
    <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
      <td height="30" colspan="7" align="left" valign="middle" bgcolor="#FFFFFF" ><span class="Peticion1"><?php echo "Registros encontrados: ".number_format($TotalRegistros,0,"",","); ?></span></td>
    </tr>
  <tr class="TextoEncabezadoTablas" bgcolor="#1a447e">
    <td>Tipo de Movimiento</td>
    <td>Almac&eacute;n Origen</td>
    <td>Almacen Destino</td>
    <td>Referencia</td>
    <td>Descripci&oacute;n</td>
    <td width="100">Fecha</td>
    <td width="100">&nbsp;</td>
    </tr>
  <?php while($fila = mysqli_fetch_object($rs)	){
	  	$origen=$fila->origen; if($origen==0){$origenT="no aplica";}else{$sqlO="SELECT * FROM cat_almacenes WHERE idalmacen=$fila->origen";$rsO=mysqli_query($conn,$sqlO);$filaO=mysqli_fetch_object($rsO);$origenT=$filaO->almacen; }
		$destino=$fila->destino; if($destino==0){$destinoT="no aplica";}else{$sqlO="SELECT * FROM cat_almacenes WHERE idalmacen=$fila->destino";$rsO=mysqli_query($conn,$sqlO);$filaO=mysqli_fetch_object($rsO);$destinoT=$filaO->almacen; }
		$fecha=str_replace(".","",strftime("%d/%m/%Y",strtotime($fila->fecha)));
			if($class == "renglon0" ){$class = "renglon1";} else {$class = "renglon0";}
  ?>
  <tr  class="<?php echo $class; ?>">
    <td><?php echo base_html($fila->descripcionref); ?></td>
    <td><?php echo base_html($origenT); ?></td>
    <td><?php echo base_html($destinoT); ?></td>
    <td><?php echo base_html($fila->referencia); ?></td>
    <td height="25"><?php echo base_html($fila->descripcion); ?></td>
    <td><?php echo $fecha; ?></td>
    <td><a href="movimientos-consultar.php?item=<?php echo $fila->idmovimiento; ?>"><img src="imagenes/iconoconsultar.png" width="100" height="25" alt="Consultas" /></a></td>
    </tr>
  <?php }  ?>
  <tr  class="renglon2">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="25">&nbsp;</td>
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