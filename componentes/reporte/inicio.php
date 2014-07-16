<?php include "componentes/reporte/class.contenidos.php";
if(isset($_GET['id']) && $_GET['buscar']) { Reporte::inicio($_GET['buscar']); }
?>