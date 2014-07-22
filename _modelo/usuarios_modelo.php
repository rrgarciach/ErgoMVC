<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 08-August-2013
**/
require_once "_modelo/_modelo_class.php";

class Usuarios extends Modelo {
    // TODO
    private $elemento = 'usuario';
    private $id_usuario = "";
    private $clave = "";
    private $tipo = "";
    private $email = "";
    private $pregunta = "";
    private $respuesta = "";

    // Funciones setters y getters:
    public function setId_usuario($value) {
        $this->id_usuario = $value;
    }

    public function getId_usuario() {
        return $this->id_usuario;
    }

    public function setClave($value) {
        $this->clave = $value;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setTipo($value) {
        $this->tipo = $value;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPregunta($value) {
        $this->pregunta = $value;
    }

    public function getPregunta() {
        return $this->pregunta;
    }

    public function setRespuesta($value) {
        $this->respuesta = $value;
    }

    public function getRespuesta() {
        return $this->respuesta;
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
	$toArray['Clave'] = $this->clave;
	$toArray['Tipo'] = $this->tipo;
	$toArray['Email'] = $this->email;
	$toArray['Pregunta'] = $this->pregunta;
	$toArray['Respuesta'] = $this->respuesta;
	
        return $toArray;
    }
     
        
}

/*
MySQL query:

CREATE TABLE  `gcdbmaster`.`usuarios` (
`id_usuario` VARCHAR( 8 ) NOT NULL ,
`clave` VARCHAR( 16 ) NOT NULL ,
`tipo` VARCHAR( 16 ) NOT NULL ,
`email` VARCHAR( 32 ) NOT NULL ,
`pregunta` VARCHAR( 32 ) NOT NULL ,
`respuesta` VARCHAR( 32 ) NOT NULL ,
`timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
INDEX (  `id_usuario` )
) ENGINE = MYISAM
 */