<?php
include "../config.php";
include "../funciones/function.globales.php";
$respuesta = new stdClass();
$respuser = mysql_query("select * from usuarios where dni='".$_POST['dni']."' or codigo='".$_POST['dni']."'"); $user = mysql_fetch_array($respuser);
$rows = mysql_num_rows($respuser);
    if($rows==1){
        $sedes=split("[|.-]", $user['sede_id']);
        $var1 = 0;
        for($k=0;$k<count($sedes);$k++)//separar una a una
            if ($sedes[$k] == $_COOKIE["sedea"]) {
                $var1 = 1;
                break;
            }
            if ($var1 == 1){
                if($_POST['ensa']=="Entrada"){
                    $mmensaje = "Bienvenido</br>".$user['nombres']." ".$user['apellidop']." ".$user['apellidom'];
                    $fondopp = " background-color: #29B12E;";
                }
                else if($_POST['ensa']=="Salida"){
                    $mmensaje = "Hasta luego</br>".$user['nombres']." ".$user['apellidop']." ".$user['apellidom'];
                    $fondopp = " background-color: #FC0000;";
                }
                $sql = "INSERT INTO com_asistencia (id_user, apellidop, apellidom, nombre, dni, ensa, sede, fecha) VALUES ('".$user['id']."', '".$user['apellidop']."', '".$user['apellidom']."', '".$user['nombres']."', '".$user['dni']."', '".$_POST['ensa']."', '".$_POST['sede']."', '".time()."')";
                mysql_query($sql,$con);
            }
            else {
                $mmensaje = $user['nombres']." ".$user['apellidop']." ".$user['apellidom']."</br>no pertenece a esta sede.";
                $fondopp = " background-color: #FFD600;";
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
        }, 3000);
        setTimeout(function () {
            $(\".jo\").remove();
            $(\".overlay\").remove();
            $(\"#dni\").val(\"\");
            $('#dni').focus();
        }, 3000);
        return false;
    });
    </script>
    <div class=\"jo animated bounceInDown\" style=\"width: 380px;$fondopp\">
        <div class=\"cerrar\">x</div>
        <span class=\"texto\">
            <center><h2>".$mmensaje."</h2></center>
        </span>
    </div><div class=\"overlay\"></div>";
echo json_encode($respuesta);
?>