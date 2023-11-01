<?php
    // Constante que almacena la URL base de la aplicación.
    const APP_URL = "http://localhost/borgattaingenieria/";

    // Constante que almacena el nombre de la aplicación.
    const APP_NAME = "BORGATTA INGENIERÍA";

    // Constante que almacena el nombre de la sesión de la aplicación.
    const APP_SESSION_NAME = "borgatta_ingenieria";

    /*
        Configuración de la zona horaria de la aplicación. En este caso, se establece la zona horaria a "America/Mexico_City".
        Esto afectará cómo se manejan las fechas y horas en la aplicación.
        Puedes cambiar esta configuración según la zona horaria de tu preferencia.
        Para obtener una lista de zonas horarias válidas, consulta:
        http://php.net/manual/es/timezones.php
    */
    date_default_timezone_set("America/Mexico_City");
?>
