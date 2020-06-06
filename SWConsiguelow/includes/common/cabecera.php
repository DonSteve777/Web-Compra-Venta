<div id="cabecera">
    <div id="titulo">
    <h1>CONSIGUELOW</h1>
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