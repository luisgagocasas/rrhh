<?php include "componentes/Configuracion/class.contenidos.php";
if (!isset($_GET['id'])) { Configuracion::inicio(); }
if($_GET['id']=="permisos") { Configuracion::permisos(); }
if($_GET['id']=="nuevo") { Configuracion::nuevo(); }
if(isset($_GET['id']) && $_GET['editar']) { Configuracion::editar($_GET['id'], $_GET['editar']); }
if(isset($_GET['id']) && $_GET['borrar']) { Configuracion::borrar($_GET['id'], $_GET['borrar']); }
?>