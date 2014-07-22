<?php
class Configuracion{
	function inicio(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=configuracion" title="Configuración del sitio" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Configuración</b></a>
			<a href="?lagc=configuracion&id=permisos" title="Ver Permisos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Permisos</a>
		</div>
		<?php
		$respconfig = mysql_query("select * from configuracion"); $config = mysql_fetch_array($respconfig);
		if (!isset($_POST['nombreapp'])) { ?>
			<form action="" enctype="multipart/form-data" method="post" class="frm_validate">
				<div class="grid grid-pad">
					<div class="col-1-2">
						<div class="form_control">
							<label for="nombre">Nombre de la APP</label>
							<input type="text" name="nombreapp" id="nombre" required placeholder="Ingrese el nombre" value="<?=$config['nombreapp']; ?>">
						</div>
						<div class="form_control">
							<label for="correo">Correo</label>
							<input type="email" name="correo" id="correo" required placeholder="Ingrese el correo" value="<?=$config['correo']; ?>">
						</div>
						<div class="form_control">
							<label for="direccion">Dirección</label>
							<input type="text" name="direccion" id="direccion" placeholder="Ingrese la dirección" value="<?=$config['direccion']; ?>">
						</div>
						<div class="form_control">
							<label for="telefono">Telefonos</label>
							<input type="text" name="telefono" id="telefono" placeholder="Ingrese el telefono" value="<?=$config['telefono']; ?>">
						</div>
						<div class="form_control">
							<label for="ruc">Ruc</label>
							<input type="text" name="ruc" id="ruc" placeholder="Ingrese el ruc" value="<?=$config['ruc']; ?>">
						</div>
						<div class="form_control">
							<label for="logo">Logo</label>
							<input type="file" name="archivo" id="logo">
							<?php
							if(!empty($config['logo'])){
								echo "<center><img src=\"utilidades/imagenes/".$config['logo']."\"></center>";
							}
							?>
						</div>
						<div class="form_control">
				            <center>
				                <button type="submit" id="sbmSend" title="Enviar" style="margin: 30px 0px 0px 0px" class="btn">Guardar</button>
				            </center>
			        	</div>
					</div>
					<div class="col-1-2">
			        </div>
				</div>
			</form>
		<?php
		}
		else{
			if (!empty($_FILES['archivo']['name'])) {
				if ($_FILES['archivo']["error"] > 0){ echo "Error: ".$_FILES['archivo']['error']."<br />"; }
				else {
					$tipoft = substr($_FILES['archivo']['type'], 6);
					$nombreft = "logo.".$tipoft;
					$fotoruta = "utilidades/imagenes/";
					echo "<br /><br /><div style=\"margin: 0px auto; width: 350px;\">";
						echo "<center><h2>Datos de la Imagen</h2></center>";
						echo "Nombre: ".$nombreft."<br />";
						echo "Tipo: ".$_FILES['archivo']['type']."<br />";
						echo "Tamaño: ".($_FILES["archivo"]["size"] / 1024)." kB<br />";
					echo "</div>";
					move_uploaded_file($_FILES['archivo']['tmp_name'],$fotoruta.$nombreft);
				}
			}
			else { $nombreft = $config['logo']; }
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "UPDATE configuracion SET nombreapp='".$_POST['nombreapp']."', correo='".$_POST['correo']."', direccion='".$_POST['direccion']."', telefono='".$_POST['telefono']."', ruc='".$_POST['ruc']."', logo='".$nombreft."'";
			$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
			mysql_close($con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=configuracion'\", 1500) </script></br></br><center><h4>Se guardo correctamente.</h4></center>";
		}
	}
	static function permisos(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=configuracion" title="Configuración del sitio" class="menucompo">
				<img src="plantillas/default/img/lista.png">Configuración</a>
			<a href="?lagc=configuracion&id=permisos" title="Ver Permisos" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Permisos</b></a>
			<a href="?lagc=configuracion&id=nuevo" title="Ver Permisos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Crear Permiso</a>
		</div>
		<?php
		$respcont = mysql_query("select * from permisos");
        $rows = mysql_num_rows($respcont); ?>
		<ul class="titulos">
			<li>Nombre</li>
			<li>Nivel</li>
            <li><b>Registros (<?=$rows; ?>)</b></li>
        </ul>
        <?php
        while($cont = mysql_fetch_array($respcont)){
	        echo "<ul class=\"resultados\">\n";
	        echo "<li>".$cont['nombre']."</li>";
	        echo "<li>".Configuracion::nombrenivel($cont['nivel'])."</li>";
	        echo "<li>
	        <a href=\"?lagc=configuracion&id=".$cont['id']."&editar=".LGlobal::Url_Amigable($cont['nombre'])."\" title=\"Editar Participante\" class=\"btnopcion\">
	        	<img src=\"plantillas/default/img/editar.png\" />
	        </a>
	        <a href=\"?lagc=configuracion&id=".$cont['id']."&borrar=".LGlobal::Url_Amigable($cont['nombre'])."\" title=\"Borrar Participante\" class=\"btnopcion\">
	        	<img src=\"plantillas/default/img/borrar.png\" />
	        </a></li>";
	        echo "</ul>";
        }
	}
	static function nuevo(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=configuracion" title="Configuración del sitio" class="menucompo">
				<img src="plantillas/default/img/lista.png">Configuración</a>
			<a href="?lagc=configuracion&id=permisos" title="Ver Permisos" class="menucompo">
				<img src="plantillas/default/img/lista.png">Permisos</a>
			<a href="?lagc=configuracion&id=nuevo" title="Ver Permisos" class="menucompo">
				<img src="plantillas/default/img/lista.png"><b>Crear Permiso</b></a>
		</div>
		<?php
		if (empty($_POST['nombres'])) {
			include "nuevo.tpl";
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "INSERT INTO permisos (nombre, nivel) VALUES ('".$_POST['nombres']."','".$_POST['niveles']."')";
			mysql_query($sql,$con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=configuracion&id=permisos'\", 1000) </script>
				<br><br><center><h3>".$_POST['nombres'].".<br>Se guardo correctamente.</h3></center>";
		}
	}
	static function nombrenivel($val){
		if($val==1){
			$fin = "Administrador";
		}
		else if($val==2){
			$fin = "Supervisor";
		}
		else if($val==3){
			$fin = "Asistencia";
		}
		else if($val==4){
			$fin = "Trabajador";
		}
		return $fin;
	}
}
?>