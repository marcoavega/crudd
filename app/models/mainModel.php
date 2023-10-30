<?php
namespace app\models;

use \PDO;

//con this-> se puede acceder a todos los metodos y variables de la clase.

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

    protected function conectar()
    {
        $conexion = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db, $this->user, $this->pass);
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }

    /*----------  Funcion ejecutar consultas  ----------*/
    protected function ejecutarConsulta($consulta)
    {
        $sql = $this->conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    /*----------  Funcion limpiar cadenas  ----------*/
		public function limpiarCadena($cadena){

			$palabras=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];

			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);

			foreach($palabras as $palabra){
				$cadena=str_ireplace($palabra, "", $cadena);
			}

			$cadena=trim($cadena);
			$cadena=stripslashes($cadena);

			return $cadena;
		}
        
}
?>