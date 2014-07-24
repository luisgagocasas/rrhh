<?php include "componentes/asistencia/class.contenidos.php"; ?>
<script src="componentes/asistencia/asistencia.js"></script>
<?php
if (!isset($_GET['id'])) { Asistencia::inicio(); }
if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
	if($_GET['id']=="exportar") { Asistencia::exportar(); }
}
?>