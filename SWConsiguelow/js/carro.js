$(function() {
    
    $(".comprar").click(function() {
       var url = 'anadirPedido.php'; 
        var idPedido = $(this).val();

        var e = {
            "id" : idPedido,
          };
       
        $.post(url,JSON.stringify(e),function(data,status){
        })
        .done(function() {
            window.location.href = "caja.php";
          })
          .fail(function(){
            alert( "error. No se ha comprado" );
          })
    });

    $(".eliminar").click(function() {
       var url = 'eliminaCarrito.php'; 
        var idPedido = $(this).val();
        var e = {
            "id" : idPedido,
          };
        $.post(url,JSON.stringify(e),function(data,status){
            var counter = parseInt($('#counter').text()); 
            counter = counter -1;
            $('#counter').text(counter);
            var precio = parseInt(data);
            var total = parseInt($('#total').text());
            var totalnumber = parseInt(total);
      
            totalnumber = totalnumber - precio;
            $('#total').text(totalnumber);

        })
        .done(function() {
            $('#' + idPedido).remove();
            $('#' + idPedido + 'li').remove();
          })
  
          .fail(function() {
            alert( "error. No se ha eliminado" );
          });
    });


})