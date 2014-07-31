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
		<div class="tlcabecera" style="height: auto;">
			<h2>Ver asistencia</h2><br>
			<form method="get" action="" class="frm_validate" style="display: inline-block;width: 300px;">
				<input type="hidden" name="lagc" value="asistencia">
				<input type="hidden" name="id" value="buscar">
			    <input type="search" name="buscar" required placeholder="Ingrese algo que buscar" value="<?=$_GET['buscar']; ?>">
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
            <li style="width: 200px;">Sedes</li>
            <li style="width: 80px;">Estado</li>
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
			    echo "<li style=\"width: 200px;text-align: left;\"> ".Asistencia::sede_nombre($cont['sede_id'], $cont['id'])."</li>\n";
			    echo "<li style=\"width: 80px;\">".Usuarios::estado($cont['estado'])."</li>\n";
		        if(Componente::permisos($_COOKIE["lgpermisos"], 1, "", "", "")){
			        echo "<li style=\"text-align:right\">
			        <a href=\"?lagc=asistencia&id=".$cont['id']."&ver=".$cont['nombres']." ".$cont['apellidop']." ".$cont['apellidom']."\" title=\"Ver Asistencia de ".$cont['nombres']." ".$cont['apellidop']." ".$cont['apellidom']."\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/lista.png\" />
			        </a> -
			        <a href=\"componentes/asistencia/exportar.php?que=sedetodo&usuario=".$cont['id']."\" title=\"Exportar por Usuario\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/excel.png\" />
			        </a></li>";
			    }
		        echo "</ul>";
	        }
	    }
	}
	static function ver($var1, $var2){ ?>
		<h2 style="display: inline-block;">Resumen de asistencia de: <?=$var2; ?></h2>
		<a href="?lagc=asistencia&id=<?=$var1; ?>&nuevo=<?=$var2; ?>" style="text-decoration: none;color: #277386;font-weight: bold;float: right;"><img src="plantillas/default/img/agregar.png" style="width: 25px;" /> Agregar asistencia</a>
    	<ul class="titulos">
			<li>Apellidos</li>
            <li>Nombres</li>
            <li>DNI</li>
            <li>Entrada/Salida</li>
            <li>Sede</li>
            <li style="width:150px;">Fecha</li>
            <li></li>
        </ul>
        <?php
		$respasis = mysql_query("select * from com_asistencia where id_user='".$var1."'");
	    while($asistencia = mysql_fetch_array($respasis)) {
	    	echo "<ul class=\"resultados\">\n";
			   	echo "<li>".$asistencia['apellidop']." ".$asistencia['apellidom']."</li>\n";
			   	echo "<li>".$asistencia['nombre']."</li>\n";
			   	echo "<li>".$asistencia['dni']."</li>\n";
			   	echo "<li>".$asistencia['ensa']."</li>\n";
			   	echo "<li>".$asistencia['sede']."</li>\n";
			   	echo "<li style=\"width:150px;\">".date("Y-m-d H:i:s",$asistencia['fecha'])."</li>\n";
			   	 echo "<li>
			        <a href=\"?lagc=asistencia&id=".$asistencia['id_asis']."&editar=".$asistencia['nombre']."\" title=\"Editar Asistencia\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/editar.png\" />
			        </a>
			        <a href=\"?lagc=asistencia&id=".$asistencia['id_asis']."&borrar=".$asistencia['nombre']."\" title=\"Borrar Asistencia\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/borrar.png\" />
			        </a></li>";
		   	echo "</ul>";
	    }
	}
	static function nuevo($id){
		$respasis = mysql_query("select * from usuarios where id='".$id."'");
	   	$asistencia = mysql_fetch_array($respasis); ?>
    	<div class="tlcabecera">
	        <a href="?lagc=asistencia&id=<?=$asistencia['id'];?>&ver=<?=$asistencia['nombres']." ".$asistencia['apellidop']." ".$asistencia['apellidom']; ?>" title="Lista de asistencia" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Regresar
	        </a>
		</div>
    	<?php
		if (empty($_POST['sede'])) { ?>
			<h2>Crear asistencia para: <?=$asistencia['nombres']." ".$asistencia['apellidop']."".$asistencia['apellidom']; ?></h2>
			<form method="post" action="" class="frm_validate">
				<div class="grid grid-pad select001">
                    <div class="col-1-3">
						<div class="form_control">
					        <label for="txtName">Entrada / Salida</label>
					        <select name="ensa">
					        	<option value="Entrada">Entrada</option>
					        	<option value="Salida">Salida</option>
					        </select>
					    </div>
                    </div>
                    <div class="col-1-3"></div>
                    <div class="col-1-31"></div>
                </div>
                <div class="grid grid-pad select001">
                    <div class="col-1-3">
						<div class="form_control">
					        <label for="txtName">Sede</label>
					        <select name="sede">
					        	<?php
					        	$respsede = mysql_query("select * from com_sedes");
    							while($sede = mysql_fetch_array($respsede)) {
    								echo "<option value=\"".$sede['sede_id']."\">".$sede['sede_nombre']."</option>";
    							}
					        	?>
					        </select>
					    </div>
                    </div>
                    <div class="col-1-3"></div>
                    <div class="col-1-31"></div>
                </div>
                <div class="grid grid-pad select001">
                    <div class="col-1-3">
						<div class="form_control">
					        <label for="txtfecha">Fecha</label>
					        <input type="date" name="fecha" id="txtfecha">
					    </div>
                    </div>
                    <div class="col-1-3"></div>
                    <div class="col-1-31"></div>
                </div>
                <div class="grid grid-pad select001">
                    <div class="col-1-3">
						<div class="form_control">
		                	<button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
		                </div>
                    </div>
                    <div class="col-1-3"></div>
                    <div class="col-1-31"></div>
                </div>
            </form>
			<?php
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$respsede2 = mysql_query("select * from com_sedes where sede_id=".$_POST['sede']."");
    		$sede2 = mysql_fetch_array($respsede2);
			$sql = "INSERT INTO com_asistencia (id_user, apellidop, apellidom, nombre, dni, ensa, sede, sede_id, fecha) VALUES ('".$asistencia['id']."', '".$asistencia['apellidop']."', '".$asistencia['apellidom']."', '".$asistencia['nombres']."', '".$asistencia['dni']."', '".$_POST['ensa']."', '".$sede2['sede_nombre']."', '".$_POST['sede']."', '".time($_POST['fecha'])."')";
			mysql_query($sql,$con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=asistencia&id=".$asistencia['id']."&ver=".$asistencia['nombres']." ".$asistencia['apellidop']." ".$asistencia['apellidom']."'\", 1000) </script>
			<br><br><center><h3>".$asistencia['nombres']." ".$asistencia['apellidop']." ".$asistencia['apellidom'].".</br>Se guardo correctamente.</h3></center>";
		}
	}
	static function editar($id, $titulo){
		$respasis = mysql_query("select * from com_asistencia where id_asis='".$id."'");
	   	$asistencia = mysql_fetch_array($respasis); ?>
    	<div class="tlcabecera">
	        <a href="?lagc=asistencia&id=<?=$asistencia['id_user'];?>&ver=<?=$asistencia['nombre']." ".$asistencia['apellidop']." ".$asistencia['apellidom']; ?>" title="Lista de asistencia" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
    	<?php
		if (empty($_POST['ensa'])) {
			$respcont = mysql_query("select * from com_asistencia where id_asis='".$id."'"); $cont = mysql_fetch_array($respcont);
			if ($cont['id_asis']==$id) { ?>
			<h2>Editar asistencia de: <?=$cont['nombre']." ".$cont['apellidop']."".$cont['apellidom']; ?></h2>
				<form method="post" action="" class="frm_validate">
					<div class="grid grid-pad select001">
	                    <div class="col-1-3">
							<div class="form_control">
						        <label for="txtName">Entrada / Salida</label>
						        <select name="ensa">
						        	<option value="Entrada" <?=Asistencia::select($cont['ensa'],"Entrada"); ?>>Entrada</option>
						        	<option value="Salida" <?=Asistencia::select($cont['ensa'],"Salida"); ?>>Salida</option>
						        </select>
						    </div>
	                    </div>
	                    <div class="col-1-3"></div>
	                    <div class="col-1-31"></div>
	                </div>
	                <div class="grid grid-pad select001">
	                    <div class="col-1-3">
							<div class="form_control">
						        <label for="txtName">Sede</label>
						        <select name="sede">
						        	<?php
						        	$respsede = mysql_query("select * from com_sedes");
	    							while($sede = mysql_fetch_array($respsede)) {
	    								if($sede['sede_id']==$cont['sede_id']){
	    									echo "<option value=\"".$sede['sede_id']."\" selected=\"selected\">".$sede['sede_nombre']."</option>";
	    								}
	    								else {
	    									echo "<option value=\"".$sede['sede_id']."\">".$sede['sede_nombre']."</option>";
	    								}
	    							}
						        	?>
						        </select>
						    </div>
	                    </div>
	                    <div class="col-1-3"></div>
	                    <div class="col-1-31"></div>
	                </div>
	                <div class="grid grid-pad select001">
	                    <div class="col-1-3">
							<div class="form_control">
						        <label for="txtfecha">Fecha</label>
						        <input type="date" name="fecha2" id="txtfecha" value="<?=date("Y-m-d",$cont['fecha']); ?>">
						    </div>
	                    </div>
	                    <div class="col-1-3"></div>
	                    <div class="col-1-31"></div>
	                </div>
	                <div class="grid grid-pad select001">
	                    <div class="col-1-3">
							<div class="form_control">
			                	<button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
			                </div>
	                    </div>
	                    <div class="col-1-3"></div>
	                    <div class="col-1-31"></div>
	                </div>
                </form>
				<?php
			} else { echo "<br><center><h3>No existe</h3></center>"; }
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$respsede2 = mysql_query("select * from com_sedes where sede_id='".$_POST['sede']."'"); $sede2 = mysql_fetch_array($respsede2);
			$sql = "UPDATE com_asistencia SET ensa='".$_POST['ensa']."', sede_id='".$_POST['sede']."', sede='".$sede2['sede_nombre']."', fecha='".time(date("Y-m-d",$_POST['fecha2']))."' WHERE id_asis='".$id."'";
			$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
			mysql_close($con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=asistencia&id=".$asistencia['id_user']."&ver=".$asistencia['nombre']." ".$asistencia['apellidop']." ".$asistencia['apellidom']."'\", 1500) </script>
				<br><br><center><h3>".$asistencia['nombre']." ".$asistencia['apellidop']." ".$asistencia['apellidom'].".</h3><h4>Se guardo correctamente.</h4></center>";
		}
	}
	static function borrar($id, $titulo) {
		$respasis = mysql_query("select * from com_asistencia where id_asis='".$id."'");
	   	$asistencia = mysql_fetch_array($respasis); ?>
    	<div class="tlcabecera">
	        <a href="?lagc=asistencia&id=<?=$asistencia['id_user'];?>&ver=<?=$asistencia['nombre']." ".$asistencia['apellidop']." ".$asistencia['apellidom']; ?>" title="Lista de asistencia" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
    	<?php
		$contenidos = mysql_query("select * from com_asistencia where id_asis='".$id."'");
		$conte = mysql_fetch_array($contenidos);
		if (!empty($conte['id_asis'])) {
			if (empty($_POST['id'])) { ?>
			<center>
	            <form name="frmborrar" method="post" action="">
		            <input type="hidden" name="id" value="<?=$conte['id_asis']; ?>">
		            <input type="hidden" name="title" value="<?=$conte['nombre']." ".$conte['apellidop']." ".$conte['apellidom']; ?>"><br /><br />
		            <h3>Usted desea eliminar:<br><em style="color:#000;"><?=$conte['nombre']." ".$conte['apellidop']." ".$conte['apellidom']; ?></em>.</h3><br>
		            <button type="button" onclick="javascript:history.back(1);" onclick="location.href='?lagc=asistencia&id=<?=$conte['id_user']."&ver=".$conte['nombre']." ".$conte['apellidop']." ".$conte['apellidom']; ?>'">Atras</button>
		            <button type="submit">Borrar</button>
	            </form>
        	</center>
            <?php
			}
			else {
				$config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "DELETE FROM com_asistencia WHERE id_asis='".$id."'";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				$sql = "ALTER TABLE com_asistencia AUTO_INCREMENT=1";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				mysql_close($con);
				echo "<br /><script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=asistencia&id=".$asistencia['id_user']."&ver=".$asistencia['nombre']." ".$asistencia['apellidop']." ".$asistencia['apellidom']."'\", 1500) </script><center><h3><b><em>".$_POST['title']."</em></b>.</h3><h4>Borrado Correctamente</h4></center>";
			}
		} else { echo "<br><center><h3>No existe el contenido</h3></center>"; }
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
	static function select($val1, $val2){
		if($val1==$val2){ $fin = " selected=\"selected\""; }
		else { $fin = ""; }
		return $fin;
	}
}
?>