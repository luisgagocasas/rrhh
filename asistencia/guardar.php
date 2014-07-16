<?php
include "../config.php";
include "../funciones/function.globales.php";
$respuesta = new stdClass();
$respuser = mysql_query("select * from usuarios where dni='".$_POST['dni']."'"); $user = mysql_fetch_array($respuser);
$rows = mysql_num_rows($respuser);
    if($rows==1){
        $sql = "INSERT INTO com_asistencia (id_user, apellidop, apellidom, nombre, dni, ensa, sede, fecha) VALUES ('".$user['id']."', '".$user['apellidop']."', '".$user['apellidom']."', '".$user['nombres']."', '".$user['dni']."', '".$_POST['ensa']."', '".$_POST['sede']."', '".time()."')";
        mysql_query($sql,$con);
        if($_POST['ensa']=="Entrada"){
            $mmensaje = "Hola, ".$user['nombres']." ".$user['apellidop']." ".$user['apellidom'];
        }
        else if($_POST['ensa']=="Salida"){
            $mmensaje = "Chau, ".$user['nombres']." ".$user['apellidop']." ".$user['apellidom'];
        }
    }
    else {
        $mmensaje = "El DNI no existe.";
    }
    $respuesta->mensaje .= "
    <script>
    $(\".cerrar\").click(function(){
        $(\".jo\").addClass('bounceOutUp');
        setTimeout(function () {
            $(\".jo\").removeClass('bounceOutUp').removeClass('bounceInDown');
        }, 1010);
        setTimeout(function () {
            $(\".jo\").remove();
            $(\".overlay\").remove();
            $(\"#dni\").val(\"\");
            $('#dni').focus();
        }, 500);
        return false;
    });
    $(document).ready(function(){
        setTimeout(function () {
            $(\".jo\").addClass('bounceOutUp');
        }, 1500);
        setTimeout(function () {
            $(\".jo\").remove();
            $(\".overlay\").remove();
            $(\"#dni\").val(\"\");
            $('#dni').focus();
        }, 2000);
        return false;
    });
    </script>
    <div class=\"jo animated bounceInDown\" style=\"width: 380px;\">
        <div class=\"cerrar\">x</div>
        <span class=\"texto\">
            <center><h2>".$mmensaje."</h2></center>
        </span>
    </div><div class=\"overlay\"></div>";
echo json_encode($respuesta);
?>