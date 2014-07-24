<?php include "componentes/cursos/class.contenidos.php"; ?>
<script src="componentes/cursos/cursos.js"></script>
<?php
if (!isset($_GET['id'])) { Cursos::inicio(); }
if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
	if(isset($_GET['id']) && $_GET['editar']) { Cursos::editar($_GET['id'], $_GET['editar']); }
	if(isset($_GET['id']) && $_GET['borrar']) { Cursos::borrar($_GET['id'], $_GET['borrar']); }
	if($_GET['id']=="agregar") { Cursos::nuevo(); }
	if($_GET['id']=="asignar") { Cursos::asignar(); }
}
if(isset($_GET['id']) && $_GET['participantes']) { Cursos::participantes($_GET['id'], $_GET['participantes']); }
if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, 3, "")){
	if($_GET['id']=="buscar") { Cursos::buscar(); }
}
?>