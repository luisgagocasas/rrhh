$(document).ready( function(){
	$(".asgcurso").on('click',function(e){
		e.preventDefault();
		var sede=$(this).attr('href');
		var user=$(this).attr('title');
        $.ajax({
            dataType: 'json',
            url: "componentes/cursos/asignarcurso.php?id="+sede+"&user="+user
        }).done(function(respuesta){
            $("#mensaje").html(respuesta.mensaje).fadeIn();
        });
    });
});