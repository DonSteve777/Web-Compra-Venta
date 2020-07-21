$(document).ready(function() {	//carga del DOM tree
	$("#userOK").hide();
	
	$("#campoUser").change(function(){
		var url = "comprobarUsuario.php?user=" + $("#campoUser").val();
		$.get(url,usuarioExiste);
  });
  
	function usuarioExiste(data,status) {
		if (data === 'disponible')
			$("#userOK").html('&#x2714');
		else	
			$("#userOK").html('&#x26a0');
		$("#userOK").show();
		alert("Data: " + data + "\nStatus: " + status);

	}
})