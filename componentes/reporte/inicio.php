<?php include "componentes/reporte/class.contenidos.php";
if (!isset($_GET['id'])) { Reporte::inicio(); }
if(isset($_GET['id']) && $_GET['reportecurso']) { Reporte::reportecurso($_GET['id'], $_GET['reportecurso']); }
?>