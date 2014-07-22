<?php
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 06-August-2013
**/
require_once "_modelo/modelo_class.php";

class Posts extends Modelo {
    // TODO 
    private $elemento = 'post';
    private $id_post = "";
    private $titulo = "";
    private $subtitulo = "";
    private $texto = "";
    private $autor = "";
    private $fecha = "";
    private $imagen = "post_default";

    // Funciones setters y getters:
    public function setId_post($value) {
            $this->id_post = $value;
    }
    public function getId_post() {
            return $this->id_post;
    }

    public function setTitulo($value) {
            $this->titulo = $value;
    }
    public function getTitulo() {
            return $this->titulo;
    }

    public function setSubtitulo($value) {
            $this->subtitulo = $value;
    }
    public function getSubtitulo() {
            return $this->subtitulo;
    }

    public function setTexto($value) {
            $this->texto = $value;
    }
    public function getTexto() {
            return $this->texto;
    }

    public function setAutor($value) {
            $this->autor = $value;
    }
    public function getAutor() {
            return $this->autor;
    }

    public function setFecha($value) {
            $this->fecha = $value;
    }
    public function getFecha() {
            return $this->fecha;
    }

    public function setImagen($value) {
            $this->imagen = $value;
    }
    public function getImagen() {
            return $this->imagen;
    }

    /**
    * Regresa los valores del objeto en un arreglo.
    * @return array
    */ 
    public function toArray() {
    $toArray = array();
    $toArray['key'] = $key;
    $toArray['elemento'] = $this->elemento;
    $toArray['id_post'] = $this->id_post;
    $toArray['titulo'] = $this->titulo;
    $toArray['subtitulo'] = $this->subtitulo;
    $toArray['texto'] = $this->texto;
    $toArray['autor'] = $this->autor;
    $toArray['fecha'] = $this->fecha;
    $toArray['image'] = $this->image;
    return $toArray;
}

}

/*
MySQL query:

CREATE TABLE  `gcdbmaster`.`posts` (
 `id_post` INT( 4 ) NOT NULL AUTO_INCREMENT ,
 `titulo` VARCHAR( 64 ) NOT NULL ,
 `subtitulo` VARCHAR( 128 ) NULL ,
 `texto` VARCHAR( 1024 ) NOT NULL ,
 `autor` VARCHAR( 16 ) NOT NULL ,
 `fecha` DATE NOT NULL ,
 `imagen` VARCHAR( 32 ) NULL DEFAULT  'post_default',
 `timestamp` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (  `id_post` ) ,
INDEX (  `id_post` )
) ENGINE = MYISAM
 */