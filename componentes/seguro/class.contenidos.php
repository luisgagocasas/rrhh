<?php
include "componentes/usuarios/class.contenidos.php";
include "componentes/sedes/class.contenidos.php";
class Seguros{
	static function inicio(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=seguro" title="Lista de Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Todos</b></a>
			<a href="?lagc=seguro&id=asignar" title="Asignar Seguro" class="menucompo">
				<img src="plantillas/default/img/lista.png">Asignar Seguro</a>
			<a href="?lagc=seguro&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png">Buscar Personal</a>
		</div>
        <?php
        $respsedes = mysql_query("select * from com_sedes where sede_estado='1' ORDER BY sede_id DESC");
        while($conts = mysql_fetch_array($respsedes)){
        	echo "<h2>".$conts['sede_nombre']."</h2>";
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
		        echo "<li><a href=\"?lagc=seguro&id=".$cont['seguro_id']."&participantes=".$cont['seguro_nombre']."\">Participantes ($rowss)</a></li>";
		        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
			        echo "<li>
			        <a href=\"?lagc=seguro&id=".$cont['seguro_id']."&editar=".LGlobal::Url_Amigable($cont['seguro_nombre'])."\" title=\"Editar Perfil\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/editar.png\" />
			        </a>
			        <a href=\"?lagc=seguro&id=".$cont['seguro_id']."&borrar=".LGlobal::Url_Amigable($cont['seguro_nombre'])."\" title=\"Borrar Perfil\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/borrar.png\" />
			        </a></li>";
			    }
		        echo "</ul>";
	        }
        }

    }
    static function buscar(){
		$palabra = $_GET['buscar'];
		?>
		<div class="tlcabecera">
			<a href="?lagc=seguro" title="Lista de Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Todos</a>
			<a href="?lagc=seguro&id=asignar" title="Asignar Seguro" class="menucompo">
				<img src="plantillas/default/img/lista.png">Asignar Seguro</a>
			<a href="?lagc=seguro&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Buscar Personal</b></a>
		</div>
		<h2>Ver seguro del personal</h2>
		<div class="tlcabecera">
			<form method="get" action="" class="frm_validate">
				<input type="hidden" name="lagc" value="seguro">
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
	            <li style="width: 35%">Seguros Asignados</li>
	        </ul>
	        <?php
	        while($cont = mysql_fetch_array($result)){
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['dni']."</li>\n";
		        echo "<li>".$cont['nombres']."</li>";
			    echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
		        echo "<li>".Usuarios::estado($cont['estado'])."</li>\n";
		        echo "<li style=\"width: 35%\">";
		        echo Seguros::seguropersonal($cont['id']);
		        echo "</li>\n";
		        echo "</ul>";
	        } ?>
	        <div id="mensaje"></div>
	        <?php
	    }
	}
	static function seguropersonal($val1){
		$respaseguro = mysql_query("select * from com_seguro_asignar where id_usuario='".$val1."'");
	    while($aseguros = mysql_fetch_array($respaseguro)){
	    	$respseguro = mysql_query("select * from com_seguros where seguro_id='".$aseguros['id_seguro']."'");
	    	$seguro = mysql_fetch_array($respseguro);
			echo "<u>".$seguro['seguro_nombre']."</u>, ";
	    }
	}
    static function participantes($id, $titulo){ ?>
    	<div class="tlcabecera">
	        <a href="?lagc=seguro" title="Lista de seguros" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
		</br>
		<?php $respcont = mysql_query("select * from com_seguro_asignar where id_seguro='".$id."'");
		$rows = mysql_num_rows($respcont);  ?>
		<h2>Participantes del Seguro: <u><?=$_GET['participantes']; ?></u> (<?=$rows; ?>)</h2></br>
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
		if (!empty($cont['id_seguro'])) { echo "<br><center><h3>Ninguno</h3></center>"; }
	}
    static function editar($id, $titulo){ ?>
    	<div class="tlcabecera">
	        <a href="?lagc=seguro" title="Lista de Seguros" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
    	<?php
		if (empty($_POST['nombres'])) {
			$respcont = mysql_query("select * from com_seguros where seguro_id='".$id."'"); $cont = mysql_fetch_array($respcont);
			if (!empty($cont['seguro_id']) and $titulo==LGlobal::Url_Amigable($cont['seguro_nombre'])) {
				include "editar.tpl";
			} else { echo "<br><center><h3>No existe el docente</h3></center>"; }
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "UPDATE com_seguros SET seguro_nombre='".$_POST['nombres']."', sede_id='".$_POST['sedes']."' WHERE seguro_id='".$id."'";
			$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
			mysql_close($con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=seguro'\", 1500) </script>
				<br><br><center><h3>".$_POST['nombres'].$sicambio.".</h3><h4>Se guardo correctamente.</h4></center>";
		}
	}
	static function asignar(){
		$palabra = $_GET['buscar'];
		?>
		<div class="tlcabecera">
			<a href="?lagc=seguro" title="Lista de Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Todos</a>
			<a href="?lagc=seguro&id=asignar" title="Asignar Seguro" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Asignar Seguro</b></a>
			<a href="?lagc=seguro&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png">Buscar Personal</a>
		</div>
		<h2>Busque personal</h2>
		<div class="tlcabecera">
			<form method="get" action="" class="frm_validate">
				<input type="hidden" name="lagc" value="seguro">
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
	function nuevo(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=seguro" title="Lista de Seguros" class="menucompo">
				<img src="plantillas/default/img/lista.png">Todos</a>
		</div>
		<?php
		if (empty($_POST['nombres'])) {
			include "nuevo.tpl";
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "INSERT INTO com_seguros (seguro_nombre, sede_id) VALUES ('".$_POST['nombres']."','".$_POST['sedes']."')";
			mysql_query($sql,$con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=seguro'\", 1000) </script>
				<br><br><center><h3>".$_POST['nombres'].".<br>Se guardo correctamente.</h3></center>";
		}
	}
	function borrar($id, $titulo) { ?>
		<div class="tlcabecera">
	        <a href="?lagc=seguro" title="Lista de Seguros" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
    	<?php
		$contenidos = mysql_query("select * from com_seguros where seguro_id='".$id."'");
		$conte = mysql_fetch_array($contenidos);
		if (!empty($conte['seguro_id']) and $titulo==LGlobal::Url_Amigable($conte['seguro_nombre'])) {
			if (empty($_POST['id'])) { ?>
			<center>
	            <form name="frmborrar" method="post" action="">
		            <input type="hidden" name="id" value="<?=$conte['seguro_id']; ?>">
		            <input type="hidden" name="title" value="<?=$conte['seguro_nombre']; ?>"><br /><br />
		            <h3>Usted desea eliminar:<br><em style="color:#000;"><?=$conte['seguro_nombre']; ?></em>.</h3><br>
		            <button type="button" onclick="javascript:history.back(1);" onclick="location.href='?lagc=seguro'">Atras</button>
		            <button type="submit">Borrar</button>
	            </form>
        	</center>
            <?php
			}
			else {
				$config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "DELETE FROM com_seguros WHERE seguro_id='".$id."'";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				$sql = "ALTER TABLE com_seguros AUTO_INCREMENT=1";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				mysql_close($con);
				echo "<br /><script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=seguro'\", 1500) </script><center><h3><b><em>".$_POST['title']."</em></b>.</h3><h4>Borrado Correctamente</h4></center>";
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