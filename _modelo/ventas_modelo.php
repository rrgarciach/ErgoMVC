<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 10-October-2013
 * */
require_once BASE_URI . "_modelo/pedidos_class.php";

class Ventas extends Pedidos {

    // TODO
    protected $elemento = 'venta';
    private $id_venta = 0;
//    private $id_cliente = "";
//    private $direccion_envio = array();
//    private $renglones = array();
//    private $id_vendedor = "";
//    private $fecha = "";
//    private $estatus = "NA";
//    private $estatus_cobranza = "NA";
//    private $saldo = 0;
//    private $metodo_pago = "NA";
//    private $referencia_pago = "NA";
//    private $notas = "";

    public function __construct() {
        parent::__construct();
    }

    // Funciones setters y getters:
    public function setId_venta($value) {
        $this->id_venta = $value;
    }

    public function getId_venta() {
        return $this->id_venta;
    }

//    public function setId_cliente($value) {
//        $this->id_cliente = $value;
//    }
//
//    public function getId_cliente() {
//        return $this->id_cliente;
//    }
//
//    public function setDireccion_envio($value) {
//        $this->direccion_envio = $value;
//    }
//
//    public function getDireccion_envio() {
//        return $this->direccion_envio;
//    }
//
//    public function setRenglones($value) {
//        $this->renglones = $value;
//    }
//
//    public function getRenglones() {
//        return $this->renglones;
//    }
//
//    public function setId_vendedor($value) {
//        $this->id_vendedor = $value;
//    }
//
//    public function getId_vendedor() {
//        return $this->id_vendedor;
//    }
//
//    public function setFecha($value) {
//        $this->fecha = $value;
//    }
//
//    public function getFecha() {
//        return $this->fecha;
//    }
//
//    public function setEstatus($value) {
//        $this->estatus = $value;
//    }
//
//    public function getEstatus() {
//        return $this->estatus;
//    }
//
//    public function getEstatus_cobranza() {
//        return $this->estatus_cobranza;
//    }
//
//    public function setEstatus_cobranza($estatus_cobranza) {
//        $this->estatus_cobranza = $estatus_cobranza;
//    }
//
//    public function getSaldo() {
//        return $this->saldo;
//    }
//
//    public function setSaldo($saldo) {
//        $this->saldo = $saldo;
//    }
//
//    public function getMetodo_pago() {
//        return $this->metodo_pago;
//    }
//
//    public function setMetodo_pago($metodo_pago) {
//        $this->metodo_pago = $metodo_pago;
//    }
//
//    public function getReferencia_pago() {
//        return $this->referencia_pago;
//    }
//
//    public function setReferencia_pago($referencia_pago) {
//        $this->referencia_pago = $referencia_pago;
//    }
//
//    public function setNotas($value) {
//        $this->notas = $value;
//    }
//
//    public function getNotas() {
//        return $this->notas;
//    }

    /**
     * Regresa los valores del objeto en un arreglo.
     * @return array
     */
    public function toArray() {
        $toArray = array();
        $toArray['key'] = 'id_venta';
        $toArray['elemento'] = $this->elemento;
        $toArray['Id_venta'] = $this->id_venta;
        $toArray['Id_cliente'] = $this->id_cliente;
        $toArray['Direccion_envio'] = $this->direccion_envio;
        $toArray['Renglones'] = $this->renglones;
        $toArray['Id_vendedor'] = $this->id_vendedor;
        $toArray['Fecha'] = $this->fecha;
        $toArray['Estatus'] = $this->estatus;
        $toArray['Estatus_cobranza'] = $this->estatus_cobranza;
        $toArray['Saldo'] = $this->saldo;
        $toArray['Metodo_pago'] = $this->metodo_pago;
        $toArray['Referencia_pago'] = $this->referencia_pago;
        $toArray['Notas'] = $this->notas;
        return $toArray;
    }

}

/*
MySQL query:

CREATE TABLE  `gcdbmaster`.`ventas` (
`id_venta` INT( 4 ) NOT NULL AUTO_INCREMENT ,
`id_cliente` VARCHAR( 8 ) NOT NULL ,
`direccion_envio` TEXT NOT NULL COMMENT  'datos XML',
`renglones` TEXT NOT NULL COMMENT  'datos XML',
`id_vendedor` INT( 4 ) NOT NULL ,
`fecha` DATE NOT NULL ,
`estatus` VARCHAR( 16 ) NOT NULL DEFAULT  'NA',
`estatus_cobranza` VARCHAR( 32 ) NOT NULL DEFAULT  'NA',
`saldo` FLOAT( 8 ) NOT NULL ,
`metodo_pago` VARCHAR( 16 ) NOT NULL DEFAULT  'NA',
`referencia_pago` VARCHAR( 16 ) NULL ,
`notas` VARCHAR( 1024 ) NOT NULL ,
`timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (  `id_venta` ) ,
INDEX (  `id_venta` )
) ENGINE = MYISAM
 */