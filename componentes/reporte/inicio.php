<?php include "componentes/reporte/class.contenidos.php";
if (!isset($_GET['id'])) { Reporte::inicio(); }
if(isset($_GET['id']) && $_GET['reportesedes']) { Reporte::reportesedes($_GET['id'], $_GET['reportesedes']); }
if(isset($_GET['id']) && $_GET['reportecurso']) { Reporte::reportecurso($_GET['id'], $_GET['reportecurso']); }
if($_GET['id']=="sedesyexamenes") { Reporte::sedesyexamenes(); }
if(isset($_GET['id']) && $_GET['reporteexamen']) { Reporte::reporteexamen($_GET['id'], $_GET['reporteexamen']); }
if(isset($_GET['id']) && $_GET['reportesedesexamen']) { Reporte::reportesedesexamen($_GET['id'], $_GET['reportesedesexamen']); }
if($_GET['id']=="sedesyseguros") { Reporte::sedesyseguros(); }
if(isset($_GET['id']) && $_GET['reporteseguro']) { Reporte::reporteseguro($_GET['id'], $_GET['reporteseguro']); }
if(isset($_GET['id']) && $_GET['reportesedesseguro']) { Reporte::reportesedesseguro($_GET['id'], $_GET['reportesedesseguro']); }
?>