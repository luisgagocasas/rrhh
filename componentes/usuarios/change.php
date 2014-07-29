<?php include "../../config.php";
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
    <div class="ja animated bounceInDown" style="width: 30%;">
    <div class="cerrar">x</div>
    <div class="texto">';
if($_GET['que']=="password"){
    $respuesta->mensaje .= '
        <center><h2>Cambiar contraseña</h2></center>
        <script>
        $("#frm1").submit(function(){
            var formulario = new FormData($("#frm1")[0]);
            $.ajax({
                dataType: "json",
                url: "componentes/usuarios/changeguardar.php?tipo=password",
                type: "POST",
                data: formulario,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(respuesta){
                $("#confirmar").html(respuesta.mensaje).fadeIn();
                $("#save").addClass("boton-verde_bloqueado");
                document.frm1.password.disabled = true;
            });
            return false;
        });
        </script>
        <form action="" name="frm1" id="frm1">
            <input type="hidden" name="id" value="'.$_GET['id'].'">
            <div class="form_control">
                <label for="txtpass">Ingrese su nueva contraseña</label>
                <input type="password" name="password" required id="txtpass" placeholder="Nueva contraseña">
            </div>
            <center><button type="submit" class="boton-verde" id="save">Guardar</button></center>
        </form>';
}
$respuesta->mensaje .= '<div id="confirmar"></div></div></div><div class="overlay"></div>';
echo json_encode($respuesta);
?>