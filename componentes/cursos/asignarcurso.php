<?php include "../../config.php";
$respsede = mysql_query("select * from com_sedes where sede_id='".$_GET['id']."'"); $sede = mysql_fetch_array($respsede);
$respcont = mysql_query("select * from com_cursos where sede_id='".$sede['sede_id']."'");
$respuser = mysql_query("select * from usuarios where id='".$_GET['user']."'"); $user = mysql_fetch_array($respuser);
function check($val1, $val2){
    if($val1==$val2){ $fin = " checked"; }
    else { $fin = ""; }
    return $fin;
}
function archivo($val1, $val2){
    if(!empty($val1)){
        if(substr($val1, -3)=="pdf"){
            $fin = "<a href=\"archivos_cursos/".$val1."\" target=\"_blank\"><img src=\"plantillas/default/img/pdf.png\">".$val1."</a> - <a href=\"".$val2."\" class=\"eliminararch\" title=\"".$val1."\">x</a>";
        }
        else {
            $fin = "<a href=\"archivos_cursos/".$val1."\" target=\"_blank\"><img src=\"plantillas/default/img/jpg.png\">".$val1."</a> - <a href=\"".$val2."\" class=\"eliminararch\" title=\"".$val1."\">x</a>";
        }
    }
    else {
        $fin = "";
    }
    return $fin;
}
$respuesta = new stdClass();
$respuesta->mensaje = '
    <script>
    $(".cerrar").click(function(){
        $(".overlay").addClass("fadeOut");
        $(".ja").addClass("bounceOutUp");
        setTimeout(function () {
            $(".overlay").removeClass("fadeOut").removeClass("fadeIn");
            $(".ja").removeClass("bounceOutUp").removeClass("bounceInDown");
        }, 1010);
        setTimeout(function () {
            $(".overlay").remove();
            $(".ja").remove();
        }, 500);
        return false;
    });
    </script>
    <div class="ja animated bounceInDown">
        <div class="cerrar">x</div>
        <div class="texto">
        <center><h2>'.$user["apellidop"].' '.$user["apellidom"].' '.$user["nombres"].'</h2></center>
        <h2>Sede: '.$sede["sede_nombre"].'</h2>';
        //1 = exite registro a editar
        while($cont = mysql_fetch_array($respcont)){
            //
            $respasig = mysql_query("select * from com_curso_asignar where id_curso='".$cont['curso_id']."' and id_usuario='".$user['id']."'");
            $asig = mysql_fetch_array($respasig);
            //
            $respuesta->mensaje .= '
            <script>
            $("#frm'.$cont['curso_id'].'").submit(function(){
                var formulario = new FormData($("#frm'.$cont['curso_id'].'")[0]);
                $.ajax({
                    dataType: "json",
                    url: "componentes/cursos/guardar.php",
                    type: "POST",
                    data: formulario,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(respuesta){
                    $("#confir").html(respuesta.mensaje).fadeIn();
                    $("#frm'.$cont['curso_id'].'").addClass("savecurso");
                    document.frm'.$cont['curso_id'].'.inicio.disabled = true;
                    document.frm'.$cont['curso_id'].'.fin.disabled = true;
                    document.frm'.$cont['curso_id'].'.estado.disabled = true;
                    document.frm'.$cont['curso_id'].'.archivo.disabled = true;
                    document.frm'.$cont['curso_id'].'.guardar.disabled = true;
                    $("#save'.$cont['curso_id'].'").addClass("boton-verde_bloqueado");
                });
                return false;
            });
            </script>';
            if($asig['id_curso']==$cont['curso_id'] and $asig['id_usuario']==$user['id']){
                $respuesta->mensaje .= '
                <script>
                $(".eliminararch").on("click",function(e){
                    e.preventDefault();
                    var ida=$(this).attr("href");
                    var archivo=$(this).attr("title");
                    $.ajax({
                        dataType: "json",
                        url: "componentes/cursos/guardar.php?tipo=borrararchivo&id="+ida+"&archivo="+archivo
                    }).done(function(respuesta){
                        $("#confir").html(respuesta.mensaje).fadeIn();
                    });
                });
                </script>
                <form action="" enctype="multipart/form-data" name="frm'.$cont['curso_id'].'" id="frm'.$cont['curso_id'].'">
                    <input type="hidden" name="idcurso" value="'.$cont['curso_id'].'">
                    <input type="hidden" name="iduser" value="'.$user['id'].'">
                    <input type="hidden" name="nombreuser" value="'.$user['nombres'].'">
                    <input type="hidden" name="apellidopuser" value="'.$user['apellidop'].'">
                    <input type="hidden" name="apellidomuser" value="'.$user['apellidom'].'">
                    <input type="hidden" name="idasig" value="'.$asig['id_asig_curso'].'">
                    <input type="hidden" name="archivo" value="'.$asig['archivo'].'">
                    <input type="hidden" name="tipo" value="editar">
                    <div class="grid grid-pad select001">
                        <div class="col-1-3">
                            <div class="form_control">
                                <label class="ioption ck" style="margin-left: 0px;">
                                    <input name="estado" type="checkbox" '.check($asig['activo'], "1").' value="1">'.$cont['curso_nombre'].'
                                </label>
                            </div>
                        </div>
                        <div class="col-1-3">
                            <h4>Fecha de Inicio</h4>
                            <input type="date" name="inicio" step="1" value="'.$asig['fechainicio'].'"></br>
                            <h4>Fecha de Fin</h4>
                            <input type="date" name="fin" step="1" value="'.$asig['fechafin'].'">
                        </div>
                        <div class="col-1-3">
                            <div style="display: inline;margin: 5px 0px 0px 0px;">
                                '.archivo($asig['archivo'], $asig['id_asig_curso']).'
                                <input type="file" name="archivo">
                            </div>
                        </div>
                        <center><button type="submit" name="guardar" class="boton-verde" id="save'.$cont['curso_id'].'">Guardar</button></center>
                    </div>
                </form>';
            }
            else{
                $respuesta->mensaje .= '
                <form action="" enctype="multipart/form-data" name="frm'.$cont['curso_id'].'" id="frm'.$cont['curso_id'].'">
                    <input type="hidden" name="idcurso" value="'.$cont['curso_id'].'">
                    <input type="hidden" name="iduser" value="'.$user['id'].'">
                    <input type="hidden" name="nombreuser" value="'.$user['nombres'].'">
                    <input type="hidden" name="apellidopuser" value="'.$user['apellidop'].'">
                    <input type="hidden" name="apellidomuser" value="'.$user['apellidom'].'">
                    <input type="hidden" name="tipo" value="crear">
                    <div class="grid grid-pad select001">
                        <div class="col-1-3">
                            <div class="form_control">
                                <label class="ioption ck" style="margin-left: 0px;">
                                    <input name="estado" type="checkbox" value="1">'.$cont['curso_nombre'].'
                                </label>
                            </div>
                        </div>
                        <div class="col-1-3">
                            <h4>Fecha de Inicio</h4>
                            <input type="date" name="inicio" step="1" value="'.$asig['fechainicio'].'"></br>
                            <h4>Fecha de Fin</h4>
                            <input type="date" name="fin" step="1" value="'.$asig['fechafin'].'">
                        </div>
                        <div class="col-1-3">
                            <div style="display: inline;margin: 5px 0px 0px 0px;">
                                <input type="file" name="archivo">
                            </div>
                        </div>
                        <center><button type="submit" name="guardar" class="boton-verde" id="save'.$cont['curso_id'].'">Guardar</button></center>
                    </div>
                </form>';
            }
        }
$respuesta->mensaje .= '<div id="confir"></div></div></div><div class="overlay"></div>';
echo json_encode($respuesta);
?>