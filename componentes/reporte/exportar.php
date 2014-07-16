<?php
include "../../config.php"; include "../../funciones/function.globales.php";
$result = mysql_query("SHOW COLUMNS FROM usuarios");
$i = 0;
if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
		$i++;
	}
}
$values = mysql_query("SELECT apellidop,apellidom,nombres,dni,cargo,fechanacimiento,fechaingresoempresa,email,celular,gsanguineo FROM usuarios ORDER BY apellidop ASC");
while ($rowr = mysql_fetch_row($values)) {
	for ($j=0;$j<$i;$j++) {
		$salida_cvs .= $rowr[$j].", ";
	}
	$salida_cvs .= "\n";
}

header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv".date("Y-m-d:")."_".LGlobal::Url_Amigable($config->lagcnombre).".csv");
header("Content-disposition: filename=".date("Y-m-d_H-i")."_".LGlobal::Url_Amigable($config->lagcnombre).".csv");
print $salida_cvs;
exit;
?>