<?php
include "../../config.php"; include "../../funciones/function.globales.php"; include "class.contenidos.php";
if($_GET['que']=="curso"){
		$salida_cvs = "Sede:,".$_GET['sede'].",";
		$salida_cvs .= "\n";
		$salida_cvs .= "Curso:,".$_GET['curso'].",";
		$salida_cvs .= "\n";
	$respasig = mysql_query("SELECT * from com_curso_asignar where id_curso=".$_GET['idcurso']."");
	$usuarios = mysql_query('select * from usuarios');
		$salida_cvs .= mysql_field_name($usuarios, 12).",";
		$salida_cvs .= mysql_field_name($usuarios, 4).",";
		$salida_cvs .= mysql_field_name($usuarios, 5).",";
		$salida_cvs .= mysql_field_name($usuarios, 6).",";
		$salida_cvs .= mysql_field_name($respasig, 3).",";
		$salida_cvs .= mysql_field_name($respasig, 4)."";
		$salida_cvs .= "\n";
	while($asigcurso = mysql_fetch_array($respasig)){
		$user = mysql_query("SELECT * FROM usuarios where id=".$asigcurso['id_usuario']."");
		$rowr = mysql_fetch_array($user);
		$salida_cvs .= $rowr['dni'].", ";
		$salida_cvs .= utf8_decode($rowr['nombres']).", ";
		$salida_cvs .= utf8_decode($rowr['apellidop']).", ";
		$salida_cvs .= utf8_decode($rowr['apellidom']).", ";
		$salida_cvs .= $asigcurso['fechainicio'].", ";
		$salida_cvs .= $asigcurso['fechafin']."";
		$salida_cvs .= "\n";
	}
}
else if($_GET['que']=="sede"){
		$salida_cvs = "Sede:,".$_GET['sede'].",";
		$salida_cvs .= "\n";
		$salida_cvs .= "Cursos:,".Reporte::nombrecursos($_GET['idsede'], true).",";
		$salida_cvs .= "\n";
	$respasig = mysql_query("SELECT * from com_curso_asignar where id_curso=".$_GET['idsede']."");
	$respcursos = mysql_query("select * from com_cursos where sede_id='".$_GET['idsede']."'");
	$usuarios = mysql_query('select * from usuarios');
		$salida_cvs .= mysql_field_name($usuarios, 12).",";
		$salida_cvs .= mysql_field_name($usuarios, 4).",";
		$salida_cvs .= mysql_field_name($usuarios, 5).",";
		$salida_cvs .= mysql_field_name($usuarios, 6).",";
		$salida_cvs .= mysql_field_name($respcursos, 1).",";
		$salida_cvs .= mysql_field_name($respasig, 3).",";
		$salida_cvs .= mysql_field_name($respasig, 4)."";
		$salida_cvs .= "\n";
	while($cursos = mysql_fetch_array($respcursos)){
		$respasig1 = mysql_query("SELECT * from com_curso_asignar where id_curso=".$cursos['curso_id']."");
		while($asigcurso = mysql_fetch_array($respasig1)){
			$user = mysql_query("SELECT * FROM usuarios where id=".$asigcurso['id_usuario']."");
			$rowr = mysql_fetch_array($user);
			$salida_cvs .= $rowr['dni'].", ";
			$salida_cvs .= utf8_decode($rowr['nombres']).", ";
			$salida_cvs .= utf8_decode($rowr['apellidop']).", ";
			$salida_cvs .= utf8_decode($rowr['apellidom']).", ";
			$salida_cvs .= utf8_decode($cursos['curso_nombre']).", ";
			$salida_cvs .= $asigcurso['fechainicio'].", ";
			$salida_cvs .= $asigcurso['fechafin']."";
			$salida_cvs .= "\n";
		}
	}
}
else if($_GET['que']=="examen"){
		$salida_cvs = "Sede:,".$_GET['sede'].",";
		$salida_cvs .= "\n";
		$salida_cvs .= utf8_decode("Exámen").":".",".$_GET['examen'].",";
		$salida_cvs .= "\n";
	$respasig = mysql_query("SELECT * from com_examen_asignar where id_examen=".$_GET['idexamen']."");
	$usuarios = mysql_query('select * from usuarios');
		$salida_cvs .= mysql_field_name($usuarios, 12).",";
		$salida_cvs .= mysql_field_name($usuarios, 4).",";
		$salida_cvs .= mysql_field_name($usuarios, 5).",";
		$salida_cvs .= mysql_field_name($usuarios, 6).",";
		$salida_cvs .= mysql_field_name($respasig, 3).",";
		$salida_cvs .= mysql_field_name($respasig, 4)."";
		$salida_cvs .= "\n";
	while($asigexamen = mysql_fetch_array($respasig)){
		$user = mysql_query("SELECT * FROM usuarios where id=".$asigexamen['id_usuario']."");
		$rowr = mysql_fetch_array($user);
		$salida_cvs .= $rowr['dni'].", ";
		$salida_cvs .= utf8_decode($rowr['nombres']).", ";
		$salida_cvs .= utf8_decode($rowr['apellidop']).", ";
		$salida_cvs .= utf8_decode($rowr['apellidom']).", ";
		$salida_cvs .= $asigexamen['fechainicio'].", ";
		$salida_cvs .= $asigexamen['fechafin']."";
		$salida_cvs .= "\n";
	}
}

header("Content-type: application/vnd.ms-excel; charset=UTF-8");
header("Content-disposition: csv".date("Y-m-d:")."_".LGlobal::Url_Amigable($config->lagcnombre).".csv");
header("Content-disposition: filename=".date("Y-m-d_H-i")."_".LGlobal::Url_Amigable($config->lagcnombre).".csv");
print $salida_cvs;
exit;
?>