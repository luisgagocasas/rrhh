<?php include "componentes/sedes/class.contenidos.php";
if (!isset($_GET['id'])) { Sedes::inicio(); }
if(isset($_GET['id']) && $_GET['editar']) { Sedes::editar($_GET['id'], $_GET['editar']); }
if(isset($_GET['id']) && $_GET['borrar']) { Sedes::borrar($_GET['id'], $_GET['borrar']); }
if($_GET['id']=="agregar") { Sedes::nuevo(); }
?>