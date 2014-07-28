<?php
class Usuarios{
	static function inicio(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=usuarios" title="Lista de Usuarios" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Todos</b></a>
			<a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Administradores</a>
			<a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Trabajadores</a>
			<form method="get" action="" class="frm_validate" style="display: inline-block;float: right;">
				<input type="hidden" name="lagc" value="usuarios">
				<input type="hidden" name="id" value="true">
			    <input type="text" name="buscar" required placeholder="Ingrese algo que buscar">
			</form>
		</div>
        <?php $respcont = mysql_query("select * from usuarios ORDER BY id DESC");
        $rows = mysql_num_rows($respcont); ?>
		<ul class="titulos">
			<li style="width: 30px;"></li>
			<li>DNI</li>
            <li>Nombre</li>
            <li>Apellidos</li>
            <li>Correo</li>
            <li>Estado</li>
            <li><b>Registros (<?=$rows; ?>)</b></li>
        </ul>
        <form action="" id="eliminarr" method="post">
        <?php
        while($cont = mysql_fetch_array($respcont)){
	        echo "<ul class=\"resultados\">\n";
	        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
		        if($cont['nivel']==4){ echo "<li style=\"width: 30px;\"><input name=\"checkbox[]\" type=\"checkbox\" value=\"".$cont['id']."\" alt=\"1\" onChange=\"suma(this)\"></li>"; }
		        else { echo "<li style=\"width: 30px;\"></li>"; }
		    }
	        echo "<li>".$cont['dni']."</li>\n";
	        echo "<li><a href=\"?lagc=usuarios&id=".$cont['id']."&verperfil=".LGlobal::Url_Amigable($cont['nombres'])."\">".$cont['nombres']."</a></li>";
		    echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
	        echo "<li>".$cont['email']."</li>\n";
	        echo "<li>".Usuarios::estado($cont['estado'])."</li>\n";
	        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
		        echo "<li>
		        <a href=\"?lagc=usuarios&id=".$cont['id']."&editar=".LGlobal::Url_Amigable($cont['nombres'])."\" title=\"Editar Participante\" class=\"btnopcion\">
		        	<img src=\"plantillas/default/img/editar.png\" />
		        </a>";
	    	}
	        echo "</ul>";
        }
        ?>
        </form>
        <div class="mensaje" id="mensaje">
        	<?php
        	if(empty($_POST['checkbox'])){ ?>
		        Ha seleccionado <input type="text" id="numero" disabled readonly="true" value="0" size="1" class="numero"> usuarios.<br/>
		        ¿desea eliminarlos?<br/>
		        <a href="#" id="checkeff" class="btnm">No</a>
		        <a href="#" id="eliminar" class="btnm">Si</a>
        	<?php } ?>
	        <?php
	        if($_POST['checkbox']){
		        $config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "delete from usuarios WHERE id in (".implode(",", $_POST['checkbox']).")";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				echo "Registros eliminados.";
				echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=usuarios'\", 500) </script>";
				?>
				<script>
					$(document).ready(function(){
						$("#mensaje").css({"display":"block"});
					});
				</script>
				<?php
	        }
	        ?>
	        <div id="mensaje_editar">
	        	<hr>
	        	Desea editar el registro?<br/>
		        <a href="#" id="editar" class="btnm">Si</a>
	        </div>
        </div>
		<?php
	}
	static function editar($id, $titulo){
		if (empty($_POST['nombres'])) {
			$respcont = mysql_query("select * from usuarios where id='".$id."'"); $cont = mysql_fetch_array($respcont);
			if (!empty($cont['id']) and $titulo==LGlobal::Url_Amigable($cont['nombres']) or !empty($cont['id']) and $titulo=="true") {
				include "editar.tpl";
			} else { echo "<br><center><h3>No existe el personal</h3></center>"; }
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			/*Imagen de perfil*/
			if(!empty($_POST['sedes'])){ $sedes = implode ('|', $_POST["sedes"]); }
			else { $sedes = ""; }
			if (!empty($_FILES['archivo']['name'])) {
				if ($_FILES['archivo']["error"] > 0){ echo "Error: ".$_FILES['archivo']['error']."<br />"; }
				else {
					$tipoft = substr($_FILES['archivo']['type'], 6);
					$nombreft = $_POST['id']."_".LGlobal::Url_Amigable($_POST['nombres'].$_POST['apellidop'].$_POST['apellidom']).".".$tipoft;
					$fotoruta = "imagenes/";
					echo "<br /><br /><div style=\"margin: 0px auto; width: 350px;\">";
						echo "<center><h2>Datos de la Imagen</h2></center>";
						echo "Nombre: ".$nombreft."<br />";
						echo "Tipo: ".$_FILES['archivo']['type']."<br />";
						echo "Tamaño: ".($_FILES["archivo"]["size"] / 1024)." kB<br />";
					echo "</div>";
					move_uploaded_file($_FILES['archivo']['tmp_name'],$fotoruta.$nombreft);
				}
			}
			else { $nombreft = $_POST['fotohid']; }
			// Si cambia de contraseña
			if(!empty($_POST['password'])){
				$apassword = "password='".md5($_POST['password'])."', ";
			}
			if(!empty($_POST['usuario'])){
				$ausuario = "usuario='".$_POST['usuario']."', ";
			}
			/* */
			$resppermisos = mysql_query("select * from permisos where id='".$_POST['permisos']."'");
			$permisos = mysql_fetch_array($resppermisos);
			$nivel = $permisos['nivel'];
			$sql = "UPDATE usuarios SET $apassword $ausuario email='".$_POST['email']."', nombres='".$_POST['nombres']."', apellidop='".$_POST['apellidop']."', apellidom='".$_POST['apellidom']."', permisos='".$_POST['permisos']."', nivel='".$nivel."', imagen='".$nombreft."', dni='".$_POST['dni']."', codigo='".$_POST['codigo']."', cargo='".$_POST['cargo']."', fechanacimiento='".$_POST['cumpleanios']."', departamento='".$_POST['departamento']."', celular='".$_POST['cel']."', fechaingresoempresa='".$_POST['fempresa']."', gsanguineo='".$_POST['gsanguineo']."', estado='".$_POST['estado']."', genero='".$_POST['radGener']."', modificadoel='".time()."', comentario='".$_POST['comentario']."', sede_id='".$sedes."' WHERE id='".$id."'";
			$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
			mysql_close($con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=usuarios'\", 1000) </script><br><br><center><h3>".$_POST['nombres']." ".$_POST['apellidop'].$_POST['apellidom'].".<br>Se guardo correctamente.</h3></center>";
		}
	}
	static function verperfil($id, $titulo){
		$respcont = mysql_query("select * from usuarios where id='".$id."'"); $cont = mysql_fetch_array($respcont);
		if (!empty($cont['id']) and $titulo==LGlobal::Url_Amigable($cont['nombres'])) {
			include "verperfil.tpl";
		} else { echo "<br><center><h3>No existe el perfil</h3></center>"; }
	}
	static function buscar($palabra){ ?>
		<div class="tlcabecera">
			<a href="?lagc=usuarios" title="Lista de Usuarios" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Todos</b></a>
			<a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Administradores</a>
			<a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Trabajadores</a>
			<form method="get" action="" class="frm_validate" style="display: inline-block;float: right;">
				<input type="hidden" name="lagc" value="usuarios">
				<input type="hidden" name="id" value="true">
			    <input type="text" name="buscar" required placeholder="Ingrese algo que buscar" value="<?=$_GET['buscar']; ?>">
			</form>
		</div>
		<?php
		$result = mysql_query("SELECT * FROM usuarios WHERE nombres LIKE '%$palabra%' or apellidop LIKE '%$palabra%' or email LIKE '%$palabra%' or dni LIKE '%$palabra%' or apellidom LIKE '%$palabra%'");
		$rows = mysql_num_rows($result);
		?>
		<ul class="titulos">
			<li style="width: 30px;"></li>
			<li>DNI</li>
            <li>Nombre</li>
            <li>Apellidos</li>
            <li>Correo</li>
            <li>Estado</li>
            <li><b>Registros (<?=$rows; ?>)</b></li>
        </ul>
		<form action="" id="eliminarr" method="post">
		<?php
        while($cont = mysql_fetch_array($result)){
	        echo "<ul class=\"resultados\">\n";
	        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
		        if($cont['nivel']==4){ echo "<li style=\"width: 30px;\"><input name=\"checkbox[]\" type=\"checkbox\" value=\"".$cont['id']."\" alt=\"1\" onChange=\"suma(this)\"></li>"; }
		        else { echo "<li style=\"width: 30px;\"></li>"; }
		    }
	        echo "<li>".$cont['dni']."</li>\n";
	        echo "<li><a href=\"?lagc=usuarios&id=".$cont['id']."&verperfil=".LGlobal::Url_Amigable($cont['nombres'])."\">".$cont['nombres']."</a></li>";
		    echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
	        echo "<li>".$cont['email']."</li>\n";
	        echo "<li>".Usuarios::estado($cont['estado'])."</li>\n";
	        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
		        echo "<li>
		        <a href=\"?lagc=usuarios&id=".$cont['id']."&editar=".LGlobal::Url_Amigable($cont['nombres'])."\" title=\"Editar Participante\" class=\"btnopcion\">
		        	<img src=\"plantillas/default/img/editar.png\" />
		        </a></li>";
		    }
	        echo "</ul>";
        }
        ?>
        </form>
        <div class="mensaje" id="mensaje">
        	<?php
        	if(empty($_POST['checkbox'])){ ?>
		        Ha seleccionado <input type="text" id="numero" disabled readonly="true" value="0" size="1" class="numero"> usuarios.<br/>
		        ¿desea eliminarlos?<br/>
		        <a href="#" id="checkeff" class="btnm">No</a>
		        <a href="#" id="eliminar" class="btnm">Si</a>
        	<?php } ?>
	        <?php
	        if($_POST['checkbox']){
		        $config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "delete from usuarios WHERE id in (".implode(",", $_POST['checkbox']).")";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				echo "Registros eliminados.";
				echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=usuarios'\", 1500) </script>";
				?>
				<script>
					$(document).ready(function(){
						$("#mensaje").css({"display":"block"});
					});
				</script>
				<?php
	        }
	        ?>
	        <div id="mensaje_editar">
	        	<hr>
	        	Desea editar el registro?<br/>
		        <a href="#" id="editar" class="btnm">Si</a>
	        </div>
        </div>
		<?php
	}
	static function borrar($id, $titulo) { ?>
		<a href="?lagc=usuarios" title="Lista de usuarios" class="menucompo">
			<img src="plantillas/default/img/lista.png">Todos</a>
		<a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
			<img src="plantillas/default/img/lista.png">Administradores</a>
		<a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
			<img src="plantillas/default/img/lista.png">Trabajadores</a>
    	<?php
		$contenidos = mysql_query("select * from usuarios where id='".$id."'");
		$conte = mysql_fetch_array($contenidos);
		if (!empty($conte['id']) and $titulo==LGlobal::Url_Amigable($conte['nombres'])) {
			if (empty($_POST['id'])) { ?>
			<center>
	            <form name="frmborrar" method="post" action="">
		            <input type="hidden" name="id" value="<?=$conte['id']; ?>">
		            <input type="hidden" name="title" value="<?=$conte['nombres']; ?>"><br /><br />
		            <h3>Usted desea eliminar:<br><em style="color:#000;"><?=$conte['nombres']." ".$conte['apellidop']." ".$conte['apellidom']; ?></em>.</h3><br>
		            <button type="button" onclick="javascript:history.back(1);" onclick="location.href='?lagc=usuarios'">Atras</button>
		            <button type="submit">Borrar</button>
	            </form>
        	</center>
            <?php
			}
			else {
				$config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "DELETE FROM usuarios WHERE id='".$id."'";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				$sql = "ALTER TABLE usuarios AUTO_INCREMENT=1";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				mysql_close($con);
				echo "<br /><script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=usuarios'\", 1500) </script><center><h3><b><em>".$_POST['title']."</em></b>.</h3><h4>Borrado Correctamente</h4></center>";
			}
		} else { echo "<br><center><h3>No existe el contenido</h3></center>"; }
	}
	static function ver($id){
		if($id=="1"){ ?>
			<div class="tlcabecera">
				<a href="?lagc=usuarios" title="Lista de usuarios" class="menucompo">
					<img src="plantillas/default/img/lista.png">Todos</a>
				<a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
					<img src="plantillas/default/img/lista.png"><b>Administradores</b></a>
				<a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
					<img src="plantillas/default/img/lista.png">Trabajadores</a>
					<form method="get" action="" class="frm_validate" style="display: inline-block;float: right;">
						<input type="hidden" name="lagc" value="usuarios">
						<input type="hidden" name="id" value="true">
					    <input type="text" name="buscar" required placeholder="Ingrese algo que buscar">
					</form>
			</div>
	        <?php $respcont = mysql_query("select * from usuarios where nivel='1' ORDER BY id DESC");
	        $rows = mysql_num_rows($respcont); ?>
			<ul class="titulos">
				<li>Foto</li>
		        <li>Nombre</li>
		        <li>Apellidos</li>
		        <li>Correo</li>
		        <li><b>Registros (<?=$rows; ?>)</b></li>
	        </ul>
	        <?php
	        while($cont = mysql_fetch_array($respcont)){
		        echo "<ul class=\"resultados\">\n";
		        echo "<li>".LGlobal::foto_perfil($cont['id'], "fotoperfil")."</li>\n";
		        echo "<li><a href=\"?lagc=usuarios&id=".$cont['id']."&verperfil=".LGlobal::Url_Amigable($cont['nombres'])."\">".$cont['nombres']."</a></li>";
		        echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
		        echo "<li>".$cont['email']."</li>\n";
		        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
			        echo "<li>
			        <a href=\"?lagc=usuarios&id=".$cont['id']."&editar=".LGlobal::Url_Amigable($cont['nombres'])."\" title=\"Editar Participante\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/editar.png\" />
			        </a>
			        <a href=\"?lagc=usuarios&id=".$cont['id']."&borrar=".LGlobal::Url_Amigable($cont['nombres'])."\" title=\"Borrar Participante\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/borrar.png\" />
			        </a></li>";
			    }
		        echo "</ul>";
	        }
		}
		else if($id=="2"){ ?>
			<div class="tlcabecera">
				<a href="?lagc=usuarios" title="Lista de usuarios" class="menucompo">
					<img src="plantillas/default/img/lista.png">Todos</a>
				<a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
					<img src="plantillas/default/img/lista.png">Administradores</a>
				<a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
					<img src="plantillas/default/img/lista.png"><b>Trabajadores</b></a>
				<form method="get" action="" class="frm_validate" style="display: inline-block;float: right;">
					<input type="hidden" name="lagc" value="usuarios">
					<input type="hidden" name="id" value="true">
				    <input type="text" name="buscar" required placeholder="Ingrese algo que buscar">
				</form>
			</div>
	        <?php $respcont = mysql_query("select * from usuarios where nivel='4' ORDER BY id DESC");
	        $rows = mysql_num_rows($respcont); ?>
			<ul class="titulos">
				<li style="width: 30px;"></li>
		        <li>DNI</li>
		        <li>Nombre</li>
		        <li>Apellidos</li>
		        <li>Correo</li>
		        <li>Estado</li>
		        <li><b>Registros (<?=$rows; ?>)</b></li>
	        </ul>
	        <form action="" id="eliminarr" method="post">
	        <?php
	        while($cont = mysql_fetch_array($respcont)){
		        echo "<ul class=\"resultados\">\n";
		        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
		        	echo "<li style=\"width: 30px;\"><input name=\"checkbox[]\" type=\"checkbox\" value=\"".$cont['id']."\" alt=\"1\" onChange=\"suma(this)\"></li>";
		        }
		        echo "<li>".$cont['dni']."</li>\n";
		        echo "<li><a href=\"?lagc=usuarios&id=".$cont['id']."&verperfil=".LGlobal::Url_Amigable($cont['nombres'])."\">".$cont['nombres']."</a></li>";
		        echo "<li>".$cont['apellidop']." ".$cont['apellidom']."</li>\n";
		        echo "<li>".$cont['email']."</li>\n";
		        echo "<li>".Usuarios::estado($cont['estado'])."</li>\n";
		        if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
			        echo "<li>
			        <a href=\"?lagc=usuarios&id=".$cont['id']."&editar=".LGlobal::Url_Amigable($cont['nombres'])."\" title=\"Editar Participante\" class=\"btnopcion\">
			        	<img src=\"plantillas/default/img/editar.png\" />
			        </a></li>";
			    }
		        echo "</ul>";
	        }
	        ?>
		    </form>
	        <div class="mensaje" id="mensaje">
	        	<?php
	        	if(empty($_POST['checkbox'])){ ?>
			        Ha seleccionado <input type="text" id="numero" disabled readonly="true" value="0" size="1" class="numero"> usuarios.<br/>
			        ¿desea eliminarlos?<br/>
			        <a href="#" id="checkeff" class="btnm">No</a>
			        <a href="#" id="eliminar" class="btnm">Si</a>
	        	<?php } ?>
		        <?php
		        if($_POST['checkbox']){
			        $config = new LagcConfig(); //Conexion
					$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
					mysql_select_db($config->lagcbd,$con);
					$sql = "delete from usuarios WHERE id in (".implode(",", $_POST['checkbox']).")";
					$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
					echo "Registros eliminados.";
					echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=usuarios'\", 1500) </script>";
					?>
					<script>
						$(document).ready(function(){
							$("#mensaje").css({"display":"block"});
						});
					</script>
					<?php
		        }
		        ?>
		        <div id="mensaje_editar">
		        	<hr>
		        	Desea editar el registro?<br/>
			        <a href="#" id="editar" class="btnm">Si</a>
		        </div>
	        </div>
	        <?php
	    }
	}
	static function importar(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=usuarios" title="Lista de Usuarios" class="menucompo">
				<img src="plantillas/default/img/lista.png">Todos</a>
			<a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Administradores</a>
			<a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Trabajadores</a>
		</div></br></br></br>
		<?php
		if (empty($_POST['Submit'])) {
			include "importar.tpl";
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			//
			if ($_FILES[csv][size] > 0) {

			    //get the csv file
			    $file = $_FILES[csv][tmp_name];
			    $handle = fopen($file,"r");
			    //loop through the csv file and insert into database
			    do {
			        if ($data[0]) {
			        	$nuevo_usuario=mysql_query("select dni from usuarios where dni='".$data[3]."' or codigo='".$data[4]."'");
			        	if(mysql_num_rows($nuevo_usuario)>0) {
							echo "<p style=\"color: #F00;\"><b>DNI ó Código duplicado: </b> ".addslashes($data[0])." ".addslashes($data[1]).", ".addslashes($data[2])." - ".addslashes($data[3]).", ".addslashes($data[4])."</p>";
						}
						else {
				            mysql_query("INSERT INTO usuarios (usuario, password, apellidop, apellidom, nombres, dni, codigo, cargo, fechanacimiento, fechaingresoempresa, email, celular, gsanguineo, creadoel, ascreated, genero) VALUES
				                (
				                	'".addslashes($data[4])."',
				                	'".addslashes(md5($data[4]))."',
				                    '".addslashes($data[0])."',
				                    '".addslashes($data[1])."',
				                    '".addslashes($data[2])."',
				                    '".addslashes($data[3])."',
				                    '".addslashes($data[4])."',
				                    '".addslashes($data[5])."',
				                    '".addslashes($data[6])."',
				                    '".addslashes($data[7])."',
				                    '".addslashes($data[8])."',
				                    '".addslashes($data[9])."',
				                    '".addslashes($data[10])."',
				                    '".time()."',
				                    '1',
				                    '1'
				                )
				            ");
						echo "<p><b>Se a creado: </b>
									".addslashes($data[0])."
									".addslashes($data[1])."
									".addslashes($data[2])."' -
				                    ".addslashes($data[3]).",
				                    ".addslashes($data[4])."
				                    </p>";
				        }
			        }
			    } while ($data = fgetcsv($handle,1000,",","'"));
			    echo "<br/><br/><center>Se proceso correctamente.</br><a href=\"?lagc=usuarios\">Continuar...</a></center>";
			}
		}
	}
	static function nuevo(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=usuarios" title="Lista de Usuarios" class="menucompo">
				<img src="plantillas/default/img/lista.png">Todos</a>
			<a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Administradores</a>
			<a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Trabajadores</a>
		</div>
		<?php
		if (empty($_POST['nombres'])) {
			include "nuevo.tpl";
		}
		else {
			$nuevo_usuario=mysql_query("select dni from usuarios where dni='".$_POST['dni']."' or codigo='".$_POST['codigo']."'");
			if(mysql_num_rows($nuevo_usuario)>0 and !empty($_POST['codigo']))  {
				echo "<p>El DNI o el Código ya esta registrado</p>
				<p><a href='javascript:history.go(-1)'>Volver atrás</a></p>";
			}
			else {
				$config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				if($_POST["sedes"]){ $sedes = implode ('|', $_POST["sedes"]); }
				else { $sedes=""; }
				// id nuevo user
				$rs = mysql_query("SELECT MAX(id) AS id FROM usuarios");
				if ($row = mysql_fetch_row($rs)) {
					$id = trim($row[0])+1;
				}
				/*Subo imagen*/
				if (!empty($_FILES['archivo']['name'])) {
					if ($_FILES['archivo']["error"] > 0){ echo "Error: ".$_FILES['archivo']['error']."<br />"; }
					else {
						$tipoft = substr($_FILES['archivo']['type'], 6);
						$nombreft = $id."_".LGlobal::Url_Amigable($_POST['nombres'].$_POST['apellidop'].$_POST['apellidom']).".".$tipoft;
						$fotoruta = "imagenes/";
						echo "<br /><br /><div style=\"margin: 0px auto; width: 350px;\">";
							echo "<center><h2>Datos de la Imagen</h2></center>";
							echo "Nombre: ".$nombreft."<br />";
							echo "Tipo: ".$_FILES['archivo']['type']."<br />";
							echo "Tamaño: ".($_FILES["archivo"]["size"] / 1024)." kB<br />";
						echo "</div>";
						move_uploaded_file($_FILES['archivo']['tmp_name'],$fotoruta.$nombreft);
					}
				}
				else { $nombreft = ""; }
				$resppermisos = mysql_query("select * from permisos where id='".$_POST['permisos']."'");
				$permisos = mysql_fetch_array($resppermisos);
				$nivel = $permisos['nivel'];
				if($nivel=="4"){
					if(empty($_POST['password'])){ $pashay = $_POST['dni']; }
					else { $pashay = $_POST['password']; }
					$sql = "INSERT INTO usuarios (usuario, password, email, nombres, apellidop, apellidom, permisos, nivel, dni, codigo, cargo, fechanacimiento, departamento, celular, fechaingresoempresa, gsanguineo, estado, genero, creadoel, ascreated, comentario, imagen, sede_id) VALUES ('".$_POST['dni']."', '".md5($pashay)."', '".$_POST['email']."', '".$_POST['nombres']."', '".$_POST['apellidop']."', '".$_POST['apellidom']."', '".$_POST['permisos']."', '".$nivel."', '".$_POST['dni']."', '".$_POST['codigo']."', '".$_POST['cargo']."', '".$_POST['cumpleanios']."', '".$_POST['departamento']."', '".$_POST['cel']."', '".$_POST['fempresa']."', '".$_POST['gsanguineo']."', '".$_POST['estado']."', '".$_POST['radGener']."', '".time()."', '0', '".$_POST['comentario']."', '".$nombreft."', '".$sedes."')";
				}
				else {
					$sql = "INSERT INTO usuarios (usuario, password, email, nombres, apellidop, apellidom, permisos, nivel, dni, codigo, cargo, fechanacimiento, departamento, celular, fechaingresoempresa, gsanguineo, estado, genero, creadoel, ascreated, comentario, imagen, sede_id) VALUES ('".$_POST['usuario']."', '".md5($_POST['password'])."', '".$_POST['email']."', '".$_POST['nombres']."', '".$_POST['apellidop']."', '".$_POST['apellidom']."', '".$_POST['permisos']."', '".$nivel."', '".$_POST['dni']."', '".$_POST['codigo']."', '".$_POST['cargo']."', '".$_POST['cumpleanios']."', '".$_POST['departamento']."', '".$_POST['cel']."', '".$_POST['fempresa']."', '".$_POST['gsanguineo']."', '".$_POST['estado']."', '".$_POST['radGener']."', '".time()."', '0', '".$_POST['comentario']."', '".$nombreft."', '".$sedes."')";
				}
				mysql_query($sql,$con);
				echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=usuarios'\", 1000) </script><br><br><center><h3>".$_POST['nombres']." ".$_POST['apellidop'].$_POST['apellidom'].".<br>Se guardo correctamente.</h3></center>";
			}
		} ?>
	<?php
	}
	static function exportar(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=usuarios" title="Lista de Usuarios" class="menucompo">
				<img src="plantillas/default/img/lista.png">Todos</a>
			<a href="?lagc=usuarios&id=1&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Administradores</a>
			<a href="?lagc=usuarios&id=2&ver=true" title="Lista de entradas" class="menucompo">
				<img src="plantillas/default/img/lista.png">Trabajadores</a>
		</div>
		</br></br></br>
		<center>
			En segundos se descargará automáticamente.</br>
			<span style="font-size: 14px;color: #A74242;">Clic <a href="<?=$config->lagcurl; ?>componentes/usuarios/exportar.php" style="text-decoration: none;color: #A74242;">" aqui "</a> si no se descarga automáticamente.</span>
			</br>
			<iframe src="<?=$config->lagcurl; ?>componentes/usuarios/exportar.php" frameborder="0" width="0" height="0"></iframe>
		</center>
		<?php
	}
	function estado($var1){
		if($var1=="1"){ $final = "<span class=\"estado bg1\"></span>"; }
		else if($var1=="0"){ $final = "<span class=\"estado bg2\"></span> "; }
		return $final;
	}
	static function check($val1, $val2){
		if($val1==$val2){ $fin = " checked"; }
		else { $fin = ""; }
		return $fin;
	}
	static function select($val1, $val2){
		if($val1==$val2){ $fin = " selected"; }
		else { $fin = ""; }
		return $fin;
	}
	function nombre_creadoen($var1){
		if($var1=="0"){ $final = "Formulario"; }
		else if($var1=="1"){ $final = "Importado"; }
		return $final;
	}
}
?>