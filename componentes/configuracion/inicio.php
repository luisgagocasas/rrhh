<?php include "componentes/Configuracion/class.contenidos.php";
if (!isset($_GET['id'])) { Configuracion::inicio(); }
if($_GET['id']=="permisos") { Configuracion::permisos(); }
?>