<?php
namespace app\models;

use \PDO;

// Verifica si el archivo de configuración server.php existe en la ubicación adecuada.
if (file_exists(__DIR__ . "/../../config/server.php")) {
    // Si el archivo de configuración existe, se requiere para acceder a las variables de configuración de la base de datos.
    require_once __DIR__ . "/../../config/server.php";
}

class MainModel
{
    // Establece propiedades privadas para la configuración de la base de datos.
    private $server = DB_SERVER; // Valor del servidor de la base de datos
    private $db = DB_NAME; // Valor del nombre de la base de datos
    private $user = DB_USER; // Valor del nombre de usuario de la base de datos
    private $pass = DB_PASS; // Valor de la contraseña de la base de datos

    // Método protegido para establecer la conexión a la base de datos.
    protected function conectar()
    {
        $conexion = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db, $this->user, $this->pass);
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }

    /*----------  Función para ejecutar consultas SQL  ----------*/
    protected function ejecutarConsulta($consulta)
    {
        $sql = $this->conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    /*----------  Función para limpiar cadenas  ----------*/
    public function limpiarCadena($cadena)
    {
        // Lista de palabras o caracteres no permitidos en las cadenas.
        $palabras = ["<script>", "</script>", "<script src", "<script type=", "SELECT * FROM", "SELECT ", " SELECT ", "DELETE FROM", "INSERT INTO", "DROP TABLE", "DROP DATABASE", "TRUNCATE TABLE", "SHOW TABLES", "SHOW DATABASES", "<?php", "?>", "--", "^", "<", ">", "==", "=", ";", "::"];

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        // Remueve las palabras o caracteres no permitidos de la cadena.
        foreach ($palabras as $palabra) {
            $cadena = str_ireplace($palabra, "", $cadena);
        }

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        return $cadena;
    }

    /*---------- Función para verificar datos (expresión regular) ----------*/
    protected function verificarDatos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    }

    /*----------  Función para ejecutar una consulta INSERT preparada  ----------*/
    protected function guardarDatos($tabla, $datos)
    {
        // Construye la consulta INSERT a partir de los datos proporcionados.
        $query = "INSERT INTO $tabla (";

        $C = 0;
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_nombre"];
            $C++;
        }

        $query .= ") VALUES(";

        $C = 0;
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_marcador"];
            $C++;
        }

        $query .= ")";

        // Prepara la consulta y asigna valores a los marcadores.
        $sql = $this->conectar()->prepare($query);

        foreach ($datos as $clave) {
            $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
        }

        // Ejecuta la consulta.
        $sql->execute();

        return $sql;
    }

    /*---------- Funcion seleccionar datos ----------*/
    public function seleccionarDatos($tipo, $tabla, $campo, $id)
    {
        $tipo = $this->limpiarCadena($tipo);
        $tabla = $this->limpiarCadena($tabla);
        $campo = $this->limpiarCadena($campo);
        $id = $this->limpiarCadena($id);

        if ($tipo == "Unico") {
            $sql = $this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo=:ID");
            $sql->bindParam(":ID", $id);
        } elseif ($tipo == "Normal") {
            $sql = $this->conectar()->prepare("SELECT $campo FROM $tabla");
        }
        $sql->execute();

        return $sql;
    }

    /*----------  Funcion para ejecutar una consulta UPDATE preparada  ----------*/
    protected function actualizarDatos($tabla, $datos, $condicion)
    {

        $query = "UPDATE $tabla SET ";

        $C = 0;
        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_nombre"] . "=" . $clave["campo_marcador"];
            $C++;
        }

        $query .= " WHERE " . $condicion["condicion_campo"] . "=" . $condicion["condicion_marcador"];

        $sql = $this->conectar()->prepare($query);

        foreach ($datos as $clave) {
            $sql->bindParam($clave["campo_marcador"], $clave["campo_valor"]);
        }

        $sql->bindParam($condicion["condicion_marcador"], $condicion["condicion_valor"]);

        $sql->execute();

        return $sql;
    }

}
?>