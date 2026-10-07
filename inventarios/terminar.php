<?php
	include("conexion.php");
	session_start();
	session_unset();
	session_destroy();
	$conn=abre_conexion();
	mysqli_close($conn);
?>
<form name="terminar" method="post" action="index.php" target="_top">
</form>
<script language="javascript">
terminar.submit();
</script>