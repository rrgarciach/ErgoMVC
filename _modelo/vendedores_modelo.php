<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 14-August-2013
**/
require_once "_modelo/_modelo_class.php";

class Vendedores extends Modelo {
    // TODO
    private $elemento = 'vendedor';
    private $id_vendedor = "";
    private $id_usuario = "";
    private $nombre = "";
    private $apellido_p = "";
    private $apellido_m = "";
    private $rfc = "";
//    private $calle = "";
//    private $numero = "";
//    private $colonia = "";
//    private $cp = "";
//    private $estado = "";
//    private $localidad = "";
    private $telefono1 = "";
    private $telefono2 = "";
    private $email1 = "";
    private $email2 = "";
    private $id_zona = "";
    private $comision = "";

    // Funciones setters y getters:
    public function setId_vendedor($value) {
        $this->id_vendedor = $value;
    }

    public function getId_vendedor() {
        return $this->id_vendedor;
    }

    public function setId_usuario($value) {
        $this->id_usuario = $value;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setNombre($value) {
        $this->nombre = $value;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setApellido_p($value) {
        $this->apellido_p = $value;
    }

    public function getApellido_p() {
        return $this->apellido_p;
    }

    public function setApellido_m($value) {
        $this->apellido_m = $value;
    }

    public function getApellido_m() {
        return $this->apellido_m;
    }

    public function setRfc($value) {
        $this->rfc = $value;
    }

    public function getRfc() {
        return $this->rfc;
    }

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
//    public function setEstado($value) {
//        $this->estado = $value;
//    }
//
//    public function getEstado() {
//        return $this->estado;
//    }
//
//    public function setLocalidad($value) {
//        $this->localidad = $value;
//    }
//
//    public function getLocalidad() {
//        return $this->localidad;
//    }

    public function setTelefono1($value) {
        $this->telefono1 = $value;
    }
    public function getTelefono1() {
        return $this->telefono1;
    }
    
    public function setTelefono2($value) {
        $this->telefono2 = $value;
    }
    public function getTelefono2() {
        return $this->telefono2;
    }

    public function setEmail1($value) {
        $this->email1 = $value;
    }
    public function getEmail1() {
        return $this->email1;
    }
    
    public function setEmail2($value) {
        $this->email2 = $value;
    }
    public function getEmail2() {
        return $this->email2;
    }

    public function setId_zona($value) {
        $this->id_zona = $value;
    }

    public function getId_zona() {
        return $this->id_zona;
    }

    public function setComision($value) {
        $this->comision = $value;
    }

    public function getComision() {
        return $this->comision;
    }


    /**
    * Regresa los valores del objeto en un arreglo.
    * @return array
    */ 
    public function toArray() {
        $toArray = array();
        $toArray['key'] = 'id_vendedor';
        $toArray['elemento'] = $this->elemento;
        $toArray['Id_vendedor'] = $this->id_vendedor;
	$toArray['Id_usuario'] = $this->id_usuario;
	$toArray['Nombre'] = $this->nombre;
	$toArray['Apellido_p'] = $this->apellido_p;
	$toArray['Apellido_m'] = $this->apellido_m;
	$toArray['Rfc'] = $this->rfc;
//	$toArray['Calle'] = $this->calle;
//	$toArray['Numero'] = $this->numero;
//	$toArray['Colonia'] = $this->colonia;
//	$toArray['Cp'] = $this->cp;
//	$toArray['Estado'] = $this->estado;
//	$toArray['Localidad'] = $this->localidad;
	$toArray['Telefono1'] = $this->telefono;
	$toArray['Telefono2'] = $this->telefono;
	$toArray['Email1'] = $this->email;
	$toArray['Email2'] = $this->email;
	$toArray['Id_zona'] = $this->id_zona;
	$toArray['Comision'] = $this->comision;
	
        return $toArray;
    }
     
        
}

/*
MySQL query:

CREATE TABLE  `gcdbmaster`.`vendedores` (
`id_vendedor` INT( 4 ) NOT NULL ,
`id_usuario` VARCHAR( 16 ) NOT NULL ,
`nombre` VARCHAR( 32 ) NOT NULL ,
`apellido_p` VARCHAR( 16 ) NOT NULL ,
`apellido_m` VARCHAR( 16 ) NOT NULL ,
`rfc` VARCHAR( 16 ) NOT NULL DEFAULT  'XAXX010101000',
`direccion` TEXT NOT NULL COMMENT  'datos XML',
`telefono1` VARCHAR( 16 ) NOT NULL ,
`telefono2` VARCHAR( 16 ) NOT NULL ,
`email1` VARCHAR( 32 ) NOT NULL ,
`email2` VARCHAR( 32 ) NOT NULL ,
`id_zona` INT( 4 ) NOT NULL ,
`comision` FLOAT NOT NULL ,
`timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
INDEX (  `id_vendedor` )
) ENGINE = MYISAM
 */