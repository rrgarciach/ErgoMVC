<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 22-August-2013
**/
require_once BASE_URI."_controlador/_controlador_class.php";
function __autoload($class_name) {
    @require_once BASE_URI . '_modelo/' . strtolower($class_name) . '_modelo.php';
}
        
class PedidosCtrl extends Controlador {
    // TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de objetos Pedidos
     */
    static public function buscarPedidos($valor, $campo='id_pedido', $patron='=') {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $valor = $conn->filterQueryInput($valor);
         $campo = $conn->filterQueryInput($campo);
         $query = "SELECT * FROM pedidos WHERE $campo $patron '$valor'";
         if ($patron=='LIKE') $query = "SELECT * FROM pedidos WHERE $campo $patron '%$valor%'";
         $pedidos = $conn->selectToObject($query, 'Pedidos');
         
         // HAY QUE TRASLADAR ESTO A UNA FUNCION ESTATICA EN LA CLASE XML:
         // DESDE AQUI:
         foreach ($pedidos as $pedido) { 
            $pedido = self::parseoXML($pedido, 'Renglones');
            $pedido = self::parseoXML($pedido, 'Direccion_Envio');
         }
         // ...HASTA AQUI.
         
         $conn->close();
         return $pedidos;
     }
        
   /**
      * Recibe como parametro un objeto pedido y, en caso de no existir, lo agrega a la base de datos.
      * @param objeto $pedido
      * @return String $id_pedido
      */ 
   static public function agregarPedidos($pedido) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        
        // HAY QUE TRASLADAR ESTO A UNA FUNCION ESTATICA EN LA CLASE XML:
        // DESDE AQUI:
        $renglones = new SimpleXMLElement('<renglones/>');
        require_once BASE_URI.'librerias/xml_class.php';
//        echo print_r($pedido->getRenglones());
        $tr = $pedido->getRenglones();
        foreach ($pedido->getRenglones() as $renglon) {
            $xmlElement = new XML($renglon);
            $child = new SimpleXMLElement($xmlElement->getXML());
            self::sxml_append($renglones, $child);
        }
        $pedido->setRenglones($renglones->asXML());
        $direcciones = new SimpleXMLElement('<direcciones/>');
//        $dir = $pedido->getDireccion_envio();
        foreach ($pedido->getDireccion_envio() as $direccion) {
            $xmlElement = new XML($direccion);
//        $dir2 = unserialize($dir[0]->getCalle());
//        echo print_r($direccion);
//            $xmlElement = new XML($dir[0][0]);
            $child = new SimpleXMLElement($xmlElement->getXML());
            self::sxml_append($direcciones, $child);
        }
        $pedido->setDireccion_envio($direcciones->asXML());
        // ...HASTA AQUI.
        
        // Encuentra el maximo id_pedido y lo incrementa para insertarlo en la tabla.
        $count = $conn->query("SELECT MAX(id_pedido) from pedidos");
        $id_pedido = $count[0][0] + 1;
        $pedido->setId_pedido($id_pedido);
        
        $resultado = $conn->insertObject($pedido, 'Pedidos', true);
        $conn->close();
        if (!$resultado) return false;
        return $id_pedido;
    }

   /**
      * Recibe como parametro un objeto pedido y, en caso de existir, lo modifica en la base de datos.
      * @param objeto $pedido
      * @return boolean
      */
   static public function actualizarPedidos($pedido) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
//        $productos = new SimpleXMLElement('<productos/>');
//        req uire_once 'librerias/xml_class.php';
//        foreach ($pedido->getProductos() as $producto) {
//            $xml = new XML($producto);
//            $e = new SimpleXMLElement($xml->getXML());
//            self::sxml_append($productos, $e);
//        }
//        $pedido->setProductos($productos->asXML());
        
        // HAY QUE TRASLADAR ESTO A UNA FUNCION ESTATICA EN LA CLASE XML:
        // DESDE AQUI:
        $productos = new SimpleXMLElement('<renglones/>');
        require_once BASE_URI.'librerias/xml_class.php';
        foreach ($pedido->getRenglones() as $producto) {
            $xmlElement = new XML($producto);
            $child = new SimpleXMLElement($xmlElement->getXML());
            self::sxml_append($productos, $child);
        }
        $pedido->setRenglones($productos->asXML());
        $direcciones = new SimpleXMLElement('<direcciones/>');
        foreach ($pedidoDirecciones as $direccion) {
            $xmlElement = new XML($direccion);
            $child = new SimpleXMLElement($xmlElement->getXML());
            self::sxml_append($direcciones, $child);
        }
        $pedido->setDireccion_envio($direcciones->asXML());
        // ...HASTA AQUI.
        
        $resultado = $conn->updateObject($pedido, 'Pedidos', true);
        $conn->close();
        if (!$resultado) return false;
        return true;
    }

   /**
      * Recibe como parametro un objeto pedido y, en caso de no existir, lo elimina de la base de datos.
      * @param objeto $pedido
      * @return boolean
      */ 
   static public function borrarPedidos($pedido) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->deleteObject($pedido, 'Pedidos');
        $conn->close();
        if (!$resultado) return false;
        return true;
    }
    
    /**
     * Convierte de XML a objetos cada uno de los elementos de los arreglos
     * contenidos en el objeto principa.
     * @param Objeto $pedido Objeto instancia de la clase Pedidos.
     */
    static public function parseoXML($pedido, $clase) {
        require_once BASE_URI.'librerias/xml_class.php';
        //$pedido->setCliente( XML::xmlToObject( $pedido->getCliente(), 'clientes' ) );
//        $xmlIterator = new SimpleXMLIterator( $pedido->getProductos() );
        $metodo = 'get'.$clase;
        $xmlObj = simplexml_load_string($pedido->$metodo());
        $array = array();
        foreach ($xmlObj->children() as $child) {
            $producto = XML::xmlToObject($child->asXML(), $clase);
            array_push($array, $producto);
        }
        $metodo = 'set'.$clase;
        $pedido->$metodo($array);
        return $pedido;
    }
    
    static function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }
    
    /**
      * Genera un documento XML del producto buscado segun el id_pedido.
      * @param int $codigo
      * @param String $ruta
      * @return boolean
      */
     static public function generarXML($codigo, $ruta='') {
         if (! $pedidos = PedidosCtrl::buscarPedidos($codigo)) { echo 'PEDIDO NO ENCONTRADO.'; return false; }       
         require_once BASE_URI.'librerias/xml_class.php';
         $codigo = str_pad($codigo, 6, '0', STR_PAD_LEFT);
         $pedidoXML = new Xml($pedidos[0]);
         $pedidoXML->saveToFile($ruta."pedido$codigo.xml");
     }
     
     static public function abrirXML($xml) {
         require_once BASE_URI.'librerias/xml_class.php';
         $pedido = XML::fileToObject($xml, 'Pedidos');
//         echo '<h1>Productos: </h1>';
//         echo $pedido->getProductos();
//         print_r($pedido->toArray());
//         $XMLProductos = simplexml_load_string($pedido->getProductos());
//         $arrayProductos = array();
//         foreach ($XMLProductos as $producto) {
//             $p = XML::xmlToObject($producto, 'Productos');
//             array_push($arrayProductos, $p);
//         }
//         $pedido->setProductos($arrayProductos);
         return $pedido;
     }
}

// Funciones jQuery:
extract($_REQUEST);
if(!isset($f)) $f='';
switch ($f) {
    case 'ajaxSetPedido':
//    case 'ajaxGuardarPedidoXML':
        require_once BASE_URI . "_modelo/pedidos_modelo.php";
        
        if (!isset($_SESSION)) session_start();
        
        $pedido = new Pedidos();
        $pedido->setId_vendedor('rgarcia');
//        echo print_r($_SESSION['pedido']->toArray());
        $_SESSION['pedido'] = serialize($pedido);
        break;
        
    case 'ajaxSetCliente':
        require_once BASE_URI . "_modelo/pedidos_modelo.php";
        require_once BASE_URI . "_modelo/direcciones_envio_modelo.php";
        require_once BASE_URI . "_modelo/direcciones_modelo.php";
        require_once BASE_URI . "_controlador/clientes_controlador.php";
        require_once BASE_URI . 'librerias/xml_class.php';
        
        if (!isset($_SESSION)) session_start();
        
        $pedido = unserialize($_SESSION['pedido']);
        $date = date("Y-d-m");
        $pedido->setFecha($date);
        $pedido->setId_cliente($id_cliente);
        $clientes = ClientesCtrl::buscarClientes($id_cliente);
        $cliente = $clientes[0];
        ////// Mejor implementar esto en una función del controlador de clientes:
        $direcciones = $cliente->getDirecciones_envio();
        
        $pedido->setDireccion_envio($direcciones);
        $_SESSION['pedido'] = serialize($pedido);
        break;
        
    case 'ajaxSetRenglon':
        require_once BASE_URI . "_modelo/pedidos_modelo.php";
        require_once BASE_URI . "_modelo/renglones_modelo.php";
        require_once BASE_URI . "_controlador/renglones_controlador.php";
        require_once BASE_URI . "_controlador/productos_controlador.php";
        require_once BASE_URI . 'librerias/xml_class.php';
        
        if (!isset($_SESSION)) session_start();
        
        $pedido = unserialize($_SESSION['pedido']);
        $renglones = $pedido->getRenglones();
        $renglon = new Renglones($id_producto, $cantidad, $precio, $descuento_cliente, $descuento_adicional, $estatus);
        array_push($renglones, $renglon);
        $pedido->setRenglones($renglones);
        $xmlElement = new XML($renglon);
        echo $xmlElement->getXML();;
        $_SESSION['pedido'] = serialize($pedido);
        break;
        
    case 'ajaxGuardarPedidoXML':
        // Imports necesarios:
        require_once BASE_URI . "_modelo/renglones_modelo.php";
        require_once BASE_URI . "_controlador/pedidos_controlador.php";
        require_once BASE_URI . "_modelo/pedidos_modelo.php";
        require_once BASE_URI . 'librerias/xml_class.php';
        
        // Checar si existe sesión para iniciarla:
        if (!isset($_SESSION)) session_start();
        
        $pedido = unserialize($_SESSION['pedido']);
        
        // Agrega a la base de datos el pedido y retorna el id_pedido obtenido:
        $id_pedido = PedidosCtrl::agregarPedidos($pedido);
        // Si la variable $id_pedido vale false ó 0, significa que el pedido no pudo ser insertado en la base de datos:
        if ($id_pedido == false || $id_pedido == 0) {
            // Entonces, establecer como id_pedido 0 para indicar en el documento XML que no ha sido subido:
            $id_pedido = 0;
        }
        $pedido->setId_pedido($id_pedido);
        $xmlProducto = new XML($pedido);
//        PedidosCtrl::generarXML($_SESSION['pedido']);
        
        // Configuracion de headers para forzar descarga de archivo XML
        header('Content-Type: application/octetstream; name=pedido_'.$id_pedido . '.xml');
	header('Content-Type: application/octet-stream; name=pedido_'.$id_pedido . '.xml');
	header('Content-Disposition: attachment; filename=pedido_'.$id_pedido . '.xml');
        $string = htmlspecialchars_decode((string) $xmlProducto->getXML());
	echo $string;
        
        $_SESSION['pedido'] = serialize($pedido);
//        unset($_SESSION['pedido']);
        break;

    default:
        break;
}