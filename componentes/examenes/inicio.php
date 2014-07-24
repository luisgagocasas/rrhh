<?php include "componentes/examenes/class.contenidos.php"; ?>
<script src="componentes/examenes/examenes.js"></script>
<?php
if (!isset($_GET['id'])) { Examenes::inicio(); }
if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
	if(isset($_GET['id']) && $_GET['editar']) { Examenes::editar($_GET['id'], $_GET['editar']); }
	if(isset($_GET['id']) && $_GET['borrar']) { Examenes::borrar($_GET['id'], $_GET['borrar']); }
	if($_GET['id']=="agregar") { Examenes::nuevo(); }
	if($_GET['id']=="asignar") { Examenes::asignar(); }
}
if(isset($_GET['id']) && $_GET['participantes']) { Examenes::participantes($_GET['id'], $_GET['participantes']); }
if($_GET['id']=="buscar") { Examenes::buscar(); }
// Clinicas
if($_GET['id']=="clinicas") { Examenes::clinicas(); }
if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
	if($_GET['id']=="agregarclinica") { Examenes::nuevaclinica(); }
	if(isset($_GET['id']) && $_GET['editarclinica']) { Examenes::editarclinica($_GET['id'], $_GET['editarclinica']); }
	if(isset($_GET['id']) && $_GET['borrarclinica']) { Examenes::borrarclinica($_GET['id'], $_GET['borrarclinica']); }
}
?>