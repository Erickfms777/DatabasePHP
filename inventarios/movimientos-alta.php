<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(movimientosaltas()==0){verificaseguridad();}
else
{
	include("conexion.php");
	include("utilerias.php");
	setlocale(LC_TIME,"es_MX");
	$conn=abre_conexion();
	$idusuario=$_SESSION['idusuario'];
	$idmovimientotipo=$_SESSION['idmovimientotipo'];
	$origen=$_SESSION['origen'];
	$destino=$_SESSION['destino'];
	$referencia=$_SESSION['referencia'];
	$descripcion=$_SESSION['descripcion'];
	$fecha=$_SESSION['fecha'];	
	$mensaje=$_SESSION['mensaje']; //echo $mensaje;
	$validacion=$_SESSION['validacion'];// echo $validacion;
	$cantidad=$_SESSION['cantidad'];
	$codigo=$_SESSION['codigo'];
	$sqlReg="SELECT * FROM movimientos_desglose_aux WHERE movimientos_desglose_aux.idusuario=$idusuario ORDER BY idmovimientodesglose";//echo $sqlReg;
	$rsReg = mysqli_query($conn,$sqlReg);
	$totalReg = mysqli_num_rows($rsReg); 
	$sqlTipoMov="SELECT * FROM cat_movimientos ORDER BY idmovimientogrupo,idmovimientotipo"; //echo $sqlTipoMov;
	$rsTipoMov= mysqli_query($conn,$sqlTipoMov);
	if($origen==0){$oritenTexto="No aplica";}else{$sqlAlmacenOrigen="SELECT * FROM cat_almacenes ORDER BY idalmacen";$rsAlmacenOrigen= mysqli_query($conn,$sqlAlmacenOrigen);}
	if($destino==0){$destinoTexto="No aplica";}else{$sqlAlmacenDestino="SELECT * FROM cat_almacenes ORDER BY idalmacen";$rsAlmacenDestino= mysqli_query($conn,$sqlAlmacenDestino);}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Monograf- Sistema de Inventarios</title>
<link rel="stylesheet" href="estilos/estilos.css">
<link rel="stylesheet" href="estilos/menu.css">
</head>
<body>
<?php
//require "inicializa.php";
?>
<div id="contenedor">
	<?php require("encabezado-logotipo.php"); ?>
	<?php require("encabezado-usuario.php"); ?>
  <?php require "encabezado-menusuperior.php"; ?>
  <?php require "movimientos-menu.php"; ?>

<div id="informacion">
<script type="text/javascript" language="javascript" src="scripts/movimientos-alta-validaregistro.js"></script>
<form name="MovimientosAlta" id="MovimientosAlta" action="movimientos-alta-sube.php" method="post" target="_top">
<h1>Movimientos al Inventario - Nuevo</h1><br />
<br />

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr class="renglon1">
      <td width="20%" height="40" align="left" valign="middle" class="texto_formulario">Tipo de Movimiento:</td>
      <td height="40" align="left" valign="middle">
      <select name=" idmovimientotipo" id=" idmovimientotipo" class="captura_fuente" onchange="EligeTipoMovimiento(this.form)">
        <?php
		   while($filaTipoMov = mysqli_fetch_object($rsTipoMov)){ ?>
        <option value="<?php echo $filaTipoMov->idmovimientotipo; ?>" <?php if($filaTipoMov->idmovimientotipo==$idmovimientotipo){echo "selected";} ?> ><?php echo base_html($filaTipoMov->descripcion); ?></option>
        <?php } ?>
      </select></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon2">
      <td height="40" align="left" valign="middle" class="texto_formulario">Almacen Origen: </td>
      <td height="40" align="left" valign="middle">
      <?php if($origen==0){?>
	      <select name="idalmacenorigen" id="idalmacenorigen" class="captura_fuente" onchange="FiltraDestino(this.form)">
          <option value="0">No aplica</option>
			<?php }else{ ?>
      		<select name="idalmacenorigen" id="idalmacenorigen" class="captura_fuente" onchange="FiltraDestino(this.form)">
    	    <?php
			   while($filaAlmacenOrigen = mysqli_fetch_object($rsAlmacenOrigen)){ ?>
	        <option value="<?php echo $filaAlmacenOrigen->idalmacen; ?>" <?php if($filaAlmacenOrigen->idalmacen==$origen){echo "selected";} ?> ><?php echo base_html($filaAlmacenOrigen->almacen); ?></option>
        	<?php } }?>
            
      </select></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon1">
      <td height="40" align="left" valign="middle" class="texto_formulario">Almacen Destino: </td>
      <td height="40" align="left" valign="middle">
      <?php if($destino==0){?>
	      <select name="idalmacendestino" id="idalmacendestino" class="captura_fuente">
          <option value="0">No aplica</option>
			<?php }else{ ?>
        <select name="idalmacendestino" id="idalmacendestino" class="captura_fuente">
          <?php
			   while($filaAlmacenDestino = mysqli_fetch_object($rsAlmacenDestino)){ 
			   if($origen!=$filaAlmacenDestino->idalmacen){?>
          <option value="<?php echo $filaAlmacenDestino->idalmacen; ?>" <?php if($filaAlmacenDestino->idalmacen==$destino){echo "selected";} ?> ><?php echo base_html($filaAlmacenDestino->almacen); ?></option>
          <?php }} }?>
        </select></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon2">
      <td height="40" align="left" valign="middle" class="texto_formulario">Referencia:</td>
      <td height="40" align="left" valign="middle"><input name="referencia" type="text" class="CapturaContrato" id="referencia" value="<?php echo $referencia; ?>" maxlength="200" /></td>
      <td width="10" align="left" valign="middle"></td>
    </tr>
    <tr class="renglon1">
      <td height="40" align="left" valign="middle" class="texto_formulario">Descripci&oacute;n:</td>
      <td height="40" align="left" valign="middle"><input name="descripcion" type="text"  class="CapturaProducto" id="descripcion" value="<?php echo $descripcion; ?>" /></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon2">
      <td height="40" align="left" valign="middle" class="texto_formulario">Fecha</td>
      <td height="40" align="left" valign="middle"><input name="fecha" type="date" class="CapturaFecha" id="fecha" value="<?php echo $fecha; ?>" size="100" maxlength="100" /></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon2" >
      <td height="2" colspan="3" align="left" valign="middle" bgcolor="#000000" ></td>
    </tr>
  </table>
<br>

<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#336600" class="bordetablacompleto">
  <tr>
    <td height="30"><table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr class="texto_formulario">
        <td width="85" height="50" align="left" valign="middle">Cantidad</td>
        <td width="125" align="left" valign="middle"><label for="cantidad"></label>
          <input name="cantidad" type="text" class="CapturaCP" id="cantidad" value="<?php echo $cantidad; ?>" /></td>
        <td width="85" align="left" valign="middle">Producto</td>
        <td width="125"><input name="codigo" type="text"  class="CapturaProducto" id="codigo" value="<?php echo $codigo; ?>" /></td>
        <td width="160" align="center" valign="middle"><input type="submit" class="btAgrega" name="btAgrega2" id="btAgrega2" value="Agregar Producto" onclick="ValidaRegistro(this.form)" /></td>
      </tr>
      <tr class="texto_formulario">
        <td height="10" colspan="5" align="left" valign="middle"><?php echo $validacion; ?></td>
        </tr>
    </table></td>
  </tr>
<?php if($totalReg!=0){ ?>

  <tr>
    <td height="30">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr class="TextoEncabezadoTablas">
        <td height="20" align="left" valign="middle" bgcolor="#666666">Cantidad</td>
        <td align="left" valign="middle" bgcolor="#666666">C&oacute;digo Corto</td>
        <td align="left" valign="middle" bgcolor="#666666">C&oacute;digo de Barras</td>
        <td align="left" valign="middle" bgcolor="#666666">Descripci&oacute;n</td>
        <td align="center" valign="middle" bgcolor="#666666">&nbsp;</td>
      </tr>
    <?php 
		while ($filaReg = mysqli_fetch_object($rsReg)){ ?>

      <tr class="texto_formulario">
        <td height="30" align="left" valign="middle"><?php echo $filaReg->cantidad; ?></td>
        <td align="left" valign="middle"><?php echo $filaReg->codigocorto; ?></td>
        <td align="left" valign="middle"><?php echo $filaReg->barcode; ?></td>
        <td align="left" valign="middle"><?php echo base_html($filaReg->producto); ?></td>
        <td width="160" align="center" valign="middle"><input type="submit" class="btBorra" name="btBorrar" id="btBorrar" value="Borrar Producto" onclick="BorraRegistro(this.form,<?php echo $filaReg->idmovimientodesglose; ?>)" /></td>
      </tr>
      <?php  } ?>
    </table>
    </td>
  </tr>
  <?php } ?>
  </table>
<br />

<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" align="center" valign="middle"><input name="aceptar" type="submit" value="Genera Movimiento" onclick="RealizaMovimiento(this.Form);" class="boton_formulario" />
      <input name="idusuario" type="hidden" id="idusuario" value="<?php echo $idusuario; ?>" />
      <input type="hidden" name="registro" id="registro" /></td>
  </tr>
</table>
<br />
<br />
</form>
<br />
<script language="javascript">
function EligeTipoMovimiento(form){ MovimientosAlta.action="movimientos-alta-eligemovimiento.php"; MovimientosAlta.target="_top"; form.submit();}
function FiltraDestino(form){ MovimientosAlta.action="movimientos-alta-filtradestino.php"; MovimientosAlta.target="_top"; form.submit();}
function RealizaMovimiento(form){ MovimientosAlta.action="movimientos-alta-sube.php"; MovimientosAlta.target="_top"; form.submit();}
function AgregaRegistro(form){ MovimientosAlta.action="movimientos-alta-registro.php"; MovimientosAlta.target="_top"; form.submit();}
function BorraRegistro(form,registro){document.MovimientosAlta.registro.value =registro; MovimientosAlta.action="movimientos-alta-regborra.php"; ComprasAlta.target="_top"; form.submit();}
</script>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>
  	<?php require("pie.php"); ?>
</div> 
<?php if($mensaje!="") { ?>
	<script language="javascript">
		alert('<?php echo $mensaje; ?>');
	</script>
<?php } ?>
</body>
</html>
<?php } ?>
