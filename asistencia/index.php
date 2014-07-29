<?php
if(empty($_COOKIE["sedea"])){
	echo "<br><br><br><br><center><h2>Primero debe autorizarse</h2></center>";
	exit();
}
include "../config.php";
function verquesede($val1){
	$respsede = mysql_query("select * from com_sedes where sede_id='".$val1."'"); $sede = mysql_fetch_array($respsede);
	if($sede['sede_id']==$val1){ $final = $sede['sede_nombre']; }
	return $final;
}
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Asistencia - <?=$bdconfig['nombreapp']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="shortcut icon" href="../favicon.ico" />
	<script src="../plantillas/default/js/jquery-1.9.1.min.js"></script>
	<script src="asistencia.js"></script>
	<link rel="stylesheet" href="../plantillas/default/css/estilos.css" />
</head>
<body>
	<script type="text/javascript">
	$(function () {
		$(window).load(function () {
			$('#dni').focus();
		});
	})
	</script>
	<div id="pagina"><br><br><br><br>
		<div class="asistencia">
			<center>
			<h1>SEDE: <?=verquesede($_COOKIE["sedea"]); ?></h1>
				<h2>Sistencia del <u><?=date("d"); ?></u> de <?=$meses[date('n')-1]; ?> de <?=date("Y"); ?></h2>
				<form method="post" class="frm_validate" style="width: 320px" id="frmcheck">
				    <input type="hidden" name="sede" value="<?=verquesede($_COOKIE["sedea"]); ?>">
				    <input type="hidden" name="idsede" value="<?=$_COOKIE["sedea"]; ?>">
				    <label for="entrada"><input name="ensa" id="entrada" type="radio" checked value="Entrada" />Entrada</label>
				    <label for="salida"><input name="ensa" id="salida" type="radio" value="Salida" /> Salida</label>
				    <input type="text" name="dni" id="dni" autocomplete="off" required placeholder="DNI o Código">
				</form>
			</center>
		</div>
	</div>
	<div id="mensaje"></div>
	</br></br></br></br>
</body>
</html>
?>