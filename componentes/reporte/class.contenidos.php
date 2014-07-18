<?php
class Reporte{
	static function inicio(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Cursos</b></a>
			<a href="?lagc=reporte&id=examenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Exámenes</a>
			<a href="?lagc=reporte&id=seguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Seguros</a>
		</div>
        <?php
        $respsedes = mysql_query("select * from com_sedes where sede_estado='1' ORDER BY sede_id DESC");
        while($conts = mysql_fetch_array($respsedes)){
        	echo "<a href=\"#\"><img src=\"plantillas/default/img/reporte.png\" style=\"display: inline-block;width: 40px;\"></a> <h2 style=\"display: inline-block;\">".$conts['sede_nombre']."</h2>";
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
		        echo "<li style=\"width:20%\"><a href=\"?lagc=reporte&id=".$cont['curso_id']."&reportecurso=".$cont['curso_nombre']."\"><img src=\"plantillas/default/img/reporte.png\" style=\"display: inline-block;width: 40px;\">Participantes ($rowss)</a></li>";
		        echo "<li></li>";
		        echo "</ul>";
	        }
        }
	}
	static function reportecurso($val1, $val2){
		$respconfig = mysql_query("select * from configuracion"); $config = mysql_fetch_array($respconfig);
		$respcursos = mysql_query("select * from com_cursos where curso_id='".$_GET['id']."'"); $cursos = mysql_fetch_array($respcursos); ?>
		<div class="tlcabecera">
			<a href="?lagc=reporte" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Sedes y Cursos</b></a>
			<a href="?lagc=reporte&id=examenes" title="Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Exámenes</a>
			<a href="?lagc=reporte&id=seguros" title="Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Seguros</a>
		</div>
		<div style="text-align: right;"><a href="componentes/reporte/exportar.php?idcurso=<?=$_GET['id']; ?>&sede=<?=Reporte::nombresede($cursos['sede_id']); ?>&curso=<?=$cursos['curso_nombre']; ?>">Exportar</a></div>
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
			    echo "<div class=\"col-1-5\">".$personal['dni']."</div>";
			    echo "<div class=\"col-1-5\">".$personal['nombres']."</div>";
			    echo "<div class=\"col-1-5\">".$personal['apellidop']." ".$personal['apellidom']."</div>";
			    echo "<div class=\"col-1-5\">".$asigcurso['fechainicio']."</div>";
			    echo "<div class=\"col-1-5\">".$asigcurso['fechafin']."</div>";
			}
			?>
		</div>
	<?php
	}
	static function nombresede($val1){
		$respsede = mysql_query("select * from com_sedes where sede_id='".$val1."'"); $sede = mysql_fetch_array($respsede);
		return $sede['sede_nombre'];
	}
}
?>