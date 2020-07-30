<?php
    $entityBody = file_get_contents('php://input');
            $dictionary = json_decode($entityBody);
            if (!is_object($dictionary)) {
                echo 'No se ha enviado un objeto';
                var_dump($dictionary);
                exit();
                //throw new ParametroNoValidoException('El cuerpo de la petición no es valido');
            }
            $dictionary = json_decode($entityBody, true);
            if ($dictionary['pagado']== 0)
                echo '<p> esto es data en html</p>';
            else {
                # code...
                echo '<p> esto es data en html, pero pagado no es 0</p>';
            }
?>