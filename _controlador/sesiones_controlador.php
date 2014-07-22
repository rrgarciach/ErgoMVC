<?php
require_once "_addresses.php";
//if(!defined('BASE')) define('BASE', str_replace($_SERVER['SERVER_NAME'], '', $_SERVER['DOCUMENT_ROOT'])); // The Base Root Directory Name
//if(!defined('BASE_URI')) define('BASE_URI', $_SERVER['DOCUMENT_ROOT'] . '/'); // The HTML Directory Name
//if(!defined('BASE_URL')) define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/'); // Your Website's Full URL Address
/** Archivo generado automaticamente por la clase generadorMVC.php
 * Fecha de creacion: 31-August-2013
 * */
require_once BASE_URI."_controlador/_controlador_class.php";

class SesionesCtrl extends Controlador {

    /** TODO:
     * -GENERAR SINGLETON PARA MANEJO DE TIEMPO DE INACTIVIDAD DE USUARIO
     */
    
    /**
     * Busca un elemento en la base de datos y lo retorna como un arreglo de objetos. Cada registro es recibido como un objeto.
     * @param string $campo La columna en dónde buscar.
     * @param string $valor El valor a buscar.
     * @return array de Objetos
     */
    static public function buscarSesion($valor, $campo) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $valor = $conn->filterQueryInput($valor);
        $query = "SELECT * FROM sesiones WHERE $campo='$valor'";
        $sesiones = $conn->selectToObject($query, 'Sesiones');
        $conn->close();
        return $sesiones;
    }

    /**
     * Recibe como parametro un objeto sesiones y, en caso de no existir, lo agrega a la base de datos.
     * @param objeto $sesiones
     * @return boolean
     */
    static public function agregarSesion($sesiones) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->insertObject($sesiones, 'Sesiones');
        $conn->close();
        if ($resultado)
            return false;
        return true;
    }

    /**
     * Recibe como parametro un objeto sesiones y, en caso de existir, lo modifica en la base de datos.
     * @param objeto $sesiones
     * @return boolean
     */
    static public function actualizarSesion($sesiones) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->updateObject($sesiones, 'Sesiones');
        $conn->close();
        if (!$resultado)
            return false;
        return true;
    }

    /**
     * Recibe como parametro un objeto sesiones y, en caso de no existir, lo elimina de la base de datos.
     * @param objeto $sesiones
     * @return boolean
     */
    static public function borrarSesion($sesiones) {
//        require_once BASE_URI . "librerias/sqlserver_class.php";
        require_once BASE_URI . "librerias/mysql_class.php";
//        $conn = new SQLServer('gcmaster', 'w');
        $conn = new MySQL('gcdbmaster', 'w');
        $resultado = $conn->deleteObject($sesiones, 'Sesiones');
        $conn->close();
        if (!$resultado)
            return false;
        return true;
    }

    /**
     * Funcion para iniciar sesion.
     * @param string $usuario
     * @param string $clave
     * @return string|boolean Regresa un string con el resultado. En caso de ser satisfactoria, regresa "true" o "1".
     */
    static public function iniciarSesion($usuario, $clave) {
        // Comprueba que NO se haya iniciado sesion todavia;
        if (session_status() == PHP_SESSION_NONE) {
            require_once BASE_URI.'_controlador/usuarios_controlador.php';
            $usuarios = UsuariosCtrl::buscarUsuarios($usuario, 'id_usuario');
            if (!$usuarios || count($usuarios) == 0) {
                return 'no_usuario';
            } else {
                // Se extraen del objeto usuario los valores de id_usuario y clave:
                $usuario = $usuarios[0];
                $id_usuario = $usuario->getId_usuario();
                $clave = $usuario->getClave();
                if ($clave == $clave) {
                    // Inicio de session
                    session_start();
                    // Verifica si ya existe una sesión iniciada en la base de datos:
                    $sesiones = self::buscarSesion($id_usuario, 'id_usuario');
                    if (!$sesiones || count($sesiones) == 0) {
                        // Crea una nueva instancia de clase Sesiones en variable de session:
                        require_once BASE_URI.'_modelo/sesiones_modelo.php';
                        $_SESSION['sesion'] = new Sesiones();
                        $_SESSION['sesion']->setId_usuario($id_usuario);
                    } else {
                        // Inserta la sesion guardada en la base de datos en la variable de session:
                        $sesion = $sesiones[0];
                        $_SESSION['sesion'] = $sesion;
                    }
                    // Busca carrito en base de datos:
                    require_once BASE_URI.'_controlador/carritos_controlador.php';
                    $carritos = CarritosCtrl::buscarCarrito($id_usuario, 'id_usuario');
                    if (!$carritos || count($carritos) == 0) {
                        // Crea una nueva instancia de clase Carritos en variable de session:
                        require_once '_modelo/carritos_modelo.php';
                        $_SESSION['carrito'] = new Carritos();
                        $_SESSION['carrito']->setId_usuario($id_usuario);
                    } else {
                        // Carga el objeto carrito de la base de datos en la variable de session:
                        $carrito = $carritos[0];
                        $_SESSION['carrito'] = $carrito;
                    }
                    // Carga el objeto Usuario a la variable de session:
                    $_SESSION['usuario'] = $usuario;
                    // Agrega el log a objeto sesion:
                    $fecha = date('Y-m-d h:m:s');
                    $logTag = "<log><hora>$fecha</hora></log>";
                    $_SESSION['sesion']->addLog($logTag);
                    // Carga la hora de acceso a la variable de session:
                    // SINGLETON: TIEMPO DE INACTIVIDAD.
                    $_SESSION['log_hora'] = date('h:m:s');
                    return true;
                } else {
                    // En caso de que la clave de usuario no coincida.
                    return 'no_clave';
                }
            }
        } else {
            // En caso de que ya se haya iniciado sesion.
            return 'sesion_ya_iniciada';
        }
    }

    /**
     * Maneja el cierre de la sesion.
     * @return string|boolean Regresa un string con el resultado. En caso de ser satisfactoria, regresa "true" o "1".
     */
    static public function cerrarSesion() {
        // Comprueba si ya se ha iniciado sesion;
        if (session_status() == PHP_SESSION_ACTIVE) {
            $sesion = $_SESSION['sesion'];
            $carrito = $_SESSION['carrito'];
            session_destroy();
            $id_usuario = $sesion->getId_usuario();
            // Actualiza o crea la sesion en la base de datos:
            $sesiones = self::buscarSesion($id_usuario, 'id_usuario');
            if (!$sesiones || count($sesiones) == 0) {
                ////TRY CATCH
                self::agregarSesion($sesion);
            } else {
                ////TRY CATCH
                self::actualizarSesion($sesion);
            }
            // Actualiza o crea el carrito en la base de datos:
            require_once BASE_URI.'_controlador/carritos_controlador.php';
            $carritos = CarritosCtrl::buscarCarrito($id_usuario, 'id_usuario');
//            echo $carritos[0];
//            echo "<h1>carritos:".print_r($carritos)."</h1>";
            if (!$carritos || count($carritos) == 0) {
                ////TRY CATCH
                CarritosCtrl::agregarCarrito($carrito);
            } else {
                ////TRY CATCH
                CarritosCtrl::actualizarCarrito($carrito);
            }
            return true;
        } else {
            // En caso de que NO se haya iniciado sesion.
            return 'sesion_no_iniciada';
        }
    }

}
