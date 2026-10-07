<?php
include("seguridad.php");
if(!function_exists("parametrizarpermisos")){ include ("permisos.php");}
if(movimientosconsultas()==0){verificaseguridad();}
else
{
	include("conexion.php");
	include("utilerias.php");
	$conn=abre_conexion();
	$idmovimiento=$_GET['item'];
	$sql="SELECT movimientos.*,cat_movimientos.descripcion as descrip FROM movimientos,cat_movimientos WHERE movimientos.idmovimientotipo=cat_movimientos.idmovimientotipO AND movimientos.idmovimiento=$idmovimiento";
	$rs=mysqli_query($conn,$sql);
	$fila = mysqli_fetch_object($rs);
	$sqlUsr="SELECT * FROM usuarios WHERE idusuario=$fila->idusuario";
	$rsUsr=mysqli_query($conn,$sqlUsr);
	$filaUsr = mysqli_fetch_object($rsUsr);
	$nombreusuario=base_html($filaUsr->nombre);
	$fecha=str_replace(".","",strftime("%d/%m/%Y",strtotime($fila->fecha)));
	$origen=$fila->origen;
	if($origen==0){$origenT="No aplica";}else{$sqlO="SELECT * FROM cat_almacenes WHERE idalmacen=$origen"; $rsO=mysqli_query($conn,$sqlO);$filaO = mysqli_fetch_object($rsO); $origenT=base_html($filaO->almacen);}
	$destino=$fila->destino;
	if($destino==0){$destinoT="No aplica";}else{$sqlD="SELECT * FROM cat_almacenes WHERE idalmacen=$destino"; $rsD=mysqli_query($conn,$sqlD);$filaD=mysqli_fetch_object($rsD); $destinoT=base_html($filaD->almacen);}	
	$sqlReg="SELECT * FROM movimientos_desglose WHERE movimientos_desglose.idmovimiento=$idmovimiento ORDER BY idmovimientodesglose";// echo $sqlReg;
	$rsReg = mysqli_query($conn,$sqlReg);
	$totalReg = mysqli_num_rows($rsReg); 
	$class = "renglon1";
	$TotalPiezas=0;
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

<div id="contenedor">
	<?php require("encabezado-logotipo.php"); ?>
	<?php require("encabezado-usuario.php"); ?>
  <?php require "encabezado-menusuperior.php"; ?>
  <?php require "movimientos-menu.php"; ?>

<div id="informacion">
<script type="text/javascript" language="javascript" src="scripts/remisiones-alta.js"></script>
<h1>Movimientos al Inventario   - Consultar</h1><br />
<br />

<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr class="renglon1">
      <td height="40" align="left" valign="middle" class="texto_formulario">Tipo de Movimiento</td>
      <td height="40" align="left" valign="middle"  class="texto_formulario"><?php echo base_html($fila->descrip); ?></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon0">
      <td height="40" align="left" valign="middle" class="texto_formulario">Almacen Origen</td>
      <td height="40" align="left" valign="middle"  class="texto_formulario"><?php echo $origenT; ?></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon1">
      <td height="40" align="left" valign="middle" class="texto_formulario">Almacen destino:</td>
      <td height="40" align="left" valign="middle"  class="texto_formulario"><?php echo $destinoT; ?></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon0">
      <td height="40" align="left" valign="middle" class="texto_formulario">Referencia: </td>
      <td height="40" align="left" valign="middle"  class="texto_formulario"><?php echo base_html($fila->referencia); ?></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon1">
      <td height="40" align="left" valign="middle" class="texto_formulario">Descripcion: </td>
      <td height="40" align="left" valign="middle"><span class="texto_formulario"><?php echo base_html($fila->descripcion); ?></span></td>
      <td align="left" valign="middle"></td>
    </tr>
    <tr class="renglon0">
      <td height="40" align="left" valign="middle" class="texto_formulario">Fecha:</td>
      <td height="40" align="left" valign="middle"><span class="texto_formulario"><?php echo $fecha; ?></span></td>
      <td width="10" align="left" valign="middle"></td>
    </tr>
    <?php if(movimientosconsultasusuario()==1) { ?>
    <tr class="renglon1">
      <td height="40" align="left" valign="middle" class="texto_formulario">Usuario:</td>
      <td height="40" align="left" valign="middle"><span class="texto_formulario"><?php echo $nombreusuario; ?></span></td>
      <td align="left" valign="middle"></td>
    </tr>
    <?php } ?>
    <tr class="renglon2" >
      <td height="2" colspan="3" align="left" valign="middle" bgcolor="#000000" ></td>
    </tr>
  </table>
<br>

<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#336600" class="bordetablacompleto">
  <?php if($totalReg!=0){ ?>

  <tr>
    <td height="30">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr class="TextoEncabezadoTablas">
        <td height="20" align="left" valign="middle" bgcolor="#1A447E">Cantidad</td>
        <td align="left" valign="middle" bgcolor="#1A447E">Codigo Corto</td>
        <td align="left" valign="middle" bgcolor="#1A447E">C&oacute;digo de Barras</td>
        <td align="left" valign="middle" bgcolor="#1A447E">Producto</td>
        </tr>
    <?php 
		while ($filaReg = mysqli_fetch_object($rsReg)){
			if($class == "renglon0" ){$class = "renglon1";} else {$class = "renglon0";}
			$TotalPiezas+=$filaReg->cantidad;			
			 ?>

      <tr class="<?php echo $class; ?>">
        <td height="30" align="left" valign="middle"><?php echo $filaReg->cantidad; ?></td>
        <td align="left" valign="middle"><?php echo $filaReg->codigocorto; ?></td>
        <td align="left" valign="middle"><?php echo $filaReg->barcode; ?></td>
        <td align="left" valign="middle"><?php echo base_html($filaReg->producto); ?></td>
        </tr>
      <?php   } ?>
      <tr class="texto_formulario">
        <td height="30" align="left" valign="middle"><?php echo $TotalPiezas." Piezas"; ?></td>
        <td align="left" valign="middle"></td>
        <td align="left" valign="middle"></td>
        <td align="left" valign="middle"></td>
        </tr>      
    </table>
    </td>
  </tr>
  <?php } ?>
  <tr class="texto_formulario">
    <td align="right" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
<blockquote>
  <blockquote>
    <blockquote>
      <p><br />
        
      </p>
    </blockquote>
  </blockquote>
</blockquote>
<blockquote>
  <blockquote>
    <blockquote>
      <p><br />
        <br />
        <br />
      </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </blockquote>
    </blockquote>
</blockquote>
</div>
  	<?php require("pie.php"); ?>
</div> 

</body>
</html>
<?php } ?>
