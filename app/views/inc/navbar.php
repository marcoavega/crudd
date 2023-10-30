<nav class="navbar">
    <!-- Navbar Brand: Logo e ícono de hamburguesa -->
    <div class="navbar-brand">
        <!-- Enlace del logo -->
        <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard/">
            <img src="<?php echo APP_URL; ?>app/views/img/logo-.png" alt="Bulma" width="120" height="200">
        </a>
        <!-- Ícono de hamburguesa para menú desplegable en dispositivos móviles -->
        <div class="navbar-burger" data-target="navbarExampleTransparentExample">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <!-- Menú de navegación -->
    <div id="navbarExampleTransparentExample" class="navbar-menu">
        <!-- Elementos del menú en la parte izquierda -->
        <div class="navbar-start">
            <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard/">
                Dashboard
            </a>

            <!-- Menú desplegable "Usuarios" -->
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="#">
                    Usuarios
                </a>
                <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item" href="<?php echo APP_URL; ?>userNew/">
                        Nuevo
                    </a>
                    <a class="navbar-item" href="<?php echo APP_URL; ?>userList/">
                        Lista
                    </a>
                    <a class="navbar-item" href="<?php echo APP_URL; ?>userSearch/">
                        Buscar
                    </a>
                </div>
            </div>
        </div>

        <!-- Elementos del menú en la parte derecha -->
        <div class="navbar-end">
            <!-- Menú desplegable con información del usuario -->
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    ** <?php echo $_SESSION['usuario']; ?> **
                </a>
                <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item" href="<?php echo APP_URL."userUpdate/".$_SESSION['id']."/"; ?>">
                        Mi cuenta
                    </a>
                    <a class="navbar-item" href="<?php echo APP_URL."userPhoto/".$_SESSION['id']."/"; ?>">
                        Mi foto
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="<?php echo APP_URL."logOut/"; ?>" id="btn_exit">
                        Salir
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
