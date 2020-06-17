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
                    <li class="nav-item active mr-3">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown text-center  mr-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>
                                <img src="img/person.png" alt="imagen no disponible" width="30" height="30">
                                Mi cuenta
                            </span>
                        </a>
                        <div class="dropdown-menu text-center mr-3" aria-labelledby="navbarDropdown">
                            <p class="text-center"> 
                            <?php
                                if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
                                    $logueado = true;
                                    ?>
                                    Bienvenido, <a href="vistaUsuario.php"><?php echo $_SESSION['nombre'];?></a>
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
                            <a class="dropdown-item" href="vistaCarrito.php">Mis pedidos</a>
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
                    <li class="nav-item  mr-3">
                        <a href="vender.php" class="btn btn-light btn-lg active" role="button" aria-pressed="true">      
                            <span>
                                <img src="img/sell.png" alt="imagen no disponible" width="15" height="15">
                                Vender
                            </span>
                        </a>                     
                    </li>
                    <li class="nav-item">
                        <a href="vistaCarrito.php" class="btn btn-light btn-lg active" role="button" aria-pressed="true">
                            <span>
                                <img src="img/shopping-cart.png" alt="imagen no disponible" width="15" height="15">
                                Carrito
                            </span>
                        </a>
                    </li>
                </ul>
                <!--form class="form-inline my-2 my-lg-0" action="filtrar.php" method="GET">
                    <input class="form-control mr-sm-2" type="search" placeholder="search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                -->
                <form class="form-inline my-2 my-lg-0" action="filtrar.php" method="GET">
                    <input class="form-control mr-sm-2" name="search" type="text" value='' placeholder="Type here"></input>
                    <input class="btn btn-outline-info my-2 my-sm-0" type="submit" value="Search"></input>
                </form>
            </div>
        </nav>
    </div>
</div>


       
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>


