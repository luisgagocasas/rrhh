$(document).ready( function(){
    $("#frmcheck").submit(function(){
        var formulario = $("#frmcheck").serializeArray();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "guardar.php",
            data: formulario
        }).done(function(respuesta){
            $("#mensaje").html(respuesta.mensaje).fadeIn();
        });
        return false;
    });
});