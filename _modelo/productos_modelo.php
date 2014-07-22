<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 06-August-2013
**/
require_once BASE_URI . "/_modelo/_modelo_class.php";

class Productos extends Modelo {
    // TODO 
    private $elemento = 'producto';
    private $id_producto = "";
    private $clave = "";
    private $grupo = "";
    private $subgrupo = "";
    private $descripcion = "";
    private $marca = "";
    private $caja = "";
    private $master = "";
    private $unidad = "";
    private $ean = "";
    private $ean_caja = "";
    private $ean_master = "";
    private $precio = "";
    private $lleva_iva = "1";
    private $imagen = "picture_not_found";
    private $estante = "";
    private $anaquel = "";
    private $id_proveedor = "";
    private $estatus = "disponible";

        // Funciones setters y getters:
    public function setId_producto($value) {
            $this->id_producto = $value;
    }
    public function getId_producto() {
            return $this->id_producto;
    }
    
    public function getClave() {
        return $this->clave;
    }
    public function setClave($clave) {
        $this->clave = $clave;
    }
    
    public function getGrupo() {
        return $this->grupo;
    }
    public function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    public function getSubgrupo() {
        return $this->subgrupo;
    }
    public function setSubgrupo($subgrupo) {
        $this->subgrupo = $subgrupo;
    }
    
    public function getMarca() {
        return $this->marca;
    }
    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function setDescripcion($value) {
            $this->descripcion = $value;
    }
    public function getDescripcion() {
            return $this->descripcion;
    }

    public function setCaja($value) {
            $this->caja = $value;
    }
    public function getCaja() {
            return $this->caja;
    }

    public function setMaster($value) {
            $this->master = $value;
    }
    public function getMaster() {
            return $this->master;
    }

    public function setUnidad($value) {
            $this->unidad = $value;
    }
    public function getUnidad() {
            return $this->unidad;
    }

    public function setEan($value) {
            $this->ean = $value;
    }
    public function getEan() {
            return $this->ean;
    }
    
    public function getEan_caja() {
        return $this->ean_caja;
    }
    public function setEan_caja($ean_caja) {
        $this->ean_caja = $ean_caja;
    }

    public function getEan_master() {
        return $this->ean_master;
    }
    public function setEan_master($ean_master) {
        $this->ean_master = $ean_master;
    }

    public function setPrecio($value) {
            $this->precio = $value;
    }
    public function getPrecio() {
            return $this->precio;
    }

    public function setLleva_iva($value) {
            $this->lleva_iva = $value;
    }
    public function getLleva_iva() {
            return $this->lleva_iva;
    }

    public function setImagen($value) {
            $this->imagen = $value;
    }
    public function getImagen() {
            return $this->imagen;
    }

    public function setEstante($value) {
            $this->estante = $value;
    }
    public function getEstante() {
            return $this->estante;
    }

    public function setAnaquel($value) {
            $this->anaquel = $value;
    }
    public function getAnaquel() {
            return $this->anaquel;
    }

    public function setId_proveedor($value) {
            $this->id_proveedor = $value;
    }
    public function getId_proveedor() {
            return $this->id_proveedor;
    }
    
    public function getEstatus() {
        return $this->estatus;
    }
    public function setEstatus($estatus) {
        $this->estatus = $estatus;
    }

        /**
    * Regresa los valores del objeto en un arreglo.
    * @return array
    */ 
    public function toArray() {
        $toArray = array();
        $toArray['key'] = 'id_producto';
        $toArray['elemento'] = $this->elemento;
        $toArray['Id_producto'] = $this->id_producto;
        $toArray['Clave'] = $this->clave;
        $toArray['Grupo'] = $this->grupo;
        $toArray['Subgrupo'] = $this->subgrupo;
        $toArray['Descripcion'] = $this->descripcion;
        $toArray['Marca'] = $this->marca;
        $toArray['Caja'] = $this->caja;
        $toArray['Master'] = $this->master;
        $toArray['Unidad'] = $this->unidad;
        $toArray['Ean'] = $this->ean;
        $toArray['Ean_caja'] = $this->ean_caja;
        $toArray['Ean_master'] = $this->ean_master;
        $toArray['Precio'] = $this->precio;
        $toArray['Lleva_iva'] = $this->lleva_iva;
        $toArray['Imagen'] = $this->imagen;
        $toArray['Estante'] = $this->estante;
        $toArray['Anaquel'] = $this->anaquel;
        $toArray['Id_proveedor'] = $this->id_proveedor;
        $toArray['Estatus'] = $this->estatus;
        return $toArray;
    } 

}

/*
MySQL query:

CREATE TABLE `productos` (
  `id_producto` varchar(16) NOT NULL,
  `descripcion` varchar(128) NOT NULL,
  `clave` varchar(4) NOT NULL,
  `grupo` int(4) NOT NULL,
  `subgrupo` int(4) NOT NULL,
  `marca` varchar(16) NOT NULL,
  `caja` int(4) NOT NULL,
  `master` int(4) NOT NULL,
  `ean` varchar(16) default '0',
  `ean_caja` varchar(16) default '0',
  `ean_master` varchar(16) default '0',
  `precio` float NOT NULL,
  `lleva_iva` int(1) NOT NULL default '1',
  `imagen` varchar(32) NOT NULL default 'picture_not_found',
  `estante` varchar(4) default NULL,
  `anaquel` varchar(4) default NULL,
  `id_proveedor` int(4) default NULL,
  `estatus` varchar(16) NOT NULL default 'disponible',
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  KEY `id_producto` (`id_producto`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 */
