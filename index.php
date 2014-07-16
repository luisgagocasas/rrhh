<?php include "config.php"; include "funciones/funciones.php"; include "funciones/componentes.php"; include "funciones/function.globales.php"; $login = new Login();
header('Content-Type: text/html; charset=UTF-8');
if ($_GET["logout"]) { $login->LogOut(); header("location: index.php"); exit(); }
if ($_POST) {
	if (!$login->Logon($_POST["usuario_lagc"],$_POST["password_lagc"]))	{ $mensaje = "El usuario &oacute; password son incorrectos"; }
	else { header("location: ".$_POST['url']); }
} $login->Check();
$cnfpla = "plantillas/".$config->lagctemplsite."/config.xml";
if (file_exists($cnfpla)) {
	$plantillas = simplexml_load_file($cnfpla);
	if($plantillas){
		foreach ($plantillas as $plantilla) {
			$archivo = "plantillas/".$config->lagctemplsite."/inicio.tpl";
			if (file_exists($archivo)) {
				header('Content-Type: text/html; charset=UTF-8');
				if(empty($_COOKIE["username"])) { include "plantillas/".$config->lagctemplsite."/login.tpl"; }
				else { include $archivo; }
			} else { echo "Error abriendo \"plantillas/".$config->lagctemplsite."/inicio.tpl\n"; }
		}
	} else { echo "Sintaxi XML inválida Revise el archivo \"plantillas/".$config->lagctemplsite."/config.xml\n"; }
} else { echo "Error abriendo \"plantillas/".$config->lagctemplsite."/config.xml\n"; } ?>