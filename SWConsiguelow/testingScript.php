<?php
require_once __DIR__.'/includes/config.php';
use es\fdi\ucm\aw\FormularioLogin;

$form = new FormularioLogin(); 
$html = $form->gestiona();
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Local Consiguelow</title>
<link rel="icon" href="img/money.ico"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/modal.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/modal.js"></script> 


</head>
<body>
    <!-- Trigger/Open The Modal -->
    <button id="myBtn">Open Modal</button>
    <!-- The Modal -->
    <div id="myModal" class="modal">
    <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="row text-center">
                <div class="col-4"></div>
                    <div class="col-4">
                        <div class="container  w-75 d-flex flex-column mt-5">
                            <?php echo $html; ?>
                            <h6 class="mt-4"> 
                                <a href="registro.php">¿Todavía no tienes cuenta? Regístrate aquí</a>
                            </h6>
                        </div>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>
        </div>

</body>
</html>
