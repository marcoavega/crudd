<?php
    // Incluye la configuración de la aplicación y la función de autoloading de clases.
    require_once "./config/app.php";
    require_once "./autoload.php";

    /*---------- Iniciando sesion ----------*/
    // Incluye el archivo que inicia la sesión.
    require_once "./app/views/inc/session_start.php";

    // Verifica si la variable GET 'views' está definida en la URL.
    if(isset($_GET['views'])){
        // Divide la cadena en 'views' por el carácter '/' y almacena los resultados en un array.
        $url = explode("/", $_GET['views']);
    }else{
        // Si 'views' no está definida, establece un valor por defecto "login" en el array.
        $url = ["login"];
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        // Incluye el encabezado de HTML, que probablemente contiene metadatos y etiquetas <title>.
        require_once "./app/views/inc/head.php";
    ?>
</head>
<body>
    <?php
        // Importa el espacio de nombres 'app\controllers\viewsController'.
        use app\controllers\viewsController;

        // Crea una instancia de la clase 'viewsController'.
        $viewsController = new viewsController();

        // Llama al método 'obtenerVistasControlador' con el primer elemento del array '$url'.
        $vista = $viewsController->obtenerVistasControlador($url[0]);

        // Comprueba si la vista es "login" o "404" y carga el archivo correspondiente.
        if($vista == "login" || $vista == "404"){
            // Incluye el archivo de vista correspondiente (login-view.php o 404-view.php).
            require_once "./app/views/content/".$vista."-view.php";
        }else{
            // Incluye el archivo de la barra de navegación y el archivo de la vista principal.
            require_once "./app/views/inc/navbar.php";
            require_once $vista;
        }

        // Incluye el archivo de scripts JavaScript al final del cuerpo de la página.
        require_once "./app/views/inc/script.php"; 
    ?>
</body>
</html>
