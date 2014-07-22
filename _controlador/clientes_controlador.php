<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 14-August-2013
 * */
require_once BASE_URI."_controlador/_controlador_class.php";

class ClientesCtrl extends Controlador {

    // TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de Objetos
     */
    static public function buscarClientes($valor, $campo = 'id_cliente', $patron = '=') {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $valor = $conn->filterQueryInput($valor);
        $campo = $conn->filterQueryInput($campo);
        $query = "SELECT * FROM clientes WHERE $campo $patron '$valor'";
        if ($patron == 'LIKE')
            $query = "SELECT * FROM clientes WHERE $campo $patron '%$valor%'";
        $clientes = $conn->selectToObject($query, 'Clientes');
        foreach ($clientes as $cliente) { 
            $cliente = self::parseoXML($cliente, 'Direcciones_envio', 'direcciones_envio');
            $cliente = self::parseoXML($cliente, 'Direccion_fiscal', 'direccion_fiscal');
         }
        $conn->close();
        return $clientes;
    }

    /**
     * Agrega un nuevo elemento a la base de datos.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array
     */
    static public function agregarClientes($cliente) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->insertObject($cliente, 'Clientes', true);
        $conn->close();
        if ($resultado)
            return false;
        return true;
    }

    /**
     * Recibe como parametro un objeto producto y, en caso de existir, lo modifica en la base de datos.
     * @param objeto $producto
     * @return boolean
     */
    static public function actualizarClientes($cliente) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->updateObject($cliente, 'Clientes');
        $conn->close();
        if (!$resultado)
            return false;
        return true;
    }

    /**
     * Recibe como parametro un objeto producto y, en caso de no existir, lo elimina de la base de datos.
     * @param objeto $producto
     * @return boolean
     */
    static public function borrarClientes($cliente) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->deleteObject($cliente, 'Clientes');
        $conn->close();
        if (!$resultado)
            return false;
        return true;
    }
    
    /**
     * Convierte de XML a objetos cada uno de los elementos de los arreglos
     * contenidos en el objeto principa.
     * @param Objeto $cliente Objeto instancia de la clase Clientes.
     */
    static public function parseoXML($cliente, $clase, $atributo) {
        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
        require_once BASE_URI . "librerias/xml_class.php";
        //$pedido->setCliente( XML::xmlToObject( $pedido->getCliente(), 'clientes' ) );
//        $xmlIterator = new SimpleXMLIterator( $pedido->getProductos() );
        $metodo = 'get'.$atributo;
        $xmlObj = simplexml_load_string($cliente->$metodo());
        $array = array();
        foreach ($xmlObj->children() as $child) {
            $producto = XML::xmlToObject($child->asXML(), $clase);
            array_push($array, $producto);
        }
        $metodo = 'set'.$atributo;
        $cliente->$metodo($array);
        return $cliente;
    }
    
    static function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
        $toDom = dom_import_simplexml($to);
        $fromDom = dom_import_simplexml($from);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
    }

    /**
     * Genera un documento XML del producto buscado segun el id_cliente.
     * @param int $codigo
     * @param String $ruta
     * @return boolean
     */
    static public function generarXML($codigo, $ruta = '') {
        //$codigo = 10012;;
        if (!$clientes = ProductosCtrl::buscarClientes($codigo)) {
            echo 'PRODUCTO NO ENCONTRADO.';
            return false;
        }
        require_once BASE_URI."librerias/xml_class.php";
        $clienteXML = new Xml($clientes[0]);
        $clienteXML->saveToFile($ruta . "cliente$codigo.xml");
    }
    
    /**
     * Funcion estatica para ser implementada por la vista de productos
     * al momento de buscar el precio correspondiente al cliente.
     * @param string $id_cliente
     */
    static public function precioCliente($id_cliente) {
        $clientes = self::buscarClientes($id_cliente);
        if (count($clientes) > 0) {
            $cliente = $clientes[0];
            $descuento = $cliente->getDescuento();
            return $descuento;
        }
        else {
            return false;
        }
    }

    /**
     * Regresa los valores de la comision por pago con TDC segun se definen
     * en el archivo globales.xml
     * @param string $id_cliente
     */
    static public function precioTDC($id_cliente) {
        $clientes = self::buscarClientes($id_cliente);
        if (count($clientes) > 0) {
            $cliente = $clientes[0];
            $descuento = $cliente->getDescuento();
            $ruta = "default";
            if ($descuento > 0)
                $ruta = "mayoreo";
            if ($descuento == 0)
                $ruta = "menudeo";
            $xml = simplexml_load_file(BASE_URI."xml/globales.xml");
            $valores = array();
            $valores['propocional'] = (string) $xml->sobreprecios->$ruta->propocional;
            $valores['aditivo'] = (string) $xml->sobreprecios->$ruta->aditivo;
            $valores['promociones'] = (string) $xml->sobreprecios->$ruta->promociones;
            $valores['valor_promociones'] = (string) $xml->sobreprecios->$ruta->valor_promociones;
            return $valores;
        }
        else {
            return false;
        }
    }

}

