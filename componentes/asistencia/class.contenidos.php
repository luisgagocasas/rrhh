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
			    <input type="text" name="buscar" required placeholder="Ingrese algo que buscar">
			</form>
		</div>
		<?php
		$result = mysql_query("SELECT * FROM com_asistencia WHERE dni LIKE '%$palabra%' or apellidop LIKE '%$palabra%' or apellidom LIKE '%$palabra%' or nombre LIKE '%$palabra%' or ensa LIKE '%$palabra%' or sede LIKE '%$palabra%'");
		$rows = mysql_num_rows($result);
		?>
		<ul class="titulos">
			<li>Apellidos</li>
            <li>Nombres</li>
            <li>DNI</li>
            <li>Entrada/Salida</li>
            <li>Sede</li>
            <li>Fecha</li>
            <li><b>Registros (<?=$rows; ?>)</b></li>
        </ul>
		<?php
		if(!empty($palabra)){
			$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	        while($cont = mysql_fetch_array($result)){
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
		        echo "<li><a href=\"?lagc=usuarios&id=".$cont['id_user']."&verperfil=".LGlobal::Url_Amigable($cont['nombre'])."\">".$cont['nombre']."</a></li>";
			    echo "<li>".$cont['dni']."</li>\n";
		        echo "<li>".$cont['ensa']."</li>\n";
		        echo "<li>".$cont['sede']."</li>\n";
		        echo "<li><u>".date("d", $cont['fecha'])."</u> de ".$meses[date('n', $cont['fecha'])-1]." de ".date("Y", $cont['fecha'])."</li>\n";
		        if(Componente::permisos($_COOKIE["lgpermisos"], 1, "", "", "")){
			        echo "<li>
			        <a href=\"#\" title=\"Exportar\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/excel.png\" />
			        </a>
			        <a href=\"#\" title=\"Editar registro\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/editar.png\" />
			        </a>
			        <a href=\"#\" title=\"Borrar registro\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/borrar.png\" />
			        </a></li>";
			    }
		        echo "</ul>";
	        }
	    }
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
			<span style="font-size: 14px;color: #A74242;">Clic <a href="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php" style="text-decoration: none;color: #A74242;">" aqui "</a> si no se descarga automáticamente.</span>
			</br>
			<iframe src="<?=$config->lagcurl; ?>componentes/asistencia/exportar.php" frameborder="0" width="0" height="0"></iframe>
		</center>
		<?php
	}
}
?>