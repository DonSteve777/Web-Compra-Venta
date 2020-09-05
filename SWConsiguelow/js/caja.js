$(function() {
    $("#editarBtn").click(function() {
        $("#enviara").load("enviarA.php", function( response, status, xhr ) {
            if ( status == "error" ) {
              var msg = "Sorry but there was an error: ";
              $( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
            } 
            $("#btnEnviarA").click(function() {
                $.post('enviarA.php', $('form#formEnviarA').serialize(), function(data, status) {
                    location.reload();
                    //$("#enviara").html(data);
                });
            }); 
            $("#btnCancelar").click(function() {
                location.reload();
            });

        });
    });
    $("#pagarBtn").click(function() {
        var url = 'anadirPedido.php'; 
         var idProducto = $(this).val();
         var e = {
             "producto" : idProducto,
             "pagado"   : 1
           };
         $.post(url,JSON.stringify(e),function(data,status){
            $("#respuesta").html(data);
            var modal = document.getElementById("myModal");
            // Get the button that opens the modal
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            modal.style.display = "block";
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
                window.location.href = "index.php";
            }
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    window.location.href = "index.php";
                }
            }
          })
     });
});
