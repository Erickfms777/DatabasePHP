<?php
// Se obtiene cuantas semanas tiene un mes
function nSemanas($month, $year) {
	date_default_timezone_set('America/Mexico_City');	
    $dayend = cal_days_in_month(CAL_GREGORIAN,$month,$year); echo $dayend.":";
    if ($month<10) { $add = "-0"; } else {
    $add = "-"; }
    $date1 = $year.$add.$month."-01"; echo "<br>:".date("F",strtotime($date1))." : ".$date1.":dia:".date("N",strtotime($date1)).":";
    $date2 = $year.$add.$month."-".$dayend; echo $date2.":dia:".date("N",strtotime($date2)).":<br>"; 
	if($month==1){$weeks = date("W",strtotime($date2));}
	else{ $weeks = date("W",strtotime($date2))-date("W",strtotime($date1)) + 1;}
    return $weeks;
}

function dianumericofecha($day,$month,$year)
{
	$day=str_pad($day,2,"0",STR_PAD_LEFT);
	$month=str_pad($month,2,"0",STR_PAD_LEFT);	
	$year=str_pad($year,4,"0",STR_PAD_LEFT);
	return date("N",strtotime($year."-".$month."-".$day));
}

function DiferenciaMeses($fecha1,$fecha2)
{
	// Las fechas en formato "Y-m-d"
	$fechainicial = new DateTime($fecha1);
	$fechafinal = new DateTime($fecha2);
	$diferencia = $fechainicial->diff($fechafinal);
	$meses = ( $diferencia->y * 12 ) + $diferencia->m;
	return $meses;
}


function MesFecha($mes)
{
	switch($mes)
	  {
		case 1: $MM="ENERO"; break;
		case 2: $MM="FEBRERO"; break;
		case 3: $MM="MARZO"; break;
		case 4: $MM="ABRIL"; break;
		case 5: $MM="MAYO"; break;
		case 6: $MM="JUNIO"; break;
		case 7: $MM="JULIO"; break;
		case 8: $MM="AGOSTO"; break;
		case 9: $MM="SEPTIEMBRE"; break;
		case 10: $MM="OCTUBRE"; break;
		case 11: $MM="NOVIEMBRE"; break;
		case 12: $MM="DICIEMBRE"; break;
	  }
	return $MM;
}


// Obtiene el día de fecha formato dd/mm/yyyy yyyy/mm/dd
function diafechaddmmyyyy($fecha)
{
	return substr($fecha,8,2);
}

// Obtiene el día de fecha formato dd/mm/yyyy
function mesnumfechaddmmyyyy($fecha)
{
	return substr($fecha,5,2);
}


//obtiene el mes alfabético de fecha formato 22/mm/yyyy
function mesfechaddmmyyyy($fecha)
{
	$mes=substr($fecha,5,2);
	switch($mes)
	  {
		case "01": $MM="ENERO"; break;
		case "02": $MM="FEBRERO"; break;
		case "03": $MM="MARZO"; break;
		case "04": $MM="ABRIL"; break;
		case "05": $MM="MAYO"; break;
		case "06": $MM="JUNIO"; break;
		case "07": $MM="JULIO"; break;
		case "08": $MM="AGOSTO"; break;
		case "09": $MM="SEPTIEMBRE"; break;
		case "10": $MM="OCTUBRE"; break;
		case "11": $MM="NOVIEMBRE"; break;
		case "12": $MM="DICIEMBRE"; break;
	  }
	return $MM;
}


// Obtiene el año de fecha formato dd/mm/yyyy
function yearfechaddmmyyyy($fecha)
{
	return substr($fecha,0,4);
}

// convierte fecha de fotmato yyyy-mm-dd a mm/dd/yyyy
function mysqltofecha($fecha_mysql)
{
  if($fecha_mysql=="") {return "";}	else{  return substr($fecha_mysql,5,2).'/'.substr($fecha_mysql,8,2).'/'.substr($fecha_mysql,0,4);}
}
// convierte fecha de fotmato dd/mm/yyyy a yyyy-mm-dd 
function fechatomysql($fecha)
{
  if(trim($fecha)=="") {return "";}	else{  return substr($fecha,6,4).'-'.substr($fecha,3,2).'-'.substr($fecha,0,2);}
}

// convierte fecha de fotmato yyyy-mm-dd a dd/mm/yyyy
function mysqltoddmmyyy($fecha_mysql)
{
  if($fecha_mysql=="") {return "";}	else{  return substr($fecha_mysql,8,2).'/'.substr($fecha_mysql,5,2).'/'.substr($fecha_mysql,0,4);}
}


// convierte fecha de fotmato yyyy-mm-dd a dd/mm/yyyy
function mysqltoddMMyyyy($fecha_mysql)
{
  if($fecha_mysql=="") {return "";}
  else
  {
	  $dd=substr($fecha_mysql,8,2);
	  $mm=substr($fecha_mysql,5,2);
	  switch($mm)
	  {
		case "01": $MM="ene"; break;
		case "02": $MM="feb"; break;
		case "03": $MM="mar"; break;
		case "04": $MM="abr"; break;
		case "05": $MM="may"; break;
		case "06": $MM="jun"; break;
		case "07": $MM="jul"; break;
		case "08": $MM="ago"; break;
		case "09": $MM="sep"; break;
		case "10": $MM="oct"; break;
		case "11": $MM="nov"; break;
		case "12": $MM="dic"; break;
	  }
	  $yyyy=substr($fecha_mysql,0,4);
	  return $dd.'/'.$MM.'/'.$yyyy;
  }
}

function mmddyyy_to_ddmmyyy($fecha)
{
  if($fecha=="") {return "";}	else{  return substr($fecha,3,2).'/'.substr($fecha,0,2).'/'.substr($fecha,6,4);}
}
function fecha_mas_dias($fecha,$dias)
{
	$nuevafecha = strtotime ( '+'.$dias.' day' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
	return $nuevafecha;
}

// compara fechas en formato dd/mm/yyyy
function compararFechas($primera, $segunda)
 {
  $valoresPrimera = explode ("/", $primera);   
  $valoresSegunda = explode ("/", $segunda); 

  $diaPrimera    = $valoresPrimera[0];  
  $mesPrimera  = $valoresPrimera[1];  
  $anyoPrimera   = $valoresPrimera[2]; 

  $diaSegunda   = $valoresSegunda[0];  
  $mesSegunda = $valoresSegunda[1];  
  $anyoSegunda  = $valoresSegunda[2];

  $diasPrimeraJuliano = gregoriantojd($mesPrimera, $diaPrimera, $anyoPrimera);  
  $diasSegundaJuliano = gregoriantojd($mesSegunda, $diaSegunda, $anyoSegunda);     

  if(!checkdate($mesPrimera, $diaPrimera, $anyoPrimera)){
    // "La fecha ".$primera." no es v&aacute;lida";
    return 0;
  }elseif(!checkdate($mesSegunda, $diaSegunda, $anyoSegunda)){
    // "La fecha ".$segunda." no es v&aacute;lida";
    return 0;
  }else{
    return  $diasPrimeraJuliano - $diasSegundaJuliano;
  } 

}
function base_html($cadena)
{
//	return($cadena);
	return(utf8_encode($cadena)); 
}

function html_base($cadena)
{
//	return($cadena);
	return(utf8_decode($cadena)); 
}

function CerrarConexion($conn){
	mysqli_close($conn);
}


?>

