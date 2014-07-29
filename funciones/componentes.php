<?php
class Componente {
	static function existe($componente) {
		if (!empty($componente)) {
			$respcompo = mysql_query("select * from componentes where url='".$componente."'");
			$compo = mysql_fetch_array($respcompo);
			if ($compo['url']!=$_GET['lagc']) { $final = "El Componente no existe"; }
		}
		return $final;
	}
	static function primercompo($id) {
		$respcompo = mysql_query("select * from componentes where id_com='".$id."'");
		$compo = mysql_fetch_array($respcompo);
		include "componentes/".$compo['url']."/".$compo['archivo'].".php";
	}
	static function componentes() {
		$respcompo = mysql_query("select * from componentes where visible='1'");
		while($compo = mysql_fetch_array($respcompo)) {
			if (!empty($compo['archivo']) and !empty($compo['url'])) {
				if ($_GET['lagc']==$compo['url']) { include "componentes/".$compo['url']."/".$compo['archivo'].".php"; }
			}
			else {	echo "<div id=\"alerta_comp\">error en un componente</div>"; }
		}
	}
	static function Mostrar() {
		$config = new LagcConfig();
		if (empty($_COOKIE["username"])) {
			if ($config->lagcactivo==2) { echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='inicio.php'\",0) </script>"; exit; }
			//si esta logeado puede acceder aqui
		}
		if (!isset($_GET['lagc'])){ Componente::primercompo($config->lagccompopri); }
		Componente::existe($_GET['lagc']);
		Componente::componentes();
	}
	static function CompoTitulo($compo, $id) {
		$config = new LagcConfig();
		if (!empty($_GET['lagc'])) {
			$respcomp = mysql_query("select * from componentes where url='".$compo."'"); $comp = mysql_fetch_array($respcomp);
			if (empty($comp['campobd'])) { echo $comp['nombre']." - ".$config->lagctitulo; }
			else {
				$rptcomp = mysql_query("select * from ".$comp['campobd']." where ".$comp['campoid']."='".$id."'");
				$rpt = mysql_fetch_array($rptcomp);
				if (!empty($id)) {
					if (!empty($rpt[$comp['campoid']]) and $_GET['ver']==LGlobal::Url_Amigable($rpt[$comp['campotitulo']])) {
						echo ucwords($rpt[$comp['campotitulo']])." - ";
					}
				}
				if ($comp['url']==$compo) { echo ucwords($comp['nombre'])." - ".$config->lagctitulo; }
				else { echo "Error. noce encontro el Componentes."; }
			}
		}
		else { echo $config->lagctitulo; }
	}
	static function ShowComponentesMenu(){
		$config = new LagcConfig();
		$respcomp = mysql_query("select * from componentes where visible='1' and id_com!='2' and id_com!='7' and id_com!='8' and id_com!='9'");
		while ($comp = mysql_fetch_array($respcomp)){
			if(empty($comp['menu_admin'])){
				echo "<li><a href=\"?lagc=".$comp['url']."\">".$comp['nombre']."</a></li>\n";
			}
			else {
				echo "<li><a href=\"?lagc=".$comp['url']."\">".$comp['nombre']."</a>\n";
					echo "<ul>\n";
						$idstock=explode("|",$comp['menu_admin']);
						for($n=0;$n<count($idstock);$n++) {
							$finalarray = explode('>', $idstock[$n]);
							if (!empty($finalarray['1'])) { echo "<li><a href=\"?lagc=".$comp['url']."&id=".$finalarray['1']."\">".$finalarray['0']."</a></li>\n"; }
						}
					echo "</ul>";
				echo "</li>";
			}
		}
	}
	static function ShowComponentesModulo(){
		$config = new LagcConfig();
		if(empty($_GET['lagc'])){ $filtrar = "inicio"; }
		else { $filtrar = $_GET['lagc']; }
		$respcomp = mysql_query("select * from componentes where visible='1' and url='".$filtrar."'");
		$comp = mysql_fetch_array($respcomp);
		if(empty($_GET['lagc'])){ ?>
			<article class="componente">
				<h2>Descripción</h2>
				<div class="descripcion">
					<?=$comp['descripcion']; ?>
				</div>
			</article>
			<article class="componente">
				<h2>Bienvenido a RRHH</h2>
				<div class="descripcion">
					Sistema de RRHH
				</div>
			</article>
		<?php
		}
		else if(!empty($_GET['lagc']) and $_GET['lagc']==$comp['url']) {
		?>
			<h1><?=$comp['nombre']; ?></h1>
			<article class="componente">
				<h2>Descripción</h2>
				<div class="descripcion">
					<?=$comp['descripcion']; ?>
				</div>
			</article>
			<article class="componente">
				<h2>Opciones</h2>
				<nav class="menu">
					<ul>
						<?php
						$idstock=explode("|",$comp['menu_admin']);
						for($n=0;$n<count($idstock);$n++) {
							$finalarray = explode('>', $idstock[$n]);
							if (!empty($finalarray['1'])) { echo "<li><a href=\"?lagc=".$comp['url']."&id=".$finalarray['1']."\">".$finalarray['0']."</a></li>\n"; }
						}
						?>
					</ul>
				</nav>
			</article>
			<?=$comp['html_admin']; ?>
		<?php
		}
		else { echo "no se encontro"; }
	}
	static function permisos($permiso, $val1, $val2, $val3, $val4){
		if($permiso==$val1 or $permiso==$val2 or $permiso==$val3){ $final = true; }
		else { $final = false; }
		return $final;
	}
}
?>