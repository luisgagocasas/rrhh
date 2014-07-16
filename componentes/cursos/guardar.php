<?php
include "../../config.php";
include "../../funciones/function.globales.php";
$respuesta = new stdClass();
$config = new LagcConfig(); //Conexion
$con = mysql_connect($config->lagclocal,$config->lagcuser,$config->lagcpass);
mysql_select_db($config->lagcbd,$con);
/*Subo imagen*/
if (!empty($_FILES['archivo']['name'])) {
    if ($_FILES['archivo']["error"] > 0){ $respuesta->mensaje .= "Error: ".$_FILES['archivo']['error']."<br />"; }
    else {
        if($_FILES['archivo']['type']=="application/pdf"){ $tipoft = "pdf"; }
        else { $tipoft = substr($_FILES['archivo']['type'], 6); }
        $nombreft = $_POST['iduser']."_".$_POST['idcurso']."_".LGlobal::Url_Amigable($_POST['nombreuser'].$_POST['apellidopuser'].$_POST['apellidomuser']).".".$tipoft;
        $fotoruta = "../../archivos_cursos/";
        move_uploaded_file($_FILES['archivo']['tmp_name'],$fotoruta.$nombreft);
    }
}
else { $nombreft = $_POST['archivo']; }
if($_POST['tipo']=="crear"){
    $sql = "INSERT INTO com_curso_asignar (id_curso, id_usuario, fechainicio, fechafin, archivo, activo) VALUES ('".$_POST['idcurso']."', '".$_POST['iduser']."', '".$_POST['inicio']."', '".$_POST['fin']."', '".$nombreft."', '".$_POST['estado']."')";
    mysql_query($sql,$con);
    $respuesta->mensaje .= "
    <script>
    $(\".cerrar\").click(function(){
        $(\".jo\").addClass('bounceOutUp');
        setTimeout(function () {
            $(\".jo\").removeClass('bounceOutUp').removeClass('bounceInDown');
        }, 1010);
        setTimeout(function () {
            $(\".jo\").remove();
        }, 500);
        return false;
    });
    </script>
    <div class=\"jo animated bounceInDown\" style=\"width: 380px;\">
        <div class=\"cerrar\">x</div>
        <span class=\"texto\"><br>
            <center><h2>Se guardo correctamente.</h2></center>";
    if (!empty($_FILES['archivo']['name'])) {
        $respuesta->mensaje .= "<br /><br /><div style=\"margin: 0px auto; width: 350px;\">
                    <center><h2>Datos del documento</h2></center>
                    Nombre: ".$nombreft."<br />
                    Tipo: ".$_FILES['archivo']['type']."<br />
                    Tamaño: ".($_FILES["archivo"]["size"] / 1024)." kB<br /></div>";
    }
    $respuesta->mensaje .= "<br>
        </span>
    </div>";
}
if($_POST['tipo']=="editar"){
    $sql = "UPDATE com_curso_asignar SET id_curso='".$_POST['idcurso']."', id_usuario='".$_POST['iduser']."', fechainicio='".$_POST['inicio']."', fechafin='".$_POST['fin']."', archivo='".$nombreft."', activo='".$_POST['estado']."' WHERE id_asig_curso='".$_POST['idasig']."'";
    mysql_query($sql,$con);
    $respuesta->mensaje .= "
    <script>
    $(\".cerrar\").click(function(){
        $(\".jo\").addClass('bounceOutUp');
        setTimeout(function () {
            $(\".jo\").removeClass('bounceOutUp').removeClass('bounceInDown');
        }, 1010);
        setTimeout(function () {
            $(\".jo\").remove();
        }, 500);
        return false;
    });
    </script>
    <div class=\"jo animated bounceInDown\" style=\"width: 380px;\">
        <div class=\"cerrar\">x</div>
        <span class=\"texto\"><br>
            <center><h2>Se guardo correctamente.</h2></center>";
    if (!empty($_FILES['archivo']['name'])) {
        $respuesta->mensaje .= "<br /><br /><div style=\"margin: 0px auto; width: 350px;\">
                    <center><h2>Datos del documento</h2></center>
                    Nombre: ".$nombreft."<br />
                    Tipo: ".$_FILES['archivo']['type']."<br />
                    Tamaño: ".($_FILES["archivo"]["size"] / 1024)." kB<br /></div>";
    }
    $respuesta->mensaje .= "<br>
        </span>
    </div>";
}
if($_GET['tipo']=="borrararchivo"){
    $sql = "UPDATE com_curso_asignar SET archivo='' WHERE id_asig_curso='".$_GET['id']."'";
    mysql_query($sql,$con);
    unlink("../../archivos_cursos/".$fotoruta.$_GET['archivo']);
    $respuesta->mensaje .= "
    <script>
    $(\".cerrar\").click(function(){
        $(\".jo\").addClass('bounceOutUp');
        setTimeout(function () {
            $(\".jo\").removeClass('bounceOutUp').removeClass('bounceInDown');
        }, 1010);
        setTimeout(function () {
            $(\".jo\").remove();
        }, 500);
        return false;
    });
    </script>
    <div class=\"jo animated bounceInDown\" style=\"width: 380px;\">
        <div class=\"cerrar\">x</div>
        <span class=\"texto\"><br>
            <center><h2>Se borro correctamente.</h2></center>
        </span>
    </div>";
}
echo json_encode($respuesta);
?>