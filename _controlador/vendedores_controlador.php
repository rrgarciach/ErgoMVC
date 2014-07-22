<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 14-August-2013
**/
require_once BASE_URI."_controlador/_controlador_class.php";
        
class VendedoresCtrl extends Controlador {
    // @TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de Objetos
     */
    public function buscarVendedores($valor, $campo) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $query = "SELECT * FROM vendedores WHERE '$campo'='$valor'";
         $vendedores = $conn->selectToObject($query, 'Vendedores');
         $conn->close();
         return $vendedores;
     }
     
     /**
      * Recibe como parametro un objeto vendedor y, en caso de no existir, lo agrega a la base de datos.
      * @param objeto $vendedor
      * @return boolean
      */
     public function agregarVendedor($vendedor) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $resultado = $conn->insertObject($vendedor, 'Vendedores');
         $conn->close();
         if ($resultado) return false;
         return true;
     }
     
     /**
      * Recibe como parametro un objeto vendedor y, en caso de existir, lo modifica en la base de datos.
      * @param objeto $vendedor
      * @return boolean
      */
     public function actualizarVendedor($vendedor) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $resultado = $conn->updateObject($vendedor, 'Vendedores');
         $conn->close();
         if (!$resultado) return false;
         return true;
     }
     
     /**
      * Recibe como parametro un objeto vendedor y, en caso de no existir, lo elimina de la base de datos.
      * @param objeto $vendedor
      * @return boolean
      */
     public function borrarVendedor($vendedor) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $resultado = $conn->deleteObject($vendedor, 'Vendedores');
         $conn->close();
         if (!$resultado) return false;
         return true;
     }
}
        