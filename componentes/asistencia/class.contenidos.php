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
				está Activo</br>¿Desea Cerrar Sesión?</br><span class=\"btnm\" id=\"terminar\">Si</span>
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