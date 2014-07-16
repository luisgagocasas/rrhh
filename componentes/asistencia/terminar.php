<?php
setcookie("sedea", "", time()+(60*60*24*30), "/");
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
        }, 500);
        return false;
    });
    </script>
    <div class=\"jo animated bounceInDown\" style=\"width: 450px;\">
        <div class=\"cerrar\">x</div>
        <span class=\"texto\">
            <center>
                <h2>Modulo de Asistencia Desactivado</h2>
            </center>
        </span>
    </div><div class=\"overlay\"></div>";
echo json_encode($respuesta);
?>