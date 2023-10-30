<?php
    // Registra una función anónima como un cargador automático de clases utilizando spl_autoload_register.
    spl_autoload_register(function($clase){
        // Define la ruta del archivo de clase basado en el nombre de la clase.
        $archivo = __DIR__ . "/" . $clase . ".php";
        // Reemplaza las barras invertidas "\" en el nombre de la clase con barras diagonales "/" (común en rutas de archivos).
        $archivo = str_replace("\\", "/", $archivo);

        // Comprueba si el archivo de clase existe en la ubicación especificada.
        if(is_file($archivo)){
            // Si el archivo existe, se incluye (requiere) en el script actual.
            require_once $archivo;
        } 
    });
