<?php //clase blobal para todo el cms
class LGlobal {
	static function Url_Amigable($cadena) {
	   // Sepadador de palabras que queremos utilizar
	   $separador = "-";
	   // Eliminamos el separador si ya existe en la cadan actual
	   $cadena = str_replace($separador, "",$cadena);
	   // Convertimos la cadena a minusculas
	   $cadena = strtolower($cadena);
	   // Remplazo tildes y eñes
	   $cadena = strtr($cadena, "áéíóúÁñÑ", "aeiouAnN");
	   // Remplazo cuarquier caracter que no este entre A-Za-z0-9 por un espacio vacio
	   $cadena = trim(ereg_replace("[^ A-Za-z0-9]", "", $cadena));
	   // Inserto el separador antes definido
	   $cadena = ereg_replace("[ \t\n\r]+", $separador, $cadena);
	   return $cadena;
	}
	static function Url_AmigableUser($cadena) {
	   // Sepadador de palabras que queremos utilizar
	   $separador = "";
	   // Eliminamos el separador si ya existe en la cadan actual
	   $cadena = str_replace($separador, "",$cadena);
	   // Convertimos la cadena a minusculas
	   $cadena = strtolower($cadena);
	   // Remplazo tildes y eñes
	   $cadena = strtr($cadena, "áéíóúÁñÑ", "aeiouAnN");
	   // Remplazo cuarquier caracter que no este entre A-Za-z0-9 por un espacio vacio
	   $cadena = trim(ereg_replace("[^ A-Za-z0-9]", "", $cadena));
	   // Inserto el separador antes definido
	   $cadena = ereg_replace("[ \t\n\r]+", $separador, $cadena);
	   return $cadena;
	}
	static function tiempohace($valor){
		if(!empty($valor)){
			// FORMATOS:
			// segundos    desde 1970 (función time())        hace_tiempo('12313214');
			// defecto (variable $formato_defecto)        hace_tiempo('12:01:02 04-12-1999');
			// tu propio formato                        hace_tiempo('04-12-1999 12:01:02 [n.j.Y H:i:s]');
			$formato_defecto="H:i:s j-n-Y";
			// j,d = día
			// n,m = mes
			// Y = año
			// G,H = hora
			// i = minutos
			// s = segundos
			if(stristr($valor,'-') || stristr($valor,':') || stristr($valor,'.') || stristr($valor,',')){
				if(stristr($valor,'[')){
					$explotar_valor=explode('[',$valor);
					$valor=trim($explotar_valor[0]);
					$formato=str_replace(']','',$explotar_valor[1]);
				}else{
					$formato=$formato_defecto;
				}
				$valor = str_replace("-"," ",$valor);
				$valor = str_replace(":"," ",$valor);
				$valor = str_replace("."," ",$valor);
				$valor = str_replace(","," ",$valor);
				$numero = explode(" ",$valor);
				$formato = str_replace("-"," ",$formato);
				$formato = str_replace(":"," ",$formato);
				$formato = str_replace("."," ",$formato);
				$formato = str_replace(","," ",$formato);
				$formato = str_replace("d","j",$formato);
				$formato = str_replace("m","n",$formato);
				$formato = str_replace("G","H",$formato);
				$letra = explode(" ",$formato);
				$relacion[$letra[0]]=$numero[0];
				$relacion[$letra[1]]=$numero[1];
				$relacion[$letra[2]]=$numero[2];
				$relacion[$letra[3]]=$numero[3];
				$relacion[$letra[4]]=$numero[4];
				$relacion[$letra[5]]=$numero[5];
				$valor = mktime($relacion['H'],$relacion['i'],$relacion['s'],$relacion['n'],$relacion['j'],$relacion['Y']);
			}
			$ht = time()-$valor;
			if($ht>=2116800){
			$dia = date('d',$valor);
			$mes = date('n',$valor);
			$año = date('Y',$valor);
			$hora = date('H',$valor);
			$minuto = date('i',$valor);
			$mesarray = array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$fecha = "el $dia de $mesarray[$mes] del $año";
			}
			if($ht<30242054.045){$hc=round($ht/2629743.83);if($hc>1){$s="es";}$fecha="hace $hc mes".$s;}
			if($ht<2116800){$hc=round($ht/604800);if($hc>1){$s="s";}$fecha="hace $hc semana".$s;}
			if($ht<561600){$hc=round($ht/86400);if($hc==1){$fecha="ayer";}if($hc==2){$fecha="antes de ayer";}if($hc>2)$fecha="hace $hc d&iacute;as";}
			if($ht<84600){$hc=round($ht/3600);if($hc>1){$s="s";}$fecha="hace $hc hora".$s;if($ht>4200 && $ht<5400){$fecha="hace m&aacute;s de una hora";}}
			if($ht<3570){$hc=round($ht/60);if($hc>1){$s="s";}$fecha="hace $hc minuto".$s;}
			if($ht<60){$fecha="hace $ht segundos";}
			if($ht<=3){$fecha="ahora";}
			return $fecha;
		}
		else {
			return "";
		}
	}
	static function Url_Usuario($id, $campo, $campo1, $ctn) {
		if (!empty($id)) {
			$respuser = mysql_query("select * from usuarios where id='".$id."'"); $user = mysql_fetch_array($respuser);
			if (!empty($user['id'])) {
				if($ctn=="1"){
					$final = $user[$campo];
				}
				else if($ctn=="2"){
					$final = $user[$campo]." ".$user[$campo1];
				}
				else {
					$final = $user['nombres'];
				}
			}
			else { $final = "<em>No existe el Usuario</em>"; }
		}
		else {
			$final = "<em>No Introdujo el id del usuario</em>";
		}
		return $final;
	}
	static function Editor() { ?>
		<script type="text/javascript" src="utilidades/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
	    	tinyMCE.init({
	        // General options
	        mode : "textareas",
	        theme : "advanced",
			editor_deselector : "mceNoEditor", //para que el textarea no tenga editor
	        plugins : "spellchecker,pagebreak,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,openmanager",
	        // Theme options
	        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,undo,redo,formatselect,fontselect,fontsizeselect,insertdate,inserttime",
	        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,cleanup,|,image,forecolor,|,removeformat,visualaid,|,code,preview,fullscreen",
	        theme_advanced_buttons3 : "tablecontrols,|,charmap,iespell,media,advhr,|,sub,sup,|,openmanager",
	        theme_advanced_toolbar_location : "top",
	        theme_advanced_toolbar_align : "left",
	        theme_advanced_statusbar_location : "bottom",
	        theme_advanced_resizing : true,

	        //imagenes
	        file_browser_callback: "openmanager",
	        open_manager_upload_path: '../../../../uploads/',
	        // Skin options
	        skin : "o2k7",
	        skin_variant : "silver",
	        // Drop lists for link/image/media/template dialogs
	        template_external_list_url : "js/template_list.js",
	        external_link_list_url : "js/link_list.js",
	        external_image_list_url : "js/image_list.js",
	        media_external_list_url : "js/media_list.js",
	        // Replace values for the template plugin
	        template_replace_values : {
	                username : "Some User",
	                staffid : "991234"
	        }
	    });
		</script>
	<?php
	}
	static function foto_perfil($id, $class){
		$respuser = mysql_query("select * from usuarios where id='".$id."'");
		$user = mysql_fetch_array($respuser);
		if(!empty($user['imagen'])){ $final = "<img src=\"imagenes/".$user['imagen']."\" class=\"".$class."\">"; }
		else { if($user['genero']=="1"){ $final = "<img src=\"imagenes/perfil_hombre.png\" class=\"".$class."\">"; } else { $final = "<img src=\"imagenes/perfil_mujer.png\" class=\"".$class."\">"; } }
		return $final;
	}
}
?>