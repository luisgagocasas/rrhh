<?php
include "../config.php";
include "../funciones/function.globales.php";
$respuesta = new stdClass();
$respuser = mysql_query("select * from usuarios where dni='".$_POST['dni']."' or codigo='".$_POST['dni']."'"); $user = mysql_fetch_array($respuser);
$rows = mysql_num_rows($respuser);
    if($rows==1){
        $respuser1 = mysql_query("select * from com_asistencia where id_user='".$user['id']."' or ensa='".$_POST['ensa']."'"); $user1 = mysql_fetch_array($respuser1);
        $fechasql = date("m-d",$user1['fecha']);
        $fechahoy = date("m-d",time());
        $hoytemporal = 0;
        if($fechasql==$fechahoy and $hoytemporal==1){
            if($_POST['ensa']=="Entrada"){
                $sql = "INSERT INTO com_asistencia (id_user, apellidop, apellidom, nombre, dni, ensa, sede, fecha) VALUES ('".$user['id']."', '".$user['apellidop']."', '".$user['apellidom']."', '".$user['nombres']."', '".$user['dni']."', 'Salida', '".$_POST['sede']."', '".time()."')";
                mysql_query($sql,$con);
                $mmensaje = "Chau, ".$user['nombres']." ".$user['apellidop']." ".$user['apellidom'];
            }
            else if($_POST['ensa']=="Salida"){
                $sql = "INSERT INTO com_asistencia (id_user, apellidop, apellidom, nombre, dni, ensa, sede, fecha) VALUES ('".$user['id']."', '".$user['apellidop']."', '".$user['apellidom']."', '".$user['nombres']."', '".$user['dni']."', 'Entrada', '".$_POST['sede']."', '".time()."')";
                mysql_query($sql,$con);
                $mmensaje = "Hola, ".$user['nombres']." ".$user['apellidop']." ".$user['apellidom'];
                $hoytemporal = 0;
            }
        }
        if($fechasql!=$fechahoy and $hoytemporal==0){
            if($_POST['ensa']=="Entrada"){
                $sql = "INSERT INTO com_asistencia (id_user, apellidop, apellidom, nombre, dni, ensa, sede, fecha) VALUES ('".$user['id']."', '".$user['apellidop']."', '".$user['apellidom']."', '".$user['nombres']."', '".$user['dni']."', '".$_POST['ensa']."', '".$_POST['sede']."', '".time()."')";
                mysql_query($sql,$con);
                $mmensaje = "Hola, ".$user['nombres']." ".$user['apellidop']." ".$user['apellidom'];
            }
            else if($_POST['ensa']=="Salida"){
                $sql = "INSERT INTO com_asistencia (id_user, apellidop, apellidom, nombre, dni, ensa, sede, fecha) VALUES ('".$user['id']."', '".$user['apellidop']."', '".$user['apellidom']."', '".$user['nombres']."', '".$user['dni']."', '".$_POST['ensa']."', '".$_POST['sede']."', '".time()."')";
                mysql_query($sql,$con);
                $mmensaje = "Chau, ".$user['nombres']." ".$user['apellidop']." ".$user['apellidom'];
                $hoytemporal = 1;
            }
        }
    }
    else {
        $mmensaje = "El DNI o el Código no existe.";
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
        }, 300);
        return false;
    });
    $(document).ready(function(){
        setTimeout(function () {
            $(\".jo\").addClass('bounceOutUp');
        }, 1010);
        setTimeout(function () {
            $(\".jo\").remove();
            $(\".overlay\").remove();
            $(\"#dni\").val(\"\");
            $('#dni').focus();
        }, 3000);
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