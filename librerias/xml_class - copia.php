<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of xml
 *
 * @author Ruy
 */
class Xml {
    private $xml;
    
    /**
     * 
     * @param Modelo $object Objeto a convertir.
     * @return boolean Regresa el resultado de si se generó exitosamente.
     */
    public function __construct($object) {
        $content = new SimpleXMLElement('<producto/>');
        if ( !$object instanceof Modelo) return false;
        $array = $object->toArray();
        //$content->addAttribute('encoding', 'UTF-8', 'xml');
        foreach ($array as $key => $value) {
            $content->addChild( $key, $value);
        }
        $this->xml = $content->asXML();
        return true;
    }
    
    /**
     * 
     * @return objeto xml
     */
    public function getXML() {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->preserveWhiteSpace = false;
        //$dom->loadXML($this->xml);
        $dom->formatOutput = true;
        return $dom->saveXML();
    }
    
    /**
     * 
     * @param string $name Nombre del archivo.
     * @param string $url Ruta del archivo (direccion actual por default).
     */
    public function getFile($name, $url='') {
        $modeloFile = fopen($url.$name.".xml", "w");
        fwrite($modeloFile, $this->getXML());
        fclose($modeloFile);
    }
}

?>
