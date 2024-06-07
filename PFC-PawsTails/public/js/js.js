//Funcion para desplegar el formulario para ver las respuestas a los comentarios
$(document).ready(function() {
    $(".mostrarFormulario").on("click", function(event) {
        event.preventDefault();
        var formularioRespuesta = $(this).next(".formulario-respuesta");
        formularioRespuesta.toggle();
    });

    $(".mostrar-respuestas").click(function(event) {
        event.preventDefault();
        var respuestas = $(this).data("target");
        $(respuestas).toggle();
    });
});
