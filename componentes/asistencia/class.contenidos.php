<?php
class Asistencia{
	static function inicio(){ ?>
		</br></br></br></br>
		<center><h2>Seleccione una sede para activar el modulo de <b>Asistencia</b>.</h2></center>
		<div class="grid grid-pad">
		<?php
		$respsede = mysql_query("select * from com_sedes where sede_estado='1'");
		while($sede = mysql_fetch_array($respsede)){
		    echo "<div class=\"activar col-1-3 mrgsede\" title=\"".$sede['sede_id']."\">".$sede['sede_nombre']."</div>";
		}
		?>
		</div>
		<div id="mensaje"></div>
		</br></br>
		<center>
			<?php
			if(!empty($_COOKIE["sedea"])){
				echo "<span id=\"sede\">sede</span></br>";
				echo "<div class=\"btnma activo\">".Asistencia::verquesede($_COOKIE["sedea"])."</div>";
				echo "<div class=\"apagarasistencia\">
				está Activo</br><span class=\"btnm\" style=\"background: #f00; width: auto\" id=\"terminar\">Cerrar esta sesión de Asistencia</span>
				</div>";
			}
			else {
				echo "<div class=\"btnma desactivado\">Desactivado</div>";
			}
			?>
		</center>
		</br></br>
		<?php
	}
	static function buscar($palabra){ ?>
		<div class="tlcabecera">
			<form method="get" action="" class="frm_validate" style="display: inline-block;width: 300px;">
				<input type="hidden" name="lagc" value="asistencia">
				<input type="hidden" name="id" value="buscar">
			    <input type="text" name="buscar" required placeholder="Ingrese algo que buscar" value="<?=$_GET['buscar']; ?>">
			</form>
			<?php
			if(!empty($palabra)){ ?>
				<div style="float:right;">
				<?php
				$result = mysql_query("SELECT * FROM usuarios WHERE dni LIKE '%$palabra%' or apellidop LIKE '%$palabra%' or apellidom LIKE '%$palabra%' or nombres LIKE '%$palabra%' or codigo LIKE '%$palabra%'");
				$rows = mysql_num_rows($result); ?>
            	<b>Registros (<?=$rows; ?>)</b>
            	</div>
            <?php } ?>
		</div>
		<ul class="titulos">
			<li>Apellidos</li>
            <li>Nombres</li>
            <li>DNI</li>
            <li style="width: 330px;">Sedes</li>
            <li>Estado</li>
            <li></li>
        </ul>
		<?php
		if(!empty($palabra)){
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	        while($cont = mysql_fetch_array($result)){
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
		        echo "<li><a href=\"?lagc=usuarios&id=".$cont['id']."&verperfil=".LGlobal::Url_Amigable($cont['nombres'])."\">".$cont['nombres']."</a></li>";
			    echo "<li>".$cont['dni']."</li>\n";
			    echo "<li style=\"width: 330px;text-align: left;\"> ".Asistencia::sede_nombre($cont['sede_id'], $cont['id'])."</li>\n";
			    echo "<li style=\"width: 50px;\">".Usuarios::estado($cont['estado'])."</li>\n";
		        if(Componente::permisos($_COOKIE["lgpermisos"], 1, "", "", "")){
			        echo "<li>
			        <a href=\"componentes/asistencia/exportar.php?que=sedetodo&usuario=".$cont['id']."\" title=\"Exportar por Usuario\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/excel.png\" /> Todo
			        </a></li>";
			    }
		        echo "</ul>";
	        }
	    }
	}
	static function sede_nombre($val1,$val2){
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
	                $fin .= "<a href=\"componentes/asistencia/exportar.php?que=sede&sedeid=".$datapc['sede_id']."&usuario=".$val2."\"><img src=\"plantillas/default/img/excel.png\" style=\"width: 20px;\" />".$datapc['sede_nombre']."</a>, ";
	        }
	    }
	    else {
	    	$fin = "No pertenece a ninguna sede";
	    }
	    return $fin;
	}
	static function verquesede($val1){
		$respsede = mysql_query("select * from com_sedes where sede_id='".$val1."'"); $sede = mysql_fetch_array($respsede);
		if($sede['sede_id']==$val1){ $final = $sede['sede_nombre']; }
		return $final;
	}
	static function exportar(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=asistencia" title="Activar Sede" class="menucompo">
				<img src="plantillas/default/img/lista.png">Activar Sede</a>
		</div>
		</br></br></br>
		<center>
			En segundos se descargará automáticamente.</br>
			<span style="font-size: 14px;color: #A74242;">Clic <a href="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=todo" style="text-decoration: none;color: #A74242;">" aqui "</a> si no se descarga automáticamente.</span>
			</br>
			<iframe src="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=todo" frameborder="0" width="0" height="0"></iframe>
		</center>
		<?php
	}
	static function exportar1dias(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=asistencia" title="Activar Sede" class="menucompo">
				<img src="plantillas/default/img/lista.png">Activar Sede</a>
		</div>
		</br></br></br>
		<center>
			En segundos se descargará automáticamente.</br>
			<span style="font-size: 14px;color: #A74242;">Clic <a href="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=por1dias" style="text-decoration: none;color: #A74242;">" aqui "</a> si no se descarga automáticamente.</span>
			</br>
			<iframe src="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=por1dias" frameborder="0" width="0" height="0"></iframe>
		</center>
		<?php
	}
	static function exportar7dias(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=asistencia" title="Activar Sede" class="menucompo">
				<img src="plantillas/default/img/lista.png">Activar Sede</a>
		</div>
		</br></br></br>
		<center>
			En segundos se descargará automáticamente.</br>
			<span style="font-size: 14px;color: #A74242;">Clic <a href="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=por7dias" style="text-decoration: none;color: #A74242;">" aqui "</a> si no se descarga automáticamente.</span>
			</br>
			<iframe src="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=por7dias" frameborder="0" width="0" height="0"></iframe>
		</center>
		<?php
	}
	static function exportar15dias(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=asistencia" title="Activar Sede" class="menucompo">
				<img src="plantillas/default/img/lista.png">Activar Sede</a>
		</div>
		</br></br></br>
		<center>
			En segundos se descargará automáticamente.</br>
			<span style="font-size: 14px;color: #A74242;">Clic <a href="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=por15dias" style="text-decoration: none;color: #A74242;">" aqui "</a> si no se descarga automáticamente.</span>
			</br>
			<iframe src="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=por15dias" frameborder="0" width="0" height="0"></iframe>
		</center>
		<?php
	}
	static function exportar1mes(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=asistencia" title="Activar Sede" class="menucompo">
				<img src="plantillas/default/img/lista.png">Activar Sede</a>
		</div>
		</br></br></br>
		<center>
			En segundos se descargará automáticamente.</br>
			<span style="font-size: 14px;color: #A74242;">Clic <a href="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=por1mes" style="text-decoration: none;color: #A74242;">" aqui "</a> si no se descarga automáticamente.</span>
			</br>
			<iframe src="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php?que=por1mes" frameborder="0" width="0" height="0"></iframe>
		</center>
		<?php
	}
}
?>