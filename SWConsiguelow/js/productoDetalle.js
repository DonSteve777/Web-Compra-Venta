$(function() {
    $("#addCart").click(function() {
        var producto = $(this).val();
        var url = " usuarioLogueado.php";
        var logueado = false;
        $.get(url,function(data,status){

            if (data == 'logueado'){
                //var producto = location.search.substring(4);
                var e = {
                    "producto" : producto ,
                    "pagado"   : 0
                };
                $.post( "anadirPedido.php", JSON.stringify(e), function(data, status) {
                    $("#addCart").replaceWith(data);         
                })
            }
            else{
               // var contenidoModal = document.getElementById("containerForm");
                $("#containerForm").html(data);
                var modal = document.getElementById("myModal");
                // Get the button that opens the modal
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
                modal.style.display = "block";
            // }
                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            }
        });
    });

    $("#comprarBtn").click(function() {
        var producto = $(this).val();
        var url = " usuarioLogueado.php";
        var logueado = false;
        $.get(url,function(data,status){
            if (data == 'logueado'){
                url = "caja.php?id="+producto;
               // alert(url);
                window.location.href= url;
            }
            else{
                var contenidoModal = document.getElementById("containerForm");
                $("#containerForm").html(data);
                var modal = document.getElementById("myModal");
                // Get the button that opens the modal
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
                modal.style.display = "block";
            // }
                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }        
            }
        });
    });
})
