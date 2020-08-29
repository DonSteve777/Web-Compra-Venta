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

    $("#pagarBtn").click(function() {
        var url = 'anadirPedido.php'; 
         var idProducto = $(this).val();
         var e = {
             "id" : idProducto,
             "pagado"   : 1
           };
         $.post(url,JSON.stringify(e),function(data,status){
         })
         .done(function() {
             alert("Pedido realizado");
             window.location.href = "index.php";    //MEJORAR: modal de éxito con enlace 
           })
           .fail(function(){
             alert( "error. No se ha comprado" );
           })
     });
});
