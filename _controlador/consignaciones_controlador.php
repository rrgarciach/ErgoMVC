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
        
class ConsignacionesCtrl extends Controlador {
    // TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de objetos Consignaciones
     */
    static public function buscarConsignaciones($valor, $campo='id_consignacion', $patron='=') {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
         $conn = new SQLServer('gcmaster', 'w');
//         $conn = new MySQL('gcdbmaster', 'w');
         $valor = $conn->filterQueryInput($valor);
         $campo = $conn->filterQueryInput($campo);
         $query = "SELECT * FROM consignaciones WHERE $campo $patron '$valor'";
         if ($patron=='LIKE') $query = "SELECT * FROM consignaciones WHERE $campo $patron '%$valor%'";
         $consignaciones = $conn->selectToObject($query, 'Consignaciones');
         
         // HAY QUE TRASLADAR ESTO A UNA FUNCION ESTATICA EN LA CLASE XML:
         // DESDE AQUI:
         foreach ($consignaciones as $consignacion) { 
            $consignacion = self::parseoXML($consignacion, 'Renglones');
            //$pedido = self::parseoXML($pedido, 'Direccion_Envio');
         }
         // ...HASTA AQUI.
         
         $conn->close();
         return $consignaciones;
     }
        
   /**
      * Recibe como parametro un objeto pedido y, en caso de no existir, lo agrega a la base de datos.
      * @param objeto $consignacion
      * @return String $id_consignacion
      */ 
   static public function agregarConsignaciones($consignacion) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
        $conn = new SQLServer('gcmaster', 'w');
//        $conn = new MySQL('gcdbmaster', 'w');
        
        // HAY QUE TRASLADAR ESTO A UNA FUNCION ESTATICA EN LA CLASE XML:
        // DESDE AQUI:
        $renglones = new SimpleXMLElement('<renglones/>');
        require_once BASE_URI.'librerias/xml_class.php';
//        echo print_r($pedido->getRenglones());
        foreach ($consignacion->getRenglones() as $renglon) {
            $xmlElement = new XML($renglon);
            $child = new SimpleXMLElement($xmlElement->getXML());
            self::sxml_append($renglones, $child);
        }
        $consignacion->setRenglones($renglones->asXML());
//        $direcciones = new SimpleXMLElement('<direcciones/>');
////        $dir = $pedido->getDireccion_envio();
//        foreach ($pedido->getDireccion_envio() as $direccion) {
//            $xmlElement = new XML($direccion);
////        $dir2 = unserialize($dir[0]->getCalle());
////        echo print_r($direccion);
////            $xmlElement = new XML($dir[0][0]);
//            $child = new SimpleXMLElement($xmlElement->getXML());
//            self::sxml_append($direcciones, $child);
//        }
//        $pedido->setDireccion_envio($direcciones->asXML());
        
        // ...HASTA AQUI.
        
        // Encuentra el maximo id_pedido y lo incrementa para insertarlo en la tabla.
        $count = $conn->query("SELECT MAX(id_consignacion) FROM consignaciones");
        $id_consignacion = $count[0][0] + 1;
        $consignacion->setId_consignacion($id_consignacion);
        
        $resultado = $conn->insertObject($consignacion, 'Consignaciones', true);
        $conn->close();
        if (!$resultado) return false;
        return $id_consignacion;
    }

   /**
      * Recibe como parametro un objeto pedido y, en caso de existir, lo modifica en la base de datos.
      * @param objeto $consignacion
      * @return boolean
      */
   static public function actualizarConsignaciones($consignacion) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
        $conn = new SQLServer('gcmaster', 'w');
//        $conn = new MySQL('gcdbmaster', 'w');
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
        foreach ($consignacion->getRenglones() as $producto) {
            $xmlElement = new XML($producto);
            $child = new SimpleXMLElement($xmlElement->getXML());
            self::sxml_append($productos, $child);
        }
        $consignacion->setRenglones($productos->asXML());
//        $direcciones = new SimpleXMLElement('<direcciones/>');
//        foreach ($pedidoDirecciones as $direccion) {
//            $xmlElement = new XML($direccion);
//            $child = new SimpleXMLElement($xmlElement->getXML());
//            self::sxml_append($direcciones, $child);
//        }
//        $pedido->setDireccion_envio($direcciones->asXML());
        
        // ...HASTA AQUI.
        
        $resultado = $conn->updateObject($consignacion, 'Consignaciones', true);
        $conn->close();
        if (!$resultado) return false;
        return true;
    }

   /**
      * Recibe como parametro un objeto pedido y, en caso de no existir, lo elimina de la base de datos.
      * @param objeto $pedido
      * @return boolean
      */ 
   static public function borrarConsignaciones($pedido) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
        $conn = new SQLServer('gcmaster', 'w');
//        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->deleteObject($pedido, 'Consignaciones');
        $conn->close();
        if (!$resultado) return false;
        return true;
    }
    
    /**
     * Convierte de XML a objetos cada uno de los elementos de los arreglos
     * contenidos en el objeto principa.
     * @param Objeto $pedido Objeto instancia de la clase Consignaciones.
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
      * Genera un documento XML del producto buscado segun el id_consignacion.
      * @param int $id_consignacion
      * @param String $ruta
      * @return boolean
      */
     static public function generarXML($id_consignacion, $ruta='') {
         if (! $consignaciones = PedidosCtrl::buscarPedidos($id_consignacion)) { echo 'CONSIGNACION NO ENCONTRADA.'; return false; }       
         require_once BASE_URI.'librerias/xml_class.php';
         $id_consignacion = str_pad($id_consignacion, 6, '0', STR_PAD_LEFT);
         $consignacionXML = new Xml($consignaciones[0]);
         $consignacionXML->saveToFile($ruta."consignacion$id_consignacion.xml");
     }
     
     static public function abrirXML($xml) {
         require_once BASE_URI.'librerias/xml_class.php';
         $consignacion = XML::fileToObject($xml, 'Consignaciones');
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
         return $consignacion;
     }
}

// Funciones jQuery:
extract($_REQUEST);
if(!isset($f)) $f='';
switch ($f) {
    case 'ajaxSetConsignacion':
        require_once BASE_URI . "_modelo/consignaciones_modelo.php";
        
        if (!isset($_SESSION)) session_start();
        
        $consignacion = new Consignaciones();
//        $consignacion->setId_vendedor('rgarcia');
//        echo print_r($_SESSION['pedido']->toArray());
        
        $_SESSION['consignacion'] = serialize($consignacion);
        break;
        
    case 'ajaxSetCliente':
        require_once BASE_URI . "_modelo/consignaciones_modelo.php";
        require_once BASE_URI . "_controlador/clientes_controlador.php";
        require_once BASE_URI . 'librerias/xml_class.php';
        
        if (!isset($_SESSION)) session_start();
        $consignacion = unserialize($_SESSION['consignacion']);
        
        $date = date("Y-d-m");
        $consignacion->setFecha($date);
        $consignacion->setId_cliente($id_cliente);
        
        $_SESSION['consignacion'] = serialize($consignacion);
        break;
        
    case 'ajaxSetRenglon':
        require_once BASE_URI . "_modelo/consignaciones_modelo.php";
        require_once BASE_URI . "_modelo/renglones_modelo.php";
        require_once BASE_URI . "_controlador/renglones_controlador.php";
        require_once BASE_URI . "_controlador/productos_controlador.php";
        require_once BASE_URI . 'librerias/xml_class.php';
        
        if (!isset($_SESSION)) session_start();
        $consignacion = unserialize($_SESSION['consignacion']);
        
        $renglones = $consignacion->getRenglones();
        $renglon = new Renglones($id_producto, $cantidad, $precio, $descuento_cliente, $descuento_adicional, $estatus);
        array_push($renglones, $renglon);
        $consignacion->setRenglones($renglones);
        $xmlElement = new XML($renglon);
        echo $xmlElement->getXML();
        
        $_SESSION['consignacion'] = serialize($consignacion);
        break;
        
    case 'ajaxGuardarConsignacionXML':
        // Imports necesarios:
        require_once BASE_URI . "_modelo/renglones_modelo.php";
        require_once BASE_URI . "_controlador/consignaciones_controlador.php";
        require_once BASE_URI . "_modelo/consignaciones_modelo.php";
        require_once BASE_URI . 'librerias/xml_class.php';
        
        // Checar si existe sesión para iniciarla:
        if (!isset($_SESSION)) session_start();
        $consignacion = unserialize($_SESSION['consignacion']);
        
        // Agrega a la base de datos la consignacion y retorna el id_consignacion obtenido:
        $id_consignacion = ConsignacionesCtrl::agregarConsignaciones($consignacion);
        // Si la variable $id_consignacion vale false ó 0, significa que la consignacion no pudo ser insertada en la base de datos:
        if ($id_consignacion == false || $id_consignacion == 0) {
            // Entonces, establecer como id_consignacion 0 para indicar en el documento XML que no ha sido subido:
            $id_consignacion = 0;
        }
        $consignacion->setId_consignacion($id_consignacion);
        $xmlProducto = new XML($consignacion);
//        ConsignacionesCtrl::generarXML($_SESSION['consignacion']);
        
        // Configuracion de headers para forzar descarga de archivo XML
        header('Content-Type: application/octetstream; name=consignacion_'.$id_consignacion . '.xml');
	header('Content-Type: application/octet-stream; name=consignacion_'.$id_consignacion . '.xml');
	header('Content-Disposition: attachment; filename=consignacion_'.$id_consignacion . '.xml');
        $string = htmlspecialchars_decode((string) $xmlProducto->getXML());
	echo $string;
        
        $_SESSION['consignacion'] = serialize($consignacion);
//        unset($_SESSION['consignacion']);
        break;
        
    case 'ajaxBuscarConsignacionesCliente':
        /*
         * Variables requeridas:
         * $cliente: id_cliente
         */
        // Imports necesarios:
        require_once BASE_URI . "_modelo/renglones_modelo.php";
        require_once BASE_URI . "_controlador/consignaciones_controlador.php";
        require_once BASE_URI . "_modelo/consignaciones_modelo.php";
        require_once BASE_URI . 'librerias/xml_class.php';
        
        // Checar si existe sesión para iniciarla:
        if (!isset($_SESSION)) session_start();
        
        $consignaciones = ConsignacionesCtrl::buscarConsignaciones($id_cliente, 'id_cliente');
        if (count($consignaciones) > 0) {
            $respuestaJSON = array();
            $i = 0;
            foreach ($consignaciones as $consignacion) {
                $respuestaJSON[$i]['id_consignacion'] = $consignacion->getId_consignacion();
                $renglones = $consignacion->getRenglones();
                $respuestaJSON[$i]['total'] = 0;
                $respuestaJSON[$i]['numero_renglones'] = 0;
                foreach ($renglones as $renglon) {
                    $precio = $renglon->getPrecio();
                    $cantidad = $renglon->getCantidad();
                    $respuestaJSON[$i]['total'] += $precio * $cantidad;
                    ++$respuestaJSON[$i]['numero_renglones'];
                }
                $respuestaJSON[$i]['renglones'] = array();
                foreach ($renglones as $renglon) {
                    array_push($respuestaJSON[$i]['renglones'], $renglon->toArray());
                }
                $fecha = $consignacion->getFecha();
                $respuestaJSON[$i]['fecha'] = $fecha->format('d-m-Y');
                $respuestaJSON[$i]['estatus'] = $consignacion->getEstatus();
                $i++;
            }
            echo json_encode($respuestaJSON);
        }
        else {
            echo 'vacio';
        }
        
        break;
        
    case 'ajaxDescargarConsignacionXML':
        /*
         * Variables requeridas:
         * $id_consignacion: id_consignacion
         */
        // Imports necesarios:
        require_once BASE_URI . "_modelo/renglones_modelo.php";
        require_once BASE_URI . "_controlador/consignaciones_controlador.php";
        require_once BASE_URI . "_modelo/consignaciones_modelo.php";
        require_once BASE_URI . 'librerias/xml_class.php';

        // Checar si existe sesión para iniciarla:
        if (!isset($_SESSION))
            session_start();

        $consignaciones = ConsignacionesCtrl::buscarConsignaciones($id_consignacion);
        if (count($consignaciones) > 0) {
            $xml = new Xml($consignaciones[0]);
            $string = htmlspecialchars_decode((string) $xml->getXML());
            echo $string;
        } else {
            echo 'vacio';
        }

        break;

    default:
        break;
}