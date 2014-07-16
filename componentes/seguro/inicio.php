<?php include "componentes/seguro/class.contenidos.php"; ?>
<script src="componentes/seguro/seguros.js"></script>
<?php
if (!isset($_GET['id'])) { Seguros::inicio(); }
if(isset($_GET['id']) && $_GET['editar']) { Seguros::editar($_GET['id'], $_GET['editar']); }
if(isset($_GET['id']) && $_GET['borrar']) { Seguros::borrar($_GET['id'], $_GET['borrar']); }
if($_GET['id']=="agregar") { Seguros::nuevo(); }
if($_GET['id']=="asignar") { Seguros::asignar(); }
if(isset($_GET['id']) && $_GET['participantes']) { Seguros::participantes($_GET['id'], $_GET['participantes']); }
if($_GET['id']=="buscar") { Seguros::buscar(); }
?>