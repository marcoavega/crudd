<?php
namespace app\controllers;
use app\models\viewsModel;

class viewsController extends viewsModel {
    // Método público para obtener vistas.
    public function obtenerVistasControlador($vista) {
        if ($vista != "") {
            // Llama al método heredado para obtener la vista correspondiente.
            $respuesta = $this->obtenerVistasModelo($vista);
        } else {
            // Si no se proporciona una vista, se establece "login" como vista por defecto.
            $respuesta = "login";
        }
        return $respuesta;
    }
}
?>
