$(document).ready(function() {	//carga del DOM tree
    $("#addCart").onclick(function(){
        var url = "añadirAlCarrito.php?id=1";
        $.get(url,addCart);
    });

    function addCart(data,status) {
        if (data === 'disponible')
			$("#userOK").html('&#x2714');
		else	
			$("#userOK").html('&#x26a0');
		$("#userOK").show();
		alert("Data: " + data + "\nStatus: " + status);

})