<?php
require_once __DIR__.'/includes/config.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Local Consiguelow</title>
    <link rel="icon" href="img/money.ico"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script> 

    <script>
        $(function() {
            $("#test").click(function() {
              var e = {
                "id" : 1,
                "pagado"   : 0
              };
                $.post( "testingRequest.php", JSON.stringify(e), function(data, status) {
                  $("#mensaje").html(data);
                   /* .done(function (data, textStatus, jqXHR) {
                $("#mensaje").html(data);*/           
                }, "json")
            });
        })
    </script>     
</head>
    <body>
    <button id="test" type="button" class="btn btn-info btn-lg" role="button" >Comprar</button>
    <div id="mensaje"></div>
    </body>
</html>