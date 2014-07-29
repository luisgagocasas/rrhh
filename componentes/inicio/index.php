<?php include "componentes/usuarios/class.contenidos.php";
function sede_nombre($val1,$val2){
	if($val1){
		$resppc = mysql_query("select * from com_sedes where sede_estado='1'");
        while($datapc = mysql_fetch_array($resppc)) {
            $aSubcads=split("[|.-]", $val1);//sacar las |
            $var1 = 0;
            for($k=0;$k<count($aSubcads);$k++)//separar una a una
                if ($aSubcads[$k] == $datapc['sede_id']) {
                    $var1 = 1;
                    break;
                }
            if ($var1 == 1)
                $fin .= $datapc['sede_nombre'].", ";
        }
    }
    else {
    	$fin = "No pertenece a ninguna sede";
    }
    return $fin;
}
?>
<div style="margin:10px auto 0px auto;">
	Bienvenido, <b><?=$_COOKIE["lgnombres"]." ".$_COOKIE["lgapellidos"]; ?></b></br>
	A contunuación te presentamos el resumen de tus actividades en la empresa.</br></br>
	<?php
	$respuser = mysql_query("select * from usuarios where id='".$_COOKIE["user"]."'");
    $usuario = mysql_fetch_array($respuser);
	?>
</div>
<ul class="titulos" style="text-align: center;">
	<li style="width: 25%;">Sedes</li>
	<li style="width: 25%;">Ingreso a la empresa</li>
	<li style="width: 25%;">Estado</li>
    <li style="width: 25%;">Asistencia</li>
</ul>
<ul class="resultados" style="text-align: center;">
	<li style="width: 25%;"><?=sede_nombre($usuario['sede_id'], $usuario['id']); ?></li>
	<li style="width: 25%;"><?=$usuario['fechaingresoempresa']; ?></li>
	<li style="width: 25%;"><?=Usuarios::estado($usuario['estado']); ?></li>
    <li style="width: 25%;"><a href="?lagc=asistencia&id=<?=$usuario['id']; ?>&ver=<?=$usuario['nombres']." ".$usuario['apellidop']." ".$usuario['apellidom']; ?>">Mi asistencia</a></li>
</ul>
<div class="grid grid-pad">
    <div class="col-1-3">
    	<?php
	    $respcont = mysql_query("select * from com_curso_asignar where id_usuario=".$_COOKIE["user"]."");
	       $rows = mysql_num_rows($respcont); ?>
	    	<center><h2>Cursos (<?=$rows; ?>)</h2></center>
		    <ul class="titulos">
				<li style="width: 150px;">Sede</li>
		        <li style="width: auto;">Exámen</li>
		    </ul>
	        <?php
	        while($asigcurso = mysql_fetch_array($respcont)){
	        	$respcurso = mysql_query("select * from com_cursos where curso_id=".$asigcurso['id_curso']."");
	        	$curso = mysql_fetch_array($respcurso);
		    	$respsedes = mysql_query("select * from com_sedes where sede_id='".$curso['sede_id']."'");
		        $sedes = mysql_fetch_array($respsedes);
	        	echo "<ul class=\"resultados\">\n";
		        	echo "<li style=\"width: 150px;\">".$sedes['sede_nombre']."</li>";
			        echo "<li style=\"width: auto;\">".$curso['curso_nombre']."</li>";
		        echo "</ul>";
		    }
	    ?>
    </div>
    <div class="col-1-3">
    	<?php
    	$respcont = mysql_query("select * from com_examen_asignar where id_usuario=".$_COOKIE["user"]."");
        $rows = mysql_num_rows($respcont); ?>
    	<center><h2>Exámenes (<?=$rows; ?>)</h2></center>
    	<ul class="titulos">
    		<li style="width: 100px;">Sede</li>
			<li style="width: 100px;">Clinica</li>
            <li style="width: auto;">Exámen</li>
        </ul>
        <?php
        while($asigexamen = mysql_fetch_array($respcont)){
        	$respexamen = mysql_query("select * from com_examenes where examen_id=".$asigexamen['id_examen']."");
        	$examenes = mysql_fetch_array($respexamen);
        	$respclinica = mysql_query("select * from com_examen_clinica where id_clinica=".$examenes['id_clinica']."");
        	$clinica = mysql_fetch_array($respclinica);
        	$respsedes = mysql_query("select * from com_sedes where sede_id='".$examenes['sede_id']."'");
		    $sedes = mysql_fetch_array($respsedes);
	        	echo "<ul class=\"resultados\">\n";
	        		echo "<li style=\"width: 100px;\">".$sedes['sede_nombre']."</li>";
			        echo "<li style=\"width: 100px;\">".$clinica['nombre']."</li>";
			        echo "<li style=\"width: auto;\">".$examenes['examen_nombre']."</li>";
		        echo "</ul>";
	    }
	    ?>
    </div>
    <div class="col-1-3">
    	<?php
    	$respcont = mysql_query("select * from com_seguro_asignar where id_usuario=".$_COOKIE["user"]."");
        $rows = mysql_num_rows($respcont); ?>
    	<center><h2>Seguro (<?=$rows; ?>)</h2></center>
    	<ul class="titulos">
				<li style="width: 150px;">Sede</li>
		        <li style="width: auto;">Seguro</li>
		    </ul>
        <?php
        while($asigseguro = mysql_fetch_array($respcont)){
        	$respcurso = mysql_query("select * from com_seguros where seguro_id=".$asigseguro['id_seguro']."");
        	$seguro = mysql_fetch_array($respcurso);
        	$respsedes = mysql_query("select * from com_sedes where sede_id='".$seguro['sede_id']."'");
		    $sedes = mysql_fetch_array($respsedes);
        	echo "<ul class=\"resultados\">\n";
        		echo "<li style=\"width: 100px;\">".$sedes['sede_nombre']."</li>";
	        	echo "<li style=\"width: auto;\">".$seguro['seguro_nombre']."</li>";
	        echo "</ul>";
	    }
	    ?>
    </div>
</div>