<?php include "componentes/Configuracion/class.contenidos.php";
if (!isset($_GET['id'])) { Configuracion::inicio(); }
if($_GET['id']=="permisos") { Configuracion::permisos(); }
if($_GET['id']=="nuevo") { Configuracion::nuevo(); }
?>