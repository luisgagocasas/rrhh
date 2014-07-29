<?php include "componentes/asistencia/class.contenidos.php"; include "componentes/usuarios/class.contenidos.php"; ?>
<script src="componentes/asistencia/asistencia.js"></script>
<?php
if (!isset($_GET['id'])) { Asistencia::inicio(); }
if($_GET['id']=="buscar") { Asistencia::buscar($_GET['buscar']); }
if($_GET['id'] && $_GET['ver']) { Asistencia::ver($_GET['id'],$_GET['ver']); }
if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
	if($_GET['id']=="exportar") { Asistencia::exportar(); }
	if($_GET['id']=="exportar1dias") { Asistencia::exportar1dias(); }
	if($_GET['id']=="exportar7dias") { Asistencia::exportar7dias(); }
	if($_GET['id']=="exportar15dias") { Asistencia::exportar15dias(); }
	if($_GET['id']=="exportar1mes") { Asistencia::exportar1mes(); }
}
if(Componente::permisos($_COOKIE["lgpermisos"], 1, "", "", "")){
	if($_GET['id'] && $_GET['nuevo']) { Asistencia::nuevo($_GET['id']); }
	if($_GET['id'] && $_GET['editar']) { Asistencia::editar($_GET['id'],$_GET['editar']); }
	if($_GET['id'] && $_GET['borrar']) { Asistencia::borrar($_GET['id'],$_GET['borrar']); }
}
?>