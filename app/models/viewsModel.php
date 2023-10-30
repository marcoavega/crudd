<?php
namespace app\models;

class viewsModel {
    // Método protegido para obtener una vista basado en el nombre de la vista.
    protected function obtenerVistasModelo($vista) {
        // Lista de vistas permitidas o "blancas".
        $listaBlanca = ["dashboard", "userNew", "userList", "userUpdate", "userSearch", "userPhoto", "logOut"];

        if (in_array($vista, $listaBlanca)) {
            if (is_file("./app/views/content/" . $vista . "-view.php")) {
                // Si la vista existe como archivo, se devuelve la ruta al archivo de vista.
                $contenido = "./app/views/content/" . $vista . "-view.php";
            } else {
                // Si no existe, se devuelve "404" como contenido.
                $contenido = "404";
            }
        } elseif ($vista == "login" || $vista == "index") {
            // Si la vista es "login" o "index", se devuelve "login" como contenido.
            $contenido = "login";
        } else {
            // Para cualquier otra vista no permitida, se devuelve "404" como contenido.
            $contenido = "404";
        }
        return $contenido;
    }
}
?>
