<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 31-August-2013
**/
require_once "_modelo/_modelo_class.php";

class Sesiones extends Modelo {
    // TODO
    private $elemento = 'sesion';
    private $id_usuario = array();
    private $tipo = "";
    private $log = "";

    // Funciones setters y getters:
    public function setId_usuario($value) {
        $this->id_usuario = $value;
    }
    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setTipo($value) {
        $this->tipo = $value;
    }
    public function getTipo() {
        return $this->tipo;
    }

    public function setLog($value) {
        $this->log = $value;
    }
    public function getLog() {
        return $this->log;
    }
    
    public function addLog($value) {
        $this->log = $this->log . $value;
    }

    /**
    * Regresa los valores del objeto en un arreglo.
    * @return array
    */ 
    public function toArray() {
        $toArray = array();
        $toArray['key'] = 'id_usuario';
        $toArray['elemento'] = $this->elemento;
        $toArray['Id_usuario'] = $this->id_usuario;
	$toArray['Tipo'] = $this->tipo;
	$toArray['Log'] = $this->log;
	
        return $toArray;
    }
     
        
}

/*
MySQL query:

CREATE TABLE  `gcdbmaster`.`sesiones` (
`id_usuario` VARCHAR( 8 ) NOT NULL ,
`tipo` VARCHAR( 16 ) NOT NULL ,
`log` TEXT NOT NULL ,
`timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
INDEX (  `id_usuario` )
) ENGINE = MYISAM
 */