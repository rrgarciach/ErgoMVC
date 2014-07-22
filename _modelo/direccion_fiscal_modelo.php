<?php
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 28-August-2013
 * */
require_once BASE_URI . "_modelo/direcciones_modelo.php";

class Direccion_fiscal extends Direcciones {

//    // TODO
    protected $elemento = 'direccion';
//    private $id_direccion = 0;
//    private $calle = "";
//    private $numero = "";
//    private $colonia = "";
//    private $cp = 0;
//    private $localidad = "";
//    private $ciudad = "";
//    private $estado = "";
//    private $x = 0;
//    private $y = 0;

    public function __construct() {
        parent::__construct();
//        $this->elemento = 'direccion_fiscal';
    }
//    // Funciones setters y getters:
//    public function setId_direccion($value) {
//        $this->id_direccion = $value;
//    }
//
//    public function getId_direccion() {
//        return $this->id_direccion;
//    }
//
//    public function setCalle($value) {
//        $this->calle = $value;
//    }
//
//    public function getCalle() {
//        return $this->calle;
//    }
//
//    public function setNumero($value) {
//        $this->numero = $value;
//    }
//
//    public function getNumero() {
//        return $this->numero;
//    }
//
//    public function setColonia($value) {
//        $this->colonia = $value;
//    }
//
//    public function getColonia() {
//        return $this->colonia;
//    }
//
//    public function setCp($value) {
//        $this->cp = $value;
//    }
//
//    public function getCp() {
//        return $this->cp;
//    }
//
//    public function setLocalidad($value) {
//        $this->localidad = $value;
//    }
//
//    public function getLocalidad() {
//        return $this->localidad;
//    }
//
//    public function setCiudad($value) {
//        $this->ciudad = $value;
//    }
//
//    public function getCiudad() {
//        return $this->ciudad;
//    }
//
//    public function setEstado($value) {
//        $this->estado = $value;
//    }
//
//    public function getEstado() {
//        return $this->estado;
//    }
//
//    public function setX($value) {
//        $this->x = $value;
//    }
//
//    public function getX() {
//        return $this->x;
//    }
//
//    public function setY($value) {
//        $this->y = $value;
//    }
//
//    public function getY() {
//        return $this->y;
//    }
//
//
//    /**
//    * Regresa los valores del objeto en un arreglo.
//    * @return array
//    */ 
//    public function toArray() {
//        $toArray = array();
//        $toArray['key'] = 'id_direccion';
//        $toArray['elemento'] = 'direccion_envio';
//        $toArray['Id_direccion'] = $this->id_direccion;
//	$toArray['Calle'] = $this->calle;
//	$toArray['Numero'] = $this->numero;
//	$toArray['Colonia'] = $this->colonia;
//	$toArray['Cp'] = $this->cp;
//	$toArray['Localidad'] = $this->localidad;
//	$toArray['Ciudad'] = $this->ciudad;
//	$toArray['Estado'] = $this->estado;
//	$toArray['X'] = $this->x;
//	$toArray['Y'] = $this->y;
//	
//        return $toArray;
//    }    
//        
}

/**
 * Query oara crear la tabla:
 * SQL SERVER QUERY: CREATE TABLE direcciones (id_direccion int IDENTITY(1,1)  PRIMARY KEY NOT NULL , calle nvarchar  (64)  NOT NULL , numero varchar  (8)  NOT NULL , colonia nvarchar  (16)  NOT NULL , cp int    NOT NULL , localidad nvarchar  (32)  NULL , ciudad nvarchar  (32)  NOT NULL , estado nvarchar  (16)  NOT NULL , x float    NOT NULL , y float    NOT NULL , timestamp timestamp)
**/