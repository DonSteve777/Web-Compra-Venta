$(function() {
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
    
    $(".comprar").click(function() {
      var producto = $(this).val();
      url = "caja.php?id="+producto;
                window.location.href= url;
    });


})