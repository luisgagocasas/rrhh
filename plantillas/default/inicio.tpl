<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=$config->lagcnombre; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="plantillas/default/css/estilos.css" />
	<script src="plantillas/default/js/jquery-1.9.1.min.js"></script>
	<script src="plantillas/default/js/main.js"></script>
</head>
<body>
	<div id="pagina">
		<header class="cabecera" id="flotar">
			<figure class="logo">
				<a href="<?=$config->lagcurl; ?>" title="<?=$config->lagcnombre; ?>">
					<img src="plantillas/default/img/logo-rrhh.png" />
				</a>
			</figure>
			<nav class="menuuser">
				<ul>
					<li>
						<a href="#">¡Hola <?=LGlobal::Url_Usuario($_COOKIE["user"], "nombres", "apellidop", "2"); ?>
							<?=LGlobal::foto_perfil($_COOKIE["user"], "avatar"); ?>
						</a>
					</li>
					<li>
						<ul>
							<?php
							if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, 3, "")){ ?>
								<li><a href="<?=$config->lagcurl; ?>?lagc=usuarios&id=<?=$_COOKIE["user"]; ?>&editar=<?=LGlobal::Url_Amigable($_COOKIE["lgnombres"]); ?>">Editar Perfil</a></li>
							<?php } else { ?>
								<li><a href="<?=$config->lagcurl; ?>?lagc=usuarios&id=<?=$_COOKIE["user"]; ?>&verperfil=<?=LGlobal::Url_Amigable($_COOKIE["lgnombres"]); ?>">Ver Perfil</a></li>
							<?php } ?>
							<li><a href="?logout=true">Salir</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav class="menuprincipal">
                <ul class="nav">
                    <li><a href=".">Inicio</a></li>
                    <?php
                    if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, 3, "")){
                    ?>
                    <li><a href="">Modulos</a>
                        <ul>
                        	<?php Componente::ShowComponentesMenu(); ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php
                    if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, 3, "")){
                    ?>
                    <li>
						<a href="?lagc=asistencia">Asistencia</a>
                    </li>
                    <?php } ?>
                    <?php
                    if(Componente::permisos($_COOKIE["lgpermisos"], 1, 2, "", "")){
                    ?>
                    <li>
                    	<a href="?lagc=reporte">Reportes</a>
                    </li>
                    <?php } ?>
                    <?php
                    if(Componente::permisos($_COOKIE["lgpermisos"], 1, "", "", "")){
                    ?>
                    <li>
                    	<a href="?lagc=configuracion">Configuración</a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
		</header>
		<div class="centro">
			<div class="grid grid-pad">
			    <div class="col-2-12 componentes">
					<?=Componente::ShowComponentesModulo(); ?>
			    </div>
			    <div class="col-10-12 mostrarc">
			           <?=Componente::Mostrar(); ?>
						</br></br>
			    </div>
			</div>
		</div>
		<footer class="pie">
			<div class="izquierdo">
				Todos los derechos reservados.<br>Copyright © <?=date(Y); ?>
			</div>
			<div class="derecho">
				Creado con <a href="http://lagc-peru.com/" target="_blank" /><img src="plantillas/default/img/logo.png" /></a>
			</div>
		</footer>
	</div>
</body>
</html>