<?php include "componentes/asistencia/class.contenidos.php"; include "componentes/usuarios/class.contenidos.php"; ?>
<script src="componentes/asistencia/asistencia.js"></script>
<?php
if (!isset($_GET['id'])) { Asistencia::inicio(); }
if($_GET['id']=="buscar") { Asistencia::buscar($_GET['buscar']); }
if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
	if($_GET['id']=="exportar") { Asistencia::exportar(); }
	if($_GET['id']=="exportar1dias") { Asistencia::exportar1dias(); }
	if($_GET['id']=="exportar7dias") { Asistencia::exportar7dias(); }
	if($_GET['id']=="exportar15dias") { Asistencia::exportar15dias(); }
	if($_GET['id']=="exportar1mes") { Asistencia::exportar1mes(); }
}
?>