<?php
	include("seguridad.php");
	include("utilerias.php");	
	include("conexion.php");
	$conn=abre_conexion();
	$idusuario=$_SESSION['idusuario'];
	$idmovimientotipo=$_POST['idmovimientotipo'];
	$_SESSION['idmovimientotipo']=$idmovimientotipo;
	$origen=$_POST['idalmacenorigen'];
	$_SESSION['origen']=$origen;
	$destino=$_POST['idalmacendestino'];
	$_SESSION['destino']=$destino;
	$_SESSION['referencia']=html_base($_POST['referencia']);
	$_SESSION['descripcion']=html_base($_POST['descripcion']);
	$_SESSION['fecha']=$_POST['fecha'];
	$_SESSION['validacion']="";
	$registro=$_POST["registro"];
	$sql="DELETE FROM movimientos_desglose_aux WHERE idmovimientodesglose=$registro";// echo $sql;
	mysqli_query($conn,$sql);
?>
<form name="MovsAlta" method="post" enctype="multipart/form-data" action="movimientos-alta.php"></form>
<script language="javascript">
document.forms["MovsAlta"].submit();
</script>
