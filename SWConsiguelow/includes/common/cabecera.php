<header>
    <nav>
    <ul class="menu">
            <li><a href="index.php?">Inicio</a></li>
            <li><a href="vender.php">Vender</a></li>
            <li><a href="mostrarProducto.php">Mostrar productos</a></li>  
            <li><a href="filtrar.php">Filtrar productos</a></li>  
                <?php 
                if (isset($_SESSION['login']) && ($_SESSION["login"]===true) ) {
                    echo "Bienvenido, " . $_SESSION['username'] . ".<a href='logout.php'>(salir)</a>";
                }else {
                    echo "Usuario desconocido. <a href='login.php'>Login</a> <a href='registro.php'>Registro</a>";
                }
            ?>    
        </ul>
    </nav>
</header>