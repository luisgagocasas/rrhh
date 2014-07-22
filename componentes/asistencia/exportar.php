<?php
include "../../config.php"; include "../../funciones/function.globales.php";
$respasig = mysql_query("SELECT * from com_asistencia");
$salida_cvs .= mysql_field_name($respasig, 2).",";
$salida_cvs .= mysql_field_name($respasig, 3).",";
$salida_cvs .= mysql_field_name($respasig, 4).",";
$salida_cvs .= mysql_field_name($respasig, 5).",";
$salida_cvs .= mysql_field_name($respasig, 6).",";
$salida_cvs .= mysql_field_name($respasig, 7).",";
$salida_cvs .= mysql_field_name($respasig, 8)."";
$salida_cvs .= "\n";
while($asistencia = mysql_fetch_array($respasig)){
	$salida_cvs .= utf8_decode($asistencia['apellidop']).",";
	$salida_cvs .= utf8_decode($asistencia['apellidom']).",";
	$salida_cvs .= utf8_decode($asistencia['nombre']).",";
	$salida_cvs .= utf8_decode($asistencia['dni']).",";
	$salida_cvs .= utf8_decode($asistencia['ensa']).",";
	$salida_cvs .= utf8_decode($asistencia['sede']).",";
	$salida_cvs .= date("Y-m-d H-i",$asistencia['fecha'])."";
	$salida_cvs .= "\n";
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv".date("Y-m-d:")."_".LGlobal::Url_Amigable($config->lagcnombre).".csv");
header("Content-disposition: filename=asistencia_".date("Y-m-d_H-i")."_".LGlobal::Url_Amigable($config->lagcnombre).".csv");
print $salida_cvs;
exit;
?>