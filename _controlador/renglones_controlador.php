<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 28-September-2013
 * */
require_once BASE_URI . "_controlador/_controlador_class.php";

class RenglonesCtrl extends Controlador {
    // TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de Objetos
     */
//    static public function buscarRenglon($renglon) {
//        extract($_REQUEST);
//        require_once '_modelo/renglones_modelo.php';
//        $renglon = new Renglones($id_producto, $cantidad, $precio, $descuento, $estatus);
//        return $renglon;
//    }

    /**
     * Recibe como parametro un objeto instancia de Productos para generar el renglon a partir de este.
     * @param objeto $producto Productos
     * @return $renglon
     */
    static public function generarRenglon($id_producto, $cantidad = 0, $precio = 0, $descuento_cliente = 0, $descuento_adicional = 0, $estatus = 0) {
//        extract($_REQUEST);
        require_once BASE_URI . '_modelo/renglones_modelo.php';
        $renglon = new Renglones($id_producto, $cantidad, $precio, $descuento_cliente, $descuento_adicional, $estatus);
        if ($renglon) return $renglon;
    }

    /**
     * Recibe como parametro un objeto carrito y, en caso de existir, lo modifica en la base de datos.
     * @param objeto $carrito
     * @return boolean
     */
    static public function editarRenglon($cantidad, $precio, $descuento_cliente, $descuento_adicional, $estatus) {
        require_once BASE_URI . '_modelo/renglones_modelo.php';
        $renglon->setCantidad($cantidad);
        $renglon->setPrecio($precio);
        $renglon->setDescuento($descuento);
        $renglon->setEstatus($estatus);
    }

    /**
     * Recibe como parametro un objeto carrito y, en caso de no existir, lo elimina de la base de datos.
     * @param objeto $carrito
     * @return boolean
     */
//    static public function borrarRenglon($renglon) {
//        require_once "librerias/sqlserver_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
//        $resultado = $conn->deleteObject($renglon, 'Carritos');
//        $conn->close();
//        if (!$resultado)
//            return false;
//        return true;
//    }

    static public function recalcularPrecio($renglon) {
        require_once BASE_URI . '_controlador/productos_controlador.php';
        require_once BASE_URI . '_controlador/promociones_controlador.php';
        $id_producto = $renglon->getId_producto();
        $producto = buscarProductos($id_producto, 'id_producto');
        if (count($producto) == 0) {
            ////TRY CATCH
        }
        $precio = $producto->getPrecio();
        $promocion = PromocionesCtrl::buscarProductosEnPromocion($producto->getId_producto());
        $renglon->setPrecio($precio);
        $renglon->setPromocion($promocion);
        /** sacar el descuento aplicable en el mes
         * sin embargo, hay que implementar la manera
         * de volver opcional la aplicacion de descuento
         * y tambien ponerle un valor proporcional de descuento
         * segun cada cliente.
         * Se tiene que revizar en los objetos de sesion de usuario.
         */
        unset($producto);
    }

    static public function importe($renglon) {
        $precio = $renglon->getPrecio();
        $cantidad = $renglon->getCantidad();
        $importe = $precio * $cantidad;
        return $importe;
    }

    static public function importeIVA($renglon) {
        $lleva_iva = $renglon->getLleva_iva();
        $importeIVA = 0;
        if ($lleva_iva == 1) {
            $globalesXML = simplexml_load_file(BASE_URI . "xml/globales.xml");
            $iva = (float) $globalesXML->iva;
            $importe = self::importe($renglon);
            $importeIVA = $importe * $iva;
        }
        return $importeIVA;
    }

    static public function subtotal($renglon) {
        $importeIVA = self::importeIVA($renglon);
        $importe = self::importe($renglon);
        $subtotal = $importe + $importeIVA;
        return $subtotal;
    }

    static public function importePromocion($renglon) {
        $importe_promocion = self::subtotal($renglon) * $renglon->getPromocion();
        return $importe_promocion;
    }

    static public function importeDescuentoCliente($renglon) {
        $importe_descuento_cliente = self::subtotal($renglon) 
                                    - self::importePromocion($renglon) 
                                    * $renglon->descuento_cliente();
        return $importe_descuento_cliente;
    }

    static public function importeDescuentoAdicional($renglon) {
        $importe_descuento_adicional = self::subtotal($renglon) 
                                    - self::importePromocion($renglon) 
                                    - self::importeDescuentoCliente($renglon) 
                                    * $renglon->descuento_adicional();
        return $importe_descuento_adicional;
    }

    static public function totalDescuentos($renglon) {
        $total_descuentos = self::importePromocion($renglon) 
                            + self::importeDescuentoCliente($renglon) 
                            + self::importeDescuentoAdicional($renglon);
        return $total_descuentos;
    }

    static public function total($renglon) {
        $subtotal = self::subtotal($renglon);
        $descuentos = self::totalDescuentos($renglon);
        $total = $subtotal - $descuentos;
        return $total;
    }
    
    /**
     * 
     * @param type $renglon
     * @return array Arreglo con los valores calculados de:
     *                  -importe
     *                  -subtotal
     *                  -importe de promocion
     *                  -importe descuento de cliente
     *                  -importe descuento adicional
     *                  -total descuentos
     *                  -total
     */
    static public function arrayDetalleCalculos($renglon) {
        $calculos = array();
        $precio = $renglon->getPrecio();
        $cantidad = $renglon->getCantidad();
        $importe = $precio * $cantidad;
        $calculos['precio'] = $precio;
        $calculos['cantidad'] = $cantidad;
        $calculos['importe'] = $importe;
        $lleva_iva = $renglon->getLleva_iva();
        $importeIVA = 0;
        if ($lleva_iva == 1) {
            $globalesXML = simplexml_load_file(BASE_URI . "xml/globales.xml");
            $iva = (float) $globalesXML->iva;
            $importe = $importe;
            $importeIVA = $importe * $iva;
        }
        $calculos['iva'] = $iva;
        $calculos['importe_iva'] = $importeIVA;
        $subtotal = $importe + $importeIVA;
        $calculos['subtotal'] = $subtotal;
        $promocion = $renglon->getPromocion();
        $importe_promocion = $subtotal * $promocion;
        $calculos['promocion'] = $promocion;
        $calculos['importe_promocion'] = $importe_promocion;
        $descuento_cliente = $renglon->getDescuento_cliente();
        $importe_descuento_cliente = ($subtotal - $importe_promocion) * $descuento_cliente;
        $calculos['descuento_cliente'] = $descuento_cliente;
        $calculos['importe_descuento_cliente'] = $importe_descuento_cliente;
        $descuento_adicional = $renglon->getDescuento_adicional();
        $importe_descuento_adicional = ($subtotal - $importe_promocion - $importe_descuento_cliente) * $descuento_adicional;
        $calculos['descuento_adicional'] = $descuento_adicional;
        $calculos['importe_descuento_adicional'] = $importe_descuento_adicional;
        $total_descuentos = $importe_promocion + $importe_descuento_cliente + $importe_descuento_adicional;
        $calculos['total_descuentos'] = $total_descuentos;
        $total = $subtotal - $total_descuentos;
        $calculos['total'] = $total;
        return $calculos;
    }
    
    /**
     * 
     * @param type $ean
     * @return \Renglones
     */
    public static function capturarRenglon($valor, $campo = 'id_producto') {
        require_once BASE_URI . '_modelo/renglones_modelo.php';
        require_once BASE_URI . '_controlador/productos_controlador.php';
        $productos = ProductosCtrl::buscarProductos($valor, $campo);
        if (count($productos) == 0) return false;
        $producto = $productos[0];
        $id_producto = $producto->getId_producto();
        $precio = $producto->getPrecio();
        $renglon = new Renglones($id_producto, 0, $precio);
        return $renglon;
    }
}

// Funciones jQuery:
extract($_REQUEST);
if(!isset($f)) $f='';
switch ($f) {
    case 'capturarRenglonPorEAN':
        require_once BASE_URI . 'librerias/xml_class.php';
        require_once BASE_URI . '_controlador/productos_controlador.php';
        
        if (!isset($_SESSION)) session_start();
        
        $renglon = RenglonesCtrl::capturarRenglon($valor, $campo);
        if ($renglon == false) echo 'vacio'; 
        $xml = new Xml($renglon);
        echo $xml->getXML();
        
        break;
        
    case 'capturarRenglonPorCodigo':
        require_once BASE_URI . 'librerias/xml_class.php';
        require_once BASE_URI . '_controlador/productos_controlador.php';
        
        if (!isset($_SESSION)) session_start();
        
        $renglon = RenglonesCtrl::capturarRenglon($valor, $campo);
        if ($renglon == false) echo 'vacio'; 
        $xml = new Xml($renglon);
        echo $xml->getXML();
        
        break;
        
    case 'capturarRenglonPorClave':
        require_once BASE_URI . 'librerias/xml_class.php';
        require_once BASE_URI . '_controlador/productos_controlador.php';
        
        if (!isset($_SESSION)) session_start();
        
        $renglon = RenglonesCtrl::capturarRenglon($valor, $campo);
        if ($renglon == false) echo 'vacio'; 
        $xml = new Xml($renglon);
        echo $xml->getXML();
        
        break;
        
    default:  
        break;
}