$(function() {
    
    $("#editarBtn").click(function() {
        $("#enviara").load("enviarA.php", function( response, status, xhr ) {
            if ( status == "error" ) {
              var msg = "Sorry but there was an error: ";
              $( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
            } 
            $("#btnEnviarA").click(function() {
                $.post('enviarA.php', $('form#formEnviarA').serialize(), function(data, status) {
                    $("#enviara").html(data);
                });
            });  
        });
    });
});
