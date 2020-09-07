$(document).ready(function() {	
	//carga del DOM tree
	$("#userOK").hide();
	$("#regexpr").hide();
	$("#campoUser").one("click", function() {
		$("#campoUser").val('');
	  });

	  $("#checkButton").click(function(){
		var url = "comprobarUsuario.php?user=" + $("#campoUser").val();
		var usernameRegex = /^[a-zA-Z0-9]+$/;
		if (usernameRegex.test($("#campoUser").val())){
			$("#regexpr").hide();
			$.get(url,function(data,status){
				//alert(data);
				if (data === 'disponible'){
					$("#userOK").html('&#x2714');
				}
				else	
					$("#userOK").html('&#x26a0');
				$("#userOK").show();
				//alert("Data: " + data + "\nStatus: " + status);
			});
		}else{
			$("#regexpr").show();
			$("#userOK").hide();
			//$("#regexpr").html('El nombre de usuario sólo puede contener símbolos alfanuméricos');
		}
  });

});