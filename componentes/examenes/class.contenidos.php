<?php
include "componentes/usuarios/class.contenidos.php";
include "componentes/sedes/class.contenidos.php";
class Examenes{
	static function inicio(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=examenes" title="Lista de Examenes" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Exámenes</b></a>
			<a href="?lagc=examenes&id=clinicas" title="Ver Clinicas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Clinica</a>
			<a href="?lagc=examenes&id=asignar" title="Asignar Perfil" class="menucompo">
				<img src="plantillas/default/img/lista.png">Asignar Perfil</a>
			<a href="?lagc=examenes&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png">Buscar Personal</a>
		</div>
        <?php
        $respsedes = mysql_query("select * from com_sedes where sede_estado='1' ORDER BY sede_id DESC");
        while($conts = mysql_fetch_array($respsedes)){
        	echo "<h2>".$conts['sede_nombre']."</h2>";
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
		        echo "<li><a href=\"?lagc=examenes&id=".$cont['examen_id']."&participantes=".$cont['examen_nombre']."\">Participantes ($rowss)</a></li>";
		        echo "<li>
		        <a href=\"?lagc=examenes&id=".$cont['examen_id']."&editar=".LGlobal::Url_Amigable($cont['examen_nombre'])."\" title=\"Editar Perfil\" class=\"btnopcion\">
		        	<img src=\"plantillas/default/img/editar.png\" />
		        </a>
		        <a href=\"?lagc=examenes&id=".$cont['examen_id']."&borrar=".LGlobal::Url_Amigable($cont['examen_nombre'])."\" title=\"Borrar Perfil\" class=\"btnopcion\">
		        	<img src=\"plantillas/default/img/borrar.png\" />
		        </a></li>";
		        echo "</ul>";
	        }
        }

    }
    static function buscar(){
		$palabra = $_GET['buscar'];
		?>
		<div class="tlcabecera">
			<a href="?lagc=examenes" title="Lista de Examenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Exámenes</a>
			<a href="?lagc=examenes&id=clinicas" title="Ver Clinicas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Clinica</a>
			<a href="?lagc=examenes&id=asignar" title="Asignar Perfil" class="menucompo">
				<img src="plantillas/default/img/lista.png">Asignar Perfil</a>
			<a href="?lagc=examenes&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Buscar Personal</b></a>
		</div>
		<h2>Ver exámenes del personal</h2>
		<div class="tlcabecera">
			<form method="get" action="" class="frm_validate">
				<input type="hidden" name="lagc" value="examenes">
				<input type="hidden" name="id" value="buscar">
			    <input type="text" name="buscar" required placeholder="Ingrese algo que buscar" style="max-width: 300px" value="<?=$palabra; ?>">
			</form>
		</div>
		<?php
		if($palabra){
			$result = mysql_query("SELECT * FROM usuarios WHERE nombres LIKE '%$palabra%' or apellidop LIKE '%$palabra%' or dni LIKE '%$palabra%' or apellidom LIKE '%$palabra%'");
			$rows = mysql_num_rows($result);
			?>
			<div style="text-align: right;"><b>Resultados (<?=$rows; ?>)</b></div>
			<ul class="titulos">
				<li>DNI</li>
	            <li>Nombre</li>
	            <li>Apellidos</li>
	            <li>Estado</li>
	            <li style="width: 35%">Exámenes Asignados</li>
	        </ul>
	        <?php
	        while($cont = mysql_fetch_array($result)){
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['dni']."</li>\n";
		        echo "<li>".$cont['nombres']."</li>";
			    echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
		        echo "<li>".Usuarios::estado($cont['estado'])."</li>\n";
		        echo "<li style=\"width: 35%\">";
		        echo Examenes::examenpersonal($cont['id']);
		        echo "</li>\n";
		        echo "</ul>";
	        } ?>
	        <div id="mensaje"></div>
	        <?php
	    }
	}
	static function examenpersonal($val1){
		$respacurso = mysql_query("select * from com_examen_asignar where id_usuario='".$val1."'");
	    while($acursos = mysql_fetch_array($respacurso)){
	    	$respcurso = mysql_query("select * from com_examenes where examen_id='".$acursos['id_examen']."'");
	    	$cursos = mysql_fetch_array($respcurso);
			echo "<u>".$cursos['examen_nombre']."</u>, ";
	    }
	}
    static function participantes($id, $titulo){ ?>
    	<div class="tlcabecera">
	        <a href="?lagc=examenes" title="Lista de Exámenes" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
		</br>
		<?php $respcont = mysql_query("select * from com_examen_asignar where id_examen='".$id."'");
		$rows = mysql_num_rows($respcont);  ?>
		<h2>Participantes del Exámen: <u><?=$_GET['participantes']; ?></u> (<?=$rows; ?>)</h2></br>
    	<?php
		while($cont = mysql_fetch_array($respcont)){
    		$respuser = mysql_query("select * from usuarios where id='".$cont['id_usuario']."'"); $user = mysql_fetch_array($respuser);
    		echo "<ul class=\"resultados\">\n";
			echo "<li>".$user['apellidop']."</li>";
			echo "<li>".$user['apellidom']."</li>";
			echo "<li>".$user['nombres']."</li>";
			echo "<li><b><a href=\"?lagc=usuarios&id=".$user['id']."&verperfil=".LGlobal::Url_Amigable($user['nombres'])."\">".$user['dni']."</a></b></li>";
			echo "</ul>";
		}
	}
    static function editar($id, $titulo){ ?>
    	<div class="tlcabecera">
	        <a href="?lagc=examenes" title="Lista de Exámenes" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Exámenes
	        </a>
		</div>
    	<?php
		if (empty($_POST['nombres'])) {
			$respcont = mysql_query("select * from com_examenes where examen_id='".$id."'"); $cont = mysql_fetch_array($respcont);
			if (!empty($cont['examen_id']) and $titulo==LGlobal::Url_Amigable($cont['examen_nombre'])) {
				include "editar.tpl";
			} else { echo "<br><center><h3>No existe el exámen</h3></center>"; }
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "UPDATE com_examenes SET examen_nombre='".$_POST['nombres']."', id_clinica='".$_POST['clinica']."', sede_id='".$_POST['sedes']."' WHERE examen_id='".$id."'";
			$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
			mysql_close($con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=examenes'\", 1500) </script>
				<br><br><center><h3>".$_POST['nombres'].$sicambio.".</h3><h4>Se guardo correctamente.</h4></center>";
		}
	}
	static function asignar(){
		$palabra = $_GET['buscar'];
		?>
		<div class="tlcabecera">
			<a href="?lagc=examenes" title="Lista de Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Exámenes</a>
			<a href="?lagc=examenes&id=clinicas" title="Ver Clinicas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Clinica</a>
			<a href="?lagc=examenes&id=asignar" title="Asignar Perfil" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Asignar Perfil</b></a>
			<a href="?lagc=examenes&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png">Buscar Personal</a>
		</div>
		<h2>Busque personal</h2>
		<div class="tlcabecera">
			<form method="get" action="" class="frm_validate">
				<input type="hidden" name="lagc" value="examenes">
				<input type="hidden" name="id" value="asignar">
			    <input type="text" name="buscar" required placeholder="Ingrese algo que buscar" style="max-width: 300px" value="<?=$palabra; ?>">
			</form>
		</div>
		<?php
		if($palabra){
			$result = mysql_query("SELECT * FROM usuarios WHERE nombres LIKE '%$palabra%' or apellidop LIKE '%$palabra%' or dni LIKE '%$palabra%' or apellidom LIKE '%$palabra%'");
			$rows = mysql_num_rows($result);
			?>
			<ul class="titulos">
				<li>DNI</li>
	            <li>Nombre</li>
	            <li>Apellidos</li>
	            <li>Estado</li>
	            <li style="width: 30%">Sedes asignadas</li>
	            <li><b>Resultados (<?=$rows; ?>)</b></li>
	        </ul>
	        <?php
	        while($cont = mysql_fetch_array($result)){
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['dni']."</li>\n";
		        echo "<li>".$cont['nombres']."</li>";
			    echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
		        echo "<li>".Usuarios::estado($cont['estado'])."</li>\n";
		        echo "<li style=\"width: 30%\">".Sedes::sede_nombre($cont['sede_id'], $cont['id'])."</li>\n";
		        echo "<li></li>";
		        echo "</ul>";
	        } ?>
	        <div id="mensaje"></div>
	        <?php
	    }
	}
	static function nuevo(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=examenes" title="Lista de Exámenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Exámenes</a>
		</div>
		<?php
		if (empty($_POST['nombres'])) {
			include "nuevo.tpl";
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "INSERT INTO com_examenes (examen_nombre, id_clinica, sede_id) VALUES ('".$_POST['nombres']."', '".$_POST['clinicas']."', '".$_POST['sedes']."')";
			mysql_query($sql,$con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=examenes'\", 1000) </script>
				<br><br><center><h3>".$_POST['nombres'].".<br>Se guardo correctamente.</h3></center>";
		}
	}
	static function borrar($id, $titulo) { ?>
		<div class="tlcabecera">
	        <a href="?lagc=examenes" title="Lista de Exámenes" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Exámenes
	        </a>
		</div>
    	<?php
		$contenidos = mysql_query("select * from com_examenes where examen_id='".$id."'");
		$conte = mysql_fetch_array($contenidos);
		if (!empty($conte['examen_id']) and $titulo==LGlobal::Url_Amigable($conte['examen_nombre'])) {
			if (empty($_POST['id'])) { ?>
			<center>
	            <form name="frmborrar" method="post" action="">
		            <input type="hidden" name="id" value="<?=$conte['examen_id']; ?>">
		            <input type="hidden" name="title" value="<?=$conte['examen_nombre']; ?>"><br /><br />
		            <h3>Usted desea eliminar:<br><em style="color:#000;"><?=$conte['examen_nombre']; ?></em>.</h3><br>
		            <button type="button" onclick="javascript:history.back(1);" onclick="location.href='?lagc=examenes'">Atras</button>
		            <button type="submit">Borrar</button>
	            </form>
        	</center>
            <?php
			}
			else {
				$config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "DELETE FROM com_examenes WHERE examen_id='".$id."'";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				$sql = "ALTER TABLE com_examenes AUTO_INCREMENT=1";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				mysql_close($con);
				echo "<br /><script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=examenes'\", 1500) </script><center><h3><b><em>".$_POST['title']."</em></b>.</h3><h4>Borrado Correctamente</h4></center>";
			}
		} else { echo "<br><center><h3>No existe el contenido</h3></center>"; }
	}
	static function clinicas(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=examenes" title="Lista de Examenes" class="menucompo">
				<img src="plantillas/default/img/lista.png">Exámenes</a>
			<a href="?lagc=examenes&id=clinicas" title="Ver Clinicas" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Clinica</b></a>
			<a href="?lagc=examenes&id=asignar" title="Asignar Perfil" class="menucompo">
				<img src="plantillas/default/img/lista.png">Asignar Perfil</a>
			<a href="?lagc=examenes&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png">Buscar Personal</a>
		</div>
		<?php
        $respclinicas = mysql_query("select * from com_examen_clinica ORDER BY nombre DESC");
        $rows = mysql_num_rows($respclinicas); ?>
		<ul class="titulos">
			<li>Nombre</li>
			<li>Dirección</li>
			<li>Telefono</li>
            <li><b>Registros (<?=$rows; ?>)</b></li>
        </ul>
        <?php
        while($clinica = mysql_fetch_array($respclinicas)){ ?>
	        <?php
	        echo "<ul class=\"resultados\">\n";
	        echo "<li>".$clinica['nombre']."</li>";
	        echo "<li>".$clinica['direccion']."</li>";
	        echo "<li>".$clinica['telefono']."</li>";
	        echo "<li>
	        <a href=\"?lagc=examenes&id=".$clinica['id_clinica']."&editarclinica=".LGlobal::Url_Amigable($clinica['nombre'])."\" title=\"Editar CLinica\" class=\"btnopcion\">
	        	<img src=\"plantillas/default/img/editar.png\" />
	        </a>
	        <a href=\"?lagc=examenes&id=".$clinica['id_clinica']."&borrarclinica=".LGlobal::Url_Amigable($clinica['nombre'])."\" title=\"Borrar CLinica\" class=\"btnopcion\">
	        	<img src=\"plantillas/default/img/borrar.png\" />
	        </a></li>";
	        echo "</ul>";
        }

    }
    static function editarclinica($id, $titulo){ ?>
    	<div class="tlcabecera">
	        <a href="?lagc=examenes&id=clinicas" title="Lista de Clinicas" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Clinicas
	        </a>
		</div>
    	<?php
		if (empty($_POST['nombre'])) {
			$respcont = mysql_query("select * from com_examen_clinica where id_clinica='".$id."'"); $cont = mysql_fetch_array($respcont);
			if (!empty($cont['id_clinica']) and $titulo==LGlobal::Url_Amigable($cont['nombre'])) {
				include "editarclinica.tpl";
			} else { echo "<br><center><h3>No existe la clinica</h3></center>"; }
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "UPDATE com_examen_clinica SET nombre='".$_POST['nombre']."', direccion='".$_POST['direccion']."', telefono='".$_POST['telefono']."' WHERE id_clinica='".$id."'";
			$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
			mysql_close($con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=examenes&id=clinicas'\", 1500) </script>
				<br><br><center><h3>".$_POST['nombre'].$sicambio.".</h3><h4>Se guardo correctamente.</h4></center>";
		}
	}
	function nuevaclinica(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=examenes&id=clinicas" title="Lista de Clinicas" class="menucompo">
				<img src="plantillas/default/img/lista.png"> Clinicas</a>
		</div>
		<?php
		if (empty($_POST['nombre'])) {
			include "nuevaclinica.tpl";
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "INSERT INTO com_examen_clinica (nombre, direccion, telefono) VALUES ('".$_POST['nombre']."','".$_POST['direccion']."','".$_POST['telefono']."')";
			mysql_query($sql,$con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=examenes&id=clinicas'\", 1000) </script>
				</br></br><center><h3>".$_POST['nombre'].".<br>Se guardo correctamente.</h3></center>";
		}
	}
	static function borrarclinica($id, $titulo) { ?>
		<div class="tlcabecera">
	        <a href="?lagc=examenes&id=clinicas" title="Lista Clinicas" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Clinicas
	        </a>
		</div>
    	<?php
		$contenidos = mysql_query("select * from com_examen_clinica where id_clinica='".$id."'");
		$conte = mysql_fetch_array($contenidos);
		if (!empty($conte['id_clinica']) and $titulo==LGlobal::Url_Amigable($conte['nombre'])) {
			if (empty($_POST['id'])) { ?>
			<center>
	            <form name="frmborrar" method="post" action="">
		            <input type="hidden" name="id" value="<?=$conte['id_clinica']; ?>">
		            <input type="hidden" name="title" value="<?=$conte['nombre']; ?>"><br /><br />
		            <h3>Usted desea eliminar:<br><em style="color:#000;"><?=$conte['nombre']; ?></em>.</h3><br>
		            <button type="button" onclick="javascript:history.back(1);" onclick="location.href='?lagc=examenes&id=clinicas'">Atras</button>
		            <button type="submit">Borrar</button>
	            </form>
        	</center>
            <?php
			}
			else {
				$config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "DELETE FROM com_examen_clinica WHERE id_clinica='".$id."'";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				$sql = "ALTER TABLE com_examen_clinica AUTO_INCREMENT=1";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				mysql_close($con);
				echo "<br /><script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=examenes&id=clinicas'\", 1500) </script><center><h3><b><em>".$_POST['title']."</em></b>.</h3><h4>Borrado Correctamente</h4></center>";
			}
		} else { echo "<br><center><h3>No existe el contenido</h3></center>"; }
	}
	static function check($val1, $val2){
		if($val1==$val2){ $fin = " checked"; }
		else { $fin = ""; }
		return $fin;
	}
	static function estado($var1){
		if($var1=="1"){ $final = "<span class=\"estado bg1\"></span>"; }
		else if($var1=="0"){ $final = "<span class=\"estado bg2\"></span> "; }
		return $final;
	}
}
?>