$(function() {
    $(".eliminar").click(function() {
       var url = 'eliminaCarrito.php'; 
        var idPedido = $(this).val();
        var e = {
            "id" : idPedido,
          };
        $.post(url,JSON.stringify(e),function(data,status){
          if (data=='error1'){
            alert('Se esperaba una petición post');
          }else if(data=='error2'){
            alert('error en el json recibido. No es un objeto');
          }else if(data=='error3'){
            alert('error, no se ha eliminado del carro');
          }else{
            var counter = parseInt($('#counter').text()); 
            counter = counter -1;
            $('#counter').text(counter);
            var precio = parseInt(data);
            var total = parseInt($('#total').text());
            var totalnumber = parseInt(total);
      
            totalnumber = totalnumber - precio;
            $('#total').text(totalnumber);
            $('#' + idPedido).remove();
            $('#' + idPedido + 'li').remove();
          }
        })
          .fail(function() {
            alert( "error, la petición http falló" );
          });
    });
    
    $(".comprar").click(function() {
      var producto = $(this).val();
      url = "caja.php?id="+producto;
      window.location.href= url;
    });


})