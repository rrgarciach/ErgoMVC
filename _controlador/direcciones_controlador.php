<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 27-August-2013
**/
require_once BASE_URI . "_controlador/_controlador_class.php";
        
class DireccionesCtrl extends Controlador {
    // TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de Objetos
     */
    static public function buscarDirecciones($valor, $campo) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $query = "SELECT * FROM direcciones WHERE $campo='$valor'";
         $direcciones = $conn->queryObject($query, 'Direcciones\s');
         $conn->close();
         return $direcciones;
     }
        
   /**
      * Recibe como parametro un objeto direcciones y, en caso de no existir, lo agrega a la base de datos.
      * @param objeto $direcciones
      * @return boolean
      */ 
   static public function agregarDirecciones($direcciones) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->insertObject($direcciones, 'Direcciones');
        $conn->close();
        if ($resultado) return false;
        return true;
    }

   /**
      * Recibe como parametro un objeto direcciones y, en caso de existir, lo modifica en la base de datos.
      * @param objeto $direcciones
      * @return boolean
      */ 
   static public function actualizarDirecciones($direcciones) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->updateObject($direcciones, 'Direcciones');
        $conn->close();
        if (!$resultado) return false;
        return true;
    }

   /**
      * Recibe como parametro un objeto direcciones y, en caso de no existir, lo elimina de la base de datos.
      * @param objeto $direcciones
      * @return boolean
      */ 
   static public function borrarDirecciones($direcciones) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->deleteObject($direcciones, 'Direcciones');
        $conn->close();
        if (!$resultado) return false;
        return true;
    }
}
        