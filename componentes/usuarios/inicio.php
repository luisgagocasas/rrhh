<?php include "componentes/usuarios/class.contenidos.php"; ?>
<script src="componentes/usuarios/main.js"></script>
<?php
if (!isset($_GET['id'])) { Usuarios::inicio(); }
if(isset($_GET['id']) && $_GET['buscar']) { Usuarios::buscar($_GET['buscar']); }
if(isset($_GET['id']) && $_GET['editar']) { Usuarios::editar($_GET['id'], $_GET['editar']); }
if(isset($_GET['id']) && $_GET['verperfil']) { Usuarios::verperfil($_GET['id'], $_GET['verperfil']); }
if(isset($_GET['id']) && $_GET['ver']) { Usuarios::ver($_GET['id']); }
if(isset($_GET['id']) && $_GET['borrar']) { Usuarios::borrar($_GET['id'], $_GET['borrar']); }
if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
	if($_GET['id']=="agregar") { Usuarios::nuevo(); }
	if($_GET['id']=="importar") { Usuarios::importar(); }
	if($_GET['id']=="exportar") { Usuarios::exportar(); }
}
?>