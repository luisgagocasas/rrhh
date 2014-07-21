<?php
class Reporte{
	static function inicio(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Cursos</b></a>
			<a href="?lagc=reporte&id=sedesyexamenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Exámenes</a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Seguros</a>
		</div>
        <?php
        $respsedes = mysql_query("select * from com_sedes where sede_estado='1' ORDER BY sede_id DESC");
        while($conts = mysql_fetch_array($respsedes)){
        	echo "<a href=\"?lagc=reporte&id=".$conts['sede_id']."&reportesedes=".$conts['sede_nombre']."\"><img src=\"plantillas/default/img/reporte.png\" style=\"display: inline-block;width: 40px;\"></a> <h2 style=\"display: inline-block;\">".$conts['sede_nombre']."</h2>";
			$respcont = mysql_query("select * from com_cursos where sede_id=".$conts['sede_id']."");
	        $rows = mysql_num_rows($respcont); ?>
			<ul class="titulos">
				<li>Nombre</li>
				<li></li>
	            <li><b>Registros (<?=$rows; ?>)</b></li>
	        </ul>
	        <?php
	        while($cont = mysql_fetch_array($respcont)){
	        	$respasig= mysql_query("select * from com_curso_asignar where id_curso='".$cont['curso_id']."'");
	        	$rowss = mysql_num_rows($respasig);
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['curso_nombre']."</li>";
		        echo "<li style=\"width:20%\"><a href=\"?lagc=reporte&id=".$cont['curso_id']."&reportecurso=".$cont['curso_nombre']."\"><img src=\"plantillas/default/img/reporte.png\" style=\"display: inline-block;width: 40px;\"></a>Participantes ($rowss)</li>";
		        echo "<li></li>";
		        echo "</ul>";
	        }
        }
	}
	static function sedesyexamenes(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Cursos</a>
			<a href="?lagc=reporte&id=sedesyexamenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Exámenes</b></a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Seguros</a>
		</div>
        <?php
        $respsedes = mysql_query("select * from com_sedes where sede_estado='1' ORDER BY sede_id DESC");
        while($conts = mysql_fetch_array($respsedes)){
        	echo "<a href=\"?lagc=reporte&id=".$conts['sede_id']."&reportesedesexamen=".$conts['sede_nombre']."\"><img src=\"plantillas/default/img/reporte.png\" style=\"display: inline-block;width: 40px;\"></a> <h2 style=\"display: inline-block;\">".$conts['sede_nombre']."</h2>";
			$respcont = mysql_query("select * from com_examenes where sede_id=".$conts['sede_id']."");
	        $rows = mysql_num_rows($respcont); ?>
			<ul class="titulos">
				<li>Nombre</li>
				<li></li>
	            <li><b>Registros (<?=$rows; ?>)</b></li>
	        </ul>
	        <?php
	        while($cont = mysql_fetch_array($respcont)){
	        	$respasig= mysql_query("select * from com_examen_asignar where id_examen='".$cont['examen_id']."'");
	        	$rowss = mysql_num_rows($respasig);
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['examen_nombre']."</li>";
		        echo "<li style=\"width:20%\"><a href=\"?lagc=reporte&id=".$cont['examen_id']."&reporteexamen=".$cont['examen_nombre']."\"><img src=\"plantillas/default/img/reporte.png\" style=\"display: inline-block;width: 40px;\"></a>Participantes ($rowss)</li>";
		        echo "<li></li>";
		        echo "</ul>";
	        }
        }
	}
	static function sedesyseguros(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Cursos</a>
			<a href="?lagc=reporte&id=sedesyexamenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Exámenes</a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Seguros</b></a>
		</div>
        <?php
        $respsedes = mysql_query("select * from com_sedes where sede_estado='1' ORDER BY sede_id DESC");
        while($conts = mysql_fetch_array($respsedes)){
        	echo "<a href=\"?lagc=reporte&id=".$conts['sede_id']."&reportesedesseguro=".$conts['sede_nombre']."\"><img src=\"plantillas/default/img/reporte.png\" style=\"display: inline-block;width: 40px;\"></a> <h2 style=\"display: inline-block;\">".$conts['sede_nombre']."</h2>";
			$respcont = mysql_query("select * from com_seguros where sede_id=".$conts['sede_id']."");
	        $rows = mysql_num_rows($respcont); ?>
			<ul class="titulos">
				<li>Nombre</li>
				<li></li>
	            <li><b>Registros (<?=$rows; ?>)</b></li>
	        </ul>
	        <?php
	        while($cont = mysql_fetch_array($respcont)){
	        	$respasig= mysql_query("select * from com_seguro_asignar where id_seguro='".$cont['seguro_id']."'");
	        	$rowss = mysql_num_rows($respasig);
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['seguro_nombre']."</li>";
		        echo "<li style=\"width:20%\"><a href=\"?lagc=reporte&id=".$cont['seguro_id']."&reporteseguro=".$cont['seguro_nombre']."\"><img src=\"plantillas/default/img/reporte.png\" style=\"display: inline-block;width: 40px;\"></a>Participantes ($rowss)</li>";
		        echo "<li></li>";
		        echo "</ul>";
	        }
        }
	}
	static function reporteseguro($val1, $val2){
		$respconfig = mysql_query("select * from configuracion"); $config = mysql_fetch_array($respconfig);
		$respeseguro = mysql_query("select * from com_seguros where seguro_id='".$_GET['id']."'"); $seguro = mysql_fetch_array($respeseguro); ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Cursos</a>
			<a href="?lagc=reporte&id=sedesyexamenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Exámenes</a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Seguros</b></a>
		</div>
		<div style="text-align: right;"><a href="componentes/reporte/exportar.php?que=seguro&idseguro=<?=$_GET['id']; ?>&sede=<?=Reporte::nombresede($seguro['sede_id']); ?>&seguro=<?=$seguro['seguro_nombre']; ?>">Exportar</a></div>
		<div class="grid grid-pad">
		    <div class="col-1-4">
		    	<img src="utilidades/imagenes/<?=$config['logo']; ?>" class="imgrepor">
		    </div>
		    <div class="col-1-4">
			    </br></br><?=$config['nombreapp']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	SEDE:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombresede($seguro['sede_id']); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	EXÁMENES:
		    </div>
		    <div class="col-1-4">
			    <?=$seguro['seguro_nombre']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
			<div class="col-1-5 rptasunto">DNI</div>
			<div class="col-1-5 rptasunto">NOMBRES</div>
			<div class="col-1-5 rptasunto">APELLIDOS</div>
			<div class="col-1-5 rptasunto">FECHA INICIO</div>
			<div class="col-1-5 rptasunto">FECHA FIN</div>
		</div>
		<div class="grid grid-pad">
			<?php $respcursoasg = mysql_query("select * from com_seguro_asignar where id_seguro='".$seguro['seguro_id']."'");
			while($asigexamen = mysql_fetch_array($respcursoasg)) {
				$respersonal = mysql_query("select * from usuarios where id='".$asigexamen['id_usuario']."'");
				$personal = mysql_fetch_array($respersonal);
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['dni']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['nombres']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['apellidop']." ".$personal['apellidom']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$asigexamen['fechainicio']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$asigexamen['fechafin']."</div>";
			}
			?>
		</div>
	<?php
	}
	static function reportesedesseguro($val1, $val2){
		$respconfig = mysql_query("select * from configuracion"); $config = mysql_fetch_array($respconfig);
		$respsedes = mysql_query("select * from com_sedes where sede_id='".$val1."'"); $sedes = mysql_fetch_array($respsedes);
		$respexamen = mysql_query("select * from com_seguros where seguro_id='".$sedes['sede_id']."'"); $examenes1 = mysql_fetch_array($respexamen); ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Cursos</a>
			<a href="?lagc=reporte&id=sedesyexamenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Exámenes</a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Seguros</b></a>
		</div>
		<div style="text-align: right;"><a href="componentes/reporte/exportar.php?que=sedeseguro&idsede=<?=$_GET['id']; ?>&sede=<?=Reporte::nombresede($examenes1['sede_id']); ?>">Exportar</a></div>
		<div class="grid grid-pad">
		    <div class="col-1-4">
		    	<img src="utilidades/imagenes/<?=$config['logo']; ?>" class="imgrepor">
		    </div>
		    <div class="col-1-4">
			    </br></br><?=$config['nombreapp']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	SEDE:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombresede($sedes['sede_id']); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	EXÁMENES:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombresedeseguro($sedes['sede_id'], true); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
			<div class="col-1-6 rptasunto">DNI</div>
			<div class="col-1-6 rptasunto">NOMBRES</div>
			<div class="col-1-6 rptasunto">APELLIDOS</div>
			<div class="col-1-6 rptasunto">SEGURO</div>
			<div class="col-1-6 rptasunto">FECHA INICIO</div>
			<div class="col-1-6 rptasunto">FECHA FIN</div>
		</div>
		<div class="grid grid-pad">
			<?php
			$respcursos = mysql_query("select * from com_seguros where sede_id='".$sedes['sede_id']."'");
			while ($examenes = mysql_fetch_array($respcursos)){
				$respcursoasg = mysql_query("select * from com_seguro_asignar where id_seguro='".$examenes['seguro_id']."'");
				while($asigcurso = mysql_fetch_array($respcursoasg)) {
					$respersonal = mysql_query("select * from usuarios where id='".$asigcurso['id_usuario']."'");
					$personal = mysql_fetch_array($respersonal);
				    echo "<div class=\"col-1-6\">&nbsp;".$personal['dni']."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".$personal['nombres']."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".$personal['apellidop']." ".$personal['apellidom']."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".Reporte::nombresedeseguro($examenes['seguro_id'], false)."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".$asigcurso['fechainicio']."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".$asigcurso['fechafin']."</div>";
				}
			}
			?>
		</div>
	<?php
	}
	static function reporteexamen($val1, $val2){
		$respconfig = mysql_query("select * from configuracion"); $config = mysql_fetch_array($respconfig);
		$respexamenes = mysql_query("select * from com_examenes where examen_id='".$_GET['id']."'"); $examen = mysql_fetch_array($respexamenes); ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Cursos</a>
			<a href="?lagc=reporte&id=sedesyexamenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Exámenes</b></a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Seguros</a>
		</div>
		<div style="text-align: right;"><a href="componentes/reporte/exportar.php?que=examen&idexamen=<?=$_GET['id']; ?>&sede=<?=Reporte::nombresede($examen['sede_id']); ?>&examen=<?=$examen['examen_nombre']; ?>">Exportar</a></div>
		<div class="grid grid-pad">
		    <div class="col-1-4">
		    	<img src="utilidades/imagenes/<?=$config['logo']; ?>" class="imgrepor">
		    </div>
		    <div class="col-1-4">
			    </br></br><?=$config['nombreapp']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	SEDE:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombresede($examen['sede_id']); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	EXÁMENES:
		    </div>
		    <div class="col-1-4">
			    <?=$examen['examen_nombre']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
			<div class="col-1-5 rptasunto">DNI</div>
			<div class="col-1-5 rptasunto">NOMBRES</div>
			<div class="col-1-5 rptasunto">APELLIDOS</div>
			<div class="col-1-5 rptasunto">FECHA INICIO</div>
			<div class="col-1-5 rptasunto">FECHA FIN</div>
		</div>
		<div class="grid grid-pad">
			<?php $respcursoasg = mysql_query("select * from com_examen_asignar where id_examen='".$examen['examen_id']."'");
			while($asigexamen = mysql_fetch_array($respcursoasg)) {
				$respersonal = mysql_query("select * from usuarios where id='".$asigexamen['id_usuario']."'");
				$personal = mysql_fetch_array($respersonal);
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['dni']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['nombres']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['apellidop']." ".$personal['apellidom']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$asigexamen['fechainicio']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$asigexamen['fechafin']."</div>";
			}
			?>
		</div>
	<?php
	}
	static function reportesedesexamen($val1, $val2){
		$respconfig = mysql_query("select * from configuracion"); $config = mysql_fetch_array($respconfig);
		$respsedes = mysql_query("select * from com_sedes where sede_id='".$val1."'"); $sedes = mysql_fetch_array($respsedes);
		$respexamen = mysql_query("select * from com_examenes where sede_id='".$sedes['sede_id']."'"); $examenes1 = mysql_fetch_array($respexamen); ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Cursos</a>
			<a href="?lagc=reporte&id=sedesyexamenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Exámenes</b></a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Seguros</a>
		</div>
		<div style="text-align: right;"><a href="componentes/reporte/exportar.php?que=sedeexamen&idsede=<?=$_GET['id']; ?>&sede=<?=Reporte::nombresede($examenes1['sede_id']); ?>">Exportar</a></div>
		<div class="grid grid-pad">
		    <div class="col-1-4">
		    	<img src="utilidades/imagenes/<?=$config['logo']; ?>" class="imgrepor">
		    </div>
		    <div class="col-1-4">
			    </br></br><?=$config['nombreapp']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	SEDE:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombresede($sedes['sede_id']); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	EXÁMENES:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombresedesexamen($sedes['sede_id'], true); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
			<div class="col-1-7 rptasunto">DNI</div>
			<div class="col-1-7 rptasunto">NOMBRES</div>
			<div class="col-1-7 rptasunto">APELLIDOS</div>
			<div class="col-1-7 rptasunto">NOMBRE DEL EXÁMEN</div>
			<div class="col-1-7 rptasunto">CLINICA</div>
			<div class="col-1-7 rptasunto">FECHA INICIO</div>
			<div class="col-1-7 rptasunto">FECHA FIN</div>
		</div>
		<div class="grid grid-pad">
			<?php
			$respcursos = mysql_query("select * from com_examenes where sede_id='".$sedes['sede_id']."'");
			while ($examenes = mysql_fetch_array($respcursos)){
				$respcursoasg = mysql_query("select * from com_examen_asignar where id_examen='".$examenes['examen_id']."'");
				while($asigcurso = mysql_fetch_array($respcursoasg)) {
					$respersonal = mysql_query("select * from usuarios where id='".$asigcurso['id_usuario']."'");
					$personal = mysql_fetch_array($respersonal);
				    echo "<div class=\"col-1-7\">&nbsp;".$personal['dni']."</div>";
				    echo "<div class=\"col-1-7\">&nbsp;".$personal['nombres']."</div>";
				    echo "<div class=\"col-1-7\">&nbsp;".$personal['apellidop']." ".$personal['apellidom']."</div>";
				    echo "<div class=\"col-1-7\">&nbsp;".Reporte::nombresedesexamen($examenes['examen_id'], false)."</div>";
				    echo "<div class=\"col-1-7\">&nbsp;".Reporte::nombreclinica($examenes['id_clinica'])."</div>";
				    echo "<div class=\"col-1-7\">&nbsp;".$asigcurso['fechainicio']."</div>";
				    echo "<div class=\"col-1-7\">&nbsp;".$asigcurso['fechafin']."</div>";
				}
			}
			?>
		</div>
	<?php
	}
	static function reportesedes($val1, $val2){
		$respconfig = mysql_query("select * from configuracion"); $config = mysql_fetch_array($respconfig);
		$respsedes = mysql_query("select * from com_sedes where sede_id='".$val1."'"); $sedes = mysql_fetch_array($respsedes);
		$respcursos1 = mysql_query("select * from com_cursos where sede_id='".$sedes['sede_id']."'"); $cursos1 = mysql_fetch_array($respcursos1); ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Cursos</b></a>
			<a href="?lagc=reporte&id=examenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Exámenes</a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Seguros</a>
		</div>
		<div style="text-align: right;"><a href="componentes/reporte/exportar.php?que=sede&idsede=<?=$_GET['id']; ?>&sede=<?=Reporte::nombresede($cursos1['sede_id']); ?>">Exportar</a></div>
		<div class="grid grid-pad">
		    <div class="col-1-4">
		    	<img src="utilidades/imagenes/<?=$config['logo']; ?>" class="imgrepor">
		    </div>
		    <div class="col-1-4">
			    </br></br><?=$config['nombreapp']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	SEDE:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombresede($sedes['sede_id']); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	CURSOS:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombrecursos($sedes['sede_id'], true); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
			<div class="col-1-6 rptasunto">DNI</div>
			<div class="col-1-6 rptasunto">NOMBRES</div>
			<div class="col-1-6 rptasunto">APELLIDOS</div>
			<div class="col-1-6 rptasunto">NOMBRE DEL CURSO</div>
			<div class="col-1-6 rptasunto">FECHA INICIO</div>
			<div class="col-1-6 rptasunto">FECHA FIN</div>
		</div>
		<div class="grid grid-pad">
			<?php
			$respcursos = mysql_query("select * from com_cursos where sede_id='".$sedes['sede_id']."'");
			while ($cursos = mysql_fetch_array($respcursos)){
				$respcursoasg = mysql_query("select * from com_curso_asignar where id_curso='".$cursos['curso_id']."'");
				while($asigcurso = mysql_fetch_array($respcursoasg)) {
					$respersonal = mysql_query("select * from usuarios where id='".$asigcurso['id_usuario']."'");
					$personal = mysql_fetch_array($respersonal);
				    echo "<div class=\"col-1-6\">&nbsp;".$personal['dni']."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".$personal['nombres']."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".$personal['apellidop']." ".$personal['apellidom']."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".Reporte::nombrecursos($cursos['curso_id'], false)."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".$asigcurso['fechainicio']."</div>";
				    echo "<div class=\"col-1-6\">&nbsp;".$asigcurso['fechafin']."</div>";
				}
			}
			?>
		</div>
	<?php
	}
	static function reportecurso($val1, $val2){
		$respconfig = mysql_query("select * from configuracion"); $config = mysql_fetch_array($respconfig);
		$respcursos = mysql_query("select * from com_cursos where curso_id='".$_GET['id']."'"); $cursos = mysql_fetch_array($respcursos); ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Cursos</a>
			<a href="?lagc=reporte&id=examenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Exámenes</b></a>
			<a href="?lagc=reporte&id=sedesyseguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Sedes y Seguros</a>
		</div>
		<div style="text-align: right;"><a href="componentes/reporte/exportar.php?que=curso&idcurso=<?=$_GET['id']; ?>&sede=<?=Reporte::nombresede($cursos['sede_id']); ?>&curso=<?=$cursos['curso_nombre']; ?>">Exportar</a></div>
		<div class="grid grid-pad">
		    <div class="col-1-4">
		    	<img src="utilidades/imagenes/<?=$config['logo']; ?>" class="imgrepor">
		    </div>
		    <div class="col-1-4">
			    </br></br><?=$config['nombreapp']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	SEDE:
		    </div>
		    <div class="col-1-4">
			    <?=Reporte::nombresede($cursos['sede_id']); ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
		    <div class="col-1-4 rptasunto" style="text-align: right;">
		    	CURSO:
		    </div>
		    <div class="col-1-4">
			    <?=$cursos['curso_nombre']; ?>
		    </div>
		    <div class="col-1-4">

		    </div>
		    <div class="col-1-4">

		    </div>
		</div>
		<div class="grid grid-pad">
			<div class="col-1-5 rptasunto">DNI</div>
			<div class="col-1-5 rptasunto">NOMBRES</div>
			<div class="col-1-5 rptasunto">APELLIDOS</div>
			<div class="col-1-5 rptasunto">FECHA INICIO</div>
			<div class="col-1-5 rptasunto">FECHA FIN</div>
		</div>
		<div class="grid grid-pad">
			<?php $respcursoasg = mysql_query("select * from com_curso_asignar where id_curso='".$cursos['curso_id']."'");
			while($asigcurso = mysql_fetch_array($respcursoasg)) {
				$respersonal = mysql_query("select * from usuarios where id='".$asigcurso['id_usuario']."'");
				$personal = mysql_fetch_array($respersonal);
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['dni']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['nombres']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$personal['apellidop']." ".$personal['apellidom']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$asigcurso['fechainicio']."</div>";
			    echo "<div class=\"col-1-5\">&nbsp;".$asigcurso['fechafin']."</div>";
			}
			?>
		</div>
	<?php
	}
	static function nombrecursos($val1, $val2){
		if($val2==false){
			$respcursos = mysql_query("select * from com_cursos where curso_id='".$val1."'");
			$cursos = mysql_fetch_array($respcursos);
			$final = $cursos['curso_nombre'];
		}
		else if($val2==true){
			$respcursos = mysql_query("select * from com_cursos where sede_id='".$val1."'");
			$rows = mysql_num_rows($respcursos);
			$i=1;
			while($cursos = mysql_fetch_array($respcursos)){
				$final .= $cursos['curso_nombre'];
				if($rows>$i){
					$final .= ", ";
				}
				else if($rows==$i){
					$final .="";
				}
				$i++;
			}
		}
		return $final;
	}
	static function nombresedesexamen($val1, $val2){
		if($val2==false){
			$respcursos = mysql_query("select * from com_examenes where examen_id='".$val1."'");
			$examenes = mysql_fetch_array($respcursos);
			$final = $examenes['examen_nombre'];
		}
		else if($val2==true){
			$respcursos = mysql_query("select * from com_examenes where sede_id='".$val1."'");
			$rows = mysql_num_rows($respcursos);
			$i=1;
			while($examenes = mysql_fetch_array($respcursos)){
				$final .= $examenes['examen_nombre'];
				if($rows>$i){
					$final .= ", ";
				}
				else if($rows==$i){
					$final .="";
				}
				$i++;
			}
		}
		return $final;
	}
	static function nombresedeseguro($val1, $val2){
		if($val2==false){
			$respcursos = mysql_query("select * from com_seguros where seguro_id='".$val1."'");
			$examenes = mysql_fetch_array($respcursos);
			$final = $examenes['seguro_nombre'];
		}
		else if($val2==true){
			$respcursos = mysql_query("select * from com_seguros where sede_id='".$val1."'");
			$rows = mysql_num_rows($respcursos);
			$i=1;
			while($examenes = mysql_fetch_array($respcursos)){
				$final .= $examenes['seguro_nombre'];
				if($rows>$i){
					$final .= ", ";
				}
				else if($rows==$i){
					$final .="";
				}
				$i++;
			}
		}
		return $final;
	}
	static function nombresede($val1){
		$respsede = mysql_query("select * from com_sedes where sede_id='".$val1."'"); $sede = mysql_fetch_array($respsede);
		return $sede['sede_nombre'];
	}
	static function nombreclinica($val1){
		$respclinica = mysql_query("select * from com_examen_clinica where id_clinica='".$val1."'"); $clinica = mysql_fetch_array($respclinica);
		return $clinica['nombre'];
	}
}
?>