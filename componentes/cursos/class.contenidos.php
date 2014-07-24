<?php
include "componentes/usuarios/class.contenidos.php";
include "componentes/sedes/class.contenidos.php";
class Cursos{
	static function inicio(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=cursos" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Todos</b></a>
			<a href="?lagc=cursos&id=asignar" title="Asignar Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Asignar Curso</a>
			<a href="?lagc=cursos&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png">Buscar Personal</a>
		</div>
        <?php
        $respsedes = mysql_query("select * from com_sedes where sede_estado='1' ORDER BY sede_id DESC");
        while($conts = mysql_fetch_array($respsedes)){
        	echo "<h2>".$conts['sede_nombre']."</h2>";
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
		        echo "<li><a href=\"?lagc=cursos&id=".$cont['curso_id']."&participantes=".$cont['curso_nombre']."\">Participantes ($rowss)</a></li>";
		        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
			        echo "<li>
			        <a href=\"?lagc=cursos&id=".$cont['curso_id']."&editar=".LGlobal::Url_Amigable($cont['curso_nombre'])."\" title=\"Editar Participante\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/editar.png\" />
			        </a>
			        <a href=\"?lagc=cursos&id=".$cont['curso_id']."&borrar=".LGlobal::Url_Amigable($cont['curso_nombre'])."\" title=\"Borrar Participante\" class=\"btnopcion\">
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
			<a href="?lagc=cursos" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Todos</a>
			<a href="?lagc=cursos&id=asignar" title="Asignar Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Asignar Curso</a>
			<a href="?lagc=cursos&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Buscar Personal</b></a>
		</div>
		<h2>Ver curso del personal</h2>
		<div class="tlcabecera">
			<form method="get" action="" class="frm_validate">
				<input type="hidden" name="lagc" value="cursos">
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
	            <li style="width: 35%">Cursos Asignados</li>
	        </ul>
	        <?php
	        while($cont = mysql_fetch_array($result)){
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".$cont['dni']."</li>\n";
		        echo "<li>".$cont['nombres']."</li>";
			    echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
		        echo "<li>".Usuarios::estado($cont['estado'])."</li>\n";
		        echo "<li style=\"width: 35%\">";
		        echo Cursos::cursospersonal($cont['id']);
		        echo "</li>\n";
		        echo "</ul>";
	        } ?>
	        <div id="mensaje"></div>
	        <?php
	    }
	}
	static function cursospersonal($val1){
		$respacurso = mysql_query("select * from com_curso_asignar where id_usuario='".$val1."'");
	    while($acursos = mysql_fetch_array($respacurso)){
	    	$respcurso = mysql_query("select * from com_cursos where curso_id='".$acursos['id_curso']."'");
	    	$cursos = mysql_fetch_array($respcurso);
			echo "<u>".$cursos['curso_nombre']."</u>, ";
	    }
	}
    static function participantes($id, $titulo){ ?>
    	<div class="tlcabecera">
	        <a href="?lagc=cursos" title="Lista de cursos" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
		</br>
		<?php $respcont = mysql_query("select * from com_curso_asignar where id_curso='".$id."'");
		$rows = mysql_num_rows($respcont);  ?>
		<h2>Participantes del Curso: <u><?=$_GET['participantes']; ?></u> (<?=$rows; ?>)</h2></br>
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
	        <a href="?lagc=cursos" title="Lista de cursos" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
    	<?php
		if (empty($_POST['nombres'])) {
			$respcont = mysql_query("select * from com_cursos where curso_id='".$id."'"); $cont = mysql_fetch_array($respcont);
			if (!empty($cont['curso_id']) and $titulo==LGlobal::Url_Amigable($cont['curso_nombre'])) {
				include "editar.tpl";
			} else { echo "<br><center><h3>No existe el docente</h3></center>"; }
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "UPDATE com_cursos SET curso_nombre='".$_POST['nombres']."', sede_id='".$_POST['sedes']."' WHERE curso_id='".$id."'";
			$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
			mysql_close($con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=cursos'\", 1500) </script>
				<br><br><center><h3>".$_POST['nombres'].$sicambio.".</h3><h4>Se guardo correctamente.</h4></center>";
		}
	}
	static function asignar(){
		$palabra = $_GET['buscar'];
		?>
		<div class="tlcabecera">
			<a href="?lagc=cursos" title="Lista de Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Todos</a>
			<a href="?lagc=cursos&id=asignar" title="Asignar Cursos" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Asignar Curso</b></a>
			<a href="?lagc=cursos&id=buscar" title="Buscar" class="menucompo">
				<img src="plantillas/default/img/lista.png">Buscar Personal</a>
		</div>
		<h2>Busque un personal para asignarle un curso</h2>
		<div class="tlcabecera">
			<form method="get" action="" class="frm_validate">
				<input type="hidden" name="lagc" value="cursos">
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
			<a href="?lagc=cursos" title="Lista de cursos" class="menucompo">
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
			$sql = "INSERT INTO com_cursos (curso_nombre, sede_id) VALUES ('".$_POST['nombres']."','".$_POST['sedes']."')";
			mysql_query($sql,$con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=cursos'\", 1000) </script>
				<br><br><center><h3>".$_POST['nombres'].".<br>Se guardo correctamente.</h3></center>";
		}
	}
	function borrar($id, $titulo) { ?>
		<div class="tlcabecera">
	        <a href="?lagc=cursos" title="Lista de cursos" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
    	<?php
		$contenidos = mysql_query("select * from com_cursos where curso_id='".$id."'");
		$conte = mysql_fetch_array($contenidos);
		if (!empty($conte['curso_id']) and $titulo==LGlobal::Url_Amigable($conte['curso_nombre'])) {
			if (empty($_POST['id'])) { ?>
			<center>
	            <form name="frmborrar" method="post" action="">
		            <input type="hidden" name="id" value="<?=$conte['curso_id']; ?>">
		            <input type="hidden" name="title" value="<?=$conte['curso_nombre']; ?>"><br /><br />
		            <h3>Usted desea eliminar:<br><em style="color:#000;"><?=$conte['curso_nombre']; ?></em>.</h3><br>
		            <button type="button" onclick="javascript:history.back(1);" onclick="location.href='?lagc=cursos'">Atras</button>
		            <button type="submit">Borrar</button>
	            </form>
        	</center>
            <?php
			}
			else {
				$config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "DELETE FROM com_cursos WHERE curso_id='".$id."'";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				$sql = "ALTER TABLE com_cursos AUTO_INCREMENT=1";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				mysql_close($con);
				echo "<br /><script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=cursos'\", 1500) </script><center><h3><b><em>".$_POST['title']."</em></b>.</h3><h4>Borrado Correctamente</h4></center>";
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