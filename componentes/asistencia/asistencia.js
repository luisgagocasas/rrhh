$(document).ready( function(){
    $(".activar").on('click',function(e){
        e.preventDefault();
        var idsede=$(this).attr('title');
        $.ajax({
            dataType: 'json',
            url: "componentes/asistencia/guardar.php?idsede="+idsede
        }).done(function(respuesta){
            $("#mensaje").html(respuesta.mensaje).fadeIn();
            $(".btnma").html(respuesta.estado).fadeIn();
            $(".btnma").removeClass("desactivado");
            $(".btnma").addClass("activo");
            $(".apagarasistencia").css("display","block");
            $("#sede").css("display","block");
        });
        return false;
    });
    $("#terminar").on('click',function(e){
        $.ajax({
            dataType: 'json',
            url: "componentes/asistencia/terminar.php"
        }).done(function(respuesta){
            $("#mensaje").html(respuesta.mensaje).fadeIn();
            $(".btnma").removeClass("activo");
            $(".btnma").addClass("desactivado");
            $(".apagarasistencia").css("display","none");
            $("#sede").css("display","none");
            $(".btnma").html("Desactivado").fadeIn();
        });
        return false;
    });
});