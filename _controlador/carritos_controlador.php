<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 28-September-2013
**/
require_once BASE_URI."_controlador/_controlador_class.php";
        
class CarritosCtrl extends Controlador {
    // TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de Objetos
     */
    static public function buscarCarrito($valor, $campo) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $valor = $conn->filterQueryInput($valor);
         $query = "SELECT * FROM carritos WHERE $campo='$valor'";
         $carritos = $conn->selectToObject($query, 'Carritos');
         $conn->close();
         require_once BASE_URI.'librerias/xml_class.php';
         foreach ($carritos as $carrito) {
            $carrito = Xml::parseoXML($carrito, 'Renglones');
         }
         return $carritos;
     }
        
   /**
      * Recibe como parametro un objeto carrito y, en caso de no existir, lo agrega a la base de datos.
      * @param objeto $carrito
      * @return boolean
      */ 
   static public function agregarCarrito($carrito) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        require_once BASE_URI.'librerias/xml_class.php';
        $renglones = $carrito->getRenglones();
        $renglones = xml::parseObjectToXml($renglones, 'Renglones');
        $carrito->setRenglones($renglones);
        $resultado = $conn->insertObject($carrito, 'Carritos');
        $conn->close();
        if ($resultado) return false;
        return true;
    }

   /**
      * Recibe como parametro un objeto carrito y, en caso de existir, lo modifica en la base de datos.
      * @param objeto $carrito
      * @return boolean
      */ 
   static public function actualizarCarrito($carrito) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        require_once BASE_URI.'librerias/xml_class.php';
        $renglones = $carrito->getRenglones();
        $renglones = xml::parseObjectToXml($renglones, 'Renglones');
        $carrito->setRenglones($renglones);
        $resultado = $conn->updateObject($carrito, 'Carritos');
        $conn->close();
        if (!$resultado) return false;
        return true;
    }

   /**
      * Recibe como parametro un objeto carrito y, en caso de no existir, lo elimina de la base de datos.
      * @param objeto $carrito
      * @return boolean
      */ 
   static public function borrarCarrito($carrito) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->deleteObject($carrito, 'Carritos');
        $conn->close();
        if (!$resultado) return false;
        return true;
    }
    
    static public function recalcularPrecios($carrito) {}
    
    static public function getImporte($carrito) {
        $importe = 0;
        $renglones = $carrito->getRenglones();
        foreach ($renglones as $renglon) {
            $precio = $renglon->getPrecio();
            $cantidad = $renglon->getCantidad();
            $importe += $precio * $cantidad;
        }
        return $importe;
        }
    
    static public function getImporteIVA($carrito) {
        $globalesXML = simplexml_load_file(BASE_URI."xml/globales.xml");
        $iva = $globalesXML->iva;
        $importe = self::getImporte($carrito);
        $importeIVA = $importe * $iva;
        return $importeIVA;
    }
    
    static public function getTotal($carrito) {
        $importeIVA = self::getImporteIVA($carrito);
        $importe = self::getImporte($carrito);
        $total = $importe + $importeIVA;
        return $total;
    }
    
    static public function vaciarCarrito($carrito) {
        $vacio = array();
        $carrito->setRenglones($vacio);
    }
}
        