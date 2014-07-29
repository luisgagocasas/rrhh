<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?=$bdconfig['nombreapp']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="stylesheet" href="plantillas/default/css/estilos.css" />
</head>
<body>
	<div id="pagina">
		<header class="cabecera">
			<figure class="logo">
				<a href="<?=$config->lagcurl; ?>" title="<?=$bdconfig['nombreapp']; ?>">
					<img src="utilidades/imagenes/<?=$bdconfig['logo']; ?>" />
				</a>
			</figure>
		</header>
		<div class="centro_login">
			<div class="login">
				<?=$mensaje; ?>
				<form class="contact_form" action="" method="post">
					<input name="url" type="hidden" value="<?=$_SERVER['REQUEST_URI']; ?>" />
					<ul>
						<li>
							<h2>Identificate</h2>
						</li>
						<li>
							<label for="name">Usuario ó E-mail:</label>
							<input type="text" name="usuario_lagc" class="campo" placeholder="usuario" required />
						</li>
						<li>
							<label for="email">Contraseña:</label>
							<input type="password" name="password_lagc" class="campo" placeholder="*******" required />
						</li>
						<li>
							<center>
								<button class="submit" type="submit">Ingresar</button>
							</center>
						</li>
					</ul>
				</form>
			</div>
		</div>
		<footer class="pie_login">
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