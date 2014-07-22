<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
* Fecha de creacion: 08-August-2013
**/
require_once BASE_URI."_controlador/_controlador_class.php";
        
class UsuariosCtrl extends Controlador {
    // TODO
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array
     */
    static public function buscarUsuarios($valor, $campo) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $valor = $conn->filterQueryInput($valor);
         $query = "SELECT * FROM usuarios WHERE $campo='$valor'";
         $usuarios = $conn->selectToObject($query, 'Usuarios');
         $conn->close();
         return $usuarios;
     }
     /**
     * Agrega un nuevo elemento a la base de datos.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array
     */  
     static public function agregarUsuarios($valor, $campo) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//         $conn = new SQLServer('gcmaster', 'w');
         $conn = new MySQL('gcdbmaster', 'w');
         $query = "SELECT * FROM usuarios WHERE $campo='$valor'";
         $usuarios = $conn->insertObject($query, 'Usuarios');
         $conn->close();
         return $usuarios;
     }
     
     /**
      * Edita un usuario en la base de datos.
      * @param objeto Usuario $usuario
      * @return boolean
      */
     static public function actualizarUsuarios($usuario) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->updateObject($usuario, 'Usuario');
        $conn->close();
        if (!$resultado) return false;
        return true;
    }
}
        