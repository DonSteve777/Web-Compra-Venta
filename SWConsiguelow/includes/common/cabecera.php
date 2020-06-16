<div class="container-fluid bg-primary">
    <div class="container p-3">
        <div class="row  align-items-center ">
            <div class="col-2">
                <img src="img/logo.gif" alt="imagen no disponible"width="100" height="100">
            </div> 
            <div class="col-6" >
                <div class="row justify-content-center"> 
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>  
            </div> 
            <div class="col" >
                <div class="row mx-md-n5">              
                    <div class="col px-md-5">
                        <div class="p-3 border bg-light">Custom column padding</div>
                    </div>
                    <div class="col px-md-5">
                        <div class="p-3 border bg-light">Custom column padding</div>
                    </div>
                </div> 
            </div> 
        </div> 
    </div>
</div>

        <nav>
            <ul class="menu">
                <li><a href="index.php?">Inicio</a></li><li><a href="vender.php">Vender</a></li>
            </ul>
            <ul class="profile">
                <?php
                if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
                    ?>
                    <li>Bienvenido, <?php echo $_SESSION['nombre'];?><a href="vistaUsuario.php">Usuario</a></li><a href="vistaAdmin.php">Admin</a></li><li><a href="vistaCarrito.php">Carrito</li><li><a href="logout.php">(salir)</a></li>
                <?php
                } else {
                ?>
                    <li>Usuario desconocido.</li><li><a href="login.php">Login</a></li><li><a href="registro.php">Registro</a></li>
                <?php
                }
                ?>
        </ul>
        </nav>
    </div>
</div>