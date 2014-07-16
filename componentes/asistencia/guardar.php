<?php
setcookie("sedea", $_GET['idsede'], time()+(60*60*24*30), "/");
include "../../config.php";
$respsede = mysql_query("select * from com_sedes where sede_id='".$_GET['idsede']."'");
$sede = mysql_fetch_array($respsede);
$respuesta = new stdClass();
    $respuesta->mensaje = "
    <script>
    $(\".cerrar\").click(function(){
        $(\".jo\").addClass('bounceOutUp');
        setTimeout(function () {
            $(\".jo\").removeClass('bounceOutUp').removeClass('bounceInDown');
        }, 1010);
        setTimeout(function () {
            $(\".jo\").remove();
            $(\".overlay\").remove();
            location.reload();
        }, 500);
        return false;
    });
    </script>
    <div class=\"jo animated bounceInDown\" style=\"width: 450px;\">
        <div class=\"cerrar\">x</div>
        <span class=\"texto\">
            <center>
                <h2>Modulo de Asistencia <u>Activado</u></br>Sede <u>".$sede['sede_nombre']."</u></h2>
                Para ver el modulo clic <a href=\"".$config->lagcurl."asistencia/\" target=\"_blank\">\"AQUI\"</a><br>
                Ya puede cerrar su sesión.
            </center>
        </span>
    </div><div class=\"overlay\"></div>";
//
if($sede['sede_id']==$_GET['idsede']){
    $respuesta->estado = $sede['sede_nombre'];
}
echo json_encode($respuesta);
?>