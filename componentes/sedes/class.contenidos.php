<?php
class Sedes{
	static function inicio(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=sedes" title="Lista de Sedes" class="menucompo">
				<img src="plantillas/default/img/lista.png"><u><b>Todos</b></u></a>
		</div>
        <?php $respcont = mysql_query("select * from com_sedes ORDER BY sede_id DESC");
        $rows = mysql_num_rows($respcont); ?>
		<ul class="titulos">
			<li>Nombre</li>
            <li>N. Contrato</li>
            <li>Codigo</li>
            <li>Estado</li>
            <li><b>Registros (<?=$rows; ?>)</b></li>
        </ul>
        <?php
        while($cont = mysql_fetch_array($respcont)){
	        echo "<ul class=\"resultados\">\n";
	        echo "<li>".$cont['sede_nombre']."</li>";
	        echo "<li>".$cont['sede_ncontrato']."</li>\n";
	        echo "<li>".$cont['sede_codigo']."</li>";
	        echo "<li>".Sedes::estado($cont['sede_estado'])."</li>\n";
	        if(Componente::permisos($_COOKIE["lgpermisos"], 1, "", "", "")){
		        echo "<li>
		        <a href=\"?lagc=sedes&id=".$cont['sede_id']."&editar=".LGlobal::Url_Amigable($cont['sede_nombre'])."\" title=\"Editar Participante\" class=\"btnopcion\">
		        	<img src=\"plantillas/default/img/editar.png\" />
		        </a>
		        <a href=\"?lagc=sedes&id=".$cont['sede_id']."&borrar=".LGlobal::Url_Amigable($cont['sede_nombre'])."\" title=\"Borrar Participante\" class=\"btnopcion\">
		        	<img src=\"plantillas/default/img/borrar.png\" />
		        </a></li>";
		    }
	        echo "</ul>";
        }
    }
    static function editar($id, $titulo){
		if (empty($_POST['nombres'])) {
			$respcont = mysql_query("select * from com_sedes where sede_id='".$id."'"); $cont = mysql_fetch_array($respcont);
			if (!empty($cont['sede_id']) and $titulo==LGlobal::Url_Amigable($cont['sede_nombre'])) {
				include "editar.tpl";
			} else { echo "<br><center><h3>No existe el docente</h3></center>"; }
		}
		else {
			$config = new LagcConfig(); //Conexion
			$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
			mysql_select_db($config->lagcbd,$con);
			$sql = "UPDATE com_sedes SET sede_nombre='".$_POST['nombres']."', sede_ncontrato='".$_POST['contrato']."', sede_codigo='".$_POST['codigo']."', sede_estado='".$_POST['estado']."' WHERE sede_id='".$id."'";
			$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
			mysql_close($con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=sedes'\", 1500) </script>
				<br><br><center><h3>".$_POST['nombres'].$sicambio.".</h3><h4>Se guardo correctamente.</h4></center>";
		}
	}
	function nuevo(){ ?>
		<div class="tlcabecera">
			<a href="?lagc=sedes" title="Lista de Sedes" class="menucompo">
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
			$sql = "INSERT INTO com_sedes (sede_nombre, sede_ncontrato, sede_codigo, sede_estado) VALUES ('".$_POST['nombres']."', '".$_POST['contrato']."', '".$_POST['codigo']."', '".$_POST['estado']."')";
			mysql_query($sql,$con);
			echo "<script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=sedes'\", 1000) </script>
				<br><br><center><h3>".$_POST['nombres'].".<br>Se guardo correctamente.</h3></center>";
		}
	}
	function borrar($id, $titulo) { ?>
		<div class="tlcabecera">
	        <a href="?lagc=sedes" title="Lista de entradas" class="menucompo">
	            <img src="plantillas/default/img/lista.png"> Lista
	        </a>
		</div>
    	<?php
		$contenidos = mysql_query("select * from com_sedes where sede_id='".$id."'");
		$conte = mysql_fetch_array($contenidos);
		if (!empty($conte['sede_id']) and $titulo==LGlobal::Url_Amigable($conte['sede_nombre'])) {
			if (empty($_POST['id'])) { ?>
			<center>
	            <form name="frmborrar" method="post" action="">
		            <input type="hidden" name="id" value="<?=$conte['sede_id']; ?>">
		            <input type="hidden" name="title" value="<?=$conte['sede_nombre']; ?>"><br /><br />
		            <h3>Usted desea eliminar:<br><em style="color:#000;"><?=$conte['sede_nombre']; ?></em>.</h3><br>
		            <button type="button" onclick="javascript:history.back(1);" onclick="location.href='?lagc=sedes'">Atras</button>
		             <button type="submit">Borrar</button>
	            </form>
        	</center>
            <?php
			}
			else {
				$config = new LagcConfig(); //Conexion
				$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
				mysql_select_db($config->lagcbd,$con);
				$sql = "DELETE FROM com_sedes WHERE sede_id='".$id."'";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				$sql = "ALTER TABLE com_sedes AUTO_INCREMENT=1";
				$Query = mysql_query ($sql, $con) or die ("Error: <b>" . mysql_error() . "</b>");
				mysql_close($con);
				echo "<br /><script type=\"text/javascript\"> setTimeout(\"window.top.location='?lagc=sedes'\", 1500) </script><center><h3><b><em>".$_POST['title']."</em></b>.</h3><h4>Borrado Correctamente</h4></center>";
			}
		} else { echo "<br><center><h3>No existe el contenido</h3></center>"; }
	}
	static function check($val1, $val2){
		if($val1==$val2){ $fin = " checked"; }
		else { $fin = ""; }
		return $fin;
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
	                $fin .= "<a href=\"".$datapc['sede_id']."\" title=\"".$val2."\" class=\"asgcurso\"><img src=\"plantillas/default/img/asignar.png\">".$datapc['sede_nombre']."</a>, ";
	        }
	    }
	    else {
	    	$fin = "<a href=\"?lagc=usuarios&id=".$val2."&editar=true\" target=\"_black\">- Editar -</a>";
	    }
        return $fin;
	}
	static function estado($var1){
		if($var1=="1"){ $final = "<span class=\"estado bg1\"></span>"; }
		else if($var1=="0"){ $final = "<span class=\"estado bg2\"></span> "; }
		return $final;
	}
}
?>