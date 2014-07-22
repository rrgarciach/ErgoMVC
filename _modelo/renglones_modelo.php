<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 06-August-2013
 * */
require_once BASE_URI . "_modelo/productos_modelo.php";

class Renglones extends Productos {

    // TODO 
    private $elemento = 'renglon';
//    private $id_producto = "";
//    private $descripcion = "";
//    private $caja = "";
//    private $master = "";
//    private $unidad = "";
//    private $ean = "";
//    private $precio = "";
//    private $lleva_iva = "1";
//    private $imagen = "picture_not_found";
//    private $estante = "";
//    private $anaquel = "";
//    private $id_proveedor = "";
    private $cantidad = 0;
    private $descuento_cliente = 0;
    private $descuento_adicional = 0;
    private $promocion = 0;
    private $estatus = "";

    /**
     * Constructor de objeto Renglon.
     * @param String $id_producto
     * @param int $cantidad
     * @param float $precio
     * @param float $descuento_cliente Valor porcentual absoluto (ej. 25% = 0.25)
     * @param float $descuento_adicional Valor porcentual absoluto (ej. 25% = 0.25)
     * @param String $estatus
     */
    public function __construct($id_producto = 0, $cantidad = 0, $precio = 0, $descuento_cliente = 0, $descuento_adicional = 0, $estatus = 0) {
        require_once BASE_URI . '_controlador/productos_controlador.php';
        $producto = ProductosCtrl::buscarProductos($id_producto, 'id_producto');
        require_once BASE_URI . '_controlador/promociones_controlador.php';
        $promocion = PromocionesCtrl::buscarPromocionDeProducto($id_producto);
        if (count($producto) > 0) {
            $producto = $producto[0];
            parent::setId_producto($id_producto);
            parent::setClave($producto->getClave());
            parent::setDescripcion($producto->getDescripcion());
            parent::setMarca($producto->getMarca());
            parent::setUnidad($producto->getUnidad());
//            $this->ean = $producto->ean;
//            $this->ean_caja = $producto->ean_caja;
//            $this->ean_master = $producto->ean_master;
            parent::setLleva_iva($producto->getLleva_iva());
            parent::setImagen($producto->getImagen());
//            if ($precio == 'NA') $precio = $producto->getPrecio();
            parent::setPrecio($precio);
            $this->cantidad = $cantidad;
            $this->descuento_cliente = $descuento_cliente;
            $this->descuento_adicional = $descuento_adicional;
            $this->promocion = $promocion;
            $this->estatus = $estatus;
        } else {
            ////TRY CATCH
        }
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function getDescuento_cliente() {
        return $this->descuento_cliente;
    }

    public function setDescuento_cliente($descuento_cliente) {
        $this->descuento_cliente = $descuento_cliente;
    }

    public function getDescuento_adicional() {
        return $this->descuento_adicional;
    }

    public function setDescuento_adicional($descuento_adicional) {
        $this->descuento_adicional = $descuento_adicional;
    }

    public function getPromocion() {
        return $this->promocion;
    }

    public function setPromocion($promocion) {
        $this->promocion = $promocion;
    }

    public function getEstatus() {
        return $this->estatus;
    }

    public function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

    /**
      @Override
     * Regresa los valores del objeto en un arreglo.
     * @return array
     */
    public function toArray() {
        $toArray = array();
        $toArray['key'] = 'id_producto';
        $toArray['elemento'] = $this->elemento;
        $toArray['Id_producto'] = parent::getId_producto();
        $toArray['Clave'] = parent::getClave();
        $toArray['Descripcion'] = parent::getDescripcion();
        $toArray['Marca'] = parent::getMarca();
        $toArray['Unidad'] = parent::getUnidad();
//        $toArray['Ean'] = parent::getEan();
//        $toArray['Ean_caja'] = parent::getEan_caja();
//        $toArray['Ean_master'] = parent::getEan_master();
        $toArray['Precio'] = parent::getPrecio();
        $toArray['Lleva_iva'] = parent::getLleva_iva();
        $toArray['Imagen'] = parent::getImagen();
        $toArray['Cantidad'] = $this->cantidad;
        $toArray['Descuento_cliente'] = $this->descuento_cliente;
        $toArray['Descuento_adicional'] = $this->descuento_adicional;
        $toArray['Promocion'] = $this->promocion;
        $toArray['Estatus'] = $this->estatus;
        return $toArray;
    }

}
