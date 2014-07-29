$(document).ready( function(){
	$(".asgcurso").on('click',function(e){
		e.preventDefault();
		var sede=$(this).attr('href');
		var user=$(this).attr('title');
        $.ajax({
            dataType: 'json',
            url: "componentes/examenes/asignarcurso.php?que=editar&id="+sede+"&user="+user
        }).done(function(respuesta){
            $("#mensaje").html(respuesta.mensaje).fadeIn();
        });
    });
    $(".asgcursov").on('click',function(e){
        e.preventDefault();
        var sede=$(this).attr('href');
        var user=$(this).attr('title');
        $.ajax({
            dataType: 'json',
            url: "componentes/examenes/asignarcurso.php?que=ver&id="+sede+"&user="+user
        }).done(function(respuesta){
            $("#mensaje").html(respuesta.mensaje).fadeIn();
        });
    });
});