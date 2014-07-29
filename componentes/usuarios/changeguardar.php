<?php
include "../../config.php";
include "../../funciones/function.globales.php";
$respuesta = new stdClass();
$config = new LagcConfig(); //Conexion
$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
mysql_select_db($config->lagcbd,$con);
if($_GET['tipo']=="password"){
    $sql = "UPDATE usuarios SET password='".md5($_POST['password'])."' WHERE id='".$_POST['id']."'";
    mysql_query($sql,$con);
    $respuesta->mensaje .= '
        <script>
        $(".cerrar").click(function(){
            $(".jo").addClass("bounceOutUp");
            setTimeout(function () {
                $(".jo").removeClass("bounceOutUp").removeClass("bounceInDown");
            }, 1010);
            setTimeout(function () {
                $(".jo").remove();
                $("#confirmar").remove();
            }, 500);
            return false;
        });
        </script>
        <div class="jo animated bounceInDown" style="width: 100%;">
            <div class="cerrar">x</div>
            <div class="texto"><br>
                <center><h2>Se Cambio correctamente.</h2></center>
            </div>
        </div>';
}
echo json_encode($respuesta);
?>