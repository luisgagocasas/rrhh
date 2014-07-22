<?php include "componentes/configuracion/class.contenidos.php";
if (!$_GET['id']) { Configuracion::inicio(); }
if($_GET['id']=="permisos") { Configuracion::permisos(); }
if($_GET['id']=="nuevo") { Configuracion::nuevo(); }
if($_GET['id'] && $_GET['editar']) { Configuracion::editar($_GET['id'], $_GET['editar']); }
if($_GET['id'] && $_GET['borrar']) { Configuracion::borrar($_GET['id'], $_GET['borrar']); }
?>