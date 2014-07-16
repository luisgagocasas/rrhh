<?php
class Configuracion{
	function inicio(){
		if (!isset($_POST['nombreapp'])) { $config = new LagcConfig(); ?>
			<form action="" enctype="multipart/form-data" method="post" class="frm_validate">
				<div class="grid grid-pad">
					<div class="col-1-2">
						<div class="form_control">
							<label for="correo">Correo</label>
							<input type="email" name="correo" id="correo" required placeholder="Ingrese el correo" value="<?=$config->lagcmail; ?>">
						</div>
						<div class="form_control">
							<label for="nombre">Nombre de la APP</label>
							<input type="text" name="nombreapp" id="nombre" required placeholder="Ingrese el nombre" value="<?=$config->lagcnombre; ?>">
						</div>
						<div class="form_control">
							<label for="direccion">Dirección</label>
							<input type="text" name="direccion" id="direccion" placeholder="Ingrese la dirección" value="<?=$config->lagcdireccion; ?>">
						</div>
						<div class="form_control">
							<label for="telefono">Telefonos</label>
							<input type="text" name="telefono" id="telefono" placeholder="Ingrese el telefono" value="<?=$config->lagctelefono; ?>">
						</div>
						<div class="form_control">
							<label for="ruc">Ruc</label>
							<input type="text" name="ruc" id="ruc" placeholder="Ingrese el ruc" value="<?=$config->lagcruc; ?>">
						</div>
						<div class="form_control">
							<label for="logo">Logo</label>
							<input type="file" name="archivo" id="logo">
							<?php
							if(!empty($config->lagclogo)){
								echo "<div style=\"float:left\"><img src=\"utilidades/imagenes/".$config->lagclogo."\"></div>";
							}
							?>
						</div>
					</div>
					<div class="col-1-2">
						<div class="form_control">
				            <center>
				                <button type="submit" id="sbmSend" title="Enviar" class="btn">Guardar</button>
				            </center>
			        	</div>
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
			else { $nombreft = $config->lagclogo; }
			// El contenido del archivo
			$archi = "<?php\n";
			$archi .= "class LagcConfig {\n";
			$archi .= "    //Datos del Sitio\n";
			$archi .= "    var \$lagcnombre = '".$_POST['nombreapp']."';\n";
			$archi .= "    var \$lagcmail = '".$_POST['correo']."';\n";
			$archi .= "    var \$lagcurl = '".$_POST['url']."';\n";
			$archi .= "    var \$lagcdireccion = '".$_POST['direccion']."';\n";
			$archi .= "    var \$lagctelefono = '".$_POST['telefono']."';\n";
			$archi .= "    var \$lagcruc = '".$_POST['ruc']."';\n";
			$archi .= "    var \$lagclogo = '".$nombreft."';\n";
			$archi .= "    \n";
			$archi .= "    //Mysql\n";
			$archi .= "    var \$lagclocal = '".$_POST['servidor']."';\n";
			$archi .= "    var \$lagcbd = '".$_POST['nombrebd']."';\n";
			$archi .= "    var \$lagcuser = '".$_POST['usuario']."';\n";
			$archi .= "    var \$lagcpass = '".$_POST['password']."';\n";
			$archi .= "    \n";
			$archi .= "    var \$lagccompopri = '2';\n";
			$archi .= "    \n";
			$archi .= "    //Plantillas\n";
			$archi .= "    var \$lagctemplsite = 'default';\n";
			$archi .= "}\n";
			$archi .= "\$config = new LagcConfig();\n";
			$archi .= "\$con = mysql_connect(\$config->lagclocal,\$config->lagcuser,\$config->lagcpass);\n";
			$archi .= "mysql_select_db(\$config->lagcbd,\$con) or die(\"<center>No hay conexion.</center>\");\n";
			$archi .= "mysql_set_charset('utf8');\n";
			$archi .= "?>";
		}
	}
}
?>