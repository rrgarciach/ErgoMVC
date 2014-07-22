<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 06-August-2013
**/
require_once BASE_URI . "_modelo/_modelo_class.php";

class Promociones extends Modelo {
    // TODO 
    private $elemento = 'promocion';
    private $id_promocion = "";
    private $id_producto = "";
    private $descuento = "";
    private $vigencia_del = "";
    private $vigencia_al = "";

    // Funciones setters y getters:
    public function setId_promocion($value) {
            $this->id_promocion = $value;
    }
    public function getId_promocion() {
            return $this->id_promocion;
    }
    public function setId_Producto($value) {
            $this->id_producto = $value;
    }
    public function getId_Producto() {
            return $this->id_producto;
    }
    public function setDescuento($value) {
            $this->descuento = $value;
    }
    public function getDescuento() {
            return $this->descuento;
    }
    public function setVigencia_del($value) {
            $this->vigencia_del = $value;
    }
    public function getVigencia_del() {
            return $this->vigencia_del;
    }
    public function setVigencia_al($value) {
            $this->vigencia_al = $value;
    }
    public function getVigencia_al() {
            return $this->vigencia_al;
    }
    
    /**
    * Regresa los valores del objeto en un arreglo.
    * @return array
    */ 
    public function toArray() {
        $toArray = array();
        $toArray['key'] = $key;
        $toArray['elemento'] = $this->elemento;
        $toArray['id_promocion'] = $this->id_promocion;
        $toArray['id_producto'] = $this->id_producto;
        $toArray['descuento'] = $this->descuento;
        $toArray['vigencia_del'] = $this->vigencia_del;
        $toArray['vigencia_al'] = $this->vigencia_al;
        return $toArray;
    }

}
