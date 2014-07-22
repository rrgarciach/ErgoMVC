<?php
//require_once "_addresses.php";
if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/**
 * Clase para DBMS con MySQL
 */
require_once BASE_URI."/librerias/sql_class.php";

class MySQL extends sql_class {

    private $server;
    private $user;
    private $password;
    private $connection;
    private $database;

    function __construct( $database, $userType ) {
        switch ($userType) {

            /* Privilegios para lectura y escritura */
            case 'w':
                $this->server       = "";
                $this->user         = "";
                $this->password     = "";
                $this->database     = $database;
                break;

            /* Privilegios sólo para lectura */
            case 'r':
                $this->server       = "";
                $this->user         = "";
                $this->password     = "";
                $this->database     = $database;
                break;
        }
        $this->connect();
    }

    function connect() {
        $this->connection   = mysql_connect($this->server, $this->user, $this->password) or die('Could not connect: ' . mysql_error());
        $dataBaseConn = mysql_select_db($this->database, $this->connection);
        if (!$dataBaseConn) {
            return false;
        }
        else {
            return true;
        }
    }

    function close() {
    	mysql_close($this->connection);
        unset($this->connection);
    }

    function query($query) {
        $result = mysql_query($this->connection, $query);
        if (!$result) return false;
        $rows = array();
        while ($row = mysql_fetch_array($result)) {
            array_push($rows, $row);
        }
        return $rows;
    }

    /**
     * Ejecuta el query y recibe cada registro como un objeto.
     * @param string $query El query a buscar.
     * @param string $class La clase de la que heredara el objeto a generar.
     * @param string $params Parametros para el contructor (default = null).
     * @param int $limit Limite para el query (default = 0).
     * @return boolean|array Regresa un array con los objetos generados o false si no se han encontrado registros.
     */
    function selectToObject($query, $class, $params = "", $limit = 0) {
        $result = mysql_query($query, $this->connection);
        if (!$result) return false;
        $rows = array();
        require_once BASE_URI.'_modelo/'.strtolower($class).'_modelo.php';
        while ($row = mysql_fetch_object($result, $class)) {
            array_push($rows, $row);
        }
        return $rows;
    }
    
    /**
     * 
     * @param Modelo $object Objeto a insertar en la tabla.
     * @param string $class La clase de la que heredara el objeto a generar.
     * @return boolean|array Regresa un array con los objetos encontrados o false si no se han encontrado registros.
     */
    function searchObject($object, $class, $from = "", $to = "") {
        if (!$object instanceof Modelo) return false;
        $objectArray = $object->toArray();
        $key = $objectArray['key'];
        $pagination = "";
        if ($from != "") {
            $pagination = "LIMIT ".$from;
            if ($to != "") $pagination .= ", ".$to;
        }
        $query = "SELECT * FROM ".strtolower($class)." WHERE $key='".$objectArray[$key]."' $pagination";
        $result = mysql_query($query, $this->connection);
        if (!$result) return false;
        $rows = array();
        echo $query;
        require_once BASE_URI.'_modelo/'.strtolower($class).'_modelo.php';
        while ($row = mysql_fetch_object($result, $class)) {
            array_push($rows, $row);
        }
        return $rows;
    }
    
    /**
     * @param objeto $object Objeto a insertar en la tabla.
     * @param clase $limit Clase y/o nombre de la tabla.
     * @return boolean Regresa true si el query se ejecuto correctamente.
     */
    function insertObject($object, $class) {
        if (!$object instanceof Modelo) return false;
        if ( $this->searchObject($object, $class) ) return false;
        $objectArray = $object->toArray();
        $key = $objectArray['key'];
        $columns = "";
        $values = "";
        foreach ($objectArray as $nombre => $valor) {
            if ($nombre=='key') continue;
            if ($nombre=='id_index') continue;
            if ($nombre=='elemento') continue;
            $columns .= "".strtolower($nombre).", ";
            if (is_array($valor)) {
                require_once BASE_URI.'librerias/xml_class.php';
                $string = '';
                foreach ($valor as $elemento) {
                    $e = new Xml($elemento);
                    $string .= htmlspecialchars_decode((string) $e->getXML());
                }
                $values .= "'".$string."', ";
            } else {
                $values .= "'".$valor."', ";
            }
        }
        $columnas = substr($columns, 0, -2);
        $valores = substr($values, 0, -2);
        $query = "INSERT INTO ".strtolower($class)." ($columnas) VALUES ($valores)";
        echo $query;
        $result = mysql_query($query, $this->connection);
        if (!$result) return false; //echo 'NO HAY RESPUESTA';
        return true;
    }
    
    /**
     * @param Modelo $object Objeto a actualizar en la tabla.
     * @param string $class Clase y/o nombre de la tabla.
     * @return boolean Regresa true si el query se ejecuto correctamente.
     */
    function updateObject($object, $class) {
        if (!$object instanceof Modelo) return false;
        if (! $this->searchObject($object, $class) ) return false;
        //require_once '_modelo/'.strtolower($class).'_modelo.php';
        $objectArray = $object->toArray();
        $key = $objectArray['key'];
        $params = "";
        foreach ($objectArray as $nombre => $valor) {
            if ($nombre=='key') continue;
//            if ($nombre==$key) continue;
            if ($nombre=='id_index') continue;
            if ($nombre=='elemento') continue;
            $params .= strtolower($nombre)." = '".$valor."', ";
        }
        $parameters = substr($params, 0, -2);
        $query = "UPDATE ".strtolower($class)." SET $parameters WHERE $key='".$objectArray[$key]."'";
        echo $query;
        $result = mysql_query($query, $this->connection);
        if (!$result) return false;
        return true;
    }
    
    /**
     * @param Modelo $object Objeto a eliminar en la tabla.
     * @param string $class Clase y/o nombre de la tabla.
     * @return boolean Regresa true si el query se ejecuto correctamente.
     */
    function deleteObject($object, $class) {
        if (!$object instanceof Modelo) return false;
        if (! $this->searchObject($object, $class) ) return false;
        $objectArray = $object->toArray();
        $key = ucwords($objectArray['key']);
        $query = "DELETE FROM ".strtolower($class)." WHERE $key='".$objectArray[$key]."'";
        echo $query;
        $result = mysql_query($query, $this->connection);
        if (!$result) return false;
        return true;
    }

}

?>