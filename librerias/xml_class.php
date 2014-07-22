<?php
//require_once "_addresses.php";
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/**
 * Description of xml
 *
 * @author Ruy
 */
class Xml {

    private $xml;

    /**
     *
     * @param Modelo $object Objeto a convertir.
     * @return boolean Regresa el resultado de si se generó exitosamente.
     */
    public function __construct($object) {
        // En caso de querer generar un objeto XML vacío:
        if ($object == '')
            return true;
        //$content = new SimpleXMLElement('<producto/>');
        if (!$object instanceof Modelo)
            return false;
        $array = $object->toArray();
        $dom = new DOMDocument('1.0', 'utf-8');
        //$content->addAttribute('encoding', 'UTF-8', 'xml');
        //$nombreSingular = substr(get_class($object), 0, -1);
        $elemento = $array['elemento'];
        $root = $dom->createElement(strtolower($elemento));
        $domAttribute = $dom->createAttribute('clase');
        $domAttribute->value = strtolower(get_class($object));
        $root->appendChild($domAttribute);
        $dom->appendChild($root);
        foreach ($array as $key => $value) {
//            //$content->addChild( $key, $value);
//            $elemento = $dom->createElement(strtolower($key), $value);
//            $root->appendChild($elemento);
            // Si es un array:
            if (is_array($value)) {
                //print_r($value);
                $productosElemento = $dom->createElement(strtolower($key));
                foreach ($value as $producto) {
//                    require_once BASE_URI . '_modelo/' . strtolower(get_class($producto)) . '_modelo.php';
                    $productoArray = $producto->toArray();
                    $subelemento = $productoArray['elemento'];
                    $productoElemento = $dom->createElement(strtolower($subelemento));
                    $domAttribute = $dom->createAttribute('clase');
                    $domAttribute->value = strtolower(get_class($producto));
                    $productoElemento->appendChild($domAttribute);
                    //print_r($productoArray);
                    foreach ($productoArray as $k => $v) {
                        if ($k == 'elemento')
                            continue;
                        $e = $dom->createElement(strtolower($k), $v);
                        $productoElemento->appendChild($e);
                    }
                    $productosElemento->appendChild($productoElemento);
                }
                $root->appendChild($productosElemento);
            }
            // Si es un Objeto instancia de DateTime:
            else if ($value instanceof DateTime) {
                if ($key == 'elemento')
                    continue;
                $elemento = $dom->createElement(strtolower($key), $value->format('Y-m-d H:m:s'));
                $root->appendChild($elemento);
            }
            else {
                if ($key == 'elemento')
                    continue;
                $elemento = $dom->createElement(strtolower($key), $value);
                $root->appendChild($elemento);
            }
        }
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $this->xml = $dom->saveXML();
        return true;
    }

    public function appendToRoot($array, $dom, $root, $key, $value) {
        foreach ($array as $key => $value) {
            //$content->addChild( $key, $value);
            $elemento = $dom->createElement(strtolower($key), $value);
            if (is_array($value))
                $elemento = $dom->createElement(strtolower($key), $value);
            $root->appendChild($elemento);
        }
    }

    /**
     *
     * @param type $string
     */
    public function setXML($string) {
        $this->xml = $string;
    }

    /**
     *
     * @return objeto xml
     */
    public function getXML() {
        return $this->xml;
    }

    /**
     *
     * @param string $name Nombre del archivo.
     * @param string $url Ruta del archivo (direccion actual por default).
     */
    public function saveToFile($name, $url = '') {
        $modeloFile = fopen($url . $name, "w");
        fwrite($modeloFile, $this->xml);
        fclose($modeloFile);
    }

    public function loadFromFile($filename) {
        if (!file_exists($filename))
            echo 'El archivo no existe.'; //return false;
        $xmlObjeto = simplexml_load_file($filename);
        $this->xml = $xmlObjeto->asXML();
    }

    static public function getRoot($xmlObjeto) {
        //$xml = simplexml_load_string($this->xml);
        $xml = simplexml_load_string($xmlObjeto);
        return $xml->getName();
    }

    static public function xmlInstanciaDe($xmlObjeto, $clase) {
        $xml = simplexml_load_string($xmlObjeto);
        $root = $xml["clase"];
//        $root = self::getRoot($xmlObjeto);
        if (strtolower($clase) != $root)
            echo "La raiz " . $root . " no es instancia de la clase $clase segun xmlInstanciaDe()"; //return false;
        return $xml->getName();
    }

    static public function toObject($xmlObjeto, $variablesObjeto, $objeto, $root) {
//        $elementoXml = $xmlObjeto;
        $elementoXml = $xmlObjeto->xpath('../' . $xmlObjeto->getName());
        //echo (string)$elementoXml[0]->asXML();
        foreach ($variablesObjeto as $key => $value) {
            if ($key == 'key')
                continue;
            if ($key == 'elemento')
                continue;
            $metodo = 'set' . $key;
            $k = strtolower($key);
            // Si el root elemento del elemnto es "productos", los genera como un array.
//            if ($k == 'productos') {
//                $productos = array();
//                foreach ($elementoXml[0]->$k->children() as $producto) {
//                    //echo $producto->asXML();
//                    $p = self::xmlToObject($producto->asXML(), 'Productos');
//                    print_r($p->toArray());
//                    array_push($productos, $p);
//                }
//                //echo '<h1>productos array:</h1>';
//                //print_r($objeto->getProductos($productos));
//                $objeto->setProductos($productos);
//                continue;
//            }
            //echo $elementoXml[0]->$k->asXML();
            //echo '<h1>'.count($elementoXml[0]->$k->children()).'</h1>';
            // Cuenta el numero de sub-elementos, si son mas de 1, entonces es un conjunto. Procede a generarlos como un array.
            if (count($elementoXml[0]->$k->children()) >= 1) {
                $productos = array();
                $r = $elementoXml[0]->$k->getName();
                $clase = ucwords($r);
                foreach ($elementoXml[0]->$k->children() as $producto) {
                    //echo $producto->asXML();
                    require_once BASE_URI . '_modelo/' . strtolower($r) . '_modelo.php';
                    $p = self::xmlToObject($producto->asXML(), $clase);
                    //print_r($p->toArray());
                    array_push($productos, $p);
                }
                $metodo = 'set' . $clase;
                $objeto->$metodo($productos);
                continue;
            }
            $objeto->$metodo((string) $elementoXml[0]->$k);
        }
        return $objeto;
    }

    /**
     *
     * @param objeto XML $xmlObjeto
     * @param string $clase Nombre de la clase
     * @return boolean|Objeto
     */
    static public function xmlToObject($xml, $clase) {
        if (!$root = self::xmlInstanciaDe($xml, $clase))
            return false;
        //$nombreClase = ucwords($root.'s');
        $nombreClase = ucwords($clase);
        require_once BASE_URI . '_modelo/' . strtolower($clase) . '_modelo.php';
        $objeto = new $nombreClase();
        $variablesObjeto = $objeto->toArray();
        //$xmlObjeto = simplexml_load_string($xml->getXML());
        $xmlObjeto = simplexml_load_string($xml);
//        $elementoXml = $xmlObjeto->xpath('../'.$root);
//        $i=0;
//        foreach ($variablesObjeto as $key => $value) {
//            if ($key == 'key') continue;
//            $metodo = 'set'.$key;
//            $objeto->$metodo((string)$elementoXml[0]->$key);
//        }
        return self::toObject($xmlObjeto, $variablesObjeto, $objeto, $root);
    }

    /**
     *
     * @param String $filename Ruta del archivo XML
     * @param String $clase Nombre de la clase a heredar
     * @return boolean|Object XML
     */
    static public function fileToObject($filename, $clase) {
        if (!file_exists($filename))
            echo 'El archivo no existe.'; //return false;
        $xmlObjeto = simplexml_load_file($filename);
        if (!$root = self::xmlInstanciaDe($xmlObjeto->asXML(), $clase))
            echo 'No es instancia de la clase.'; //return false;

            
//$root = $r;
//        $nombreClase = ucwords($root.'s');
        $nombreClase = ucwords($clase);
        require_once BASE_URI . '_modelo/' . strtolower($clase) . '_modelo.php';
        $objeto = new $nombreClase();
        $variablesObjeto = $objeto->toArray();
        return self::toObject($xmlObjeto, $variablesObjeto, $objeto, $root);
    }

    /**
     *
     * @param archivo XML $xmlFile Ruta del archivo XML a cargar como objeto.
     * @param string $clase Nombre de la clase a heredar.
     * @return Objeto
     */
    static public function cargarXML($xmlFile) {
        $resultado = simplexml_load_string($xmlFile);
        return $resultado;
    }

    /**
     * Agrega un elemento xml al final del root.
     * @param SimpleXMLElement $to
     * @param SimpleXMLElement $from
     */
    static private function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }

    /**
     * Convierte los objetos en xml para ser insertado en la base de datos.
     * @param array $objetos Arreglo de objetos a convertir.
     */
    static public function parseObjectToXml($objetos, $clase) {
//        $clase = get_class($objeto);
        $objetosXml = new SimpleXMLElement("<" . strtolower($clase) . "/>");
//        require_once 'librerias/xml_class.php';
//        $metodoGet = 'get'.$clase;
        foreach ($objetos as $objeto) {
            $xmlElement = new XML($objeto);
            $child = new SimpleXMLElement($xmlElement->getXML());
            self::sxml_append($objetosXml, $child);
        }
//        $metodoSet = 'set'.$clase;
//        $pedido->$metodoSet($productos->asXML());
        return $objetosXml->asXML();
    }

    /**
     * Convierte de XML a objetos cada uno de los elementos de los arreglos
     * contenidos en el objeto principaL.
     * @param Objeto $pedido Objeto instancia de la clase Pedidos.
     */
    static public function parseoXML($objeto, $clase) {
        $metodo = 'get' . $clase;
        $xmlObj = simplexml_load_string($objeto->$metodo());
        $array = array();
        foreach ($xmlObj->children() as $child) {
            $producto = XML::xmlToObject($child->asXML(), $clase);
            array_push($array, $producto);
        }
        $metodo = 'set' . $clase;
        $objeto->$metodo($array);
        return $objeto;
    }

}

?>
