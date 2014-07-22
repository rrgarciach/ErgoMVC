<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 06-August-2013
 * */
require_once BASE_URI."/_controlador/_controlador_class.php";

class ProductosCtrl extends Controlador {
    // TODO 
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de Objetos
     */
    static public function buscarProductos($valor, $campo='id_producto', $patron='=') {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $valor = $conn->filterQueryInput($valor);
        $campo = $conn->filterQueryInput($campo);
        $query = "SELECT * FROM productos WHERE $campo $patron '$valor'";
        if ($patron=='LIKE') $query = "SELECT * FROM productos WHERE $campo $patron '%$valor%'";
        $productos = $conn->selectToObject($query, 'Productos');
        $conn->close();
        return $productos;
    }
    
    /**
      * Recibe como parametro un objeto producto y, en caso de no existir, lo agrega a la base de datos.
      * @param objeto $producto
      * @return boolean
      */
     static public function agregarProductos($producto) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $resultado = $conn->insertObject($producto, 'Productos');
         $conn->close();
         if ($resultado) return false;
         return true;
     }
     
     /**
      * Recibe como parametro un objeto producto y, en caso de existir, lo modifica en la base de datos.
      * @param objeto $producto
      * @return boolean
      */
     static public function actualizarProductos($producto) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $resultado = $conn->updateObject($producto, 'Productos');
         $conn->close();
         if (!$resultado) return false;
         return true;
     }
     
     /**
      * Recibe como parametro un objeto producto y, en caso de no existir, lo elimina de la base de datos.
      * @param objeto $producto
      * @return boolean
      */
     static public function borrarProductos($producto) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $resultado = $conn->deleteObject($producto, 'Productos');
         $conn->close();
         if (!$resultado) return false;
         return true;
     }
     
     /**
      * Genera un documento XML del producto buscado segun el id_producto.
      * @param int $codigo
      * @param String $ruta
      * @return boolean
      */
     static public function generarXML($codigo, $ruta='') {
         if (! $productos = ProductosCtrl::buscarProductos($codigo)) { echo 'PRODUCTO NO ENCONTRADO.'; return false; }
         require_once BASE_URI.'/librerias/xml_class.php';
         $productoXML = new Xml($productos[0]);
         $productoXML->saveToFile($ruta."producto$codigo.xml");
     }
}

// Funciones jQuery:
extract($_REQUEST);
if(!isset($f)) $f='';
//$term = mysql_escape_string($term); // Attack Prevention
//$term = $conn->filterQueryInput($term);
//$funcion = 'buscarProductos';
//$valor = '22606';
switch ($f) {
    case 'buscarProductos':
        if ($valor != '') {
            $string = '';
            // Busca producto con parametros default de 'id_producto' y '=':
            $productos = ProductosCtrl::buscarProductos($valor);
            // Evalua si se encontraron resultados:
            if (count($productos) > 0) {
                // Recorre los resultados extrayéndolos como XML:
                foreach ($productos as $producto) {
                    require_once BASE_URI . 'librerias/xml_class.php';
                    $xml = new Xml($producto);
                    $string .= htmlspecialchars_decode((string) $xml->getXML());
                }
            } else {
                // En caso de no encontrar resultados:
                $string = "vacio";
            }
            echo $string;
        }
        else {
            // En caso de que el parametro $valor haya sido enviado vacío:
            $string = "vacio";
        }
        break;
    
    default:
        break;
}