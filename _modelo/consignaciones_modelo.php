<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 10-October-2013
 * */
//require_once BASE_URI . "_modelo/_modelo_class.php";
require_once BASE_URI . "_modelo/pedidos_modelo.php";

class Consignaciones extends Modelo {

    // TODO
    protected $elemento = 'consignacion';
    private $id_consignacion = 0;
    private $id_cliente = "";
    private $renglones = array();
    private $fecha = "";
    private $estatus = "NA";
    private $notas = "";

    public function __construct() {
        
    }

    // Funciones setters y getters:
    public function setId_consignacion($value) {
        $this->id_consignacion = $value;
    }
    public function getId_consignacion() {
        return $this->id_consignacion;
    }

    public function setId_cliente($value) {
        $this->id_cliente = $value;
    }
    public function getId_cliente() {
        return $this->id_cliente;
    }

    public function setRenglones($value) {
        $this->renglones = $value;
    }
    public function getRenglones() {
        return $this->renglones;
    }

    public function setFecha($value) {
        $this->fecha = $value;
    }
    public function getFecha() {
        return $this->fecha;
    }

    public function setEstatus($value) {
        $this->estatus = $value;
    }
    public function getEstatus() {
        return $this->estatus;
    }
    
    public function setNotas($value) {
        $this->notas = $value;
    }

    public function getNotas() {
        return $this->notas;
    }

    /**
     * Regresa los valores del objeto en un arreglo.
     * @return array
     */
    public function toArray() {
        $toArray = array();
        $toArray['key'] = 'id_consignacion';
        $toArray['elemento'] = $this->elemento;
        $toArray['Id_consignacion'] = $this->id_consignacion;
        $toArray['Id_cliente'] = $this->id_cliente;
        $toArray['Renglones'] = $this->renglones;
        $toArray['Fecha'] = $this->fecha;
        $toArray['Estatus'] = $this->estatus;
        $toArray['Notas'] = $this->notas;
        return $toArray;
    }

}

/**
 * Query oara crear la tabla:
 * SQL SERVER QUERY: CREATE TABLE pedidos (id_pedido int IDENTITY(1,1)  PRIMARY KEY NOT NULL , cliente varchar  (8)  NOT NULL , direcciones xml NOT NULL, renglones xml    NOT NULL , vendedor varchar  (8)  NOT NULL , fecha datetime    NOT NULL , estatus varchar (16), notas nvarchar  (1024)   NOT NULL , timestamp timestamp)
**/

/*
MySQL query:

CREATE TABLE  `gcdbmaster`.`consignaciones` (
`id_consignacion` INT( 4 ) NOT NULL ,
`id_cliente` VARCHAR( 8 ) NOT NULL ,
`renglones` TEXT NOT NULL COMMENT  'datos XML',
`fecha` VARCHAR( 8 ) NOT NULL ,
`estatus` VARCHAR( 16 ) NOT NULL DEFAULT  'NA',
`notas` VARCHAR( 1024 ) NULL ,
`timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
UNIQUE (
`id_consignacion`
)
) ENGINE = MYISAM
 */