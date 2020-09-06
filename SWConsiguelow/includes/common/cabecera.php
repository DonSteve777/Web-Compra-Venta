<?php
    namespace es\fdi\ucm\aw;
?>

<?php
function generaNavItems($categorias=array()){
    $html='';
   // if (is_array($categorias)){
        foreach($categorias as $cat){
            $nombre = $cat->nombre();   
            $id = $cat->id();
            if ($nombre!=='sin categoría'){
                $html.=<<<EOF
                <li class="nav-item">
                    <a class="nav-link text-light" href="categoria.php?id=$id">$nombre</a>
                </li>
EOF;
            } 
        }
    return $html;
}

$htmlNavCat = '';
$categorias = Categoria::getNotEmpties();
if (!is_array($categorias)){
    $htmlNavCat=<<<EOF
    <p class="text-white"> $categorias</p>
EOF;
}else{
    $htmlNavCat= generaNavItems($categorias);
}

?>


<div class="container-fluid bg-success bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand img-fluid" href="index.php?"> 
                <img src="img/logo.gif" class="rounded-circle" alt="imagen no disponible" width="70" height="70">
            </a>
            <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"> <!--margin derecho hasta el searchbar-->
                    <li class="nav-item active m-2">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown text-center  mr-3">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="align-baseline">
                                <img src="img/person.png" alt="imagen no disponible" width="30" height="30">
                                Mi cuenta
                            </span>
                        </a>
                        <div class="dropdown-menu text-center m-2" aria-labelledby="navbarDropdown">
                            <p class="text-center"> 
                            <?php
                            $logueado=false;
                                if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
                                    $logueado = true;
                            ?>
                            Bienvenido, <a href="miPerfil.php"><?php echo $_SESSION['nombre'];?></a>
                            <?php
                            } else {
                            ?>
                                <a href="login.php">Login
                                    <span>
                                        <img src="img/insert-memory-card.png" alt="imagen no disponible" width="10" height="10">
                                    </span> 
                                </a>
                            <?php
                            }
                            ?>   
                            </p>
                            <div class="dropdown-divider"></div>
                            <?php
                                if ($logueado===true) {
                            ?>
                            <a class="dropdown-item" href="vistaPedidos.php">Mis pedidos</a>
                            <a class="dropdown-item" href="vistaProdsUsuario.php">Productos subidos</a>
                            <a class="dropdown-item text-danger" href="logout.php">
                                <span>
                                    Logout
                                    <img src="img/exit.png" alt="imagen no disponible" width="15" height="15">
                                </span>
                            </a>
                            <?php
                                } else {
                            ?>
                            <a class="dropdown-item" href="registro.php">
                                <span>
                                    <img src="img/user.png" alt="imagen no disponible" width="15" height="15">
                                    Registro
                                </span>
                            </a>
                            <?php
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item m-2">
                        <a href="vender.php" class="btn d-block btn-light btn-lg active" role="button" aria-pressed="true">      
                            <span>
                                <img src="img/sell.png" alt="imagen no disponible" width="15" height="15">
                                Vender
                            </span>
                        </a>                     
                    </li>
                    <li class="nav-item m-2">
                        <a href="carro.php" class="btn btn-light btn-lg active d-block" role="button" aria-pressed="true">
                            <span>
                                <img src="img/shopping-cart.png" alt="imagen no disponible" width="15" height="15">
                                Carrito
                            </span>
                        </a>
                    </li>

                    <?php
                        if ($logueado===true && $app->tieneRol('admin', '', '')) {
                    ?>
                        <li class="nav-item m-2">
                            <a href="vistaAdmin.php" class="btn d-block btn-light btn-lg active" role="button" aria-pressed="true">
                                Administrar
                            </a>
                        </li>
                        <?php
                            }
                            ?>
                </ul>
                
                <form class="form-inline my-2 my-lg-0 d-sm-flex" action="filtrar.php" method="GET">
                    <input class="form-control mr-sm-2" name="search" id="busqueda" type="text" value='' placeholder="Type here"></input>
                    <input class="btn btn-outline-info my-2 my-sm-0" type="submit" value="Search"></input>
                </form>

            </div>
        </nav>
    </div>
    <ul class="nav justify-content-center">
        <?php
            echo $htmlNavCat;
        ?>
    </ul>
</div>

